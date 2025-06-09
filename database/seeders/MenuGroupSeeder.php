<?php

namespace Database\Seeders;

use App\Models\MenuGroup;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class MenuGroupSeeder extends Seeder
{
    public function run()
    {
        // Create permissions for MenuGroups
        $dashboardPermission = Permission::where('name', 'dashboard')->first();
        $alumniPermission = Permission::where('name', 'alumni')->first();
        $ticketPermission = Permission::where('name', 'ticket')->first();
        $pengumumanPermission = Permission::where('name', 'pengumuman')->first();
        $settingPermission = Permission::where('name', 'setting')->first();

        MenuGroup::create([
            'nama_menu_group' => 'Dashboard',
            'icon_menu_group' => 'fas fa-tachometer-alt',
            'id_permission_menu_group' => $dashboardPermission->id,
        ]);

        MenuGroup::create([
            'nama_menu_group' => 'Alumni',
            'icon_menu_group' => 'fas fa-graduation-cap',
            'id_permission_menu_group' => $alumniPermission->id,
        ]);

        MenuGroup::create([
            'nama_menu_group' => 'Support Ticket',
            'icon_menu_group' => 'fas fa-question-circle',
            'id_permission_menu_group' => $ticketPermission->id,
        ]);

        MenuGroup::create([
            'nama_menu_group' => 'Pengumuman',
            'icon_menu_group' => 'fas fa-newspaper',
            'id_permission_menu_group' => $pengumumanPermission->id,
        ]);

        MenuGroup::create([
            'nama_menu_group' => 'Setting',
            'icon_menu_group' => 'fas fa-key',
            'id_permission_menu_group' => $settingPermission->id,
        ]);
    }
}
