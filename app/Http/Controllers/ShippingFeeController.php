<?php
namespace App\Http\Controllers;

use App\Models\Ward;
use App\Models\District;
use App\Models\Province;
use App\Models\ShippingFee;
use Illuminate\Http\Request;


class ShippingFeeController extends Controller
{
     // Lấy phí vận chuyển theo province_id
     public function getShippingFeeByProvince($province_id)
     {
         $shippingFee = ShippingFee::where('province_id', $province_id)->first();
         
         if ($shippingFee) {
             return response()->json([
                 'fee' => $shippingFee->fee
             ]);
         }
 
         return response()->json(['fee' => 0]);
     }
 
     // Lấy phí vận chuyển theo province_id và district_id
     public function getShippingFeeByProvinceAndDistrict($province_id, $district_id)
     {
         $shippingFee = ShippingFee::where('province_id', $province_id)
             ->where('district_id', $district_id)
             ->first();
 
         if ($shippingFee) {
             return response()->json([
                 'fee' => $shippingFee->fee
             ]);
         }
 
         return response()->json(['fee' => 0]);
     }
    public function getDistricts($provinceId)
    {
        $districts = District::where('province_id', $provinceId)->get();
        return response()->json($districts);
    }

    public function getWards($districtId)
    {
        $wards = Ward::where('district_id', $districtId)->get();
        return response()->json($wards);
    }
    // Hiển thị danh sách phí ship
    public function index()
    {
        $shippingFees = ShippingFee::with(['province', 'district'])->get(); // Eager loading để lấy thông tin tỉnh, quận

        return view('admin.shipping_fees.index', compact('shippingFees'));
    }

    // Thêm phí ship mới
    public function create(Request $request)
    {
        $provinces = Province::all();
        // dd($provinces);
        $districts = District::where('province_id', $request->provinceId)->get();
        $wards = Ward::where('district_id', $request->districtId)->get();
        return view('admin.shipping_fees.create',compact('provinces','districts','wards'));
    }

    public function store(Request $request)
        {
            $request->validate([
                'province_id' => 'required|exists:provinces,id', // Bắt buộc chọn tỉnh/thành phố
                'district_id' => 'nullable|string|max:255',   // Quận/Huyện có thể null nếu không cần
                'fee' => 'nullable|numeric|min:0',             // Phí ship có thể null nếu miễn phí
                'is_free' => 'nullable|boolean',               // Checkbox miễn phí
            ],[
                'province_id.required' => 'Vui lòng chọn tỉnh/thành phố.',
                'province_id.exists' => 'Tỉnh/thành phố không tồn tại trong hệ thống.',
                'district_id.string' => 'Quận/huyện phải là một chuỗi ký tự.',
                'district_id.max' => 'Quận/huyện không được vượt quá 255 ký tự.',
                'fee.numeric' => 'Phí ship phải là một số.',
                'fee.min' => 'Phí ship không được nhỏ hơn 0.',
                'is_free.boolean' => 'Giá trị miễn phí ship không hợp lệ.',]);

            $data = $request->only(['province_id', 'district_id', 'fee', 'is_free']);

            // Nếu checkbox miễn phí được tích, phí ship sẽ bằng 0
            if ($request->is_free) {
                $data['fee'] = 0;
            } elseif (!$request->filled('fee')) {
                // Nếu không tích "Miễn phí" và không nhập phí ship
                return back()->withErrors(['fee' => 'Vui lòng nhập phí ship hoặc chọn miễn phí.']);
            }

                ShippingFee::create($data);
                return redirect()->route('admin.shipping_fees.create')->with('success', 'Phí ship đã được thêm thành công!');
        }

    // Chỉnh sửa phí ship
    public function edit($id)
    {
        $shippingFee = ShippingFee::findOrFail($id);
        return view('admin.shipping_fees.edit', compact('shippingFee'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'district_name' => 'required|string',
            'fee' => 'required|numeric',
            'is_free' => 'required|boolean',
        ]);

        $shippingFee = ShippingFee::findOrFail($id);
        $shippingFee->update($request->all());
        return redirect()->route('shipping_fees.index')->with('success', 'Phí ship đã được cập nhật!');
    }

    // Xóa phí ship
    public function destroy($id)
    {
        $shippingFee = ShippingFee::findOrFail($id);
        $shippingFee->delete();
        return redirect()->route('shipping_fees.index')->with('success', 'Phí ship đã được xóa!');
    }
}
