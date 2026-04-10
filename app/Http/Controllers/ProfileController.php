<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $platform = $agent->platform();
        
        return view('profile.index', compact('browser', 'platform'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $request->user()->id],
            'phone' => ['nullable', 'string', 'max:20'],
            'bio' => ['nullable', 'string', 'max:500'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048']
        ]);

        $user = $request->user();
        $user->fill($request->only(['name', 'email', 'phone', 'bio']));
        if ($request->hasFile('avatar')){
            if ($user->avatar && 
            Storage::disk('public')->exists($user->avatar))
            {
                Storage::disk('public')->delete($user->avatar);
            }

        $path =
        $request->file('avatar')->store('avatar', 'public');
        $user->avatar =$path;
        }

        $user->save();

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();
        return Redirect::route('profile.index')->with('status', 'Profil berhasil diperbarui!');
    }

    public function editPassword(Request $request)
    {
        return view('profile.password', ['user' => $request->user()]);
    }

    public function updatePassword(Request $request)
{
    $validated = $request->validate([
        'current_password' => ['required', 'current_password'], // Cek password lama benar/tidak
        'password' => ['required', Password::defaults(), 'confirmed'], // Cek password baru & konfirmasi
    ]);

    $request->user()->update([
        'password' => Hash::make($validated['password']),
    ]);

    return back()->with('status', 'password-updated');
}

    // FUNGSI UNTUK LOGOUT SEMUA PERANGKAT
    public function logoutOtherDevices(Request $request)
    {
        // Untuk fitur ini, Laravel butuh password user untuk verifikasi keamanan
        if (! Hash::check($request->password, $request->user()->password)) {
            throw ValidationException::withMessages([
                'password' => ['Password yang Anda masukkan salah.'],
            ]);
        }

        Auth::logoutOtherDevices($request->password);

        return back()->with('status', 'Berhasil keluar dari semua perangkat lain.');
    }

    public function logoutAllSessions(Request $request)
{
    DB::table('sessions')
        ->where('user_id', auth()->id())
        ->where('id', '!=', session()->getId()) // Jangan hapus sesi yang sedang dipakai
        ->delete();

    return back()->with('status', 'Berhasil keluar dari semua perangkat lain.');
}

public function destroy(Request $request)
{
    // 1. Validasi: Pastikan user memasukkan password yang benar sebelum hapus
    $request->validate([
        'password' => ['required', 'current_password'],
    ]);

    $user = $request->user();

    // 2. Logout user agar sesinya berakhir
    Auth::logout();

    // 3. Hapus user dari database
    $user->delete();

    // 4. Bersihkan session
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // 5. Lempar kembali ke halaman beranda atau login
    return redirect('/')->with('status', 'Akun kamu telah berhasil dihapus.');
}
}