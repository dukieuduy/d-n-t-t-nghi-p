<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountFormRequest;
use App\Models\Discount;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $request->all();

        $discounts = Discount::paginate($data['size'] ?? 10);
        return view('admin.pages.discounts.index', compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.discounts.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DiscountFormRequest $request)
    {
        Discount::create($request->all());
        return redirect()->route('admin.discounts.index')->with("success", "Thêm mã giảm giá thành công");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $discount = Discount::findOrFail($id);
        $discount->start_date = Carbon::parse($discount->start_date);
        $discount->end_date = Carbon::parse($discount->end_date);
        $isShow = true;
        return view('admin.pages.discounts.form', compact('discount', 'isShow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $discount = Discount::findOrFail($id);
        $discount->start_date = Carbon::parse($discount->start_date);
        $discount->end_date = Carbon::parse($discount->end_date);
        return view('admin.pages.discounts.form', compact('discount'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DiscountFormRequest $request, string $id)
    {
        $discount = Discount::findOrFail($id);
        $discount->update($request->all());
        return redirect()->route('admin.discounts.index')->with("success", "Cập nhật mã giảm giá thành công");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Discount::destroy($id);
        return redirect()->route('admin.discounts.index')->with("success", "Xóa mã giảm giá thành công!");
    }

    public function changeStatus($id) {
        $discount = Discount::findOrFail($id);
        $discount->is_active = !$discount->is_active;
        $discount->save();
        return response([
            'result' => true,
            'message' => "Success"
        ], 200);
    }
}
