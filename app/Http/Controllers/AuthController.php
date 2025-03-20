<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Negara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth as facadesAuth;

class AuthController extends Controller
{
    public function register(){
        return view('auth.register');
    }

    function registerPost(Request $request){
        $nama_admin = htmlspecialchars($request->input ('name'));
        $usia = htmlspecialchars($request->input('usia'));
        $Negara = htmlspecialchars($request->input('Negara'));
        $email = htmlspecialchars($request->input ('email'));
        $password = htmlspecialchars($request->input ('password'));
        
        if (User::where('email', $email)->exists()) {
            return redirect('/register')->with('error', 'Email sudah terdaftar rasah daftar meneh!');
        }

        $HashedPass = Hash::make($password);
        $user= new User();
        
        
        $user->name = $nama_admin;
        $user->usia = $usia;
        $user->Negara = $Negara;
        $user->email = $email;
        $user->password = $HashedPass;
        
        $user->save();
        if ($user) {
            return redirect('/login')->with('success', 'Berhasil Registrasi silahkan login');
        } else {
            return redirect('/register')->with('error', 'Gagal Registrasi');
        }
    }

    public function login(){
        return view('auth.login');
    }

    function loginPost(Request $request){
        $request->session()->flush(); // Hapus session sebelumnya

        $email = htmlspecialchars($request->input('email'));
        $password = htmlspecialchars($request->input('password'));

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect('/login')->with('error', 'Email belum terdaftar!');
        }

