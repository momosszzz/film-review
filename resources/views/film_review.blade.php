<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Film review</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css"  rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/star.css') }}">
  <link rel="stylesheet" href="{{ asset('css/star-rating.min.css') }}">
</head>
<body>
<header class="bg-white" x-data="{ isOpen: false, genreOpen: false, negaraOpen: false, tahunOpen: false }">
  <nav class="fixed top-0 left-0 right-0 bg-white z-50 w-full mx-auto flex items-center justify-between p-6 lg:px-8" aria-label="Global">
    <div class="flex lg:flex-1">
      @if (auth()->check())
        @if (auth()->user()->profile)
          <a href="{{ url('custom_user/'. $user->id_user) }}" class="-m-1.5 p-1.5">
            <img class="h-10 w-auto rounded-full" src="{{ asset('profile/' . $user->profile) }}" alt="">
          </a>
        @else
          <a href="{{ url('custom_user/'. $user->id_user) }}" class="-m-1.5 p-1.5">
            <img class="h-10 w-auto rounded-full" src="{{ asset('images/profile.jpg') }}" alt="">
          </a>
        @endif
      @else
        <span class="sr-only">Your Company</span>
        <img class="h-12 w-auto" src="{{ asset('images/logo.png') }}" alt="">
      @endif
    </div>

    @if (auth()->check() && (auth()->user()->role == 'admin' || auth()->user()->role == 'author'))
      <a href="{{ url('/data_film') }}" class="text-sm/6 font-semibold text-white-900">
        <span aria-hidden="true">&larr;</span> Dashboard
      </a>
    @endif

    <div class="flex lg:hidden">
      <button type="button" @click="isOpen = true" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
        <span class="sr-only">Open main menu</span>
        <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
      </button>
    </div>

    <div class="hidden lg:flex lg:gap-x-12 lg:flex-1 justify-center">
      <a href="{{ url('/') }}" class="text-sm/6 font-semibold text-gray-900">Home</a>

      <!-- Genre Dropdown -->
      <div class="relative" x-data="{ isOpen: false }" @click.away="isOpen = false">
        <button type="button" @click="isOpen = !isOpen" class="flex items-center gap-x-1 text-sm/6 font-semibold text-gray-900">
          Genre
          <svg class="size-5 flex-none text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
          </svg>
        </button>

        <!-- Genre Dropdown Content -->
        <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
      </svg>
      </button>

      <div x-show="isOpen"
         x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-75"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="absolute -left-8 top-full z-20 mt-3 w-screen max-w-md overflow-hidden rounded-3xl bg-white shadow-lg ring-1 ring-gray-900/5">
          <div class="p-4">
            <div class="grid grid-cols-2 gap-4">
              @foreach($genre as $g)
                <div class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50">
                  <div class="flex-auto">
                    <a href="{{ url('/filter/genre/'.$g->id_genre) }}" class="block font-semibold text-gray-900">
                      {{ $g->nama_genre }}
                      <span class="absolute inset-0"></span>
                    </a>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>

      <!-- Tahun Dropdown Desktop -->
      <div class="relative" x-data="{ isOpen: false }" @click.away="isOpen = false" >
        <button type="button" 
                @click="isOpen = !isOpen"
                class="flex items-center gap-x-1 text-sm/6 font-semibold text-gray-900" 
                aria-expanded="false">
          Tahun
          <svg class="size-5 flex-none text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
          </svg>
        </button>

        <div x-show="isOpen"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-75"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="absolute -left-8 top-full z-20 mt-3 w-screen max-w-md overflow-hidden rounded-3xl bg-white shadow-lg ring-1 ring-gray-900/5">
          <div class="p-4">
            <div class="grid grid-cols-3 gap-4">
              @foreach($tahun as $t)
                <div class="group relative flex items-center gap-x-6 rounded-lg p-2 text-sm/6 hover:bg-gray-50">
                  <div class="flex-auto">
                    <a href="{{ url('/filter/tahun/'.$t->id_tahun) }}" class="block font-semibold text-gray-900">
                      {{ $t->tahun_rilis }}
                      <span class="absolute inset-0"></span>
                    </a>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>

      <div class="relative" x-data="{ isOpen: false }" @click.away="isOpen = false" >
        <button type="button" 
                @click="isOpen = !isOpen"
                class="flex items-center gap-x-1 text-sm/6 font-semibold text-gray-900" 
                aria-expanded="false">
            Negara
            <svg class="size-5 flex-none text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
            </svg>
        </button>
    
        <div x-show="isOpen"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-75"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="absolute -left-8 top-full z-20 mt-3 w-screen max-w-md overflow-hidden rounded-3xl bg-white shadow-lg ring-1 ring-gray-900/5">
            <div class="p-4">
                <div class="grid grid-cols-2 gap-4">
                    @foreach($negara as $n)
                        <div class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50">
                            <div class="flex-auto">
                                <a href="{{ url('/filter/negara/'.$n->id_negara) }}" class="block font-semibold text-gray-900">
                                    {{ $n->nama_negara }}
                                    <span class="absolute inset-0"></span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="hidden lg:flex lg:flex-1 lg:justify-end">
      @if(auth()->check())
          <span class="text-sm/6 font-semibold text-gray-900 mr-4">
              {{ auth()->user()->name }}
          </span>
          <a href="{{ url('/logout') }}" class="text-sm/6 font-semibold text-gray-900">
              Logout <span aria-hidden="true">&rarr;</span>
          </a>
      @else
          <a href="{{ url('/login') }}" class="text-sm/6 font-semibold text-gray-900">
              Log in <span aria-hidden="true">&rarr;</span>
          </a>
          <a href="{{ url('/register') }}" class="text-sm/6 font-semibold text-gray-900 ml-4">
              Register <span aria-hidden="true">&rarr;</span>
          </a>
      @endif
  </div>
  </nav>
    <!-- Mobile menu, show/hide based on menu open state. -->
    <div class="lg:hidden" role="dialog" aria-modal="true">
      <div class="fixed inset-0 z-10" x-show="isOpen"></div>
      <div x-show="isOpen"
           x-transition:enter="transition ease-out duration-200"
           x-transition:enter-start="opacity-0 scale-95" 
           x-transition:enter-end="opacity-100 scale-100"
           x-transition:leave="transition ease-in duration-75"
           x-transition:leave-start="opacity-100 scale-100"
           x-transition:leave-end="opacity-0 scale-95"
           class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
        <div class="flex items-center justify-between">
          @if (auth()->check())
            @if (auth()->user()->profile)
                <a href="{{ url("custom_user/". $user->id_user) }}" class="-m-1.5 p-1.5">
                    <img class="h-10 w-auto rounded-full" src="{{ asset('profile/' . $user->profile) }}" alt="">
                </a>
            @else
                <a href="{{ url("custom_user/". $user->id_user) }}" class="-m-1.5 p-1.5">
                    <img class="h-10 w-auto rounded-full" src="{{ asset('images/profile.jpg') }}" alt="">
                </a>
            @endif
        @else
            <span class="sr-only">Your Company</span>
            <img class="h-12 w-auto" src="{{ asset('images/logo.png') }}" alt="">
        @endif
          <button type="button" 
                  @click="isOpen = false"
                  class="-m-2.5 rounded-md p-2.5 text-gray-700">
            <span class="sr-only">Close menu</span>
            <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <div class="mt-6 flow-root">
          <div class="-my-6 divide-y divide-gray-500/10">
            <div class="space-y-2 py-6">
              <a href="{{ url('/') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Home</a>
              
              <!-- Genre Dropdown Mobile -->
              <div class="-mx-3">
                <button type="button" 
                        @click="genreOpen = !genreOpen"
                        class="flex w-full items-center justify-between rounded-lg py-2 pl-3 pr-3.5 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">
                  Genre
                  <svg class="size-5 flex-none" 
                       :class="{ 'rotate-180': genreOpen }"
                       viewBox="0 0 20 20" 
                       fill="currentColor" 
                       aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                  </svg>
                </button>
                <div class="mt-2" 
                     x-show="genreOpen"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0">
                  <div class="grid grid-cols-2 gap-2 px-3">
                    @foreach($genre as $g)
                      <a href="{{ url('/filter/genre/'.$g->id_genre) }}" class="block rounded-lg py-2 pl-6 pr-3 text-sm font-semibold text-gray-900 hover:bg-gray-50">
                        {{ $g->nama_genre }}
                      </a>
                    @endforeach
                  </div>
                </div>
              </div>

              <!-- Tahun Dropdown Mobile -->
              <div class="-mx-3">
                <button type="button" 
                        @click="tahunOpen = !tahunOpen"
                        class="flex w-full items-center justify-between rounded-lg py-2 pl-3 pr-3.5 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">
                  Tahun
                  <svg class="size-5 flex-none" 
                       :class="{ 'rotate-180': tahunOpen }"
                       viewBox="0 0 20 20" 
                       fill="currentColor" 
                       aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                  </svg>
                </button>
                <div class="mt-2" 
                     x-show="tahunOpen"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0">
                  <div class="grid grid-cols-2 gap-2 px-3">
                    @foreach($tahun as $t)
                      <a href="{{ url('/filter/tahun/'.$t->id_tahun) }}" class="block rounded-lg py-2 pl-6 pr-3 text-sm font-semibold text-gray-900 hover:bg-gray-50">
                        {{ $t->tahun_rilis }}
                      </a>
                    @endforeach
                  </div>
                </div>
              </div>

              <!-- Negara Dropdown Mobile -->
              <div class="-mx-3">
                <button type="button" 
                        @click="negaraOpen = !negaraOpen"
                        class="flex w-full items-center justify-between rounded-lg py-2 pl-3 pr-3.5 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">
                    Negara
                    <svg class="size-5 flex-none" 
                         :class="{ 'rotate-180': negaraOpen }"
                         viewBox="0 0 20 20" 
                         fill="currentColor" 
                         aria-hidden="true">
                        <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                    </svg>
                </button>
                <div class="mt-2" 
                     x-show="negaraOpen"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0">
                    <div class="grid grid-cols-2 gap-2 px-3">
                        @foreach($negara as $n)
                            <a href="{{ url('/filter/negara/'.$n->id_negara) }}" class="block rounded-lg py-2 pl-6 pr-3 text-sm font-semibold text-gray-900 hover:bg-gray-50">
                                {{ $n->nama_negara }}
                            </a>
                        @endforeach
                    </div>
                </div>
              </div>
            </div>
            <div class="py-6">
              @if(auth()->check())
                  <span class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-gray-900">
                      {{ auth()->user()->name }}
                  </span>
                  <a href="{{ url('/logout') }}" class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Logout</a>
              @else
                  <a href="{{ url('/login') }}" class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Log in</a>
                  <a href="{{ url('/register') }}" class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Register</a>
              @endif
          </div>
          </div>
          </div>
        </div>
      </div>
    </div>
    <!--
  Heads up! 👋

  Plugins:
    - @tailwindcss/forms
