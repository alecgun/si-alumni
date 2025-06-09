<?php

namespace Database\Seeders;

use App\Models\MenuGroup;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class MenuItemSeeder extends Seeder
{
    public function run()
    {
        $settingGroup = MenuGroup::where('nama_menu_group', 'Setting')->first();
        $alumniGroup = MenuGroup::where('nama_menu_group', 'Alumni')->first();

        $this->createMenuItem('Data Alumni', $alumniGroup, [
            'alumni.index', 'alumni.create', 'alumni.edit', 'alumni.delete',
        ], 'alumni.index');

        $this->createMenuItem('User', $settingGroup, [
            'user.index', 'user.create', 'user.edit', 'user.delete', 'user.show', 'user.export',
        ], 'user.index');

        $this->createMenuItem('Role', $settingGroup, [
            'role.index', 'role.create', 'role.edit', 'role.delete',
        ], 'role.index');

        $this->createMenuItem('Activity Log', $settingGroup, [
            'log.aktivitas.index',
        ], 'log.aktivitas.index');
    }

    private function createMenuItem($name, $group, $permissionNames, $primaryPermissionName)
    {
        $permissions = Permission::whereIn('name', $permissionNames)->get();
        $primaryPermission = $permissions->firstWhere('name', $primaryPermissionName);

        MenuItem::create([
            'nama_menu_item' => $name,
            'id_menu_group' => $group->id_menu_group,
            'id_permission_menu_item' => $primaryPermission->id,
            'list_permission_menu_item' => json_encode(
                $permissions->map(function ($permission) {
                    return ['id' => $permission->id, 'name' => $permission->name];
                })->toArray()
            ),
        ]);
    }
}
