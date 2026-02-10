<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = [
            (object) ['id' => 1, 'judul' => 'Judul Blog 1', 'penulis' => 'Penulis 1', 'kategori' => 'Tutorial', 'status' => 'published'],
        ]; // Fetch blog posts from the database or model
        return view('pages.Listblog', compact('blogs'));
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
