<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\Models\User;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Memproses login
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Cek email dan password, parameter kedua untuk fitur "Ingat saya"
        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();

            // Arahkan sesuai role
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Login berhasil!');
            }

            return redirect()->route('pelanggan.dashboard')->with('success', 'Login berhasil!');
        }

        return back()
            ->withErrors(['email' => 'Email atau password salah.'])
            ->withInput($request->only('email'));
    }

    // Menampilkan form registrasi
    public function showRegister()
    {
        return view('auth.register');
    }

    // Memproses registrasi pelanggan baru
    public function register(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'email'        => 'required|email|unique:users,email',
            'no_hp'        => 'required|numeric|digits_between:9,15',
            'password'     => 'required|min:8|confirmed',
            'setuju'       => 'accepted',
        ], [
            'setuju.accepted' => 'Anda harus menyetujui Syarat & Ketentuan.',
            'email.unique'    => 'Email sudah terdaftar.',
            'password.min'    => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        // Form registrasi tidak punya kolom username, jadi dibuat otomatis dari bagian depan email
        $username = strstr($request->email, '@', true);
        if (User::where('username', $username)->exists()) {
            $username = $username . rand(100, 999);
        }

        $data['nama_lengkap'] = $request->nama_lengkap;
        $data['username']     = $username;
        $data['email']        = $request->email;
        $data['no_hp']        = $request->no_hp;
        $data['password']     = Hash::make($request->password);
        $data['role']         = 'pelanggan'; // registrasi hanya untuk pelanggan

        $user = User::create($data);

        // Langsung login setelah daftar
        Auth::login($user);

        return redirect()->route('pelanggan.dashboard')->with('success', 'Registrasi berhasil, selamat datang!');
    }

    // Menampilkan form "Lupa password" (input email)
    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    // Mengirim link reset password ke email
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Laravel membuat token, menyimpannya di tabel password_reset_tokens, lalu mengirim email
        $status = Password::sendResetLink($request->only('email'));

        if ($status == Password::RESET_LINK_SENT) {
            return back()->with('success', 'Link reset password sudah dikirim ke email Anda.');
        }

        return back()
            ->withErrors(['email' => 'Email tidak terdaftar atau terlalu sering meminta reset. Coba lagi sebentar lagi.'])
            ->withInput($request->only('email'));
    }

    // Menampilkan form password baru (dibuka dari link di email)
    public function showResetPassword(Request $request, $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    // Menyimpan password baru
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|min:8|confirmed',
        ], [
            'password.min'       => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->setRememberToken(Str::random(60));
                $user->save();
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('success', 'Password berhasil diubah. Silakan login.');
        }

        return back()->withErrors(['email' => 'Link reset tidak valid atau sudah kedaluwarsa.']);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda sudah keluar.');
    }
}
