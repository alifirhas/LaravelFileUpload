<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DeleteAccountController extends Controller
{
    public function destroy(User $user, Request $request)
    {
        // dd('you will delete your account');
        //logut user
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        //hapus foto
        Storage::delete('avatars/' . $user->avatar);

        //hapus data
        $user->where('id', $user->id)->delete();

        //redirect
        return redirect('/');
    }
}
