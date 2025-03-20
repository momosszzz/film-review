<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Custom User</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css"  rel="stylesheet" />
</head>
<body>
    @if(session('error'))
    <div role="alert" class="rounded border-s-4 border-red-500 bg-red-50 p-4">
        <strong class="block font-medium text-red-800">Aduhh salah nii!</strong>
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
    <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Custom Your Profile</h2>
<div class="flex justify-center mt-10">
    @if (auth()->user()->profile)
    <a href="{{ url("custom_user/". $user->id_user) }}" class="-m-1.5 p-1.5">
        <img class="rounded-full w-auto h-20" src="{{ asset('profile/' . $user->profile) }}" alt="image description">
    </a>
    @else
    <a href="{{ url("custom_user/". $user->id_user) }}" class="-m-1.5 p-1.5">
        <img class="rounded-full w-auto h-20" src="{{ asset('images/profile.jpg') }}" alt="image description">
    </a>
@endif
</div>
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="mt-5 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" action="{{ url('custom_user/edit') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="id_user" value="{{ $user ? $user->id_user : '' }}">
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
            <label for="gambar" class="block text-sm/6 font-medium text-gray-900">avatar</label>
            <div class="mt-2">
              <input type="file" name="avatar" id="gambar" autocomplete="gambar" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
            </div>
          </div>
          <div class="text-sm flex justify-center">
            <a href="{{ url('lupa_sandi/' . $user->id_user) }}" class="font-semibold text-indigo-600 hover:text-indigo-500">Riset Password</a>
          </div>
          <div>
            <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Simpan</button>
          </div>
        </form>
      </div>
</div>
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