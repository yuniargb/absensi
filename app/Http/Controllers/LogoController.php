<?php

namespace App\Http\Controllers;

use App\Logo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logo = Logo::first();


        return view('logo.logo', compact('logo'));
    }
    public function setrfid()
    {
        $logo = Logo::first();


        return view('logo.settingrfid', compact('logo'));
    }

    public function update(Request $request, Logo $logo)
    {
        $logo = Logo::find(1);
       
        if( $request->hasFile('logo')){
            $resorce = $request->file('logo');
            $name   = $resorce->getClientOriginalExtension();
            $newName = rand(100000, 1001238912) . "." . $name;
            \Image::make($resorce)->resize(300, 200);
            $resorce->move(\base_path() . "/public/images/", $newName);
            $logo->logo = $newName;
        }
        $logo->biodata = $request->biodata;
        $logo->namasekolah = $request->namasekolah;
        $logo->alamat = $request->alamat;

        $logo->update();
        Session::flash('success', 'Logo / Biodata berhasil diubah');
        return Redirect::back();
    }
    public function setrfidupdate(Request $request, Logo $logo)
    {
        $logo = Logo::find(1);
       
        
        $logo->presensi = $request->presensi;

        $logo->update();
        Session::flash('success', 'Setting rfid berhasil diubah');
        return Redirect::back();
    }
}
