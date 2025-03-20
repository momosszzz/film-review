<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Negara</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css"  rel="stylesheet" />
</head>
@extends('admin.sidebar')
<body>
    @section('content')
    <!--
  Heads up! 👋

  This component comes with some `rtl` classes. Please remove them if they are not needed in your project.
-->
<div class="mb-4 flex items-center gap-4">    
  <a href="{{ url('/tambah_negara') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Tambah</a>
</div>
@if(session('error'))
<div role="alert" class="rounded border-s-4 border-red-500 bg-red-50 p-4">
    <strong class="block font-medium text-red-800">Aduhh broo!</strong>
    <p class="mt-2 text-sm text-red-700">{{ session('error') }}</p>
</div>
@endif

@if(session('success'))
<div role="alert" class="rounded-xl border border-gray-100 bg-white p-4">
    <div class="flex items-start gap-4">
        <span class="text-green-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </span>
        <div class="flex-1">
            <strong class="block font-medium text-gray-900">Mantapp!</strong>
            <p class="mt-1 text-sm text-gray-700">{{ session('success') }}</p>
        </div>
        <button class="text-gray-500 transition hover:text-gray-600">
            <span class="sr-only">Dismiss popup</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>
@endif
    <div class="overflow-x-auto rounded-lg border border-gray-200">
        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
          <thead class="ltr:text-left rtl:text-right">
            <tr>
              <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">NO</th>
              <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Negara</th>
              <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Opsi</th>
            </tr>
          </thead>
      
          <tbody class="divide-y divide-gray-200">
            @foreach ($negara as $negara)
              
            <tr>
              <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-center">{{ $negara->id_negara }}</td>
              <td class="whitespace-nowrap px-4 py-2 text-gray-700 text-center">{{ $negara->nama_negara }}</td>
              <td class="whitespace-nowrap px-4 py-2 text-gray-700 text-center"><span class="inline-flex overflow-hidden rounded-md border bg-white shadow-sm">
              
                <form action="{{ url('negara/delete') }}" method="POST">
                  @method('DELETE')
                  @csrf
                  <input type="hidden" name="id_negara" value="{{ $negara->id_negara }}">
                <button
                  class="inline-block p-3 text-gray-700 hover:bg-gray-50 focus:relative"
                  title="Delete Product" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
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
                  d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                  />
                </svg>
              </button>
            </form>
            </span>
          </td>
        </tr>
        @endforeach
          </tbody>
        </table>
      </div>
      
    @endsection
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
          const dismissButton = document.querySelector('[class="text-gray-500 transition hover:text-gray-600"]');
          const alert = dismissButton?.closest('[role="alert"]');
          
          if (dismissButton && alert) {
              dismissButton.addEventListener('click', () => {
                  alert.remove();
              });
          }
      });
  </script>
  
</body> 
</html>