<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class DashboardController extends Controller
{
    public function index()
    {
        // 🔒 Cek apakah sudah login
        if (!session()->has('api_token')) {
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $client = new Client();

        try {
            $response = $client->get(
                env('API_URL') . '/api/dashboard',
                [
                    'headers' => [
                        'X-API-KEY'    => env('API_KEY'),
                        'Authorization'=> 'Bearer ' . session('api_token'),
                        'Accept'       => 'application/json',
                    ],
                    'timeout' => 10,
                    'http_errors' => false
                ]
            );

            $result = json_decode($response->getBody(), true); 

            if ($response->getStatusCode() !== 200) {
                return back()->with('error', $result['message'] ?? 'Gagal mengambil data dashboard.');
            }

            // Kirim data ke view
            return view('pages.dashboard', [
                'data' => $result
            ]);

        } catch (RequestException $e) {
            return back()->with('error', 'Server API tidak dapat diakses.');
        }
    }
}
