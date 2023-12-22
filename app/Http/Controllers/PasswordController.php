<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class PasswordController extends Controller
{
    public function showChangePasswordForm()
    {
        $page = "Change Password";
        return view('backend.pages.profile.changepassword.create',compact('page'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|different:current_password',
            'confirm_password' => 'required|same:new_password',
        ]);

        $user = Auth::user();
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }
        User::where('id',$user->id)->update([
                'password' => Hash::make($request->new_password),
        ]);
        toast('password Changed Successfully','success');
        return redirect()->route('dashboard.index');
    }
}
