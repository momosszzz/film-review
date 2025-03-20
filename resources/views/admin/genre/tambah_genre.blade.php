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
    <title>Tambah Genre</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
@extends('admin.sidebar')
<body>
  @section('content')

    @if(session('error'))
        <div role="alert" class="rounded border-s-4 border-red-500 bg-red-50 p-4">
            <strong class="block font-medium text-red-800">Aduh broo!</strong>
            <p class="mt-2 text-sm text-red-700">{{ session('error') }}</p>
        </div>
    @endif

    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
          <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Tambah Genre</h2>
        </div>
      
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
          <form class="space-y-6" action="{{ url('tambah/genre/proses') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
              <label for="genre" class="block text-sm/6 font-medium text-gray-900">Nomer Genre</label>
              <div class="mt-2">
                <input type="number" name="id_genre" id="genre" autocomplete="genre" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
              </div>
            </div>

            <div>
              <label for="email" class="block text-sm/6 font-medium text-gray-900">Genre</label>
              <div class="mt-2">
                <input type="text" name="genre" id="genre" autocomplete="genre" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
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