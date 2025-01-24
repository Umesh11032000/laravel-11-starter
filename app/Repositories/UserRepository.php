<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Enums\Gender;
use App\Enums\UserStatus;
use App\Events\UserCreated;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserRepository
{
    /**
     * @var Role
     */
    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function all()
    {
        return $this->user->get();
    }

    public function getById($id)
    {
        return $this->user->where('id', $id)->get();
    }

    public function store(Request $request)
    {
        $first_name = $request->first_name;
        $middle_name = $request->middle_name;
        $last_name = $request->last_name;
        $email = $request->email;
        $username = $request->email;
        $password = $request->password ?? Str::random(8);
        $mobile_number = $request->mobile_number;
        $gender = Gender::from($request->gender);
        $date_of_birth = $request->date_of_birth;
        $address = $request->address ?? '';
        $state_id = $request->state_id ?? NULL;
        $city_id = $request->city_id ?? NULL;

        $user = $this->user->create([
            'first_name' => $first_name,
            'middle_name' => $middle_name,
            'last_name' => $last_name,
            'email' => $email,
            'username' => $username,
            'password' => $password,
            'mobile_number' => $mobile_number,
            'gender' => $gender,
            'date_of_birth' => $date_of_birth,
            'address' => $address,
            'email_verified_at' => now(),
            'state_id' => $state_id,
            'city_id' => $city_id
        ]);

        $role = Role::findOrFail($request->role_id);
        $user->assignRole($role);

        event(new UserCreated($user, $password));

        return $user->fresh();
    }

    public function update(Request $request, $user)
    {
        $first_name = $request->first_name;
        $middle_name = $request->middle_name;
        $last_name = $request->last_name;
        $email = $request->email;
        $username = $request->email;
        $mobile_number = $request->mobile_number;
        $gender = Gender::from($request->gender);
        $date_of_birth = $request->date_of_birth;
        $address = $request->address ?? '';
        $state_id = $request->state_id ?? NULL;
        $city_id = $request->city_id ?? NULL;

        $user->update([
            'first_name' => $first_name,
            'middle_name' => $middle_name,
            'last_name' => $last_name,
            'email' => $email,
            'username' => $username,
            'mobile_number' => $mobile_number,
            'gender' => $gender,
            'date_of_birth' => $date_of_birth,
            'address' => $address,
            'state_id' => $state_id,
            'city_id' => $city_id
        ]);

        return $user->fresh();
    }

    public function delete($id)
    {
        $user = $this->user->findOrFail($id);
        $user->delete();

        return $user;
    }

    public function totalCounts()
    {
        return $this->user->query()
            ->select(
                DB::raw('COUNT(*) as total_users'),
                DB::raw('SUM(CASE WHEN status = "' . UserStatus::ACTIVE->value() . '" THEN 1 ELSE 0 END) as active_users'),
                DB::raw('SUM(CASE WHEN status = "' . UserStatus::INACTIVE->value() . '" THEN 1 ELSE 0 END) as inactive_users')
            )->first();
    }
}
