<?php

namespace App\Repository\Transaction;

use App\Entity\Transaction\Skrd;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Psy\Util\Str;

class SalinSkrdRepository
{
    /**
     * Copy all selected skrd in storage
     *
     * @return void
     */
    public function copySkrds($skrdIds)
    {
        try {
            DB::beginTransaction();
            $skrds = Skrd::whereIn('id', $skrdIds)->get();
            foreach ($skrds as $skrd) {
                $skrd = Skrd::create([
                    'nomor' => $skrd->nomor,
                    'nomor_otomatis' => $skrd->nomor_otomatis,
                    'tanggal' => Carbon::parse($skrd->tanggal)->addYear(1),
                    'due_date' => $skrd->due_date,
                    'pemakai_id' => $skrd->pemakai_id,
                    'nominal' => $skrd->nominal_idr,
                    'keterangan' => $skrd->keterangan,
                    'object_retribusi_id' => $skrd->object_retribusi_id
                ]);
                if (!$skrd){
                    throw new Exception("Error while copying skrd");
                    
                }
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
        }
    }
}
