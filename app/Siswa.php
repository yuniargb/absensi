<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    public function angkatan()
    {
        return $this->belongsTo(Angkatan::class);
    }

    public function pembayaran()
    {
        return $this->belongsTo('App\Pembayaran');
    }

    public function user()
    {
        return $this->hasOne(User::class,'username','nis');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
