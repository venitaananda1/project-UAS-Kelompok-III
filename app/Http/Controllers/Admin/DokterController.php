<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use Illuminate\Http\Request;


class DokterController extends Controller
{
    //Method untuk tampilkan data Dokter
    public function index(){
        $dokter = Dokter::latest()->when(request()->q, function($dokter){
            $dokter = $dokter->where ("nama_dokter","like","%". request()->q . "%");
        })->paginate(10);
        return view("admin.dokter.index", compact("dokter"));

    }
    // method untuk panggil form input data
    public function create(){
        return view("admin.dokter.create");
    }
    // method untuk kirim data dari inputan form ke table Data Dokter database
    public function store(Request $request){
        // Code untuk memvalidasi inputan
        $this->validate($request, [
            'nama_dokter'=> 'required|min:3',
            'no_kontak'=> 'required|min:12',
            'jenis_kelamin'=> 'required',
            'alamat'=> 'required',
            'keahlian'=> 'required',
            
            ]);

            //data input simpan kedalam tabel
            $dokter = Dokter::create([
                'nama_dokter'=> $request->nama_dokter,
                'no_kontak'=> $request->no_kontak,
                'jenis_kelamin'=> $request->jenis_kelamin,
                'alamat'=> $request->alamat,
                'keahlian'=> $request->keahlian,
            ]);

            //Kondisi
            if($dokter){
                // redirect dengan tampilkan pesan
                return redirect()->route('admin.dokter.index')->with('success','Data Berhasil Disimpan Kedalam Tabel Data Dokter');
            }else{
                return redirect()->route('admin.dokter.index')->with('error','Data Gagal Disimpan Kedalam Tabel Data Dokter');
        }
    }
            //method untuk tampilkan data yang mau diubah
            public function edit(Dokter $dokter){
                return view('admin.dokter.edit', compact('dokter'));
            }
    
            // Buat method untuk kirimkan data yang di ubah di form inputan
            public function update(Request $request, Dokter $dokter){
                // Code untuk memvalidasi inputan
                $this->validate($request, [
                    'nama_dokter'=> 'required|:dokters,nama_dokter,' .$dokter->id,
                    'no_kontak'=> 'required|:dokters,no_kontak,' .$dokter->id,
                    'jenis_kelamin'=> 'required|:dokters,jenis_kelamin,' .$dokter->id,
                    'alamat'=> 'required|:dokters,alamat,' .$dokter->id,
                    'keahlian'=> 'required|:dokters,keahlian,' .$dokter->id,
                ]);
    
                
                    //update data di tabel Dokter dengan data baru
                    $dokter = Dokter::findOrFail($dokter->id);
                    $dokter->update([
                        'nama_dokter'=> $request->nama_dokter,
                        'no_kontak'=> $request->no_kontak,
                        'jenis_kelamin'=> $request->jenis_kelamin,
                        'alamat'=> $request->alamat,
                        'keahlian'=> $request->keahlian,
                        
                    ]);
                //Kondisi Jika Berhasil atau Gagal ubah datanya
                if($dokter){
                // redirect dengan tampilkan pesan
                    return redirect()->route('admin.dokter.index')->with('success','Data Berhasil Diubah Kedalam Tabel Data Dokter');
                }else{
                    return redirect()->route('admin.dokter.index')->with('error','Data Gagal Diubah Kedalam Tabel Data Dokter');
                }
            }
            // Metodh untuk hapus data                    
            public function destroy($id){
            $dokter = Dokter::findOrFail($id);
            $dokter->delete();
                
            // Kondisi Berhasi atau Gagal menghapus datanya
            if($dokter){
                return response()->json(['status'=> 'success']);
            }else{
                return response()->json(['status'=> 'error']);
        }
    }
                        
                
            
}