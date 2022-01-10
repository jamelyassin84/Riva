<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function change_password(Request $request)
    {
        $data = (object) $request->all();
        $user = $request->user();
        $seller = Seller::where('user_id', $user->id)
            ->first();

        if (empty($seller)) {
            return response('This account has been moved or deleted ', 401);
        }

        if (!Hash::check($data->oldPassword, $seller['password'])) {
            return  response('Invalid Password', 300);
        }

        $seller->password = $data->newPassword;
        return $seller->save();
    }

    public function change_details(Request $request)
    {
        $data = (object) $request->all();
        $user = $data->user();
        $user->email = $data->email;
        return $user->save();
    }
}
