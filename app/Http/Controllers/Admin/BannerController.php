<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Product;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Banner::with('product')->orderBy('id', 'DESC')->get();
        return view('admin.banners.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = Product::all();
        return view('admin.banners.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|min:10|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'product_id' => 'required',
        ]);
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $path = 'storage/banners/';
            $name = rand(1, 100) . '_' . $request->file('image')->getClientOriginalName();
            $upload = $request->file('image')->move($path, $name);
            $data['image'] = $name;
        } else {
            $data['image'] = 'default.jpg';
        }
        $obj = Banner::create($data);
        if ($obj) {
            return redirect()->route('admin.banners.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::all();
        $banner = Banner::find($id);
        return view('admin.banners.edit', compact('product', 'banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|min:10|max:255',
            'product_id' => 'required',

        ]);
        $banner = Banner::find($id);
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            if (file_exists('storage/banners/' . $banner->image)) {
                unlink('storage/banners/' . $banner->image);
            }
            $path = 'storage/banners/';
            $name = rand(1, 100) . '_' . $request->file('image')->getClientOriginalName();
            $upload = $request->file('image')->move($path, $name);
            $data['image'] = $name;
        } else {
            $data['image'] = $banner->image;
        }
        $banner->update($data);
        return redirect()->route('admin.banners.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner = Banner::find($id);
        if (file_exists('storage/banners/' . $banner->image)) {
            unlink('storage/banners/' . $banner->image);
        }
        $banner->delete();
        return redirect()->route('admin.banners.index');
    }
}
