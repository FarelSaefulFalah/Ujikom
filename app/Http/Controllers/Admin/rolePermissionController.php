<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;

class rolePermissionController extends Controller
{
    // Tampilkan halaman manajemen role dan permission
    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.roles.index', compact('roles', 'permissions'));
    }

    // Tambahkan role baru
public function store(Request $request)
{
    $request->validate([
        'role_name' => 'required|unique:roles,name',
    ]);

    // Create the role
    $role = Role::create(['name' => $request->role_name]);

    // Assign permissions to the role (sinkronkan)
    if ($request->has('permissions')) {
        $role->syncPermissions($request->permissions); // Sync dengan permission yang dipilih
    }

    return redirect()->route('admin.roles.index')->with('success', 'Role berhasil dibuat!');
}

    // Tambahkan permission baru dan tetapkan ke role
    public function storePermission(Request $request)
    {
    $request->validate([
        'role_id' => 'required|exists:roles,id',
        'permissions' => 'array',
    ]);

    $role = Role::find($request->role_id);

    // Hapus semua permission lama dan tambahkan yang baru
    $role->syncPermissions($request->permissions);

    return redirect()->route('admin.roles.index')->with('success', 'Permission berhasil diperbarui!');
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'role_name' => 'required',
    ]);

    // Find the role
    $role = Role::findOrFail($id);

    // Update the role name
    $role->update(['name' => $request->role_name]);

    // Validate that all permission names exist
    $validPermissions = Permission::whereIn('name', $request->permissions)->get();

    // Sync permissions to the role
    $role->syncPermissions($validPermissions);

    return redirect()->route('admin.roles.index')->with('success', 'Role berhasil diperbarui!');
}


}
