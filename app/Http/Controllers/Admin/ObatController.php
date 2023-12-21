<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    //Method untuk tampilkan data Obat
    public function index(){
        $obat = Obat::latest()->when(request()->q, function($obat){
            $obat = $obat->where ("nama_obat","like","%". request()->q . "%");
        })->paginate(10);
        return view("admin.obat.index", compact("obat"));

    }
        // method untuk panggil form input data
        public function create(){
            return view("admin.obat.create");
        }
        // method untuk kirim data dari inputan form ke table Data Obat database
        public function store(Request $request){
            // Code untuk memvalidasi inputan
            $this->validate($request, [
                'nama_obat'=> 'required',
                'jenis_obat'=> 'required',
                'persediaan_obat'=> 'required',
                
                ]);
    
                //data input simpan kedalam tabel
                $obat = Obat::create([
                    'nama_obat'=> $request->nama_obat,
                    'jenis_obat'=> $request->jenis_obat,
                    'persediaan_obat'=> $request->persediaan_obat,
                ]);
    
                //Kondisi
                if($obat){
                    // redirect dengan tampilkan pesan
                    return redirect()->route('admin.obat.index')->with('success','Data Berhasil Disimpan Kedalam Tabel Data Obat');
                }else{
                    return redirect()->route('admin.obat.index')->with('error','Data Gagal Disimpan Kedalam Tabel Data Obat');
            }
            
        }
        //method untuk tampilkan data yang mau diubah
        public function edit(Obat $obat){
            return view('admin.obat.edit', compact('obat'));
        }

        // Buat method untuk kirimkan data yang di ubah di form inputan
        public function update(Request $request, Obat $obat){
            // Code untuk memvalidasi inputan
            $this->validate($request, [
                'nama_obat'=> 'required|:obats,nama_obat,' .$obat->id,
                'jenis_obat'=> 'required|:obats,jenis_obat,' .$obat->id,
                'persediaan_obat'=> 'required|:obats,persediaan_obat,' .$obat->id,

            ]);

            
            //update data di tabel Obat dengan data baru
                $obat = Obat::findOrFail($obat->id);
                $obat->update([
                    'nama_obat'=> $request->nama_obat,
                    'jenis_obat'=> $request->jenis_obat,
                    'persediaan_obat'=> $request->persediaan_obat,
                    
                ]);
            //Kondisi Jika Berhasil atau Gagal ubah datanya
            if($obat){
            // redirect dengan tampilkan pesan
                return redirect()->route('admin.obat.index')->with('success','Data Berhasil Diubah Kedalam Tabel Data Obat');
            }else{
                return redirect()->route('admin.obat.index')->with('error','Data Gagal Diubah Kedalam Tabel Data Obat');
            }
        }
        // Metodh untuk hapus data                    
        public function destroy($id){
            $obat = Obat::findOrFail($id);
            $obat->delete();
                
            // Kondisi Berhasi atau Gagal menghapus datanya
            if($obat){
                return response()->json(['status'=> 'success']);
            }else{
                return response()->json(['status'=> 'error']);
        }
    }

}
