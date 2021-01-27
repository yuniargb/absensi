<?php

namespace App\Http\Controllers;

use App\Angkatan;
use App\Http\Requests\SiswaRequest;
use App\Kelas;
use App\Siswa;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = DB::table('siswas')
            ->select('siswas.nis','siswas.nama','siswas.id','kelas.namaKelas')
            ->join('users', 'siswas.nis', '=', 'users.username')
            ->join('kelas', 'siswas.kelas_id', '=', 'kelas.id')
            ->get();
        $kelas = Kelas::all();
        // dd($siswa);
        return view('siswa.siswa', compact('siswa', 'kelas'));
    }
    public function getSiswa($kelas){
        $siswa = DB::table('siswas')
            ->select('*', 'users.id as id')
            ->join('users', 'siswas.nis', '=', 'users.username')
            ->where('role','=',2)
            ->where('siswas.kelas_id','=',$kelas)->get();
        return $siswa;
    }
   
    public function store(SiswaRequest $request)
    {

        $rules = [
            'nis' => 'unique:users,username',
        ];
        $message = [
            'unique' => ':attribute Sudah Ada!',
        ];
        $this->validate($request, $rules, $message);

        // insert into siswa
        $siswa = new Siswa;
        $siswa->nis = $request->nis;
        $siswa->nama = $request->nama;
        $siswa->user_id = 1;
        $siswa->kelas_id = $request->kelas;


        $siswa->save();

        $user = new User;
        $user->name = $request->nama;
        $user->role = 2;
        $user->username = $request->nis;
        $user->email_verified_at = now();
        $user->password = Hash::make($request->nis);
        $user->remember_token = Str::random(10);
        $user->save();

        Session::flash('success', 'Siswa berhasil ditambahkan');
        return Redirect::back();
    }

    public function pass($id)
    {
        $decrypt = Crypt::decrypt($id);
        $siswa = Siswa::find($decrypt);
        $pass = Hash::make($siswa->nis);
        $user = User::where('username', $siswa->nis)->first();
        $user->password = $pass;

        $user->update();
        
        Session::flash('success', 'Kata sandi berhasil diatur ulang');
        return Redirect::back();

        // return $siswa;
    }
    public function edit($id)
    {
        $decrypt = Crypt::decrypt($id);
        // $siswa = Siswa::find($decrypt);
         $siswa = DB::table('siswas')
            ->select('*')
            ->join('users', 'siswas.nis', '=', 'users.username')
            ->where('siswas.id',$decrypt)
            ->first();
        return json_encode($siswa);
    }
    public function update(Request $request, $id)
    {
        $decrypt = Crypt::decrypt($id);
        $siswa = Siswa::find($decrypt);

        $siswa->nis = $request->nis;
        $siswa->nama = $request->nama;
        $siswa->kelas_id = $request->kelas;
        
        $siswa->update();

        $user = User::where('username', $request->nis)->first();
        $user->name = $request->nama;
        $user->remember_token = Str::random(10);
        $user->update();
        Session::flash('success', 'Siswa berhasil diubah');
        return Redirect::back();
    }
    public function destroy($id)
    {
        $decrypt = Crypt::decrypt($id);
        $siswa = Siswa::find($decrypt);
        $siswa->delete();

        $user = User::where('username', $siswa->nis)->first();
        $user->delete();
        Session::flash('success', 'Siswa berhasil dihapus');
        return '/siswa';
    }
}
