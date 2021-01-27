<?php

namespace App\Http\Controllers;

use App\User;
use App\Logo;
use App\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Mail;

class AuthController extends Controller
{
    public function login()
    {
        $logo = Logo::first();

        return view('auth.login', compact('logo'));
    }
    public function loginGuru()
    {
        $logo = Logo::first();

        $guru = DB::table('users')
        ->select( 'users.id as id','gurus.nama')
        ->join('gurus', 'users.username', '=', 'gurus.nip')
        ->get();
        return view('auth.loginGuru', compact('logo','guru'));
    }
    public function forgot()
    {
        $logo = Logo::first();

        return view('auth.forgotPassword', compact('logo'));
    }
    public function reset($email)
    {
        $logo = Logo::first();

        return view('auth.resetPassword', compact('logo','email'));
    }

    public function loginpost(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|exists:users,username',
            'password' => 'required'
        ]);
        $user = DB::table('users')
            ->select('*', 'users.id as id')
            ->leftJoin('gurus', 'users.username', '=', 'gurus.nip')
            ->leftJoin('kelas', 'gurus.id', '=', 'kelas.guru_id')
            ->where('users.username',$request->username)->first();
        // var_dump(Hash::check($request->password, $user->password));
        if (Auth::attempt(array('username' => $request->username, 'password' => $request->password))) {
            if (auth()->user()->role == 2) {
                return redirect('/');
            } else if (auth()->user()->role == 3) {
                return redirect('/');
            } else {
                return redirect('/');
            }
        }else{
            Session::flash('failed', 'password salah');
            return redirect('/login')->withInput($request->only(['username','password']));
        }
    }
    public function logingurupost(Request $request)
    {
        // $this->validate($request, [
        //     'username' => 'required|exists:users,username'
        // ]);
        // var_dump(Hash::check($request->password, $user->password));
        if (Auth::loginUsingId($request->username)) {
            if (auth()->user()->role == 2) {
                return redirect('/');
            } else if (auth()->user()->role == 3) {
                return redirect('/');
            } else {
                return redirect('/');
            }
            Session::flash('failed', 'password salah');
        }else{
            return redirect('/login-guru')->withInput($request->only(['username','password']));
        }
    }
    public function forgotPasswordPost(Request $request)
    {
         $user = User::where('username', $request->username)->first();

        if ($user) {
            $massg = 'Silahkan Klik <a href="http://localhost:8000/reset-password/'. md5($user->username) .'">Link ini</a> untuk ubah password</p>';
            Mail::send('email.pembayaranNotif', ['nama' => $user->name, 'pesan' => $massg], function ($message) use ($user)
            {
                $message->subject('Reset '.$user->name);
                $message->from('donotreply@ashiup.com', 'SMP MUHAMADIYAH 4 KOTA TANGERANG');
                $message->to($user->email);
            });
            Session::flash('success', 'Email Success Sending');
            return redirect('/forgot-password');
        } else {
            Session::flash('failed', 'Email Not Found');
            return redirect('/forgot-password');
        }
    }

    public function resetPassword(Request $request)
    {
        $staf = DB::SELECT("SELECT * FROM users where md5(username) = '" . $request->username . "'");

        if ($staf == true) {
            if ($request->password == $request->password1) {
                $update = DB::update("UPDATE users set password = '" . Hash::make($request->password) . "' WHERE md5(username) = '" . $request->username . "'");
                if ($update == true) {
                    Session::flash('success', 'Password Success Change');
                    return redirect('/login');
                }
            } else {
                Session::flash('failed', 'Password Not Same');
                return redirect('/reset-password/' . $request->username);
            }
        } else {
            Session::flash('success', 'Email Not Found');
            return redirect('/reset-password/' . $request->username);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