-->

</div>

<div class="flex justify-center"> 
  <video class="w-full h-auto max-w-full" autoplay controls>
    <source src="{{ asset('vidio_trailer/' . $films->trailer) }}" type="video/mp4">
    Your browser does not support the video tag.
  </video>
</div>

<div class="flex justify-center mt-16 px-8">
  <article class="flex bg-white transition hover:shadow-xl max-w-4xl w-full h-1000">
    <div class="rotate-180 p-2 [writing-mode:_vertical-lr]">
      <time
        datetime="2022-10-10"
        class="flex items-center justify-between gap-4 text-xs font-bold uppercase text-gray-900"
      >
        <span>{{ $films->tahun_rilis }}</span>
        <span class="w-px flex-1 bg-gray-900/10"></span>
        <span>{{ $films->tanggal_rilis }}</span>
      </time>
    </div>

    <div class="basis-32 sm:basis-56 h-full">
      <img
        alt="{{ $films->judul }}"
        src="{{ asset('gambar_film/' . $films->gambar_film) }}"
        class="aspect-[3/4] h-full w-full object-cover"
      />
    </div>

    <!-- Bagian Informasi Film -->
    <div class="flex flex-1 flex-col justify-between">
      <div class="border-s border-gray-900/10 p-4 sm:border-l-transparent sm:p-6">
          <h3 class="font-bold uppercase text-gray-900">
            {{ $films->nama_film }}
          </h3>

        <p class="mt-2 text-sm/relaxed text-gray-700">
          <strong>Genre:</strong> 
          @foreach($films->genreRelasi as $genre)
              {{ $genre->nama_genre }}
              @if(!$loop->last)
                  , 
              @endif
          @endforeach
        </p>
        <p class="mt-2 text-sm/relaxed text-gray-700">
          <strong>Tahun Rilis:</strong> 
          {{ $films->tahunRelasi ? $films->tahunRelasi->tahun_rilis : 'Tahun tidak ditemukan' }}
        </p>
        <p class="mt-2 text-sm/relaxed text-gray-700">
          <strong>Negara:</strong> 
          {{ $films->negaraRelasi ? $films->negaraRelasi->nama_negara : 'Negara tidak ditemukan' }}
        </p>
        <p class="mt-2 text-sm/relaxed text-gray-700">
          <strong>Sinopsis:</strong> 
          {{ $films->deskripsi }}
        </p>
      </div>
    </div>
  </article>
