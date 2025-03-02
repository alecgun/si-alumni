<?php

namespace App\Services;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Exception;
use Illuminate\Support\Facades\DB;

class RoleService
{
    public function createRole($data)
    {
        DB::beginTransaction();
        try {
            $role = Role::create(['name' => $data['name']]);
            if (isset($data['permissions'])) {
                $permissions = Permission::whereIn('id', $data['permissions'])->get();
                $role->syncPermissions($permissions);
            }
            DB::commit();
            return ['status' => true, 'role' => $role];
        } catch (Exception $e) {
            DB::rollback();
            return ['status' => false, 'message' => 'Gagal membuat role: ' . $e->getMessage()];
        }
    }

    public function updateRole(Role $role, $data)
    {
        DB::beginTransaction();
        try {
            $role->update(['name' => $data['name']]);

            if (isset($data['permissions'])) {
                $role->permissions()->detach();
                $permissions = Permission::whereIn('id', $data['permissions'])->get();
                $role->syncPermissions($permissions);
            }

            DB::commit();
            return ['status' => true, 'role' => $role];
        } catch (Exception $e) {
            DB::rollback();
            return ['status' => false, 'message' => 'Gagal memperbarui role: ' . $e->getMessage()];
        }
    }

    public function deleteRole(Role $role)
    {
        DB::beginTransaction();
        try {
            $role->delete();
            DB::commit();
            return ['status' => true];
        } catch (Exception $e) {
            DB::rollback();
            return ['status' => false, 'message' => 'Gagal menghapus role: ' . $e->getMessage()];
        }
    }

    public function editRole($id)
    {
        try {
            $role = Role::with('permissions')->findOrFail($id);
            return [
                'status' => true,
                'data' => [
                    'id' => $role->id,
                    'name' => $role->name,
                    'permissions' => $role->permissions->pluck('id')->toArray()
                ]
            ];
        } catch (Exception $e) {
            return ['status' => false, 'message' => 'Gagal mengambil data role: ' . $e->getMessage()];
        }
    }

    public function getRoleQuery()
    {
        try {
            return Role::query();
        } catch (Exception $e) {
            return ['status' => false, 'message' => 'Gagal mengambil data role: ' . $e->getMessage()];
        }
    }

    public function searchRoles($query, $search)
    {
        try {
            return $query->where('name', 'like', "%{$search}%");
        } catch (Exception $e) {
            return ['status' => false, 'message' => 'Gagal mencari role: ' . $e->getMessage()];
        }
    }
}