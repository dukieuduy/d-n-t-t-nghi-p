<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Category::query();

        // Tìm kiếm theo tên danh mục
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Sắp xếp theo tên
        if ($request->has('sort_by') && in_array($request->sort_by, ['asc', 'desc'])) {
            $query->orderBy('name', $request->sort_by);
        }

        // Phân trang kết quả
        $categories = $query->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // 'is_active' =>'required',
        ]);

        Category::create([
            'name' => $request->name,
            // 'is_active' =>$request->is_active,
        ]);


        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
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
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('admin.categories.index')->with('error', 'Category not found');
        }
        $categories = Category::all();
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // 'is_active' =>'required',
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->all());

        // Trả về danh sách danh mục sau khi cập nhật
        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $hash = Product::where('category_id', $id)->exists();
        if (!$hash) {
            $category->delete();
            $catefories = Category::all();
            foreach ($catefories as $x) {
                if ($x->parent_id == $id) {
                    $x->delete();
                }
            }
            return redirect()->route('admin.categories.index')->with('success', 'Xoá danh mục thành công !');

        }else{
            return redirect()->route('admin.categories.index')->with('error', 'Vui lòng chuyển các sản phẩm sang danh mục khác để tiền hành xoá danh mục này.');

        }
        // Trả về danh sách danh mục sau khi xóa
    }
}
