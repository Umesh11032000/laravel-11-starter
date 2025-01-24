<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\RolesDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Services\PermissionService;
use App\Services\RoleService;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    protected RoleService $roleService;
    protected PermissionService $permissionService;

    public function __construct(RoleService $roleService, PermissionService $permissionService)
    {
        $this->roleService = $roleService;
        $this->permissionService = $permissionService;
    }

    public function index(RolesDataTable $dataTable)
    {
        return $dataTable->render('admin.roles.index');
    }

    public function create()
    {
        $permissions = $this->permissionService->all(true);

        return view('admin.roles.create', compact('permissions'));
    }

    public function store(RoleStoreRequest $request)
    {
        $request->validated();

        $user = $this->roleService->store($request);

        if ($user) {
            return redirect()
                ->route('admin.roles.index')
                ->withSuccess(__('messages.created', ['name' => __('app.role')]));
        }

        return redirect()
            ->back()
            ->withError(__('messages.not_created', ['name' => __('app.role')]))
            ->withInput();
    }

    public function edit(Role $role)
    {
        $permissions = $this->permissionService->all(true);
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function update(RoleUpdateRequest $request, Role $role)
    {
        $user = $this->roleService->update($request, $role);

        if ($user) {
            return redirect()
                ->route('admin.roles.index')
                ->withSuccess(__('messages.updated', ['name' => __('app.user')]));
        }

        return redirect()
            ->back()
            ->withError(__('messages.not_updated', ['name' => __('app.user')]));
    }

    public function destroy(Role $role)
    {
        $user = $this->roleService->delete($role->id);

        if ($user) {
            return redirect()
                ->route('admin.roles.index')
                ->withSuccess(__('messages.deleted', ['name' => __('app.user')]));
        }

        return redirect()
            ->back()
            ->withError(__('messages.not_deleted', ['name' => __('app.user')]));
    }
}
