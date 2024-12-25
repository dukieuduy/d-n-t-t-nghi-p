<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaleFormRequest;
use App\Models\Category;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $sales = Sale::orderBy('id', 'DESC')->paginate($data['size'] ?? 10);
        return view('admin.pages.sales.index', compact('sales', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.pages.sales.form', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaleFormRequest $request)
    {
        $data = $request->all();
        $sale = Sale::create([
            'percentage' => $data['percentage'],
            'name' => $data['name'],
            'issue_date' => $data['issue_date'],
            'expired_date' => $data['expired_date'],
            'is_active' => $data['is_active'] ?? 0,
        ]);

        $sale->products()->sync($data['products']);
        return redirect()->route('admin.sales.index')->with('success', 'Thêm chương trình giảm giá thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categories = Category::all();
        $sale = Sale::findOrFail($id);

        $sale->issue_date = Carbon::parse($sale->issue_date);
        $sale->expired_date = Carbon::parse($sale->expired_date);
        $isShow = true;
        return view('admin.pages.sales.form', compact('sale', 'isShow', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::all();
        $sale = Sale::findOrFail($id);

        $sale->issue_date = Carbon::parse($sale->issue_date);
        $sale->expired_date = Carbon::parse($sale->expired_date);
        return view('admin.pages.sales.form', compact('sale', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SaleFormRequest $request, $id)
    {
        $data = $request->all();
        $sale = Sale::findOrFail($id);
        $sale->update([
            'percentage' => $data['percentage'],
            'name' => $data['name'],
            'issue_date' => $data['issue_date'],
            'expired_date' => $data['expired_date'],
            'is_active' => $data['is_active'] ?? 0,
        ]);

        $sale->products()->sync($data['products']);
        return redirect()->route('admin.sales.index')->with('success', 'Cập nhật chương trình giảm giá thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sale = Sale::findOrFail($id);
        $sale->products()->detach();
        $sale->delete();
        return redirect()->route('admin.sales.index')->with('success', 'Xóa mã giảm giá thành công');
    }


    public function changeStatus($id) {
        $sale = Sale::findOrFail($id);
        $sale->is_active = !$sale->is_active;
        $sale->save();
        return response([
            'result' => true,
            'message' => "Success"
        ], 200);
    }
}
