<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UsersDataTable;
use App\Enums\Gender;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    protected UserService $userService;
    protected RoleService $roleService;

    public function __construct(UserService $userService, RoleService $roleService)
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
    }

    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('admin.users.index');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(UserStoreRequest $request)
    {
        $request->validated();

        $user = $this->userService->store($request);

        if ($user) {
            return redirect()
                ->route('admin.users.index')
                ->withSuccess(__('messages.created', ['name' => __('app.user')]));
        }

        return redirect()
            ->back()
            ->withError(__('messages.not_created', ['name' => __('app.user')]))
            ->withInput();
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user = $this->userService->update($request, $user);

        if ($user) {
            return redirect()
                ->route('admin.users.index')
                ->withSuccess(__('messages.updated', ['name' => __('app.user')]));
        }

        return redirect()
            ->back()
            ->withError(__('messages.not_updated', ['name' => __('app.user')]));
    }

    public function destroy(User $user)
    {
        $user = $this->userService->delete($user->id);

        if ($user) {
            return redirect()
                ->route('admin.users.index')
                ->withSuccess(__('messages.deleted', ['name' => __('app.user')]));
        }

        return redirect()
            ->back()
            ->withError(__('messages.not_deleted', ['name' => __('app.user')]));
    }
}
