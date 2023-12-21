<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;
    //Buat Function untuk assigment
    protected $fillable = [
        'nama_obat',
        'jenis_obat',
        'persediaan_obat',
    ];
    // Method untuk Relasional table ke table Pasien
    public function pasien(){
        return $this->hasMany(Pasien::class); //jenis relasi table one to many

    }
 
}

