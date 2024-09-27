<?php

namespace App\Repository\User;

use App\Entity\Master\ObjekRetribusi;
use DB;
use Exception;
use App\Entity\User\Pemakai;
use App\Repository\Master\ObjectRetribusiRepository;

class PemakaiRepository
{
    /**
     * Get all pemakai with pagination.
     *
     * @return Collection
     */
    public function allPaginate(array $attributes = [])
    {
        $keyword = null;

        if($attributes['keyword'])
            $keyword = $attributes['keyword'];

        #   set the default value of the array key
        $params = [
            'sort_nama',
            'sort_kecamatan'
        ];

        foreach ($params as $value) {
            if (!array_key_exists($value, $attributes)) {
                $attributes[$value] = null;
            }
        }

        return Pemakai::with([
                    'kelurahan',
                    'skrd' => function ($query) {
                        $query->doesntHave('tbpDetail');
                    },
                    'objectRetribusi.tarifRetribusi.klasifikasiPemakaian'
                ])
                ->when($keyword, function ($query) use ($keyword) {
                    if($keyword)
                    $query->where('nama', 'like', '%' . $keyword . '%');
                })
                ->when($attributes['sort_nama'] == 'desc', function ($q) {
                    $q->orderBy('nama', 'desc');
                }, function ($q) {
                    $q->orderBy('nama', 'asc');
                })
                #->orderBy('no_urut', 'asc')
                ->paginate(10);
    }

    /**
     * Get all pemakai.
     *
     * @return Collection
     */
    public function all()
    {
        return Pemakai::with([
                    'kelurahan',
                    'skrd' => function ($query) {
                        $query->doesntHave('tbpDetail');
                    },
                    'objectRetribusi.tarifRetribusi.klasifikasiPemakaian'
                ])
                ->orderBy('no_urut', 'asc')
                ->get();
    }

    /**
     * Find pemakai by id.
     *
     * @param int|string
     * @return Pemakai
     */
    public function find($id)
    {
        return Pemakai::with('kelurahan')->findOrFail($id);
    }

    /**
     * Create pemakai.
     *
     * @param array $attributes
     * @return Pemakai
     */
    public function create(array $attributes)
    {
        $num = 0;
        $lastRow = Pemakai::orderBy('id', 'desc')->first();
        if (! $lastRow) $num = 1;
        else $num = $lastRow->no_urut + 1;

        return Pemakai::create([
            'no_urut' => $num,
            'kelurahan_id' => $attributes['kelurahan'],
            'nama' => $attributes['nama'],
            'nik' => $attributes['nik'],
            'alamat' => $attributes['alamat'],
            'no_telp' => $attributes['telepon'],
            'kode_arsip' => $attributes['kode_arsip'],
        ]);
    }

    /**
     * Edit pemakai.
     *
     * @param int|string $id
     * @param array $attributes
     * @return Pemakai
     */
    public function update($id, array $attributes)
    {
        return Pemakai::findOrFail($id)->update([
            'kelurahan_id' => $attributes['kelurahan'],
            'nama' => $attributes['nama'],
            'nik' => $attributes['nik'],
            'alamat' => $attributes['alamat'],
            'no_telp' => $attributes['telepon'],
            'kode_arsip' => $attributes['kode_arsip'],
        ]);
    }

    /**
     * Delete pemakai.
     *
     * @param int|string $id
     * @return Pemakai
     */
    public function delete($id)
    {
        try {
            DB::beginTransaction();

            $objectRetribusi = ObjekRetribusi::where('pemakai_id', $id)->exists();

            if ($objectRetribusi){
                return false;
            }

            $pemakai = Pemakai::findOrFail($id);
            $number = $pemakai->no_urut;
            Pemakai::where('no_urut', '>', $number)->decrement('no_urut');

            DB::commit();

            return $pemakai->delete();
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Get pemakai by name.
     *
     * @param string $name
     * @return Collection
     */
    public function getPemakaiByName($name, $tanggal)
    {
        if($name === '') {
            return [];
        }

        return Pemakai::with([
                    'kelurahan',
                    'skrd' => function ($query) use ($tanggal) {
                        $query->doesntHave('tbpDetail')
                            ->where('tanggal', $tanggal);
                    },
                    'objectRetribusi.tarifRetribusi.klasifikasiPemakaian'
                ])
                ->where('nama', 'like', '%'. $name . '%')
                ->limit(20)
                ->get();
    }
    public function getPemakaiByNameTbp($name, $tanggal)
    {
        if($name === '') {
            return [];
        }

        // $tanggal1 = '01-01-2012';
        // $name1 = 'IRINE';
        return Pemakai::with([
                    'kelurahan',
                    'skrd' => function ($query) use ($tanggal) {
                        $query->doesntHave('tbpDetail')
                        // ->where('tanggal', $tanggal1);
                            ->whereRaw("tanggal >= ".$tanggal." ");
                    },
                    'objectRetribusi.tarifRetribusi.klasifikasiPemakaian'
                ])
                ->where('nama', 'like', '%'. $name . '%')
                ->orWhere('alamat', 'like', '%'. $name . '%')
                ->limit(20)
                ->get();
        // return Pemakai::leftjoin('skrd','pemakai.id','skrd.pemakai_id')
        //                 ->leftjoin('tbp','pemakai.id','tbp.pemakai_id')
        //                 ->whereRaw("skrd.tanggal >= ".$tanggal." AND pemakai.nama like '%".$name."%' ")
        //                 ->get();
    }
}
