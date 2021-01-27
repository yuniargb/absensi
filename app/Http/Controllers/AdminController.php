<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function index()
    {
        $admin = User::where('role', '!=', 2)->where('role', '!=', 7)->get();
        return view('admin.admin', compact('admin'));
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diisi!',
            'unique' => ':attribute sudah ada!',
        ];
        
        $this->validate($request,[
            'no_kartu' => 'required|unique:users,no_kartu',
            'username' => 'required|unique:users,username',
        ],$messages);

        $user = new User;
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->username = $request->username;
        $user->no_kartu = $request->no_kartu;
        $user->password = Hash::make($request->password);
        $user->email_verified_at = now();
        $user->remember_token = Str::random(10);
        $user->save();

        Session::flash('success', 'Data staf berhasil diinput');
        return Redirect::back();
    }

    public function edit($id)
    {
        $decrypt = Crypt::decrypt($id);
        $ang = User::find($decrypt);
        return $ang;
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'unique' => ':attribute sudah ada!'
        ];
        
        $this->validate($request,[
            'no_kartu' => 'required|unique:users,no_kartu'
        ],$messages);


        $decrypt = Crypt::decrypt($id);
        $ang = User::find($decrypt);
        $ang->name = $request->nama;
        $ang->role = $request->role;
        $ang->username = $request->username;
        $ang->no_kartu = $request->no_kartu;
        $ang->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $ang->email_verified_at = now();
        $ang->remember_token = Str::random(10);
        $ang->update();
        Session::flash('success', 'Staf berhasil diubah');
        return Redirect::back();
    }

    public function destroy($id)
    {
        $decrypt = Crypt::decrypt($id);
        $user = User::find($decrypt);
        $user->delete();
        return '/admin';
    }
}
