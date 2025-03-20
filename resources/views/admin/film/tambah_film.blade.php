<!--
  This example requires updating your template:

  ```
  <html class="h-full bg-white">
  <body class="h-full">
  ```
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah film</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
@extends('admin.sidebar')
<body>
  @section('content')
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
          <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Tambah Film</h2>
        </div>
      
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
          <form class="space-y-6" action="{{ url('tambah/film/proses') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
              <label for="name" class="block text-sm/6 font-medium text-gray-900">Nama Film</label>
              <div class="mt-2">
                <input type="text" name="name" id="name" autocomplete="name" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
              </div>
            </div>
            
            <div class="mb-4">
              <label for="deskripsi" class="block text-sm font-medium text-gray-700"> Sinopsis Film </label>
              <textarea
              name="deskripsi"
              id="deskripsi"
              class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
              rows="4" required></textarea>
            </div>

            <div class="mb-4">
            <label for="name" class="block text-sm/6 font-medium text-gray-900">Durasi Film (menit)</label>
            <div class="mt-2">
              <input type="number" name="durasi" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
            </div>
          </div>
          <div class="mb-4">
              <div class="flex items-center justify-between">
                  <label for="genre" class="block text-sm/6 font-medium text-gray-900">Genre</label>
              </div>
              <div class="mt-2">
                  <select name="genre[]" id="genre" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" multiple required>
                      @foreach ($genre as $g)
                          <option value="{{ $g->id_genre }}">{{ $g->nama_genre }}</option>
                      @endforeach
                  </select>
              </div>
          </div>
            <div class="mb-4">
              <div class="flex items-center justify-between">
                <label for="tahun" class="block text-sm/6 font-medium text-gray-900">Tahun</label>
              </div>
              <div class="mt-2">
                <select name="tahun" id="tahun" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" required>
                  <option value="">pilih tahun rilis</option>
                  @foreach ($tahun as $t )
                    <option value="{{ $t->id_tahun }}">{{ $t->tahun_rilis }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            
            <div>
              <label for="email" class="block text-sm/6 font-medium text-gray-900">Umur</label>
              <div class="mt-2">
                <select name="usia" id="usia" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" required>
                  <option value="">Film Untuk Usia</option>
                  <option value="anak">anak-anak</option>
                  <option value="remaja">remaja</option>
                  <option value="dewasa">dewasa</option>
                </select>
              </div>
            </div>

            <div class="mb-4">
              <div class="flex items-center justify-between">
                <label for="negara" class="block text-sm/6 font-medium text-gray-900">Negara</label>
              </div>
              <div class="mt-2">
                    <select name="negara" id="negar" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" required>
                      <option value="">pilih negara</option>
                     @foreach ($negara as $n )
                      <option value="{{ $n->id_negara }}">{{ $n->nama_negara }}</option>
                     @endforeach
                    </select>
                </div>
            </div>
            @if (auth()->user()->role == 'admin')
              
            <div class="mb-4">
            
              
              </div>
              @endif
      
            <div class="mb-4">
              <label for="gambar" class="block text-sm/6 font-medium text-gray-900">Gambar Film</label>
              <div class="mt-2">
                <input type="file" name="gambar" id="gambar" autocomplete="gambar" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" required>
              </div>
            </div>

            <div class="mb-4">
              <label for="gambar" class="block text-sm/6 font-medium text-gray-900">Trailer Film</label>
              <div class="mt-2">
                <input type="file" name="trailer" id="trailer" autocomplete="trailer" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" required>
              </div>
            </div>

            <div>
              <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tambah</button>
            </div>
          </form>
        </div>
      </div>
  @endsection
</body>
</html>