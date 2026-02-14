<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class AuthController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $client = new Client();

        try {
            $response = $client->post(
                'https://unappliquad-charlize-jazzy.ngrok-free.dev/api/login',
                [
                    'headers' => [
                        'X-API-KEY' => '60qCRhSVZnS7t0MPCuSr0FXjjhOTGUUuoT1EhLAleswdJsEL5egObZNBFri2iJmZ',
                        'Accept'    => 'application/json',
                    ],
                    'json' => [
                        'email'    => $request->email,
                        'password' => $request->password,
                    ],
                    'timeout' => 10,
                    'http_errors' => false // 🔥 WAJIB supaya tidak 500
                ]
            );

            $result = json_decode($response->getBody(), true);

            // Jika status bukan 200
            if ($response->getStatusCode() !== 200) {
                return back()->with('error', $result['message'] ?? 'Login gagal.');
            }

            // Jika API pakai "success"
            if (isset($result['success']) && !$result['success']) {
                return back()->with('error', $result['message'] ?? 'Login gagal.');
            }

            // Simpan session
            session([
                'api_token' => $result['token'] ?? null,
                'user'      => $result['user'] ?? null,
            ]);

            return redirect('/');

        } catch (RequestException $e) {
            return back()->with('error', 'Server API tidak dapat diakses.');
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }
}
