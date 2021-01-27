<?php

namespace App\Http\Controllers;

use App\MataPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class MataPelajaranController extends Controller
{
    public function index()
    {
        $mapel = MataPelajaran::all();
        return view('matapelajaran.matapelajaran', compact('mapel'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $mapel = new MataPelajaran;
        $mapel->namamapel = $request->namamapel;
        $mapel->jumlahjam = $request->jumlahjam;

        $mapel->save();
        Session::flash('success', 'Mata Pelajaran berhasil ditambahkan');
        return Redirect::back();
    }

  
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        $decrypt = Crypt::decrypt($id);
        $mapel = MataPelajaran::find($decrypt);
        return $mapel;
    }

    public function update(Request $request, $id)
    {
        $decrypt = Crypt::decrypt($id);
        $mapel = MataPelajaran::find($decrypt);

        $mapel->namamapel = $request->namamapel;
        $mapel->jumlahjam = $request->jumlahjam;

        $mapel->update();
        Session::flash('success', 'Mata Pelajaran berhasil diubah');
        return Redirect::back();
    }

    public function destroy($id)
    {
        $decrypt = Crypt::decrypt($id);
        $mapel = MataPelajaran::find($decrypt);
        $mapel->delete();

        Session::flash('success', 'Mata Pelajaran berhasil dihapus');
        return '/matapelajaran';
    }
}
