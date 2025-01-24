<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class RoleRepository
{
    /**
     * @var Role
     */
    protected Role $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function all($with, $withCounts)
    {
        return $this->role
            ->when($with, function ($query) use ($with) {
                $query->with($with);
            })
            ->when($withCounts, function ($query) use ($withCounts) {
                $query->withCount($withCounts);
            })
            ->get();
    }

    public function getById($id)
    {
        return $this->role->where('id', $id)->get();
    }

    public function store(Request $request)
    {
        $name = $request->name;
        $permissions = $request->permissions ?? [];

        $role = $this->role->create([
            'name' => $name,
            'slug' => Str::slug($name),
            'display_name' => $name,
            'description' => $name,
        ]);

        $permissions = Permission::whereIn('id', $permissions)->get();
        $role->syncPermissions($permissions);

        return $role->fresh();
    }

    public function update(Request $request, $role)
    {
        $name = $request->name;
        $permissions = $request->permissions ?? [];

        $role->update([
            'name' => $name,
        ]);

        $permissions = Permission::whereIn('id', $permissions)->get();
        $role->syncPermissions($permissions);

        return $role->fresh();
    }

    public function delete($id)
    {
        $role = $this->role->findOrFail($id);
        $role->delete();

        return $role;
    }
}
