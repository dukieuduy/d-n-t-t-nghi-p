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

// public function store(Request $request)
// {
//     // dd($request->all());

//     // Validate dữ liệu form
//     $request->validate([
//         'name' => 'required',
//         'description' => 'required',
//         'price_old' => 'required|numeric|min:0',  // Đã sửa thành 'required'
//         'price_new' => [
//             'required',  // Đã sửa thành 'required'
//             'numeric',
//             'min:0',
//             function ($attribute, $value, $fail) use ($request) {
//                 if ($request->price_old !== null && $value > $request->price_old) {
//                     $fail('Giá khuyến mãi (price_new) không được lớn hơn giá gốc (price_old).');
//                 }
//             }
//         ],
//         'category' => 'required|exists:categories,id',
//         'variations.*.price' => 'nullable|numeric|min:0',
//         'variations.*.stock_quantity' => 'nullable|integer|min:0',
//         'variations.*.attributes.*' => 'required|exists:product_attribute_values,id',
//         'variations.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
//     ], [
//         'name.required' => "Tên sản phẩm không được để trống.",
//         'description.required' => "Mô tả không được để trống.",
//         'category.required' => "Danh mục sản phẩm là bắt buộc.",
//         'category.exists' => "Danh mục không hợp lệ.",
//         'price_old.required' => "Giá gốc là bắt buộc.",
//         'price_new.required' => "Giá khuyến mãi là bắt buộc.",
//         'variations.*.attributes.*.required' => "Thuộc tính của biến thể là bắt buộc.",
//         'variations.*.image.image' => "File ảnh biến thể phải là định dạng ảnh.",
//         'variations.*.image.max' => "Dung lượng file ảnh không được vượt quá 2MB.",
//     ]);
    
    
//     // Tạo sản phẩm

//     // lưa ảnh sản phẩm
//     $img_prd = null;
//     // Kiểm tra nếu có file ảnh được tải lên
//     if ($request->hasFile('img_prd') && $request->file('img_prd') instanceof \Illuminate\Http\UploadedFile) {
//         // Lưu ảnh vào thư mục 'products' và lấy đường dẫn của ảnh đã lưu
//         $img_prd = $request->file('img_prd')->store('products', 'public');
//     }
//     // dd($img_prd);
//     $product = Product::create([
//         'name' => $request->name,
//         'description' => $request->description,
//         'image_prd'=>$img_prd,
//         'category_id' => $request->category,
//         'price_old' => $request->price_old ?? 0,
//         'price_new' => $request->price_new ?? 0,
//     ]);

//     // Lưu biến thể
//     foreach ($request->variations as $index => $variation) {
//         // Tạo SKU theo cú pháp id_sanpham-color-size
//         $attributes = [];
        
//         foreach ($variation['attributes'] as $attributeId => $valueId) {
//             $attributeValue = ProductAttributeValue::find($valueId);
//             if ($attributeValue) {
//                 $attributes[] = $attributeValue->value;
//             }
//         }

//         // Tạo SKU
//         $sku = $product->id . '-' . implode('-', $attributes);

//         // Kiểm tra SKU có tồn tại hay chưa
//         if (ProductVariation::where('sku', $sku)->exists()) {
//             return redirect()->back()->withErrors([
//                 "variations.$index.attributes" => "Biến thể với SKU $sku đã tồn tại."
//             ]);
//         }

//         // Lưu ảnh biến thể nếu có
//         $variationImagePath = null;
//         if (isset($variation['image']) && $variation['image'] instanceof \Illuminate\Http\UploadedFile) {
//             $variationImagePath = $variation['image']->store('variations', 'public');
//         }

//         // Tạo biến thể
//         $productVariation = ProductVariation::create([
//             'product_id' => $product->id,
//             'sku' => $sku,
//             'price' => $variation['price'] ?? 0,
//             'stock_quantity' => $variation['stock_quantity'] ?? 0,
//             'image' => $variationImagePath,
//         ]);

