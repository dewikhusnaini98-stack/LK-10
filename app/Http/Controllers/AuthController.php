<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Redirect ke WorkOS login
     */
    public function login(Request $request)
    {
        // kalau sudah login, langsung ke dashboard
        if (Auth::check()) {
            return redirect()->route('books.index');
        }

        $clientId = env('WORKOS_CLIENT_ID');
        $redirectUri = env('WORKOS_REDIRECT_URI');

        $query = http_build_query([
            'client_id'     => $clientId,
            'redirect_uri'  => $redirectUri,
            'response_type' => 'code',
            'provider'      => 'authkit',
            'screen_hint'   => 'sign-in',
        ]);

        return redirect('https://api.workos.com/user_management/authorize?' . $query);
    }

    /**
     * Callback dari WorkOS
     */
    public function callback(Request $request)
    {
        $code = $request->query('code');

        if (!$code) {
            return redirect()->route('login.page')
                ->with('error', 'Authentication code tidak ditemukan.');
        }

        $response = Http::post(
            'https://api.workos.com/user_management/authenticate',
            [
                'client_id'     => env('WORKOS_CLIENT_ID'),
                'client_secret' => env('WORKOS_API_KEY'),
                'code'          => $code,
                'grant_type'    => 'authorization_code',
            ]
        );

        if ($response->failed()) {
            Log::error('WorkOS authentication failed', [
                'response' => $response->body()
            ]);

            return redirect()->route('login.page')
                ->with('error', 'Login gagal, silakan coba lagi.');
        }

        $data = $response->json();
        $workosUser = $data['user'] ?? null;

        if (!$workosUser || empty($workosUser['email'])) {
            return redirect()->route('login.page')
                ->with('error', 'Email user tidak ditemukan dari WorkOS.');
        }

        // gabungkan nama
        $name = trim(
            ($workosUser['first_name'] ?? '') . ' ' . ($workosUser['last_name'] ?? '')
        );

        // simpan / ambil user
        $user = User::firstOrCreate(
            ['email' => $workosUser['email']],
            [
                'name' => $name ?: 'WorkOS User',
                'password' => bcrypt(Str::random(24)),
            ]
        );

        // login user
        Auth::login($user);
        $request->session()->regenerate();

        // redirect ke dashboard
        return redirect()->route('books.index');
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.page');
    }
}