<?php

namespace App\Exports;

use App\Pembayaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;

class BulanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection(Request $request)
    {
        $pembayaran = DB::table('pembayarans')
                    ->select('*', 'pembayarans.id as id_p')
                    ->join('siswas', 'pembayarans.siswa_id', '=', 'siswas.id')
                    ->where('pembayarans.bulan', $request->angkatan)->get();
        return $pembayaran;
    }
}
