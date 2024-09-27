<?php

namespace App\Repository;

use App\Entity\ListOpd;
use Illuminate\Support\Collection;

class ListOpdRepository
{
    /**
     * Return all ListOpd
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return ListOpd::orderBy('id', 'desc')->get();
    }

    /**
     * Get all ListOpd with pagination.
     *
     * @param array $attributes
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function allPaginate(array $attributes)
    {
        $keyword = $attributes['keyword'] ?? null;

        return ListOpd::orderBy('created_at', 'desc')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('nama_opd', 'like', '%' . $keyword . '%')
                    ->orWhere('jenis_retribusi', 'like', '%' . $keyword . '%');
            })
            ->paginate(10);
    }

    /**
     * Get ListOpd by id
     *
     * @param int $id
     * @return ListOpd
     */
    public function find(int $id): ListOpd
    {
        return ListOpd::findOrFail($id);
    }

    /**
     * Create ListOpd.
     *
     * @param array $attributes
     * @return ListOpd
     */
    public function create(array $attributes): ListOpd
    {
        return ListOpd::create([
            'nama_opd'               => $attributes['nama_opd'],
            'jenis_retribusi'        => $attributes['jenis_retribusi'],
            'objek_retribusi'        => $attributes['objek_retribusi'],
            'rincian_objek'          => $attributes['rincian_objek'] ?? null,
            'sub_rincian_objek'      => $attributes['sub_rincian_objek'] ?? null,
            'sub_sub_rincian_objek'  => $attributes['sub_sub_rincian_objek'] ?? null,
            'detail_rincian'         => $attributes['detail_rincian'] ?? null,
            'tarif'                  => $attributes['tarif'] ?? null,
            'satuan'                 => $attributes['satuan'],
            'status'                 => $attributes['status'],
            'link'                   => $attributes['link'] ?? null,
        ]);
    }

    /**
     * Update ListOpd.
     *
     * @param int $id
     * @param array $attributes
     * @return bool
     */
    public function update(int $id, array $attributes): bool
    {
        $listOpd = $this->find($id);

        return $listOpd->update([
            'nama_opd'               => $attributes['nama_opd'],
            'jenis_retribusi'        => $attributes['jenis_retribusi'],
            'objek_retribusi'        => $attributes['objek_retribusi'],
            'rincian_objek'          => $attributes['rincian_objek'] ?? null,
            'sub_rincian_objek'      => $attributes['sub_rincian_objek'] ?? null,
            'sub_sub_rincian_objek'  => $attributes['sub_sub_rincian_objek'] ?? null,
            'detail_rincian'         => $attributes['detail_rincian'] ?? null,
            'tarif'                  => $attributes['tarif'] ?? null,
            'satuan'                 => $attributes['satuan'],
            'status'                 => $attributes['status'],
            'link'                   => $attributes['link'] ?? null,
        ]);
    }

    /**
     * Delete ListOpd.
     *
     * @param int $id
     * @return bool|null
     * @throws \Exception
     */
    public function delete(int $id): ?bool
    {
        $listOpd = $this->find($id);
        return $listOpd->delete();
    }
}