</div>
<div class="border-t border-gray-200 mt-4 pt-4 w-full">
  <h4 class="font-bold text-gray-900 mb-4 text-center" id="komentar">Komentar</h4>
  @php
  $totalReviews = $films->komentarRelasi->count();
  
  // Calculate counts for each star rating
  $fiveStars = $films->komentarRelasi->where('rating_user', 5)->count();
  $fourStars = $films->komentarRelasi->where('rating_user', 4)->count();
  $threeStars = $films->komentarRelasi->where('rating_user', 3)->count();
  $twoStars = $films->komentarRelasi->where('rating_user', 2)->count();
  $oneStar = $films->komentarRelasi->where('rating_user', 1)->count();
  
  // Calculate percentages
  $fiveStarPercent = $totalReviews > 0 ? ($fiveStars / $totalReviews) * 100 : 0;
  $fourStarPercent = $totalReviews > 0 ? ($fourStars / $totalReviews) * 100 : 0;
  $threeStarPercent = $totalReviews > 0 ? ($threeStars / $totalReviews) * 100 : 0;
  $twoStarPercent = $totalReviews > 0 ? ($twoStars / $totalReviews) * 100 : 0;
  $oneStarPercent = $totalReviews > 0 ? ($oneStar / $totalReviews) * 100 : 0;
  
  // Calculate average rating
  $averageRating = $totalReviews > 0 ? $films->komentarRelasi->avg('rating_user') : 0;
