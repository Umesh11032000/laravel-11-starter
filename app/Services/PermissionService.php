<?php

namespace App\Services;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionService
{
    public function all($grouped = false)
    {
        $permission = Permission::query()
            ->get();
        
        if ($grouped) {
            $permission = $permission->groupBy('collection_name');
        }

        return $permission;
    }
}