<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Komentar Film</title>
</head>
@extends('admin.sidebar')
<body>
    @section('content')
<div class="mb-4">
    <form class="max-w-md mx-auto" action="{{ url('') }}" method="GET">   
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500  placeholder="Search Mockups, Logos..." required />
            <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
        </div>
    </form>
</div>
    <div class="overflow-x-auto rounded-lg border border-gray-200">
        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
          <thead class="ltr:text-left rtl:text-right">
            <tr>
              <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Gambar film</th>
              <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Nama Film</th>
              <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Komentar Film</th>
            </tr>
          </thead>
      
          <tbody class="divide-y divide-gray-200">
            @foreach ($film as $f)
            <tr>
              <td class="whitespace-nowrap px-4 py-2 text-gray-700 text-center">
                <img 
                  src="{{ asset('gambar_film/' . $f->gambar_film) }}" 
                  alt="gambar" 
                  class="w-24 h-32 object-cover rounded-lg"
                >
              </td>
              <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-center">{{ $f->nama_film }}</td>
              <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-center">
                <a href="{{ url('komentar_film/' . $f->id_film) }}"
                    class="inline-flex items-center gap-2 rounded-md px-4 py-2 text-sm bg-blue-600 hover:bg-blue-700 text-white focus:relative"
                >
                    <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="size-4"
                    >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"
                    />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>

                    View
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endsection
</body>
</html>