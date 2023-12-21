<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\Obat;
use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    //Method untuk tampilkan data Pasien
    public function index(){
        $pasien = Pasien::latest()->when(request()->q, function($pasien){
            $pasien = $pasien->where ("nama_pasien","like","%". request()->q . "%");
        })->paginate(10);
        return view("admin.pasien.index", compact("pasien"));

    }
        // method untuk panggil form input data
        public function create(){
            // kode untuk ambil data dari table relasi yaitu tabel Dokter
            $dokter = Dokter::latest()->get();
            // kode untuk ambil data dari table relasi yaitu tabel Obat
            $obat = Obat::latest()->get();
            return view('admin.pasien.create', compact('dokter','obat'));
        }
        // method untuk kirim data dari inputan form ke table Data Pasien database
        public function store(Request $request){
            // Code untuk memvalidasi inputan
            $this->validate($request, [
                'nama_pasien'=> 'required|min:3',
                'umur_pasien'=> 'required',            
                'jenis_kelamin'=> 'required',
                'alamat'=> 'required',
                'no_kontak'=> 'required|min:12',
                'dokter_id'=> 'required',
                'obat_id'=> 'required',
                
                ]);
    
                //data input simpan kedalam tabel
                $pasien = Pasien::create([
                    'nama_pasien'=> $request->nama_pasien,
                    'umur_pasien'=> $request->umur_pasien,
                    'jenis_kelamin'=> $request->jenis_kelamin,
                    'alamat'=> $request->alamat,
                    'no_kontak'=> $request->no_kontak,
                    'dokter_id'=> $request->dokter_id,
                    'obat_id'=> $request->obat_id,
                ]);
    
                //Kondisi
                if($pasien){
                    // redirect dengan tampilkan pesan
                    return redirect()->route('admin.pasien.index')->with('success','Data Berhasil Disimpan Kedalam Tabel Data Pasien');
                }else{
                    return redirect()->route('admin.pasien.index')->with('error','Data Gagal Disimpan Kedalam Tabel Data Pasien');
        }
    }
    //method untuk tampilkan data yang mau diubah
    public function edit(Pasien $pasien){
        
        // kode untuk ambil data dari table relasi yaitu tabel Dokter
            $dokter = Dokter::latest()->get();
        // kode untuk ambil data dari table relasi yaitu tabel Obat
            $obat = Obat::latest()->get();

        return view('admin.pasien.edit', compact('pasien','dokter','obat'));
    }

    // Buat method untuk kirimkan data yang di ubah di form inputan
    public function update(Request $request, Pasien $pasien){
        // Code untuk memvalidasi inputan
        $this->validate($request, [
            'nama_pasien'=> 'required|:pasiens,nama_pasien,' .$pasien->id,
            'umur_pasien'=> 'required|:pasiens,umur_pasien,' .$pasien->id,
            'jenis_kelamin'=> 'required|:pasiens,jenis_kelamin,' .$pasien->id,
            'alamat'=> 'required|:pasiens,alamat,' .$pasien->id,
            'no_kontak'=> 'required|:pasiens,no_kontak,' .$pasien->id,
            'dokter_id'=> 'required|:pasiens,dokter_id,' .$pasien->id,
            'obat_id'=> 'required|:pasiens,obat_id,' .$pasien->id,
        ]);

        
            //update data di tabel Pasien dengan data baru
           
            $pasien->update([
                'nama_pasien'=> $request->nama_pasien,
                'umur_pasien'=> $request->umur_pasien,
                'jenis_kelamin'=> $request->jenis_kelamin,
                'alamat'=> $request->alamat,
                'no_kontak'=> $request->no_kontak,
                'dokter_id'=> $request->dokter_id,
                'obat_id'=> $request->obat_id,
                
            ]);
        //Kondisi Jika Berhasil atau Gagal ubah datanya
        if($pasien){
        // redirect dengan tampilkan pesan
            return redirect()->route('admin.pasien.index')->with('success','Data Berhasil Diubah Kedalam Tabel Data Pasien');
        }else{
            return redirect()->route('admin.pasien.index')->with('error','Data Gagal Diubah Kedalam Tabel Data Pasien');
        }
    }
    // Metodh untuk hapus data                    
    public function destroy($id){
        $pasien = Pasien::findOrFail($id);
        $pasien->delete();
            
        // Kondisi Berhasi atau Gagal menghapus datanya
        if($pasien){
            return response()->json(['status'=> 'success']);
        }else{
            return response()->json(['status'=> 'error']);
    }
}
    
}