@endphp
  
@if(auth()->check())
    @php
        $hasCommented = $films->komentarRelasi->where('id_user', auth()->user()->id_user)->count() > 0;
    @endphp

    @if(!$hasCommented)
        <form action="{{ url('/tambah-komentar' ) }}" method="POST" class="mb-6">
            @csrf
            <div class="flex justify-center items-center mb-4">
                <div class="form-field">
                    <select id="glsr-ltr" class="star-rating" name="rating_user" required>
                        <option value="">Select a rating</option>
                        <option value="5">Fantastic</option>
                        <option value="4">Great</option>
                        <option value="3">Good</option>
                        <option value="2">Poor</option>
                        <option value="1">Terrible</option>
                    </select>
                </div>
            </div>
            
            <input type="hidden" name="id_film" value="{{ $films->id_film }}">
            <div class="flex flex-col items-center w-full">
              <div class="w-1/2 flex flex-col items-center space-y-2">
                <textarea
                  name="komentar"
                  rows="3"
                  class="w-full rounded-lg border-gray-200 p-3 text-sm resize-none"
                  placeholder="Tulis komentar Anda..."
                ></textarea>
                <button
                  type="submit"
                  class="rounded bg-indigo-600 px-6 py-2 text-sm font-medium text-white hover:bg-indigo-700 transition duration-200"
                >
                  Kirim
                </button>
              </div>
            </div>
        </form>
    @else
        <p class="text-center text-gray-500 mb-4">Anda sudah memberikan komentar untuk film ini</p>
    @endif
@else
<p class="text-center text-gray-500 mb-4">
    <a href="{{ url('/login') }}" class="text-indigo-600 hover:underline">Login</a>
    untuk memberikan komentar
