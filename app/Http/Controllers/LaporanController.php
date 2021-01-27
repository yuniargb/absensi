<?php

namespace App\Http\Controllers;

use App\Pembayaran;
use App\Siswa;
use App\Guru;
use App\User;
use App\Kelas;
use App\Logo;
use App\TipePembayaran;
use App\Angkatan;
use App\MataPelajaran;
use App\Exports\BulanExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use PDF;
use Response;

class LaporanController extends Controller
{
    public function absenSiswa($absensi=null,$req = null)
    {
        $kelas = Kelas::all();
        
        $siswa = Siswa::all();
        return view('laporan.lapAbsSiswa', compact('kelas','absensi','req','siswa'));
    }
    
    public function cetakAbsSiswa(Request $request)
    {
        
         $absensi = DB::table('absensis as a')
            ->join('users as u', 'a.user_id', '=', 'u.id')
            ->join('siswas as s', 'u.username', '=', 's.nis')
            ->join('kelas as k', 's.kelas_id', '=', 'k.id')
            ->join('dtl_absensi as da', 'da.id_absen', '=', 'a.absen_id')
            ->join('mata_pelajarans as mp', 'da.mata_pelajaran_id', '=', 'mp.id')
            ->whereBetween ('da.tgl_absen',[$request->from,$request->to])
            ->when($request->siswa_id != '', function ($query1) use ($request) {
                return $query1->where('s.id',  $request->siswa_id);
            })
            ->when($request->kelas_id != '', function ($query2) use ($request) {
                return $query2->where('k.id',  $request->kelas_id);
            })
            ->orderBy('da.tgl_absen','asc')->get(); 
        if($request->submit == 'read'){
            return $this->absenSiswa($absensi,$request);
        }
        if($request->submit == 'csv'){
            $headers = array(
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=agenda-agenda-presensi-".date('dmyHis').".csv",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );

            
            $columns = array(
                'Tanggal', 
                'Materi', 
                'Kegiatan', 
                'Minggu', 
                'Bulan', 
                'Jam', 
                'Mata Pelajaran', 
                'NIS',
                'Nama',
                'Kelas',
                'Keterangan',
                'Kasus',
                'Tindakan'
            );

            $callback = function() use ($absensi, $columns)
            {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);

                foreach($absensi as  $sw) {
                    fputcsv($file, array(
                        date('d-m-Y',strtotime($sw->tgl_absen)),
                        $sw->materi,
                        $sw->kegiatan,
                        $sw->minggu,
                        $sw->bulan,
                        $sw->jam,
                        $sw->namamapel,
                        $sw->nis,
                        $sw->nama,
                        $sw->namaKelas,
                        $sw->keterangan,
                        $sw->kasus,
                        $sw->tindakan
                    ));
                }
                fclose($file);
            };
            return Response::stream($callback, 200, $headers);
        }
        // if($request->submit == 'pdf'){
        //     $kelas = Kelas::find($request->kelas_id);
        //     $logo = Logo::find(1);
        //     $pdf = PDF::loadview('laporan.cetakAbsSiswa', compact('absensi', 'logo','kelas'));
        //     return $pdf->download('laporan-Presensi-Siswa-'.date('dmyHis'));
        // }
    }
}
