<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CheckEmailController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $email = $request->email;
        $id = $request->id;

        $exists = User::where('email', $email)
            ->when($id, function ($query) use ($id) {
                $query->where('id', '!=', $id);
            })
            ->exists();

        if ($exists) {
            return 'false';
        }

        return 'true';
    }
}
