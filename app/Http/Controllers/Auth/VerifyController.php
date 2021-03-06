<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function verify_code(Request $request)
    {
        $data = (object) $request->all();
        $user = $request->user();
        $seller = Seller::where('user_id', $user->id)->first();
        if ($data->verification_code  === $seller->verification_code) {
            return response('Verified', 200);
        }
        return response('unverified', 400);
    }
}
