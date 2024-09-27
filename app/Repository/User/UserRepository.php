<?php

namespace App\Repository\User;

use Hash;
use App\Entity\User\User;
use \Illuminate\Support\Facades\DB;

class UserRepository
{
    /**
     * Get all users.
     *
     * @return Collection
     */
    public function all()
    {
        return User::get();
    }

    /**
     * Find user by id.
     *
     * @param int|string
     * @return User
     */
    public function find($id)
    {
        return User::find($id);
    }

    /**
     * Create user.
     *
     * @param array $attributes
     * @return User
     */
    public function create(array $attributes)
    {
        User::create([
            'name' => $attributes['nama'],
            'username' => $attributes['username'],
            'email' => $attributes['email'],
            'password' => Hash::make($attributes['password'])
        ]);

        $db = User::where('username', $attributes['username'])
            ->where('email',$attributes['email'])
            ->where('name', $attributes['nama'])
            ->first();

        DB::table('model_has_roles')->insert([
            'role_id'    => $attributes['hak_akses'],
            'model_type' => 'App\Entity\User\User',
            'model_id'   => $db->id
        ]);

        return $db;
    }

    /**
     * Edit user.
     *
     * @param int|string $id
     * @param array $attributes
     * @return User
     */
    public function update($id, array $attributes)
    {
        $user = User::findOrFail($id);
        $user->update([
            'name' => $attributes['nama'],
            'username' => $attributes['username'],
            'email' => $attributes['email']
        ]);

        if (isset($attributes['password'])) {
            if ($attributes['password']) {
                $user->update(['password' => Hash::make($attributes['password'])]);
            }
        }

        DB::table('model_has_roles')->where('model_id', $user->id)->update([
            'role_id' => $attributes['hak_akses']
        ]);

        return $user;
    }

    /**
     * Delete user.
     *
     * @param int|string $id
     * @return User
     */
    public function delete($id)
    {
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        return User::findOrFail($id)->delete();
    }
}
