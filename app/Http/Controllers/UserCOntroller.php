<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;

class UserController extends Controller
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
            self::register($user);
        }

        return self::user($user);
    }

    protected static function login_with_Facebook($user)
    {
        $user = User::where('facebook', $user->email)
            ->first();

        if ($user->isEmpty()) {
            self::register($user);
        }

        return self::user($user);
    }

    protected static function login_with_Apple($user)
    {
        $user = User::where('apple', $user->email)
            ->first();

        if ($user->isEmpty()) {
            self::register($user);
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
        if ($user['mode'] === 'Default') {
            $data = User::where('email', $user['email'])->first();

            if (empty($data)) {
                return  response('User not Found', 404);
            }

            if (!Hash::check($user['password'], $data['password'])) {
                return  response('Invalid Password', 401);
            }
            return self::user($data);
        }

        return  response('Invalid Mode', 401);
    }

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
        $stripeCustomer = $user->createOrGetStripeCustomer();;

        return [
            'user' => $user,
            'message' => 'Created',
            'stripe' =>   $stripeCustomer
        ];
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

    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->first();

        $user->fill($request)->save();

        return  response('Updated', 200);
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return  response('Deleted', 200);
    }
}
