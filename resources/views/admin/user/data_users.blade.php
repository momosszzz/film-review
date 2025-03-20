<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data User</title>
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
  <a href="{{ url('/tambah_user') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Tambah</a>
  <div class="relative justify-center flex h-[42px] w-full">
    <form class="max-w-md mx-auto" action="{{ url('/search_user') }}" method="GET">   
      <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
      <div class="relative">
          <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
              <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
              </svg>
          </div>
          <input type="search" name="search_user" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500  placeholder="Search Mockups, Logos..." required />
          <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
      </div>
  </form>
</div>
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
              <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Profile User</th>
              <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Nama User</th>
              <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Email</th>
              <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Usia</th>
              <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Negara</th>
              <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Gelar</th>
              <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Opsi</th>
            </tr>
          </thead>
      
          <tbody class="divide-y divide-gray-200">
            @foreach ($users as $user)
              
            <tr>
              <td class="whitespace-nowrap px-4 py-2 text-gray-700 text-center">
                <div class="flex justify-center">
                @if ($user->profile)
                <a href="{{ url("custom_user/". $user->id_user) }}" class="-m-1.5 p-1.5">
                    <img class="h-10 w-auto rounded-full" src="{{ asset('profile/' . $user->profile) }}" alt="">
                </a>
                @else
                    <img class="h-10 w-auto rounded-full" src="{{ asset('images/profile.jpg') }}" alt="">
                @endif
              </div>
              </td>
              <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-center">{{ $user->name }}</td>
              <td class="whitespace-nowrap px-4 py-2 text-gray-700 text-center">{{ $user->email }}</td>
              <td class="whitespace-nowrap px-4 py-2 text-gray-700 text-center">{{ $user->usia }}</td>
              <td class="whitespace-nowrap px-4 py-2 text-gray-700 text-center">{{ $user->Negara }}</td>
              <td class="whitespace-nowrap px-4 py-2 text-gray-700 text-center">{{ $user->role }}</td>
              
              <td class="whitespace-nowrap px-4 py-2 text-gray-700 text-center"><span class="inline-flex overflow-hidden rounded-md border bg-white shadow-sm">
              
                <a href="{{ url('/user/edit/' . $user->id_user) }}"
                  class="inline-block border-e p-3 text-gray-700 hover:bg-gray-50 focus:relative"
                  title="Edit User"
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
                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
                    />
                  </svg>
                </a>
                <form action="{{ url('user/delete') }}" method="POST">
                  @method('DELETE')
                  @csrf
                  <input type="hidden" name="id_user" value="{{ $user->id_user }}">
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