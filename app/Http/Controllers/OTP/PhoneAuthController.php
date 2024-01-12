<?php

namespace App\Http\Controllers\OTP;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PhoneAuthController extends Controller
{
    public function index(){
        return view('otp.verify_otp');
    }

    public function store(Request $request){

        $check_phone = User::where(['phone' => $request->phone, 'active'=>1])->exists();

        if($check_phone === false)
        {
            User::updateOrCreate(
                [
                    'phone' => $request->phone,
                ],
                [
                    'phone' => $request->phone,
                ],
                );

                return response([
                    'status'=>'not_active',
                    'message'=>'The phone number is Saved Successfully']);
        }else{
            return response([
                'status'=>'active',
                'message'=>'This phone number is already Active']);
        }
    }

    public function register(Request $request, $phone){
      
        return view('auth.register',compact('phone'));
    }
}
