<?php

namespace App\Http\Controllers;

use App\Absensi;
use App\DtlAbsensi;
use App\Siswa;
use App\Guru;
use App\User;
use App\Kelas;
use App\MataPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\AgendaRequest;
use DB;
use Mail;
use Carbon;

class AbsensiController extends Controller
{
   
    public function agenda()
    {
        $kelas = Kelas::all();
        $walikelas = Kelas::all();
        $mapel = MataPelajaran::all();
        $absensi = DB::table('dtl_absensi as da')
            ->select(
                'da.tgl_absen',
                'da.materi',
                'da.kegiatan',
                'da.id_absen as id',
                'da.minggu',
                'da.bulan',
                'da.jam',
                'mp.namamapel',
                DB::raw('count(ab.user_id) as jumlah')
            )
            ->join('mata_pelajarans as mp', 'da.mata_pelajaran_id', '=', 'mp.id')
            ->leftJoin('absensis as ab', 'da.id_absen', '=', 'ab.absen_id')
            ->when(auth()->user()->role == 7, function ($query1) {
                return $query1->where('da.guru_id',  auth()->user()->username);
            })
            ->groupBy('da.tgl_absen',
            'da.materi',
            'da.kegiatan',
            'da.id_absen',
            'da.minggu',
            'da.bulan',
            'da.jam',
            'mp.namamapel'
            )->get();
        return view('absensi.absenDetail', compact('absensi','kelas','mapel'));
    }
    public function siswa()
    {
        $kelas = Kelas::all();
        $mapel = MataPelajaran::all();
        $waliKelas = null;
            if(!empty(auth()->user()->username))
            $waliKelas = DB::table('gurus')
                        ->select('kelas.*')
                        ->join('kelas', 'gurus.id', '=', 'kelas.guru_id')
                        ->where('gurus.nip',auth()->user()->username)
                        ->first();

        $absensi = DB::table('absensis')
            ->select(
                'siswas.nis',
                'siswas.nama',
                DB::raw('gurus.nama as walikelas'),
                'kelas.namaKelas',
                'users.id',
                DB::raw('sum(absensis.keterangan = "hadir") as hadir'),
                DB::raw('sum(absensis.keterangan = "sakit") as sakit'),
                DB::raw('sum(absensis.keterangan = "izin") as izin'),
                DB::raw('sum(absensis.keterangan = "alfa") as alfa'),
                DB::raw('sum(absensis.keterangan = "terlambat") as terlambat')
            )
            ->join('users', 'absensis.user_id', '=', 'users.id')
            ->join('siswas', 'users.username', '=', 'siswas.nis')
            ->join('kelas', 'siswas.kelas_id', '=', 'kelas.id')
            ->join('gurus', 'kelas.guru_id', '=', 'gurus.id')
            ->when(!empty($waliKelas) || auth()->user()->role == 7, function ($query1) use($waliKelas){
                if(!empty($waliKelas))
                    return $query1->where('kelas.id',  $waliKelas->id);
                else
                    return $query1->where('kelas.id',  $waliKelas);
            })
            ->groupBy('siswas.nis','siswas.nama','users.id','kelas.namaKelas','gurus.nama')->get();
        return view('absensi.absenSiswa', compact('absensi','kelas','mapel'));
    }
    
    public function rfid()
    {
        return view('absensi.absenRFID');
    }
    public function presensiall()
    {
        return view('absensi.presensiDashboard');
    }
    public function user(){
        
        $absensi = DB::table('absensis')
            ->select(
                'absensis.jam_masuk',
                'absensis.jam_pulang',
                'absensis.keterangan',
                'absensis.tgl_absen'
            )
            ->join('users', 'absensis.user_id', '=', 'users.id')
            ->where('users.id','=', auth()->user()->id)
            ->get();
        return view('absensi.absenUser', compact('absensi'));
    }
    public function detailSiswa($id){
        $decrypt = Crypt::decrypt($id);
        $absensi = DB::table('absensis')
            ->select(
                'siswas.nis',
                'siswas.nama',
                'users.id as user_id',
                'absensis.id',
                'absensis.keterangan',
                'absensis.kasus',
                'absensis.tindakan',
                'dtl_absensi.tgl_absen'
            )
            ->join('users', 'absensis.user_id', '=', 'users.id')
            ->join('siswas', 'users.username', '=', 'siswas.nis')
            ->join('dtl_absensi', 'absensis.absen_id', '=', 'dtl_absensi.id_absen')

            ->where('users.id','=',$decrypt)
            ->get();
        return $absensi;
    }
    public function detail($id){
        $decrypt = Crypt::decrypt($id);
        $absensi = DB::table('absensis')
            ->select(
                'siswas.nis',
                'siswas.nama',
                'users.id as user_id',
                'absensis.id',
                'absensis.keterangan',
                'absensis.kasus',
                'absensis.tindakan',
                'dtl_absensi.tgl_absen',
                'kelas.namaKelas'
            )
            ->join('users', 'absensis.user_id', '=', 'users.id')
            ->join('siswas', 'users.username', '=', 'siswas.nis')
            ->join('dtl_absensi', 'absensis.absen_id', '=', 'dtl_absensi.id_absen')
            ->join('kelas', 'absensis.kelas_id', '=', 'kelas.id')

            ->where('absensis.absen_id','=',$decrypt)
            ->get();
        return $absensi;
    }
   
