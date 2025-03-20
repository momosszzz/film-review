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
           class="fixed inset-y-0 right-0 z-20 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
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
                  <a href="{{ url('/login_film') }}" class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Log in</a>
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

</header>
  <!--
  Heads up! 👋

  Plugins:
    - @tailwindcss/forms
-->

<div class="relative justify-center flex mb-4 sm:mb-8 mt-20">
  <form action="{{ url('/search') }}" method="GET" class="w-1/2">
    <label for="Search" class="sr-only">Search</label>

    <input
      type="text"
      id="Search"
      name="search"
      placeholder="Search film..."
      class="w-full rounded-md border-gray-200 py-2 sm:py-2.5 pe-10 shadow-sm sm:text-sm"
    />

    <span class="absolute inset-y-0 end-0 grid w-1/2 place-content-center right-5">
      <button type="submit" class="text-gray-600 hover:text-gray-700">
        <span class="sr-only">Search</span>

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
            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"
          />
        </svg>
      </button>
    </span>
  </form>
</div>

<!-- Banner Carousel -->
<div class="container mx-auto px-2 sm:px-4 mb-4 sm:mb-8">
    <div id="controls-carousel" class="relative w-full" data-carousel="static">
        <!-- Carousel wrapper -->
        <div class="relative h-40 sm:h-56 overflow-hidden rounded-lg md:h-96">
             <!-- Item 1 -->
             <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
               <img src="{{ asset('images/banner2.jpg') }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
              </div>
             <!-- Item 2 -->
              <div class="hidden duration-700 ease-in-out" data-carousel-item>
                  <img src="{{ asset('images/banner3.jpg') }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
              </div>
              <!-- Item 3 -->
              <div class="hidden duration-700 ease-in-out" data-carousel-item>
                  <img src="{{ asset('images/banner1.jpg') }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
              </div>
            <!-- Item 4 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{ asset('images/banner4.jpg') }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 5 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{ asset('images/Tanpa Judul.jpg') }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
        </div>
        <!-- Slider controls -->
        <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-2 sm:px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
            <span class="inline-flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-3 h-3 sm:w-4 sm:h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-2 sm:px-4 cursor-pointer group focus:outline-none" data-carousel-next>
            <span class="inline-flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-3 h-3 sm:w-4 sm:h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>
</div> 

<!-- Bagian tampilan film -->
<div class="container mx-auto px-2 sm:px-4 py-4 sm:py-8">
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-6">
        @foreach($films as $film)
            <a href="{{ url('/film/review/' . $film->id_film) }}" class="block group">
                <article class="relative overflow-hidden rounded-lg shadow-md transition-all duration-300 group-hover:-translate-y-1 group-hover:shadow-xl h-[250px] sm:h-[350px]">
                      <!-- Rating di pojok kiri atas -->
                      <div class="absolute top-2 right-2 bg-yellow-400 text-black text-sm font-bold px-2 py-1 rounded">
                        ⭐ {{ number_format($film->rating, 1) }}
                    </div>

                        <!-- Durasi di pojok kanan atas -->
                      <div class="absolute top-2 right-2 flex items-center bg-black/50 rounded-lg px-2 py-1 z-10">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                          <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd"/>
                        </svg>
                          <p class="text-xs sm:text-sm font-bold text-white">{{ $film->durasi ?? '120' }} min</p>
                        </div>

                      <img
                          alt="{{ $film->nama_film }}"
                          src="{{ asset('gambar_film/'.$film->gambar_film) }}"
                          class="absolute inset-0 h-full w-full object-cover"
                      />

                      <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent">
                          <div class="absolute bottom-0 left-0 right-0 p-2 sm:p-6 text-center">
                              <h3 class="text-sm sm:text-base text-white font-bold">{{ $film->nama_film }}</h3>

                              <p class="mt-1 text-xs text-white/95 justify-center">
                                {{ $film->tahunRelasi->tahun_rilis}}
                              </p>
                              <p class="text-xs text-white/95">
                                • 
                                @foreach($film->genreRelasi as $genre)
                                    {{ $genre->nama_genre }}
                                    @if(!$loop->last)
                                        , 
                                    @endif
                                @endforeach
                              </p>
                          </div>
                      </div>
                  </article>
              </a>
        @endforeach
    </div>
</div>  
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>

<!-- Modal untuk menampilkan pesan kesalahan -->
@if(session('error'))
<div id="popup-modal" tabindex="-1" class="fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-full bg-black bg-opacity-50 flex" onclick="closeModal(event)">
    <div class="relative p-4 w-full max-w-md max-h-full" onclick="event.stopPropagation();">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="closeModal(event)">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">{{ session('error') }}</h3>
                <button onclick="closeModal(event)" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Script untuk menutup modal -->
<script>
function closeModal(event) {
    const modal = document.getElementById('popup-modal');
    modal.classList.add('hidden'); // Menyembunyikan modal
}
</script>
</html>