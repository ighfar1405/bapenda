<?php

namespace App\Repository\Transaction;

use App\Entity\Transaction\Skrd;
use Carbon\Carbon;

class MonitoringPiutangRepository
{
    /**
     * Get all piutang
     *
     * @return Collection
     */
    public function getPiutang(array $attributes = [])
    {
        $year = date('Y');
        if( isset($attributes['year']))
            $year = $attributes['year'];

        return Skrd::with('objectRetribusi.pemakai', 'tbpDetail')
            ->whereHas('objectRetribusi.pemakai', function ($query) use ($attributes) {
                if( isset($attributes['keyword']))
                    $query->where('nama', 'like', '%' . $attributes['keyword'] . '%');
            })
            ->whereDoesntHave('tbpDetail')
            ->when($year, function($query) use ($year) {
                $date = Carbon::createFromDate($year, 01, 01);
                $startOfYear = $date->copy()->startOfYear();
                $endOfYear = $date->copy()->endOfYear();

                $query->whereBetween('tanggal', [$startOfYear, $endOfYear]);
            })
            ->when(isset($attributes['id']), function($query) use ($attributes) {
                $query->where('id', $attributes['id']);
            })
            ->get();
    }

    /**
     * Get all piutang with pagiate
     *
     * @return Collection
     */
    public function getPiutangPaginate(array $attributes = [])
    {
        $year = date('Y');
        if( isset($attributes['year']))
            $year = $attributes['year'];

        $skrd = Skrd::with('objectRetribusi.pemakai', 'objectRetribusi.kelurahan', 'tbpDetail')
            ->whereHas('objectRetribusi.pemakai', function ($query) use ($attributes) {
                if( isset($attributes['keyword']))
                    $query->where('nama', 'like', '%' . $attributes['keyword'] . '%');
            })
            ->whereHas('objectRetribusi.kelurahan', function ($query) use ($attributes) {
                if( isset($attributes['kecamatan']))
                    $query->where('kecamatan_id', '=', $attributes['kecamatan']);
            })
            ->whereDoesntHave('tbpDetail')
            ->when($year, function($query) use ($year) {
                $date = Carbon::createFromDate($year, 01, 01);
                $startOfYear = $date->copy()->startOfYear();
                $endOfYear = $date->copy()->endOfYear();

                $query->whereBetween('tanggal', [$startOfYear, $endOfYear]);
            });
        $sum = $skrd->sum('nominal');
        $skrd = $skrd->paginate(10);
        $skrd->total_nominal = $sum;
        
        return $skrd;
    }
}