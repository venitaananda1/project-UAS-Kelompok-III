@extends('layouts.app', ['title' => 'Tambah Data Pasien - Admin'])

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
    <div class="container mx-auto px-6 py-8">
        
        <div class="p-6 bg-white rounded-md shadow-md">
            <h2 class="text-lg text-gray-700 font-semibold  capitalize">TAMBAH DATA PASIEN</h2>
            <hr class="mt-4">
            <form action="{{ route('admin.pasien.store') }}" method="POST" >
                @csrf
                <div class="grid grid-cols-1 gap-6 mt-4">

                    <div>
                        <label class="text-gray-700" for="nama_pasien">NAMA PASIEN</label>
                        <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text" name="nama_pasien" value="{{ old('nama_pasien') }}" placeholder="Nama Pasien">
                        @error('nama_pasien')
                            <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                <div class="px-4 py-2">
                                    <p class="text-gray-600 text-sm">{{ $message }}</p>
                                </div>
                            </div>
                        @enderror
                    </div>

                    <div>
                        <label class="text-gray-700" for="umur_pasien">UMUR PASIEN</label>
                        <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text" name="umur_pasien" value="{{ old('umur_pasien') }}" placeholder="Inputn Umur Pasien ex.30 Tahun">
                        @error('umur_pasien')
                            <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                <div class="px-4 py-2">
                                    <p class="text-gray-600 text-sm">{{ $message }}</p>
                                </div>
                            </div>
                        @enderror
                    </div>

                    <div>
                        <label class="text-gray-700" for="jenis_kelamin">JENIS KELAMIN</label>
                        <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text" name="jenis_kelamin" value="{{ old('jenis_kelamin') }}" placeholder="Jenis Kelamin P/L">
                        @error('jenis_kelamin')
                            <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                <div class="px-4 py-2">
                                    <p class="text-gray-600 text-sm">{{ $message }}</p>
                                </div>
                            </div>
                        @enderror
                    </div>

                    <div>
                        <label class="text-gray-700" for="alamat">ALAMAT</label>
                        <textarea name="alamat" rows="5"> {{ old('alamat') }} </textarea>
                        @error('alamat')
                            <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                <div class="px-4 py-2">
                                    <p class="text-gray-600 text-sm">{{ $message }}</p>
                                </div>
                            </div>
                        @enderror
                    </div>

                    
                    <div>
                        <label class="text-gray-700" for="no_kontak">NOMOR KONTAK</label>
                        <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="number" name="no_kontak" value="{{ old('no_kontak') }}" placeholder="Input Nomor HP/WhatsApp">
                        @error('no_kontak')
                            <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                <div class="px-4 py-2">
                                    <p class="text-gray-600 text-sm">{{ $message }}</p>
                                </div>
                            </div>
                        @enderror
                    </div>

                    <div>
                        <label class="text-gray-700" for="dokter_id">NAMA DOKTER</label>
                        <select class="w-full border bg-gray-200 focus:bg-white rounded px-3 py-2 outline-none" name="dokter_id">
                            @foreach($dokter as $dokter)
                                <option class="py-1" value="{{ $dokter->id}}">{{ $dokter->nama_dokter }}</option>
                            @endforeach
                        </select>
                        @error('dokter_id')
                            <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                <div class="px-4 py-2">
                                    <p class="text-gray-600 text-sm">{{ $message }}</p>
                                </div>
                            </div>
                        @enderror
                    </div>

                    <div>
                        <label class="text-gray-700" for="obat_id">NAMA OBAT</label>
                        <select class="w-full border bg-gray-200 focus:bg-white rounded px-3 py-2 outline-none" name="obat_id">
                            @foreach($obat as $obat)
                                <option class="py-1" value="{{ $obat->id}}">{{ $obat->nama_obat }}</option>
                            @endforeach
                        </select>
                        @error('obat_id')
                            <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                <div class="px-4 py-2">
                                    <p class="text-gray-600 text-sm">{{ $message }}</p>
                                </div>
                            </div>
                        @enderror
                    </div>

                <div class="flex justify-start mt-4">
                    <button type="submit" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray700">SIMPAN</button>
                </div>
            </form>
        </div>
    
    </div>
</main>
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'alamat' );
</script>
@endsection