//        // Lưu thuộc tính của biến thể
//         foreach ($variation['attributes'] as $attributeName => $valueId) {
//             // Tìm giá trị của thuộc tính (size, color, ...)
//             $attributeValue = ProductAttributeValue::find($valueId);
//             $attribute = ProductAttribute::where('name', $attributeName)->first(); // Tìm thuộc tính (size, color)
//             if ($attributeValue && $attribute) {
//                 // Chèn thuộc tính biến thể vào bảng product_variation_attributes
//                 ProductVariationAttribute::create([
//                     'product_variation_id' => $productVariation->id,
//                     'product_attribute_value_id' => $valueId,  // Sử dụng valueId là ID của giá trị thuộc tính
//                     'product_attribute_id' => $attribute->id,  // Sử dụng ID của thuộc tính (size, color)
//                 ]);
//             } else {
//                 return redirect()->back()->withErrors([
//                     "variations.$index.attributes" => "Giá trị thuộc tính không hợp lệ."
//                 ]);
//             }
//         }

//     }

//     return redirect()->back()->with('success', 'Sản phẩm đã được thêm thành công!');
// }
public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'description' => 'required',
        'price_old' => 'required|numeric|min:0',  // Đã sửa thành 'required'
        'price_new' => [
            'required',  // Đã sửa thành 'required'
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
        'variations.*.stock_quantity.required'=>"Số lướng không được để trống"
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

        $sku = $product->id . '-' . implode('-', $attributes);

        if (ProductVariation::where('sku', $sku)->exists()) {
            return redirect()->back()->withErrors([
                "variations.$index.attributes" => "Biến thể với SKU $sku đã tồn tại."
            ]);
        }

        $variationImagePath = null;
        if (isset($variation['image']) && $variation['image'] instanceof \Illuminate\Http\UploadedFile) {
            $variationImagePath = $variation['image']->store('variations', 'public');
        }

        // Nếu price của biến thể rỗng, gán bằng price_new của sản phẩm chính
        $variationPrice = $variation['price'] ?? $product->price_new;

        $productVariation = ProductVariation::create([
            'product_id' => $product->id,
            'sku' => $sku,
            'price' => $variationPrice,
            'stock_quantity' => $variation['stock_quantity'] ?? 0,
            'image' => $variationImagePath,
        ]);

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
                    "variations.$index.attributes" => "Biến thể với SKU $sku đã tồn tại."
                ]);
            }

            // Lưu ảnh biến thể nếu có
            $variationImagePath = null;
            if (isset($variation['image']) && $variation['image'] instanceof \Illuminate\Http\UploadedFile) {
                $variationImagePath = $variation['image']->store('variations', 'public');
            }

            // Tạo biến thể
            $productVariation = ProductVariation::create([
                'product_id' => $product->id,
                'sku' => $sku,
                'price' => $variation['price'] ?? 0,
                'stock_quantity' => $variation['stock_quantity'] ?? 0,
                'image' => $variationImagePath,
            ]);

            // Lưu thuộc tính của biến thể
            foreach ($variation['attributes'] as $attributeName => $valueId) {
                // Tìm giá trị của thuộc tính (size, color, ...)
                $attributeValue = ProductAttributeValue::find($valueId);
                $attribute = ProductAttribute::where('name', $attributeName)->first(); // Tìm thuộc tính (size, color)
                if ($attributeValue && $attribute) {
                    // Chèn thuộc tính biến thể vào bảng product_variation_attributes
                    ProductVariationAttribute::create([
                        'product_variation_id' => $productVariation->id,
                        'product_attribute_value_id' => $valueId,  // Sử dụng valueId là ID của giá trị thuộc tính
                        'product_attribute_id' => $attribute->id,  // Sử dụng ID của thuộc tính (size, color)
                    ]);
                } else {
                    return redirect()->back()->withErrors([
                        "variations.$index.attributes" => "Giá trị thuộc tính không hợp lệ."
                    ]);
                }
            }

        }
    }
}

    public function index(Request $request)
    {
        $products = Product::with(['variations', 'category'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            return view('admin.product.indexProduct', compact('products'));
    }
// public function index(Request $request)
// {
//     $products = Product::with(['variations', 'category'])
//         ->orderBy('created_at', 'desc')
//         ->paginate(10);

//                 return [
//                     'id' => $product->id,
//                     'name' => $product->name,
//                     'description' => $product->description,
//                     'price_old' => $product->price_old,
//                     'price_new' => $product->price_new,
//                     'category' => $product->category->name ?? null,
//                     'image' => $image,
//                     'total_stock' => $totalStock,
//                     'is_active' => $product->is_active,
//                 ];

//     return view('admin.product.indexProduct', compact('products'));
// }



// public function detail($id)
// {
//     // Lấy thông tin sản phẩm và các biến thể của nó
//     $product = Product::with([
//         'variations', // Lấy tất cả biến thể của sản phẩm // Lấy giá trị thuộc tính của mỗi biến thể
//     ])->find($id);

//     // Kiểm tra nếu sản phẩm không tồn tại
//     if (!$product) {
//         return redirect()->route('home')->with('error', 'Sản phẩm không tồn tại');
//     }
//      // Lấy các giá trị của thuộc tính "Size" và "Color"
//      $sizes = ProductAttributeValue::whereHas('attribute', function ($query) {
//         $query->where('name', 'Size');
//     })->get();

//     $colors = ProductAttributeValue::whereHas('attribute', function ($query) {
//         $query->where('name', 'Color');
//     })->get();
// dd($sizes);
//     // Trả về view với dữ liệu sản phẩm và các biến thể
//     return view('admin.product.detailProduct', compact('product','sizes','colors'));
// }
public function detail($id)
{
    // Lấy thông tin sản phẩm và các biến thể của nó
    $product = Product::with([
        'variations', // Lấy tất cả biến thể của sản phẩm
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

    // Lấy biến thể sản phẩm
    $variations = $product->variations;
    // dd($variations);

    // Tạo mảng kết hợp Color => [Sizes]
    $colorToSizes = [];

    foreach ($variations as $variation) {
        // Lấy giá trị thuộc tính màu sắc (Color) và kích thước (Size)
        $colorAttribute = $variation->variationAttributes->firstWhere('attributeValue.attribute.name', 'Color');
        $sizeAttribute = $variation->variationAttributes->firstWhere('attributeValue.attribute.name', 'Size');
        dd($colorAttribute,$sizeAttribute);
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
    dd($colorToSizes);

    // Trả về view với dữ liệu sản phẩm, kích thước, màu sắc, và mảng màu -> kích thước
    return view('admin.product.detailProduct', compact('product', 'sizes', 'colors', 'colorToSizes'));
}





// public function storeVariation(Request $request, $productId)
// {
//     $request->validate([
//         'size' => 'required|string',
//         'color' => 'required|string',
//         'price' => 'required|numeric',
//         'stock_quantity' => 'required|integer',
//         'image' => 'nullable|image|max:2048',
//     ]);

//     // Tạo SKU
//     $sku = $productId . '-' . $request->size . '-' . $request->color;

//     // Kiểm tra xem biến thể đã tồn tại chưa
//     if (ProductVariation::where('sku', $sku)->exists()) {
//         return response()->json(['success' => false, 'message' => 'Biến thể đã tồn tại.']);
//     }
// }



    public function edit($id)
    {
        // Lấy thông tin sản phẩm và các biến thể của nó
        $product = Product::with([
            'variations', // Lấy tất cả biến thể của sản phẩm
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
        //  dd($sizes);
        // Trả về view với dữ liệu sản phẩm và các biến thể
        return view('admin.product.detailProduct', compact('product', 'sizes', 'colors'));
    }



    public function storeVariation(Request $request, $productId)
    {
        $request->validate([
            'size' => 'required|string',
            'color' => 'required|string',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'image' => 'nullable|image|max:2048',
        ]);

        // Tạo SKU
        $sku = $productId . '-' . $request->size . '-' . $request->color;

        // Kiểm tra xem biến thể đã tồn tại chưa
        if (ProductVariation::where('sku', $sku)->exists()) {
            return response()->json(['success' => false, 'message' => 'Biến thể đã tồn tại.']);
        }

        // Lưu ảnh nếu có
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('variations', 'public');
        }

        // Tạo biến thể mới
        $variation = ProductVariation::create([
            'product_id' => $productId,
            'sku' => $sku,
            'price' => $request->price,
            'stock_quantity' => $request->stock_quantity,
            'image' => $imagePath,
        ]);

        // Trả về dữ liệu biến thể mới
        return response()->json([
            'success' => true,
            'data' => [
                'sku' => $variation->sku,
                'price' => $variation->price,
                'stock_quantity' => $variation->stock_quantity,
                'size' => $request->size,
                'color' => $request->color,
                'image' => $imagePath ? asset('storage/' . $imagePath) : null,
            ]
        ]);
    }

}