<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_dokter',
        'no_kontak',
        'jenis_kelamin',
        'alamat',
        'keahlian',
    ];

    // Method untuk Relasional table ke table Pasien
    public function pasien(){
        return $this->hasMany(Pasien::class); //jenis relasi table one to many

    }
}
