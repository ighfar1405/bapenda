<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Roles pages.
     *
     * @return void
     */
    public function index()
    {
        $roles = Role::get();
        return view('role.index', compact('roles'));
    }

    /**
     * Assign role permission.
     *
     * @param int|string $id
     * @return void
     */
    public function permission($id)
    {
        $role = Role::with('permissions')->find($id);
        $permissions = Permission::get();

        return view('role.form_permission', compact('role', 'permissions'));
    }

    /**
     * Sync role to permissions
     *
     * @param Request
     * @param int|string $id
     * @return void
     */
    public function syncPermissions(Request $request, $id)
    {
        $role = Role::find($id);
        $role->syncPermissions($request->permissions);
        return redirect()->back()
            ->with('success', 'Role permissions berhasil disimpan');
    }
}
