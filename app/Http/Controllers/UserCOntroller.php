<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\isEmpty;

class UserController extends Controller
{

    public function login(User $request)
    {
        $user = $request->all();

        if ($user->mode === 'Google') {
            self::login_with_Google($user);
        }

        if ($user->mode === 'Facebook') {
            self::login_with_Facebook($user);
        }

        if ($user->mode === 'Apple') {
            self::login_with_Apple($user);
        }

        self::default_login($user);
    }

    public static function login_with_Google($user)
    {
        $user = User::where('google', $user->email)
            ->first();

        if ($user . isEmpty()) {
            self::register($user);
        }

        return self::user($user);
    }

    public static function login_with_Facebook($user)
    {
        $user = User::where('facebook', $user->email)
            ->first();

        if ($user . isEmpty()) {
            self::register($user);
        }

        return self::user($user);
    }

    public static function login_with_Apple($user)
    {
        $user = User::where('apple', $user->email)
            ->first();

        if ($user . isEmpty()) {
            self::register($user);
        }

        return self::user($user);
    }

    public static function user($user)
    {
        return [
            'user' => $user,
            'token' => $user->remember_token,
            'message' => 'Signed-in',
        ];
    }

    public static function default_login($user)
    {
        if ($user->mode === 'Default') {
            $user = User::where('email', $user->email)->first();

            if ($user . isEmpty()) {
                return  response('User not Found', 404);
            }

            $user = User::first()
                ->where('email', $user->email)
                ->where('password', Hash::make($user->password));

            if ($user . isEmpty()) {
                return  response('Invalid Password', 401);
            }

            return self::user($user);
        }

        return  response('Invalid Mode', 401);
    }

    public static function register(User $request)
    {
        $user = $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'name' => ['required'],
            'mode' => ['required'],
        ]);

        $user->password = Hash::make($request->password);

        $user->remember_token = $user->createToken($user);

        $user = User::create($user);

        return [
            'user' => $user,
            'token' => $user->remember_token,
            'message' => 'Created',
        ];
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
