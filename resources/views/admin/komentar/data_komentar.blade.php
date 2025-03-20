<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Komentar Film</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
@extends('admin.sidebar')
<body>
    @section('content')
    <h3 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900 mb-5">Komentar Film {{ $film->nama_film }}</h3>
    <div class="flex justify-center mb-4">
        <div class="basis-32 sm:basis-56 h-full">
            <img
              alt="{{ $film->judul }}"
              src="{{ asset('gambar_film/' . $film->gambar_film) }}"
              class="aspect-[3/4] h-full w-full object-cover"
            />
          </div>
    </div>
    <div class="border-t border-gray-200 mt-4 pt-4 w-full">
        <h4 class="font-bold text-gray-900 mb-4 text-center" id="komentar">Komentar</h4>
        @php
        $totalReviews = $film->komentarRelasi->count();
        
        // Calculate counts for each star rating
        $fiveStars = $film->komentarRelasi->where('rating_user', 5)->count();
        $fourStars = $film->komentarRelasi->where('rating_user', 4)->count();
        $threeStars = $film->komentarRelasi->where('rating_user', 3)->count();
        $twoStars = $film->komentarRelasi->where('rating_user', 2)->count();
        $oneStar = $film->komentarRelasi->where('rating_user', 1)->count();
        
        // Calculate percentages
        $fiveStarPercent = $totalReviews > 0 ? ($fiveStars / $totalReviews) * 100 : 0;
        $fourStarPercent = $totalReviews > 0 ? ($fourStars / $totalReviews) * 100 : 0;
        $threeStarPercent = $totalReviews > 0 ? ($threeStars / $totalReviews) * 100 : 0;
        $twoStarPercent = $totalReviews > 0 ? ($twoStars / $totalReviews) * 100 : 0;
        $oneStarPercent = $totalReviews > 0 ? ($oneStar / $totalReviews) * 100 : 0;
        
        // Calculate average rating
        $averageRating = $totalReviews > 0 ? $film->komentarRelasi->avg('rating_user') : 0;
      @endphp
        
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
                <p class="text-center font-medium text-gray-500 dark:text-gray-400"><strong>{{ $film->komentarRelasi->count() }} total review</strong></p>
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
                  <div class="flex items-center mt-2">
                    <form action="{{ url('hapus-komentar/'.$k->id_komentar . '/' . $film->id_film) }}" method="POST" class="ml-2">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="text-red-600">Hapus</button>
                    </form>
                  </div>    
              </div>
            </div>
          @endforeach
        </div>
      </div>
    @endsection
</body>
</html>
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
  