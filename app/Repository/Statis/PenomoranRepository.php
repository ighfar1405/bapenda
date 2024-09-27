<?php

namespace App\Repository\Statis;

use App\Entity\Statis\Penomoran;

class PenomoranRepository
{
    /**
     * Get all Penomoran.
     *
     * @return Collection
     */
    public function all(array $attributes = [])
    {
        #   set the default value of the array key
        $params = ['sort_formulir'];

        foreach ($params as $value) {
            if (!array_key_exists($value, $attributes)) {
                $attributes[$value] = null;
            }
        }
        
        $data = Penomoran::when($attributes['sort_formulir'] == 'desc', function ($q) {
                $q->orderBy('formulir', 'desc');
            })
            ->get();

        return $data;
    }

    /**
     * Get Penomoran by id
     *
     * @param [int] $id
     * @return Penomoran
     */
    public function find($id)
    {
        return Penomoran::find($id);
    }

    /**
     * Create Penomoran.
     *
     * @param array $attributes
     * @return Penomoran
     */
    public function create(array $attributes)
    {
        return Penomoran::create([
            'formulir' => $attributes['formulir'], 
            'format_penomoran' => $attributes['format_penomoran']
        ]);
    }

    /**
     * Edit Penomoran.
     *
     * @param int|string $id
     * @param array $attributes
     * @return Penomoran
     */
    public function update($id, array $attributes)
    {
        return Penomoran::findOrFail($id)->update([
            'formulir' => $attributes['formulir'],
            'format_penomoran' => $attributes['format_penomoran']
        ]);
    }

    /**
     * Delete Penomoran.
     *
     * @param int|string $id
     * @return Penomoran
     */
    public function delete($id)
    {
        return Penomoran::findOrFail($id)->delete();
    }
}
