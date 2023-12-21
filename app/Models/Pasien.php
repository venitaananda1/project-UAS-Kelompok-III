<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;
        //Buat Function untuk assigment
        protected $fillable = [
            'nama_pasien',
            'umur_pasien',
            'jenis_kelamin',
            'alamat',
            'no_kontak',
            'dokter_id',
            'obat_id',
        ];
    //Buat method untuk relasi dari tabel Pasien ke table Dokter
    public function dokter(){
        return $this->belongsTo(Dokter::class); //jenis relasi many to one
    }

     //Buat method untuk relasi dari tabel Pasien ke table Obat
     public function obat(){
        return $this->belongsTo(Obat::class); //jenis relasi many to one
    }
     
}
