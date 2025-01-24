<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();

            $user = $this->userRepository->delete($id);

            DB::commit();

            return $user;
        } catch (Throwable $th) {
            DB::rollBack();
            logger()->error($th->getMessage());

            throw new Exception($th->getMessage());
        }

        DB::commit();

        return null;
    }

    public function all()
    {
        return $this->userRepository->all();
    }

    public function getById($id)
    {
        return $this->userRepository->getById($id);
    }

    public function update(Request $request, User $user)
    {
        try {
            DB::beginTransaction();

            $user = $this->userRepository->update($request, $user);

            DB::commit();

            return $user;
        } catch (\Throwable $th) {
            DB::rollBack();
            logger()->error($th->getMessage());

            throw new Exception($th->getMessage());
        }

        return null;
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $user = $this->userRepository->store($request);

            DB::commit();

            return $user;
        } catch (\Throwable $th) {
            DB::rollBack();
            logger()->error($th->getMessage());

            throw new Exception($th->getMessage());
        }

        return null;
    }

    public function totalCounts()
    {
        return $this->userRepository->totalCounts();
    }
}
