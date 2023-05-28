<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $notification = [
            'message' => 'User logout successfully',
            'alert-type' => 'success'
        ];
        return redirect('/login')->with($notification);
    }
    public function profile()
    {
        $id = optional(Auth::user())->id;
        $admindata = User::find($id);
        return view('admin.admin_profile_view', ['admindata' => $admindata]);
    }
    public function editProfile()
    {
        $id = optional(Auth::user())->id;
        $editdata = User::find($id);
        return view('admin.admin_profile_edit', ['editdata' => $editdata]);
    }
    public function storeProfile(Request $request)
    {
        $id = optional(Auth::user())->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->username = $request->username;
        if ($request->file('profile_image')) {
            $file = $request->file('profile_image');
            $fileName = date('Ymd') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $fileName);
            $data['profile_image'] = $fileName;
        }
        $notification = [
            'message' => 'admin Profile updated successfully',
            'alert-type' => 'success'
        ];
        $data->save();
        return redirect()->route('admin.profile')->with($notification);
    }
    public function changePassword()
    {
        return view('admin.admin_change_password');
    }
    public function updatePassword(Request $request)
    {
        $validate = $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'confirmpassword' => 'required|same:newpassword',

        ]);
        $hashPAssword = Auth::user()->password;
        if (Hash::check($request->oldpassword, $hashPAssword)) {
            $user = User::find(Auth::id());
            $user->password = bcrypt($request->newpassword);
            $user->save();
            session()->flash('message', 'password updated successfuly');
        } else {
            session()->flash('message', 'password is not match');
        }
        return  redirect()->back();
    }
}
