<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionMenuSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            'dashboard', 'setting', 'alumni',
            'user.index', 'user.create', 'user.edit', 'user.delete',
            'role.index', 'role.create', 'role.edit', 'role.delete', 'log.aktivitas.index',
            'alumni.index', 'alumni.create', 'alumni.edit', 'alumni.delete',
            'kuliah.index', 'kuliah.create', 'kuliah.edit', 'kuliah.delete',
            'kerja.index', 'kerja.create', 'kerja.edit', 'kerja.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
