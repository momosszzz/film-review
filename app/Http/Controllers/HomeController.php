<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Genre;
use App\Models\Tahun;
use App\Models\Negara;
use App\Models\Film;
use Illuminate\Support\Facades\Hash;
use App\Models\Komentar;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index(){
        $genre = Genre::all();
        $tahun = Tahun::all();
        $negara = Negara::all();
        $user = FacadesAuth::user();
        $films = Film::with(['genreRelasi', 'tahunRelasi', 'negaraRelasi'])->get();
        return view('index',compact('genre','tahun', 'films', 'negara','user'));
    }

    public function filterTahun($id){
        $genre = Genre::all();
        $tahun = Tahun::all();
        $negara = Negara::all();
        $user = FacadesAuth::user();
        $films = Film::with(['genreRelasi', 'tahunRelasi', 'negaraRelasi'])
                     ->where('tahun', $id)
                     ->get();
        return view('index',compact('genre','tahun', 'films', 'negara', 'user'));
    }

    public function filterGenre($id){
        $genre = Genre::all();
        $tahun = Tahun::all();
        $negara = Negara::all();
        $user = FacadesAuth::user();
        $films = Film::with(['genreRelasi', 'tahunRelasi', 'negaraRelasi'])
                     ->where('genre', $id)
                     ->get();
        return view('index',compact('genre','tahun', 'films', 'negara', 'user'));
    }

    public function filterNegara($id){
        $genre = Genre::all();
        $tahun = Tahun::all();
        $negara = Negara::all();
        $user = FacadesAuth::user();
        $films = Film::with(['genreRelasi', 'tahunRelasi', 'negaraRelasi'])
                     ->where('negara', $id)
                     ->get();
        return view('index',compact('genre','tahun', 'films', 'negara', 'user'));
    }

    public function filmReview($id){
        $genre = Genre::all();
        $tahun = Tahun::all();
        $negara = Negara::all();
        $films = Film::where('id_film', $id)->first();
        $user = FacadesAuth::user();
        $komentar = Komentar::with('user')
                            ->where('id_film', $id)
                            ->orderBy('created_at', 'desc')
                            ->get();
                            
        if (FacadesAuth::check()) {
            if ($user && $films) {
                // Definisikan urutan tingkat usia
                $usiaTingkat = [
                    'anak' => 1,
                    'remaja' => 2,
                    'dewasa' => 3
                ];
                
                // Cek apakah kategori usia user dan film valid
                if (isset($usiaTingkat[$user->usia]) && isset($usiaTingkat[$films->for_usia])) {
                    // Bandingkan tingkat usia
                    if ($usiaTingkat[$user->usia] < $usiaTingkat[$films->for_usia]) {
                        return redirect('/')->with('error', 'Anda tidak memenuhi syarat usia untuk menonton film ini.');
                    }
                }
                
                return view('film_review',compact('genre','tahun', 'films', 'negara', 'komentar', 'user'));
            }
        } else {
            return view('film_review', compact('genre', 'tahun', 'films', 'komentar', 'user', 'negara'));
        }
       
    }

    public function search(Request $request)
    {
        $genre = Genre::all();
        $tahun = Tahun::all();
        $negara = Negara::all();
        $user = FacadesAuth::user();
        
        $search = $request->search;
        
        $films = Film::with(['genreRelasi', 'tahunRelasi', 'negaraRelasi'])
                     ->where('nama_film', 'LIKE', "%{$search}%")
                     ->get();
                 
        return view('index', compact('genre', 'tahun', 'films', 'negara', 'user'));
    }

    public function tambahKomentar(Request $request)
    {
        if(!FacadesAuth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu');
        }

         // Check if user already commented on this film
       $existingComment = Komentar::where('id_film', $request->id_film)
       ->where('id_user', FacadesAuth::user()->id_user)
       ->first();
        
       if($existingComment) {
       return redirect('/film/review/'.$request->id_film.'#komentar')
       ->with('error', 'Anda sudah memberikan komentar untuk film ini');
       }


        Komentar::create([
            'id_film' => $request->id_film,
            'id_user' => FacadesAuth::user()->id_user,
            'rating_user' => $request->rating_user,
            'komentar' => $request->komentar
        ]);

        return redirect('/film/review/'.$request->id_film.'#komentar')->with('success', 'Komentar berhasil ditambahkan');
    }

    public function editKomentar(Request $request, $id_komentar, $id_film)
    {
        $komentar = Komentar::find($id_komentar);
        
        if ($komentar && $komentar->id_user == FacadesAuth::user()->id_user) {
            $komentar->komentar = $request->komentar;
            $komentar->save();
        }

        return redirect('/film/review/'.$id_film.'#comment-' . $id_komentar)->with('success', 'Komentar berhasil ditambahkan');
    }

    public function deleteKomentar(Request $request, $id_komentar, $id_film)
    {
        $komentar = Komentar::find($id_komentar);
        
        if ($komentar && $komentar->id_user == FacadesAuth::user()->id_user) {
            $komentar->delete();
        }

        return redirect('/film/review/'. $id_film.'#komentar-')->with('success', 'Komentar berhasil ditambahkan');
    }

    public function dataKomentar(Request $request){
        $film = Film::all();
        return view('admin.komentar.komentar_film', compact('film'));
    }
    
    public function KomentarFilm($id){
        $film = Film::where('id_film', $id)->first();
        $komentar = Komentar::with('user')
                            ->where('id_film', $id)
                            ->orderBy('created_at', 'desc')
                            ->get();
        $users = $komentar->pluck('user')->unique('id_user');
        return view('admin.komentar.data_komentar', compact('film', 'komentar', 'users'));
    }

    public function hapusKomentar(Request $request, $id_komentar, $id_film)
    {
        $komentar = Komentar::find($id_komentar);
        
        $komentar->delete();

        return redirect('komentar_film/'. $id_film.'#komentar-')->with('success', 'Komentar berhasil ditambahkan');
    }
}
