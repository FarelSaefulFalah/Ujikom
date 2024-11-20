<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class rolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Buat atau perbarui role superadmin
        $superadminRole = Role::updateOrCreate(['name' => 'superadmin']);
        // $karyawanRole = Role::updateOrCreate(['name' => 'karyawan']);

        // Daftar semua permissions
        $permissions = [
            'index-dashboard',
            'index-product',
            'create-product',
            'delete-product',
            'update-product',
            'index-kategori',
            'create-kategori',
            'delete-kategori',
            'update-kategori',
            'index-pemasok',
            'create-pemasok',
            'delete-pemasok',
            'update-pemasok',
            'index-kendaraan',
            'create-kendaraan',
            'delete-kendaraan',
            'update-kendaraan',
            'index-stock',
            'create-stock',
            'index-permission',
            'create-permission',
            'delete-permission',
            'update-permission',
            'index-role',
            'create-role',
            'delete-role',
            'update-role',
            'index-user',
            'create-user',
            'delete-user',
            'update-user',
            'index-permintaan',
            'create-permintaan',
            'index-rent',
            'create-rent',
            'index-transaction',
            'create-transaction',
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission]);
        }
        $superadminRole->syncPermissions($permissions);

        

        // $karyawanPermissions = [
        //     'index-dashboard',
        //     'index-product',
        //     'index-kendaraan',

        // ];

        // foreach ($karyawanPermissions as $permission) {
        //     Permission::firstOrCreate(['name' => $permission]);
        // }
        // $karyawanRole->syncPermissions($karyawanPermissions);
    }
}
