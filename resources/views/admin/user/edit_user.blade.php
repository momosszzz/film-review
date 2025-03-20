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
    <title>Edit User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
@extends('admin.sidebar')
<body>
  @section('content')
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
          <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Edit {{ $user->name }}</h2>
        </div>
      
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
          <form class="space-y-6" action="{{ url('edit/user/proses') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id_user" value="{{ $user->id_user }}">
            <div>
              <label for="email" class="block text-sm/6 font-medium text-gray-900">Nama Lengkap</label>
              <div class="mt-2">
                <input type="text" name="name" id="email" autocomplete="name" value="{{ $user->name }}" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
              </div>
            </div>

            <div>
              <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
              <div class="mt-2">
                <input type="email" name="email" id="email" autocomplete="email" value="{{ $user->email }}" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
              </div>
            </div>

            <div>
              <label for="email" class="block text-sm/6 font-medium text-gray-900">Umur</label>
              <div class="mt-2">
                <select name="usia" id="usia" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" required>
                  <option value="">Pilih Umur</option>
                  <option value="anak" {{ $user->usia == 'anak' ? 'selected' : '' }}>6-12</option>
                  <option value="remaja" {{ $user->usia == 'remaja' ? 'selected' : '' }}>13-18</option>
                  <option value="dewasa" {{ $user->usia == 'dewasa' ? 'selected' : '' }}>19-60</option>
                </select>
              </div>
            </div>
            <div>
              <label for="email" class="block text-sm/6 font-medium text-gray-900">Negara</label>
              <div class="mt-2">
                <input type="text" name="Negara" id="email" autocomplete="Negara" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
              </div>
            </div>

            <div>
              <div class="flex items-center justify-between">
                <label for="role" class="block text-sm/6 font-medium text-gray-900">Gelar</label>
              </div>
              <div class="mt-2">
                <select name="role" id="role" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" required>
                  <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>user</option>
                  <option value="author" {{ $user->role == 'author' ? 'selected' : '' }}>author</option>
                  <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>admin</option>
                </select>
              </div>
            </div>

            <div>
              <label for="gambar" class="block text-sm/6 font-medium text-gray-900">avatar</label>
              <div class="mt-2">
                <input type="file" name="avatar" id="gambar" autocomplete="gambar" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
              </div>
            </div>
            
            <div>
              <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Simpan</button>
            </div>
          </form>
        </div>
      </div>
  @endsection  
</body>
</html>