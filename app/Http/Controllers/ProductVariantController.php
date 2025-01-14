<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductVariation;
use Illuminate\Support\Facades\Storage;

class ProductVariantController extends Controller
{
    // Phương thức để hiển thị form chỉnh sửa biến thể sản phẩm
    public function edit($id)
    {
        // Lấy biến thể sản phẩm theo ID
        $ProductVariation = ProductVariation::findOrFail($id);

        // Trả về view với dữ liệu của biến thể sản phẩm
        return view('admin.productVariation.edit', compact('ProductVariation'));
    }

    // Phương thức để cập nhật biến thể sản phẩm
    public function update(Request $request,ProductVariation $ProductVariation )
    {
        
        $ProductVariation = ProductVariation::findOrFail($request['id']);
        // Xác thực các trường đầu vào
        $validated = $request->validate([
            'price' => 'required|numeric|min:0',
            'add_quantity' => 'nullable|integer|min:0',
            'status' => 'required|in:0,1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'price.required' => 'Vui lòng nhập giá sản phẩm.',
            'price.numeric' => 'Giá sản phẩm phải là số hợp lệ.',
            'price.min' => 'Giá sản phẩm không được nhỏ hơn 0.',
            'add_quantity.integer' => 'Số lượng thêm phải là một số nguyên.',
            'add_quantity.min' => 'Số lượng thêm không được nhỏ hơn 0.',
            'status.required' => 'Vui lòng chọn trạng thái cho sản phẩm.',
            'status.in' => 'Trạng thái không hợp lệ. Vui lòng chọn 0 (Không hoạt động) hoặc 1 (Hoạt động).',
            'image.image' => 'File tải lên phải là một hình ảnh.',
            'image.mimes' => 'Ảnh phải thuộc định dạng jpeg, png, jpg hoặc gif.',
            'image.max' => 'Dung lượng ảnh không được vượt quá 2MB.',
        ]);
        
        // Nếu có thêm số lượng, cộng dồn vào `stock_quantity`
        if (!empty($request->input('add_quantity'))) {
            $ProductVariation->stock_quantity += $request->input('add_quantity');
        }
    
        // Cập nhật các trường cần thiết
        $ProductVariation->price = $request->input('price');
        $ProductVariation->status = (int) $request->input('status'); // Đảm bảo là số nguyên
        $ProductVariation->product_id = $request->input('product_id'); // Cập nhật product_id
        $ProductVariation->id = $ProductVariation->id;
        // Xử lý ảnh nếu có thay đổi
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Xóa ảnh cũ nếu đã tồn tại
            if (!empty($ProductVariation->image) && Storage::exists($ProductVariation->image)) {
                Storage::delete($ProductVariation->image);
            }
    
            // Lưu ảnh mới
            $imagePath = $request->file('image')->store('variations', 'public');
            $ProductVariation->image = $imagePath; // Cập nhật đường dẫn ảnh mới
        }
    
        // Lưu các thay đổi vào cơ sở dữ liệu
        $ProductVariation->save();
    
        // Chuyển hướng về trang chi tiết sản phẩm kèm thông báo
        return redirect()->back()->with('success', 'Biến thể sản phẩm đã được cập nhật thành công!');
    }
    
    
    
    
    
}
