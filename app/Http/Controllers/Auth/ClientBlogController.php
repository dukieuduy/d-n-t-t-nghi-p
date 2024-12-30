<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class ClientBlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return view('client.pages.blog', compact('blogs'));
    }




    public function show(Blog $id)
    {
        $blog = Blog::findOrFail($id);

        return view('client.pages.showblog', compact('blog'));
    }
}
