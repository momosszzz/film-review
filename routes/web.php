<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FilmController;
use App\Models\Film;
use Illuminate\Container\Attributes\Auth;

Route::get('/filter/tahun/{id}', [HomeController::class, 'filterTahun']);
Route::get('/filter/genre/{id}', [HomeController::class, 'filterGenre']);
Route::get('/filter/negara/{id}', [HomeController::class, 'filterNegara']);
Route::get('/search', [HomeController::class, 'search']);
Route::get('/', [HomeController::class, 'index']);
Route::get('/film/review/{id}', [HomeController::class, 'filmReview']);



Route::middleware('guest')->group(function () {
    //AUTENTIKASI
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/loginPost', [AuthController::class, 'loginPost']);
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/registerPost', [AuthController::class, 'registerPost']);
});


Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/custom_user/{id}', [AuthController::class, 'customUser']);
    Route::post('/custom_user/edit', [AuthController::class, 'customUserEdit']);
    Route::get('/lupa_sandi/{id_user}', [AuthController::class, 'lupaSandi']);
    Route::post('/riset_password/{id_user}', [AuthController::class, 'risetPassword']);

      //KOMENTAR
    Route::post('/tambah-komentar', [HomeController::class, 'tambahKomentar']);
    Route::post('/edit-komentar/{id_komentar}/{id_film}', [HomeController::class, 'editKomentar']);
    Route::delete('/delete-komentar/{id_komentar}/{id_film}', [HomeController::class, 'deleteKomentar']);

    Route::middleware('role:admin,author')->group(function () {
        //FILM
        Route::get('/search_film', [FilmController::class, 'searchFilm']);
        Route::get('/data_film', [FilmController::class, 'data_film']);
        Route::get('/tambah_film', [FilmController::class, 'tambahFilm']);
        Route::post('/tambah/film/proses', [FilmController::class, 'tambahFilmProses']);
        Route::get('/film/edit/{id}', [FilmController::class, 'editFilm']);
        Route::post('/edit/film/proses', [FilmController::class, 'editFilmProses']);
        Route::delete('/film/delete/', [FilmController::class, 'deleteFilm']);
    });

    Route::middleware('role:admin')->group(function () {

        //DATA USERS
        Route::get('/search_user', [AuthController::class, 'searchUser']);
        Route::get('/data_users', [AuthController::class, 'dataUsers']);
        Route::get('/tambah_user', [AuthController::class, 'tambahUser']);
        Route::post('/tambah/akun/proses', [AuthController::class, 'tambahUserProses']);
        Route::get('/user/edit/{id}', [AuthController::class, 'editUser']);
        Route::post('/edit/user/proses', [AuthController::class, 'editUserProses']);
        Route::delete('/user/delete/', [AuthController::class, 'deleteUser']);

        //GENRE
        Route::get('/data_genre', [FilmController::class, 'dataGenre']);
        Route::get('/tambah_genre', [FilmController::class, 'tambahGenre']);
        Route::post('/tambah/genre/proses', [FilmController::class, 'tambahGenreProses']);
        Route::delete('/genre/delete/', [FilmController::class, 'deleteGenre']);

        //NEGARA
        Route::get('/data_negara', [FilmController::class, 'dataNegara']);
        Route::get('/tambah_negara', [FilmController::class, 'tambahNegara']);
        Route::post('/tambah/negara/proses', [FilmController::class, 'tambahNegaraProses']);
        Route::delete('/negara/delete/', [FilmController::class, 'deleteNegara']);

        //TAHUN
        Route::get('/data_tahun', [FilmController::class, 'dataTahun']);
        Route::get('/tambah_tahun', [FilmController::class, 'tambahTahun']);
        Route::post('/tambah/tahun/proses', [FilmController::class, 'tambahTahunProses']);
        Route::delete('/tahun/delete/', [FilmController::class, 'deleteTahun']);

        //TAMPIL KOMENTAR ADMIN
        Route::get('/data_komentar', [HomeController::class, 'dataKomentar']);
        Route::get('/komentar_film/{id}', [HomeController::class, 'komentarFilm']);
        Route::delete('/hapus-komentar/{id_komentar}/{id_film}', [HomeController::class, 'hapusKomentar']);
    });
});
