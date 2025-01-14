<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Order;
use App\Models\Province;
use App\Models\User;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $role = $request->input('role');
        $data = $request->all();
        $users = User::where('type', $role)->paginate($data['size'] ?? 20);
        return view('admin.pages.users.index', compact('users', 'role'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function orderByUser($id)
    {
        $orders = Order::where('user_id', $id)->latest()->paginate(10);
        $user = User::findOrFail($id);
        return view('admin.pages.users.order_by_user', compact('orders', 'user'));
    }

    public function detail($id)
    {
        $order = Order::with([
            'user',
            'orderItems.productVariation',          // Eager load productVariation từ orderItems
            'orderItems.productVariation.product',   // Eager load product từ productVariation
            'province',
            'district',
            'ward'
        ])->findOrFail($id);

        // Lấy tỉnh, huyện, xã từ ID
        $province = Province::find($order->province);
        $district = District::find($order->district);
        $ward = Ward::find($order->ward);

        return view('admin.pages.users.detail_order', compact('order', 'province', 'district', 'ward'));
    }

    /**
     * Remove the specified resource from storage.
     */
//    public function destroy(string $id)
//    {
//        $user = User::findOrFail($id);
//        $user->delete();
//        return redirect()->route('users.index')->with('success', 'Xóa người dùng thành công');
//    }
}
