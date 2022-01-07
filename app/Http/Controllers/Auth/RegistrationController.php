<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class RegistrationController extends Controller
{
    public static function register(Request $request)
    {
        $user = $request->validate([
            'mode' => ['required'],
        ]);

        if ($user['mode'] === 'Default') {
            $user = $request->validate([
                'name' => ['required', 'min:8'],
                'email' => ['email:rfc,dns', 'unique:users'],
                'password' => [
                    'required',
                    Password::min(8)
                        ->letters()
                        ->mixedCase()
                        ->numbers()
                        ->symbols()
                        ->uncompromised()
                ],
            ]);
        }
        $user['password'] = Hash::make($request->password);
        $user = User::create($user);
        $seller = [
            'user_id' => $user->id,
            'avatar' => '',
            'mode' => '',
            'google' => '',
            'facebook' => '',
            'apple' => '',
            'verification_code' => '',
        ];
        $seller = Seller::create($seller);
        return [
            'user' => $user,
            'seller' =>   $seller
        ];
    }
}
