<?php

namespace App\Services;

use App\Repositories\RoleRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Throwable;

class RoleService
{
    private RoleRepository $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();

            $role = $this->roleRepository->delete($id);

            DB::commit();

            return $role;
        } catch (Throwable $th) {
            DB::rollBack();
            logger()->error($th->getMessage());

            throw new Exception($th->getMessage());
        }

        DB::commit();

        return null;
    }

    public function all($with, $withCounts)
    {
        return $this->roleRepository->all($with, $withCounts);
    }

    public function getById($id)
    {
        return $this->roleRepository->getById($id);
    }

    public function update(Request $request, Role $role)
    {
        try {
            DB::beginTransaction();

            $role = $this->roleRepository->update($request, $role);

            DB::commit();

            return $role;
        } catch (\Throwable $th) {
            DB::rollBack();
            logger()->error($th->getMessage());

            throw new Exception($th->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $role = $this->roleRepository->store($request);

            DB::commit();

            return $role;
        } catch (\Throwable $th) {
            DB::rollBack();
            logger()->error($th->getMessage());

            throw new Exception($th->getMessage());
        }

        return null;
    }
}