</p>
@endif

  
  
  <div class="flex justify-center items-center mb-4">
    @for ($i = 1; $i <= 5; $i++)
    @if ($i <= round($averageRating))
        <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
        </svg>
    @else
        <svg class="w-4 h-4 text-gray-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
        </svg>
    @endif
    @endfor
        <p class="ms-1 text-sm font-medium text-gray-500 dark:text-gray-400">{{ number_format($averageRating, 2) }}</p>
        <p class="ms-1 text-sm font-medium text-gray-500 dark:text-gray-400">out of</p>
        <p class="ms-1 text-sm font-medium text-gray-500 dark:text-gray-400">5</p>
      </div>
          <p class="text-center font-medium text-gray-500 dark:text-gray-400"><strong>{{ $films->komentarRelasi->count() }} total review</strong></p>
          <div class="flex justify-center items-center mt-4">
            <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                <div class="h-5 bg-yellow-300 rounded" style="width: {{ number_format($fiveStarPercent, 1) }}%"></div>
            </div>
            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ number_format($fiveStarPercent, 1) }}%</span>
        </div>
        
        <div class="flex justify-center items-center mt-4">
            <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                <div class="h-5 bg-yellow-300 rounded" style="width: {{ number_format($fourStarPercent, 1) }}%"></div>
            </div>
            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ number_format($fourStarPercent, 1) }}%</span>
        </div>
        
        <div class="flex justify-center items-center mt-4">
            <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                <div class="h-5 bg-yellow-300 rounded" style="width: {{ number_format($threeStarPercent, 1) }}%"></div>
            </div>
            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ number_format($threeStarPercent, 1) }}%</span>
        </div>
        
        <div class="flex justify-center items-center mt-4">
            <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                <div class="h-5 bg-yellow-300 rounded" style="width: {{ number_format($twoStarPercent, 1) }}%"></div>
            </div>
            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ number_format($twoStarPercent, 1) }}%</span>
        </div>
        
        <div class="flex justify-center items-center mt-4 mb-10">
            <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                <div class="h-5 bg-yellow-300 rounded" style="width: {{ number_format($oneStarPercent, 1) }}%"></div>
            </div>
            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ number_format($oneStarPercent, 1) }}%</span>
        </div>
    
      
      <!-- Daftar Komentar -->
  <div class="space-y-4">
    @foreach($komentar as $k)
      <div class="flex gap-4 border-b border-gray-100 pb-4 hover:bg-gray-50 transition duration-200">
          @if ($k->user)
              @if ($k->user->profile)
                  <img class="h-10 w-auto rounded-full" src="{{ asset('profile/' . $k->user->profile) }}" alt="">
              @else
                  <img class="h-10 w-auto rounded-full" src="{{ asset('images/profile.jpg') }}" alt="">
              @endif
          @else
              <img class="h-10 w-auto rounded-full" src="{{ asset('images/profile.jpg') }}" alt="">
          @endif
        <div class="flex-1">
          <div class="flex items-center gap-2 mb-1">
            <strong class="text-gray-900 text-sm">{{ $k->user->name }}</strong>
            <span class="text-gray-500 text-xs">
              {{ $k->created_at->diffForHumans() }}
            </span>
          </div>
          <div class="flex items-center mb-2">
            @for($i = 1; $i <= 5; $i++)
                @if($i <= $k->rating_user)
                    <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                    </svg>
                @else
                    <svg class="w-4 h-4 text-gray-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                    </svg>
                @endif
            @endfor
            <span class="text-sm text-gray-500 ml-1">({{ $k->rating_user }}/5)</span>
        </div>
          <p class="text-gray-700 text-sm" id="comment-{{ $k->id_komentar }}">
            {{ $k->komentar }}
          </p>
          @if(auth()->check() && auth()->user()->id_user == $k->id_user)
            <div class="flex items-center mt-2">
              <button type="button" class="text-blue-600" onclick="toggleEdit('{{ $k->id_komentar }}')">Edit</button>
              <form action="{{ url('delete-komentar/'.$k->id_komentar . '/' . $films->id_film) }}" method="POST" class="ml-2">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600">Hapus</button>
              </form>
            </div>
            <form action="{{ url('edit-komentar/'.$k->id_komentar . '/'.$films->id_film) }}" method="POST" class="mt-2 hidden" id="edit-form-{{ $k->id_komentar }}">
              @csrf
              <input type="text" name="komentar" value="{{ $k->komentar }}" class="border rounded p-1" required>
              <button type="submit" class="ml-2 text-blue-600">Simpan</button>
            </form>
          @endif
        </div>
      </div>
    @endforeach
  </div>
</div>

</header>
  <!--
  Heads up! 👋

  Plugins:
    - @tailwindcss/forms
-->

<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
<script src="{{ asset('js/star-rating.min.js') }}"></script>
</body>
</html>

<script>
function toggleEdit(commentId) {
    const commentElement = document.getElementById('comment-' + commentId);
    const editFormElement = document.getElementById('edit-form-' + commentId);
    
    if (editFormElement) {
        editFormElement.classList.toggle('hidden');
    }
}
</script>
<script>
  var destroyed = false;
  var starratingPrebuilt = new StarRating('.star-rating-prebuilt', {
      prebuilt: true,
      maxStars: 5,
  });
  var starrating = new StarRating('.star-rating', {
      stars: function (el, item, index) {
          el.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><rect class="gl-star-full" width="19" height="19" x="2.5" y="2.5"/><polygon fill="#FFF" points="12 5.375 13.646 10.417 19 10.417 14.665 13.556 16.313 18.625 11.995 15.476 7.688 18.583 9.333 13.542 5 10.417 10.354 10.417"/></svg>';
      },
  });
  var starratingOld = new StarRating('.star-rating-old');
  document.querySelector('.toggle-star-rating').addEventListener('click', function () {
      if (!destroyed) {
          starrating.destroy();
          starratingOld.destroy();
          starratingPrebuilt.destroy()
          destroyed = true;
      } else {
          starrating.rebuild();
          starratingOld.rebuild();
          starratingPrebuilt.rebuild()
          destroyed = false;
      }
  });
</script>

