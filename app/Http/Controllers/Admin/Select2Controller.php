<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class Select2Controller extends Controller
{
    public function roles(Request $request)
    {
        $q = $request->search ?? '';

        $roles = Role::query()
            ->when($q, function ($query) use ($q) {
                return $query->where('name', 'like', "%$q%");
            })
            ->select('id', 'name as text')
            ->get();

        return response()->json($roles);
    }

    public function states(Request $request)
    {
        $q = $request->search ?? '';

        $states = State::query()
            ->when($q, function ($query) use ($q) {
                return $query->where('name', 'like', "%$q%");
            })
            ->select('id', 'name as text')
            ->get();

        return response()->json($states);
    }

    public function cities(Request $request)
    {
        $q = $request->search ?? '';
        $state_id = $request->state_id;

        if (!$state_id) {
            return response()->json([]);
        }

        $cities = City::query()
            ->when($q, function ($query) use ($q) {
                return $query->where('name', 'like', "%$q%");
            })
            ->when($state_id, function ($query) use ($state_id) {
                return $query->where('state_id', $state_id);
            })
            ->select('id', 'name as text')
            ->get();

        return response()->json($cities);
    }
}
