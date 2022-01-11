<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;

class VerificationController extends Controller
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
            return 200;
        }
        return 300;
    }
}
