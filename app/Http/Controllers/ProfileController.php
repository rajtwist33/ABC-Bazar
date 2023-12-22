<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{

    public function edit(Request $request): View
    {
        $page = "Profile";
        return view('backend.pages.profile.create',compact('page'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {

        $auth = Auth::user()->id;
        if ($request->hasFile('image')) {
            $this->validate($request, [
                'image'=>'nullable|image|mimes:jpg,jpeg,png|max:1999',
            ]);

            $file = $request->file('image');
            $image_name = md5(rand(1000, 10000));
            $ext = strtolower($file->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $uploade_path = 'uploads/profile/';
            $image_url = $uploade_path . $image_full_name;
            $file->move($uploade_path, $image_full_name);

           User::UpdateOrcreate(
                [
                    'id' => $auth,
                ],
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'image'=> $image_full_name,
                    'file_path'=> $image_url,

                ]
            );
        }
        else{
           User::UpdateOrcreate(
                [
                    'id' => $auth,
                ],
                [
                    'name' => $request->name,
                    'email' => $request->email,
                ]
            );
        }
             Alert::success('Success Title', 'Profile Updated Successfully!');
            return redirect()->route('dashboard.index');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
