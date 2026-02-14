<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class BlogController extends Controller
{
public function index()
{
    $apiUrl = env('API_BASE_URL') . 'beritas';

    try {
        $response = Http::timeout(10)->get($apiUrl);

        if ($response->failed()) {
            throw new \Exception("Gagal mengambil data dari API. Status: " . $response->status());
        }

        $result = $response->json();
        $beritas = $result['data'] ?? [];

        return view('pages.Listblog', ['blogs' => $beritas]);

    } catch (\Exception $e) {

        // Debug sementara (opsional)
        // dd($e->getMessage());

        return view('pages.Listblog', ['blogs' => []]);
    }
}


    
    public function create()
    {
        return view('pages.Tambahblog');
    }

    public function store(Request $request)
    {
        // Handle the blog post creation logic here
        dd($request->all());
        // return redirect()->route('blog.list');
    }

//     public function edit($id)
// {
//     $blog = Blog::findOrFail($id);
//     return view('pages.Editblog', compact('blog'));
// }

    public function edit($id)
{
    $json = '[
        {
            "id": 1,
            "judul": "Judul Blog Pertama",
            "kategori": "Teknologi",
            "konten": "Isi konten blog pertama",
            "gambar": "https://picsum.photos/seed/blog1/600/400"
        },
        {
            "id": 2,
            "judul": "Judul Blog Kedua",
            "kategori": "Edukasi",
            "konten": "Isi konten blog kedua",
            "gambar": "https://picsum.photos/seed/blog2/600/400"
        }
    ]';

    $blogs = collect(json_decode($json, true));
    $blog = $blogs->firstWhere('id', (int)$id);

    if (!$blog) {
        abort(404);
    }

    return view('pages.Editblog', compact('blog'));
}

}