    public function storeDetail(Request $request)
    {  
        date_default_timezone_set('Asia/Jakarta');

        $id =  date('YmdHis');
        $abs = Absensi::where('kelas_id',$request->kelas)
        ->where('absen_id',$request->absen_id)->first();

        if($abs != null){
            Session::flash('failed', 'Kelas Sudah Pernah Diinput, silahkan pilih tombol Edit untuk merubah data');
        }else{
            foreach($request->keterangan as $i => $sis){
                $data[] = array(
                    'keterangan' => $request->keterangan[$i],
                    'kasus' => $request->kasus[$i],
                    'tindakan' => $request->tindakan[$i],
                    'user_id' => $request->id[$i],
                    'kelas_id' => $request->kelas,
                    'absen_id' =>  $request->absen_id,
                );
            }
            if(!empty($data)){
                DB::table('absensis')->insert($data); 
            }
            Session::flash('success', 'Agenda berhasil ditambahkan');
        }
        
        return Redirect::back();
    }
    public function storeManual(AgendaRequest $request)
    {  
        date_default_timezone_set('Asia/Jakarta');

        $id =  date('YmdHis');

        $dtl = new DtlAbsensi;
        $dtl->id_absen = $id;
        $dtl->tgl_absen = $request->tgl_absen;
        $dtl->guru_id = $request->nip;
        $dtl->minggu = $request->minggu;
        $dtl->bulan = $request->bulan;
        $dtl->jam = $request->jam;
        $dtl->materi = $request->materi;
        $dtl->kegiatan = $request->kegiatan;
        $dtl->tipe = $request->tipe;
        $dtl->mata_pelajaran_id = $request->mapel;

        if($dtl->save()){
            Session::flash('success', 'Presensi berhasil ditambahkan');
        }else{
            Session::flash('failed', 'Presensi gagal ditambahkan');
        }
        return Redirect::back();
    }
    public function storeRFID(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');

        $user = DB::table('users')
            ->select('*','users.id as id')
            ->leftJoin('gurus', 'users.username', '=', 'gurus.nip')
            ->leftJoin('siswas', 'users.username', '=', 'siswas.nis')
            ->where('users.no_kartu','=',$request->no_kartu)
            ->first();
        // dd($user);
        // echo $user;
        if($user){
            $cek = Absensi::where('tgl_absen', date('Y-m-d'))->where('user_id', $user->id)->first();
           
            $absen = new Absensi;
            if( $cek != null ){
                $cek->jam_pulang =  date('H:i:s');
                $cek->update();
                $massg = 'Presensi pulang telah ditambahkan';
                Session::flash('success', 'Absen pulang ' . $user->name . ' berhasil ditambahkan');
            }else{
                $absen->tgl_absen =  date('Y-m-d');
                $absen->jam_masuk =  date('H:i:s');
                $absen->keterangan = 'hadir';
                $absen->tipe = $user->role;
                $absen->user_id = $user->id;
                $absen->save();
                $massg = 'Presensi masuk telah ditambahkan';
                Session::flash('success', 'Absen masuk ' . $user->name . ' berhasil ditambahkan');
            }
        }else{
           
            Session::flash('failed', 'Opps, kartu anda tidak terdaftar');
        }
        
        return Redirect::back();
    }

  
    public function show($id)
    {
        //
    }

    public function update(Request $request)
    {
        foreach($request->keterangan as $i => $sis){
            $cek = Absensi::find($request->id[$i]);
            $cek->keterangan = $request->keterangan[$i];
            $cek->kasus = $request->kasus[$i];
            $cek->tindakan = $request->tindakan[$i];
            $cek->update();
        }
        Session::flash('success', 'Presensi berhasil diubah');
        return Redirect::back();
    }
}
