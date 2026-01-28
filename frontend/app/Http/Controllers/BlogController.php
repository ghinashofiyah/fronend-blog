<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        return view('pages.blog.list');
    }

    
    public function create()
    {
        return view('pages.Tambahblog');
    }

    public function store(Request $request)
    {
        // Handle the blog post creation logic here
        return redirect()->route('blog.list');
    }
}
