<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserPolicy
{
    use HandlesAuthorization;

    public function resetPassword(User $user, User $targetUser)
    {
        if (!Auth::check()) {
            Log::info('Pengguna tidak terautentikasi');
            return redirect('/lupa_sandi')->with('error', 'Anda harus login untuk mereset kata sandi!');
        }
        return $user->id_user === $targetUser->id_user; // Hanya izinkan jika ID pengguna sama
    }
}
