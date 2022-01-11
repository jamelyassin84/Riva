<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $user = $request->all();

        if ($user['mode'] === 'Google') {
            return self::login_with_Google($user);
        }

        if ($user['mode'] === 'Facebook') {
            return self::login_with_Facebook($user);
        }

        if ($user['mode'] === 'Apple') {
            return self::login_with_Apple($user);
        }
        return self::default_login($user);
    }

    protected static function login_with_Google($user)
    {
        $user = User::where('google', $user->email)
            ->first();

        if ($user->isEmpty()) {
            RegistrationController::register($user);
        }

        return self::user($user);
    }

    protected static function login_with_Facebook($user)
    {
        $user = User::where('facebook', $user->email)
            ->first();

        if ($user->isEmpty()) {
            RegistrationController::register($user);
        }

        return self::user($user);
    }

    protected static function login_with_Apple($user)
    {
        $user = User::where('apple', $user->email)
            ->first();

        if ($user->isEmpty()) {
            RegistrationController::register($user);
        }

        return self::user($user);
    }

    protected static function user($user)
    {
        return [
            'user' => $user,
            'token' =>  self::updateToken($user->id),
            'message' => 'Signed-in',
        ];
    }

    protected static function default_login($user)
    {
        if ($user->user()) {
            $user->user()->currentAccessToken()->delete();
        }
        if ($user['mode'] === 'Default') {
            $data = User::where('email', $user['email'])->first();

            if (empty($data)) {
                return  response('User not Found', 404);
            }

            $seller = Seller::where('user_id', $data->id)->first();

            if (empty($seller)) {
                return  response('User not Found', 404);
            }

            if (!Hash::check($user['password'], $seller['password'])) {
                return  response('Invalid Password', 401);
            }
            return self::user($data);
        }

        return  response('Invalid Mode', 401);
    }

    protected static function updateToken($id, $abilities = ['*'])
    {
        $user = User::where('id', $id)->first();

        $ip = request()->ip();

        $token =  $user->createToken("{$user->name}|{$ip}", $abilities);

        $user->remember_token = null;

        $user->save();

        return $token;
    }
}
