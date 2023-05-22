<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    public function destroy(Request $request) 
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
    public function profile(){
        $id=Auth::user()->id;
        $admindata=User::find($id);
        return view('admin.admin_profile_view',['admindata'=>$admindata]);
    }
    public function editProfile(){
        $id=Auth::user()->id;
        $editdata=User::find($id);
        return view('admin.admin_profile_edit',['editdata'=>$editdata]);
    }
}