<?php

namespace App\Http\Controllers;

use App\Siswa;
use App\User;
use App\Logo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $logo = Logo::find(1);
        $absenSiswa = null;
        $absenGuru = null;
        $absenStaf = null;
        if(auth()->user()->role == 6){
           $absenSiswa  = DB::table('absensis')
            ->select(
                DB::raw('nvl(sum(keterangan = "hadir"),0) as hadir'),
                DB::raw('nvl(sum(keterangan = "sakit"),0) as sakit'),
                DB::raw('nvl(sum(keterangan = "izin"),0) as izin'),
                DB::raw('nvl(sum(keterangan = "alfa"),0) as alfa'),
                DB::raw('nvl(sum(keterangan = "dispensasi"),0) as dispensasi'),
                DB::raw('count(keterangan) as total')
            )
            ->join('users', 'absensis.user_id', '=', 'users.id')
            ->join('siswas', 'users.username', '=', 'siswas.nis')
            ->first();
           $absenGuru  = DB::table('absensis')
            ->select(
                DB::raw('nvl(sum(keterangan = "hadir"),0) as hadir'),
                DB::raw('nvl(sum(keterangan = "sakit"),0) as sakit'),
                DB::raw('nvl(sum(keterangan = "izin"),0) as izin'),
                DB::raw('nvl(sum(keterangan = "alfa"),0) as alfa'),
                DB::raw('nvl(sum(keterangan = "dispensasi"),0) as dispensasi'),
                DB::raw('count(keterangan) as total')
            )
            ->join('users', 'absensis.user_id', '=', 'users.id')
            ->join('gurus', 'users.username', '=', 'gurus.nip')
            ->first();
           $absenStaf  = DB::table('absensis')
            ->select(
                DB::raw('nvl(sum(keterangan = "hadir"),0) as hadir'),
                DB::raw('nvl(sum(keterangan = "sakit"),0) as sakit'),
                DB::raw('nvl(sum(keterangan = "izin"),0) as izin'),
                DB::raw('nvl(sum(keterangan = "alfa"),0) as alfa'),
                DB::raw('nvl(sum(keterangan = "dispensasi"),0) as dispensasi'),
                DB::raw('count(keterangan) as total')
            )
            ->join('users', 'absensis.user_id', '=', 'users.id')
            ->where('role', '<>' ,2)
            ->where('role','<>',7)
            ->first();
        }
         return view('dashboard',compact('logo','absenSiswa','absenStaf','absenGuru'));
    }

    public function user()
    {
        $id = auth()->user()->id;
        $user = User::find($id);

        if ($user->role == 2) {
            // $user = User::with('siswa')->where('username', auth()->user()->username)->first();

            $user = DB::table('users')
                ->select('*', 'siswas.id as ids', 'angkatans.tarifspp as tarif')
                ->join('siswas', 'users.username', '=', 'siswas.nis')
                ->join('angkatans', 'angkatans.id', '=', 'siswas.angkatan_id')
                ->join('kelas', 'kelas.id', '=', 'siswas.kelas_id')
                ->where('siswas.nis', auth()->user()->username)->first();
        } else {
            $user = User::find($id);
        }
        return view('user.user', compact('user'));
    }
}
