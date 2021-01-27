<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function edit($id)
    {
        $decrypt = Crypt::decrypt($id);
        $user = User::find($decrypt);
        return $user;
    }

    public function update(Request $request, $id)
    {
        $decrypt = Crypt::decrypt($id);
        $user = User::find(auth()->user()->id);
        $user->name = $request->nama;
        $user->username = $request->username;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->update();

        Session::flash('success', 'Data berhasil diubah');
        return Redirect::back();
        // echo $decrypt;
    }

    public function editUserSiswa($id)
    {
        $decrypt = Crypt::decrypt($id);
        $user = User::where('username', $decrypt)->first();
        return $user;
    }
}
