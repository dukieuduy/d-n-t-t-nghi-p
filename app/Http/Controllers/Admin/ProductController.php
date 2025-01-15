<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ProductAttribute;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttributeValue;
use App\Models\ProductVariation;
use App\Models\ProductVariationAttribute;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //     public function create()
// {
//     // $attributes = ProductAttribute::all();  // Lấy tất cả các thuộc tính
//     // return view('admin.products.create', compact('attributes'));
//     return view("admin.product.createProduct");


    public function create()
    {
        // Lấy tất cả các thuộc tính cùng giá trị liên quan
        $attributes = ProductAttribute::with('values')->get();

        // Lọc thuộc tính Color và Size
        $colors = $attributes->where('name', 'color')->first();
        $sizes = $attributes->where('name', 'size')->first();

    // Lấy danh sách giá trị của Color và Size
    $colorValues = $colors ? $colors->values : collect(); // Trả về mảng rỗng nếu không có
    $sizeValues = $sizes ? $sizes->values : collect();
    $category = Category::all();
    // Gửi dữ liệu sang view
    return view('admin.product.createProduct', compact('colorValues', 'sizeValues', 'category'));
    }


    public function store(Request $request)
    {
        // Xác thực dữ liệu
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price_old' => 'required|numeric|min:0',
            'price_new' => [
                'required',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->price_old !== null && $value > $request->price_old) {
                        $fail('Giá khuyến mãi (price_new) không được lớn hơn giá gốc (price_old).');
                    }
                }
            ],
            'category' => 'required|exists:categories,id',
            'variations.*.price' => 'nullable|numeric|min:0',
            'variations.*.stock_quantity' => 'required|integer|min:0',
            'variations.*.attributes.*' => 'required|exists:product_attribute_values,id',
            'variations.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => "Tên sản phẩm không được để trống.",
            'description.required' => "Mô tả không được để trống.",
            'category.required' => "Danh mục sản phẩm là bắt buộc.",
            'category.exists' => "Danh mục không hợp lệ.",
            'price_old.required' => "Giá gốc là bắt buộc.",
            'price_new.required' => "Giá khuyến mãi là bắt buộc.",
            'variations.*.attributes.*.required' => "Thuộc tính của biến thể là bắt buộc.",
            'variations.*.image.image' => "File ảnh biến thể phải là định dạng ảnh.",
            'variations.*.image.max' => "Dung lượng file ảnh không được vượt quá 2MB.",
            'variations.*.stock_quantity.required'=>"Số lượng không được để trống"
        ]);

        // Tạo sản phẩm
        $img_prd = null;
        if ($request->hasFile('img_prd') && $request->file('img_prd') instanceof \Illuminate\Http\UploadedFile) {
            $img_prd = $request->file('img_prd')->store('products', 'public');
        }
        
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'image_prd' => $img_prd,
            'category_id' => $request->category,
            'price_old' => $request->price_old ?? 0,
            'price_new' => $request->price_new ?? 0,
        ]);

        // Lưu biến thể
        foreach ($request->variations as $index => $variation) {
            $attributes = [];
            foreach ($variation['attributes'] as $attributeId => $valueId) {
                $attributeValue = ProductAttributeValue::find($valueId);
                if ($attributeValue) {
                    $attributes[] = $attributeValue->value;
                }
            }

            // Tạo SKU cho biến thể
            $sku = $product->id . '-' . implode('-', $attributes);

            // Kiểm tra nếu SKU đã tồn tại
            if (ProductVariation::where('sku', $sku)->exists()) {
                return redirect()->back()->withErrors([
                    "variations.$index.attributes" => "Biến thể với SKU $sku đã tồn tại."
                ]);
            }

            // Xử lý ảnh biến thể nếu có
            $variationImagePath = null;
            if (isset($variation['image']) && $variation['image'] instanceof \Illuminate\Http\UploadedFile) {
                $variationImagePath = $variation['image']->store('variations', 'public');
            }

            // Nếu giá của biến thể không có, gán giá mới của sản phẩm chính
            $variationPrice = $variation['price'] ?? $product->price_new;

            // Tạo biến thể sản phẩm
            $productVariation = ProductVariation::create([
                'product_id' => $product->id,
                'sku' => $sku,
                'price' => $variationPrice,
                'stock_quantity' => $variation['stock_quantity'] ?? 0,
                'image' => $variationImagePath,
            ]);

            // Lưu các thuộc tính của biến thể
            foreach ($variation['attributes'] as $attributeName => $valueId) {
                $attributeValue = ProductAttributeValue::find($valueId);
                $attribute = ProductAttribute::where('name', $attributeName)->first();
                
                if ($attributeValue && $attribute) {
                    ProductVariationAttribute::create([
                        'product_variation_id' => $productVariation->id,
                        'product_attribute_value_id' => $valueId,
                        'product_attribute_id' => $attribute->id,
                    ]);
                } else {
                    return redirect()->back()->withErrors([
                        "variations.$index.attributes" => "Giá trị thuộc tính không hợp lệ cho SKU $sku."
                    ]);
                }
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được tạo thành công.');
    }


    public function index(Request $request)
    {
        $products = Product::with(['variations', 'category'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        // dd($products);
        return view('admin.product.indexProduct', compact('products'));
    }


    public function detail($id)
    {
        // Lấy thông tin sản phẩm và các biến thể của nó, kèm theo các thuộc tính (size, color)
        $product = Product::with([
            'variations.variationAttributes.attributeValue', // Lấy giá trị thuộc tính của mỗi biến thể
            'variations.variationAttributes.attributeValue.attribute' // Lấy tên thuộc tính của mỗi biến thể
        ])->find($id);

        // Kiểm tra nếu sản phẩm không tồn tại
        if (!$product) {
            return redirect()->route('home')->with('error', 'Sản phẩm không tồn tại');
        }
        // Lấy các giá trị của thuộc tính "Size" và "Color"
        $sizes = ProductAttributeValue::whereHas('attribute', function ($query) {
            $query->where('name', 'Size');
        })->get();

        $colors = ProductAttributeValue::whereHas('attribute', function ($query) {
            $query->where('name', 'Color');
        })->get();

        // Tạo mảng kết hợp Color => [Sizes]
        $colorToSizes = [];

        // Lặp qua các biến thể
        foreach ($product->variations as $variation) {
            // Lấy các thuộc tính của biến thể
            $colorAttribute = null;
            $sizeAttribute = null;
        
            foreach ($variation->variationAttributes as $attribute) {
                // Kiểm tra từng attribute và gán giá trị tương ứng
                if ($attribute->attributeValue->attribute->name==='color') {
                    $colorAttribute = $attribute;
                } elseif ($attribute->attributeValue->attribute->name==='size') {
                    $sizeAttribute = $attribute;
                }
            }
            // Kiểm tra và lấy giá trị màu sắc và kích thước nếu có
            if ($colorAttribute && $sizeAttribute) {
                $color = $colorAttribute->attributeValue->value;
                $size = $sizeAttribute->attributeValue->value;
        
                // Khởi tạo mảng màu sắc nếu chưa tồn tại
                if (!isset($colorToSizes[$color])) {
                    $colorToSizes[$color] = [];
                }
        
                // Thêm kích thước vào danh sách của màu sắc, tránh trùng lặp
                if (!in_array($size, $colorToSizes[$color])) {
                    $colorToSizes[$color][] = $size;
                }
            }
        }

        // Trả về view với dữ liệu sản phẩm, kích thước, màu sắc, và mảng màu -> kích thước
        return view('admin.product.detailProduct', compact('product', 'colorToSizes','sizes','colors'));
    }
    public function edit($id)
    {
        // Lấy sản phẩm với tất cả các trường (không cần eager load category nếu chỉ cần lấy product)
        $product = Product::findOrFail($id);

        // Lấy tất cả các danh mục
        $categories = Category::all();

        // Trả về view và truyền dữ liệu
        return view('admin.product.editProduct', compact('product', 'categories'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price_old' => 'required|numeric',
            'price_new' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'img_prd' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $product = Product::findOrFail($id);
    
        // Cập nhật các trường thông tin khác
        $product->update($request->only('name', 'description', 'price_old', 'price_new', 'category_id'));
    
        // Xử lý hình ảnh nếu có
        if ($request->hasFile('image_prd') && $request->file('image_prd') instanceof \Illuminate\Http\UploadedFile) {
            // Xóa hình ảnh cũ nếu có
            if ($product->image_prd) {
                Storage::delete('public/' . $product->image_prd);
            }
            // Lưu hình ảnh mới
            $product->image_prd = $request->file('image_prd')->store('products', 'public');
        }
    
        // Lưu sản phẩm
        $product->save();
    
        return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được cập nhật!');
    }
    




    public function storeVariation(Request $request, $productId)
    {
            // Lấy giá trị của Color và Size từ bảng product_attribute_values
            $colorAttributeValue = ProductAttributeValue::where('value', $request->color)
                ->whereHas('attribute', function ($query) {
                    $query->where('name', 'Color');
                })->first();

            $sizeAttributeValue = ProductAttributeValue::where('value', $request->size)
                ->whereHas('attribute', function ($query) {
                    $query->where('name', 'Size');
                })->first();

            // Kiểm tra nếu không tìm thấy giá trị
            if (!$colorAttributeValue || !$sizeAttributeValue) {
                return response()->json(['success' => false, 'message' => 'Giá trị thuộc tính không hợp lệ.']);
            }

            // Lấy sản phẩm cha
            $product = Product::findOrFail($productId);
            

            // Tạo SKU duy nhất
            $sku = $productId . '-' . $request->size . '-' . $request->color;

            // Nếu giá không được nhập, sử dụng giá của sản phẩm cha
            $price = $request->price ?? $product->price_new;

            // Lưu ảnh nếu có
            $imagePath = null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                if ($file->isValid()) {
                    $imagePath = $file->store('variations', 'public');
                }
            }

            // Tạo biến thể sản phẩm
            $variation = ProductVariation::create([
                'product_id' => $productId,
                'sku' => $sku,
                'price' => $price,
                'stock_quantity' => $request->stock_quantity,
                'image' => $imagePath,
            ]);

            // Tạo các thuộc tính của biến thể
            ProductVariationAttribute::create([
                'product_variation_id' => $variation->id,
                'product_attribute_id' => $colorAttributeValue->attribute->id,
                'product_attribute_value_id' => $colorAttributeValue->id,
            ]);

            ProductVariationAttribute::create([
                'product_variation_id' => $variation->id,
                'product_attribute_id' => $sizeAttributeValue->attribute->id,
                'product_attribute_value_id' => $sizeAttributeValue->id,
            ]);

            // Trả về phản hồi thành công
            return redirect()->back()->with('success', 'Biến thể đã được thêm thành công.');
        }


}