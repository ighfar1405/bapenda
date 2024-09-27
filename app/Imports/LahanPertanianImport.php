<?php

namespace App\Imports;

use App\Entity\Transaction\Pertanian;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Mockery\Expectation;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class LahanPertanianImport implements
    ToCollection,
    WithHeadingRow,
    WithChunkReading
{
    /**
     * Retreive data from Command
     *
     * @param String $kelurahan
     */
    public function __construct()
    {
        //
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        try {
            DB::beginTransaction();

            foreach ($collection as $row) {
                // skip row if column name or address empty
                if (!$row['nama_penyewa'] || !$row['alamat'] || !$row['tanggal_sewa'])
                    continue;
                
                $tanggalSewa = Date::excelToDateTimeObject($row['tanggal_sewa']);
                $tanggalSewa = Carbon::instance($tanggalSewa)->format('Y-m-d');

                Log::info("{$row['no_urut']}. {$row['tanggal_sewa']}");
                // Pertanian::create([
                //     'no_perjanjian_sewa' => $row['nomor_sertifikat'],
                //     'nama_penyewa' => $row['nama_penyewa'],
                //     'lokasi' => sprintf('%s, %s', $row['alamat'], $row['letak_tanah']),
                //     'jenis_tanaman' => $row['jenis_tanaman'],
                //     'luas' => 1,
                //     'nominal' => $row['luas_m2'] * 6000000 / 10000,
                //     'tanggal_sewa' => $tanggalSewa,
                //     'status' => 'paid',
                //     'keterangan' => $row['keterangan']
                // ]);
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
}
