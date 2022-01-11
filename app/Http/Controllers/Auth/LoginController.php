<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __construct()
    {
        return $this;
    }

    public function login(Request $request)
    {
        $data = (object) $request->all();
        if ($data->mode === 'Google') return $this->login_with_socials($data, 'google');

        if ($data->mode === 'Facebook') return $this->login_with_socials($data, 'facebook');

        if ($data->mode === 'Apple') return $this->login_with_socials($data, 'apple');

        return $this->default_login($data);
    }

    protected static function default_login($user)
    {
        if ($user->mode === 'Default') {
            $data = User::where('email', $user->email)->first();
            if (empty($data)) return response('User not Found', 404);

            $seller = Seller::where('user_id', $data->id)->first();

            if (empty($seller)) return response('User not Found', 404);

            if (!Hash::check($user->password, $seller->password)) return response('Invalid Password', 401);

            return self::user($data);
        }
        return response('Invalid Mode', 401);
    }

    protected static function login_with_socials($data, string $social)
    {
        $user = User::where($social, $data->email)->first();
        if (empty($user)) return RegistrationController::register($user);
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

    protected static function updateToken($id, $abilities = ['*'])
    {
        $user = User::find($id)->first();
        $ip = request()->ip();
        $token = $user->createToken("{$user->name}|{$ip}", $abilities);
        $user->remember_token = null;
        $user->save();
        return $token;
    }
}
