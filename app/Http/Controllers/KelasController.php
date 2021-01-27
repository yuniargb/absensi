<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
   
    public function index()
    {
        // $kelas = Kelas::all();
        $kelas = DB::table('kelas')
            ->select('*', 'kelas.id as id')
            ->join('gurus', 'gurus.id', '=', 'kelas.guru_id')
            ->get();
        $guru = Guru::all();
        return view('kelas.kelas', compact('kelas','guru'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $kelas = new Kelas;
        $kelas->namakelas = $request->kelas;
        $kelas->guru_id = $request->guru_id;

        $kelas->save();
        Session::flash('success', 'Kelas berhasil ditambahkan');
        return Redirect::back();
    }

  
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        $decrypt = Crypt::decrypt($id);
        $kelas = Kelas::find($decrypt);
        return $kelas;
    }

    public function update(Request $request, $id)
    {
        $decrypt = Crypt::decrypt($id);
        $kelas = Kelas::find($decrypt);

        $kelas->namakelas = $request->kelas;
        $kelas->guru_id = $request->guru_id;

        $kelas->update();
        Session::flash('success', 'Kelas berhasil diubah');
        return Redirect::back();
    }

    public function destroy($id)
    {
        $decrypt = Crypt::decrypt($id);
        $kelas = Kelas::find($decrypt);
        $kelas->delete();

        Session::flash('success', 'Kelas berhasil dihapus');
        return '/kelas';
    }
}
