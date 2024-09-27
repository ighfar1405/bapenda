<?php

namespace App\Imports;

use DB;
use Exception;
use App\Entity\User\Pemakai;
use Illuminate\Support\Collection;
use App\Entity\Master\ObjekRetribusi;
use App\Entity\Master\TarifRetribusi;
use App\Entity\Master\KlasifikasiPemakaian;
use App\Entity\Master\Kelurahan;
use App\Entity\Statis\Akun;
use App\Entity\Statis\RekeningBank;
use App\Entity\Transaction\JenisPembayaran;
use App\Entity\Transaction\Tbp;
use App\Repository\Transaction\TbpRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Mockery\Expectation;

class ObjectRetribusiImport implements
    ToCollection,
    WithHeadingRow,
    WithChunkReading
{
    /**
     * Kelurahan Property
     *
     * @var String
     */
    private $kelurahan;

    /**
     * Year Property
     *
     * @var String
     */
    private $year;

    /**
     * Retreive data from Command
     *
     * @param String $kelurahan
     */
    public function __construct(string $kelurahan)
    {
        $this->kelurahan = $kelurahan;
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $number = '1234567890';
        $str = 'LNJSDBNFKSFKJBU2KHBES8';

        try {
            DB::beginTransaction();
            $kelurahan = Kelurahan::where('nama', $this->kelurahan)->first();
            if(!$kelurahan)
                throw new Exception('Kelurahan tidak ditemukan.');

            $bankJatim = RekeningBank::where('nama_bank', 'Bank Jatim')->first();
            if(!$bankJatim)
                throw new Exception('Rekening Bank Jatim tidak ditemukan.');

            $akunBendahara = Akun::where('kode', '1.1.1.03.60')->first();
            if(!$bankJatim)
                throw new Exception('Kas Bank di Bendahara Penerimaan tidak ditemukan.');

            $jenisPembayaran = JenisPembayaran::where('kode_jurnal', 'TBP-OA')->first();
            if(!$jenisPembayaran)
                throw new Exception('Jenis Pembayaran TBP-OA tidak ditemukan.');
            
            foreach ($collection as $row) {
                // skip row if column name or address empty
                if (!$row['nama_wajib_retribusi'] || !$row['alamat_wajib_retribusi'])
                    continue;

                $jenisKlasifikasi = ucfirst(strtolower(trim($row['klasifikasi'])));
                $klasifikasi = KlasifikasiPemakaian::where('jenis_klasifikasi', $jenisKlasifikasi)->first();
                if(!$klasifikasi)
                {
                    // return Log::info("{$row['no_urut']}. Jenis klasifikasi {$jenisKlasifikasi} tidak ditemukan.");
                    // throw new Exception("{$row['no_urut']}. Jenis klasifikasi {$jenisKlasifikasi} tidak ditemukan.");
                    $this->appendFile(sprintf('%s %s', $this->kelurahan, $row['tahun']), "No Urut {$row['no_urut']}. Jenis klasifikasi {$jenisKlasifikasi} tidak ditemukan.");
                    // return true;
                    continue;
                }

                $tarifRetribusi = TarifRetribusi::where([
                    ['tarif_meter',$row['tarif_retribusi_rp']],
                    ['klasifikasi_pemakaian_id', $klasifikasi->id],
                ])->first();

                if(!$tarifRetribusi)
                {
                    // Log::info("{$row['no_urut']}. Tarif tidak ditemukan");
                    // throw new Exception("{$row['no_urut']}. Tarif tidak ditemukan");
                    $this->appendFile(sprintf('%s %s', $this->kelurahan, $row['tahun']), "No Urut {$row['no_urut']}. Tarif tidak ditemukan");
                    // return true;
                    continue;
                }

                $pemakai = Pemakai::where('nama', $row['nama_wajib_retribusi'])->first();
                $lastPemakai = Pemakai::orderBy('id', 'desc')->first();
                $noUrut = 0;

                if (! $lastPemakai)
                    $noUrut = 1;
                else
                    $noUrut = $lastPemakai->no_urut + 1;

                if (! $pemakai) {
                    $pemakai = Pemakai::create([
                        'no_urut' => $noUrut,
                        'kelurahan_id' => $kelurahan->id,
                        'nama' => $row['nama_wajib_retribusi'],
                        // 'no_telp' => '08' . substr(str_shuffle($number), 0, 10), // sementara random
                        'no_telp' => null,
                        'alamat' => $row['alamat_wajib_retribusi'],
                        'nik' => $row['no_sk']
                    ]);
                }

                /** Select Objek Retribusi */
                /** Format: Kode Administratif Kelurahan + No Urut */
                $kodeObjek = $kelurahan->kode_administratif . $noUrut;
                $objectRetribusi = ObjekRetribusi::where([
                    'lokasi' => trim($row['alamat_wajib_retribusi']),
                    'luas' => $row['luas_m2'],
                    'kelurahan_id' => $kelurahan->id,
                ])->first();

                if(!$objectRetribusi)
                {
                    /** Create if not exists: Objek Retribusi */
                    $objectRetribusi = $pemakai->objectRetribusi()->create([
                        // 'kode' => substr(str_shuffle($str), 0, 5), // random str sementara
                        'kode' => $kodeObjek,
                        'lokasi' => $row['lokasi_obyek_retribusi'],
                        'kelurahan_id' => $kelurahan->id,
                        'luas' => $row['luas_m2'],
                        'tarif_retribusi_id' => $tarifRetribusi->id,
                        'tarif' => $row['tarif_retribusi_rp'] * $row['luas_m2']
                    ]);
                }

                $nominalBayar = $row['tarif_retribusi_rp'] * $row['luas_m2'];

                /** Create: SKRD */
                $skrd = $pemakai->skrd()->create([
                    'nomor' => $noUrut,
                    'nomor_otomatis' => 1,
                    'tanggal' => sprintf('%s-01-01', $row['tahun']),
                    'keterangan' => '-',
                    'nominal' => $nominalBayar,
                    'object_retribusi_id' => $objectRetribusi->id,
                ]);
                    
                /** Create: TBP with conditional. If, has attribute 'status_bayar' equal than 'lunas' */
                if( strtolower($row['status_bayar']) == 'lunas')
                {
                    $tbpRepository = app(TbpRepository::class);
                    
                    $tbpData = [
                        'tanggal' => sprintf('%s-01-01', $row['tahun']),
                        'kas_bank' => $bankJatim->id,
                        'bendahara' => $akunBendahara->id,
                        'pemakai' => $pemakai->id,
                        'keterangan' => "TBP tahun {$row['tahun']}",
                        'skrd' => [ $skrd->id ],
                        'nominal_bayar' => [ $nominalBayar ],
                        'jenis_pembayaran' => [ $jenisPembayaran->id ],
                    ];

                    $tbpRepository->create(
                        $tbpData, 
                        Tbp::JENIS_SKRD,
                        $tbpRepository->getLastNomor(),
                        true
                    );
                }
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }
    }

    /**
     * Chunk size.
     *
     * @return int
     */
    public function chunkSize() : int
    {
        return 100;
    }

    /**
     * Debugging with storage
     *
     * @param string $fileName
     * @param string $content
     * @return void
     */
    private function appendFile(string $fileName, string $content)
    {
        Storage::disk('local')->append($fileName, $content);
    }
}
