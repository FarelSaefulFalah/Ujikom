<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus cache permission untuk mencegah error duplikasi
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Pastikan role "user" dan "superadmin" dibuat dengan guard "web"
        $superadminRole = Role::firstOrCreate(['name' => 'superadmin', 'guard_name' => 'web']);
        $userRole = Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);

        // Daftar permissions
        $permissions = [
            'index-dashboard',
            'index-product',
            'create-product',
            'delete-product',
            'update-product',
            'index-user',
            'create-user',
            'delete-user',
            'update-user',
        ];

        // Buat permission jika belum ada
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Berikan semua permissions ke Superadmin
        $superadminRole->syncPermissions($permissions);

        // **Membuat Superadmin jika belum ada**
        $superadmin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'], // Cek berdasarkan email
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'), // Ganti dengan password yang aman
            ]
        );

        // Berikan role Superadmin ke user (dipastikan user memiliki role ini)
        $superadmin->syncRoles(['superadmin']);

        $this->command->info("Role & permission berhasil dibuat!");
    }
}