        if (FacadesAuth::attempt(["email"=>$request->email, "password"=>$request->password])) {
            // $request->session()->regenerate(); // Buat session baru
            // $request->session()->put('user', $user->id_user);
            // $request->session()->put('id_user', $user->id_user);
            // $request->session()->put('name', $user->name);
            // $request->session()->put('role', $user->role);
            return redirect('/');
        } else {
            return redirect('/login')->with('error', 'WALAWEEEE password salah!');
        }
    }

    public function lupaSandi($id_user)
    {
        $user = User::where('id_user', $id_user)->first();
        if (!$user) {
            return redirect('/lupa_sandi')->with('error', 'Pengguna tidak ditemukan!');
        }

        if (!Auth::check()) {
            Log::info('Pengguna tidak terautentikasi');
            return redirect('/lupa_sandi')->with('error', 'Anda harus login untuk mereset kata sandi!');
        }

        Log::info('Pengguna terautentikasi: ' . Auth::user()->id_user);

        if (!Auth::user()->can('reset-password', $user)) {
            Log::info('Pengguna tidak memiliki izin untuk mereset kata sandi');
            return redirect('/lupa_sandi')->with('error', 'Anda tidak memiliki izin untuk mereset password akun ini!');
        }

        return view('auth.lupa_sandi', compact('user'));
    }

    public function logout(Request $request){
        // $request->session()->flush(); // Menghapus semua session
        FacadesAuth::logout();
        return redirect('/');
    }


    public function dataUsers(){
        $users = User::all();
        return view('admin.user.data_users',compact('users'));
    }

    public function tambahUser(){
        return view('admin.user.tambah_user');
    }
    function tambahUserProses(Request $request){
        $nama_admin = htmlspecialchars($request->input ('name'));
        $email = htmlspecialchars($request->input ('email'));
        $password = htmlspecialchars($request->input ('password'));
        $usia = htmlspecialchars($request -> input('usia'));
        $Negara = htmlspecialchars($request -> input('Negara'));
        $role = htmlspecialchars($request->input ('role'));
        
        if (User::where('email', $email)->exists()) {
            return redirect('/register')->with('error', 'Email sudah terdaftar rasah daftar meneh!');
        }

        $HashedPass = Hash::make($password);
        $user= new User();
        
        
        $user->name = $nama_admin;
        $user->email = $email;
        $user->password = $HashedPass;
        $user->usia = $usia;
        $user->Negara = $Negara;
        $user->role = $role;
        
        $user->save();
        if ($user) {
            return redirect('/data_users')->with('success', 'Berhasil Registrasi silahkan login');
        } else {
            return redirect('/register')->with('error', 'Gagal Registrasi');
        }
    }

    public function editUser($id){
        $user = User::where('id_user',$id)->first();
        return view('admin.user.edit_user', compact('user'));
    }
    function editUserProses(Request $request){
        $id_user = htmlspecialchars($request->input ('id_user'));
        $name = htmlspecialchars($request->input ('name'));
        $email = htmlspecialchars($request->input ('email'));
        $usia = htmlspecialchars($request->input ('usia'));
        $Negara = htmlspecialchars($request->input ('Negara'));
        $role = htmlspecialchars($request->input ('role'));
        $avatar = $request->file('avatar');
        
        $query = User::where('id_user', $id_user)->first();

        if (!$query) {
            return redirect('/data_users')->with('error', 'Data tidak ditemukan');
        }

        $path = public_path(). '/profile';
        if($avatar){
            $thumb = $avatar->getClientOriginalName();
            if($query->profile){
                File::delete($path . '/' . $query->profile);
            }
            $avatar->move($path, $thumb);
            $query->profile =$thumb;
        }

        $query->name = $name;
        $query->email = $email;
        $query->usia = $usia;
        $query->Negara = $Negara;
        $query->role = $role;
        $query->save();
        if ($query) {
            return redirect('/data_users')->with('success', 'Data berhasil diubah');
        } else {
            return redirect('/data_users')->with('error', 'Data gagal diubah');
        }
    }

    public function deleteUser(Request $request){
        $id_user = $request->input('id_user');
        $query = User::where('id_user', $id_user)->first();
        if (!$query) {
            return redirect('/data_users')->with('error', 'Data tidak ditemukan');
        }

        // Hapus avatar profile jika ada
        $path = public_path() . 'profile/' . $query->profile;
        if ($query->profile && File::exists($path)) {
            File::delete($path);
        }

        $query->delete();
        if ($query) {
            return redirect('/data_users')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect('/data_users')->with('error', 'Data gagal dihapus');
        }
    }

    public function risetPassword(Request $request, $id_user){
        $email = htmlspecialchars($request->input('email'));
        $password = htmlspecialchars($request->input('password'));
        $password_confirmation = htmlspecialchars($request->input('password_confirmation'));
        
        // Cek apakah email terdaftar
        $user = User::where('email', $email)->first();
        if (!$user) {
            return redirect('/lupa_sandi')->with('error', 'Email tidak terdaftar!');
        }

        // Cek konfirmasi password
        if ($password !== $password_confirmation) {
            return redirect('/lupa_sandi')->with('error', 'Konfirmasi password tidak cocok!');
        }

        // Update password
        $user->password = Hash::make($password);
        $user->save();

        if ($user) {
            return redirect('custom_user/' . $id_user)->with('success', 'Password berhasil direset');
        } else {
            return redirect('/lupa_sandi')->with('error', 'Gagal mereset password');
        }
    }

    public function searchUser(Request $request) {
        $search = $request->input('search_user');
        $users = User::where('name', 'LIKE', "%{$search}%")->get();
        return view('admin.user.data_users', compact('users'));
    }

    public function customUser($id){
        if(FacadesAuth::check()){
            $user = FacadesAuth::user();
            return view('custom_user', compact('user'));
        }
    }
    function customUserEdit(Request $request){
        $id_user = htmlspecialchars($request->input ('id_user'));
        $nama = htmlspecialchars($request->input ('name'));
        $email = htmlspecialchars($request->input ('email'));
        $avatar = $request->file('avatar');

        $query = User::where('id_user', $id_user)->first();

        if(!$query){
            return redirect('/')->with('error','data tidak ditemukan');
        }

        $path = public_path(). '/profile';
        if($avatar){
            $thumb = $avatar->getClientOriginalName();
            if($query->profile){
                File::delete($path . '/' . $query->profile);
            }
            $avatar->move($path, $thumb);
            $query->profile =$thumb;
        }

        $query->name = $nama;
        $query->email = $email;
        $query->save();
        if ($query){
            return redirect('/')->with('succes', 'data berhasil diubah');
        }else{
            return redirect('/')->with('error','data gagal diubah');
        }
    }
}
