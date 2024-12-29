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
        // Validate dữ liệu form
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price_old' => 'nullable|numeric|min:0',
            'price_new' => 'nullable|numeric|min:0',
            'category' => 'required|exists:categories,id',
            'variations.*.price' => 'nullable|numeric|min:0',
            'variations.*.stock_quantity' => 'nullable|integer|min:0',
            'variations.*.attributes.*' => 'required|exists:product_attribute_values,id',
            'variations.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => "Tên sản phẩm không được để trống.",
            'description.required' => "Mô tả không được để trống.",
            'category.required' => "Danh mục sản phẩm là bắt buộc.",
            'category.exists' => "Danh mục không hợp lệ.",
            'variations.*.attributes.*.required' => "Thuộc tính của biến thể là bắt buộc.",
            'variations.*.image.image' => "File ảnh biến thể phải là định dạng ảnh.",
            'variations.*.image.max' => "Dung lượng file ảnh không được vượt quá 2MB.",
        ]);

        // Tạo sản phẩm

        // lưa ảnh sản phẩm
        $img_prd = null;
        // Kiểm tra nếu có file ảnh được tải lên
        if ($request->hasFile('img_prd') && $request->file('img_prd') instanceof \Illuminate\Http\UploadedFile) {
            // Lưu ảnh vào thư mục 'products' và lấy đường dẫn của ảnh đã lưu
            $img_prd = $request->file('img_prd')->store('products', 'public');
        }
        // dd($img_prd);
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
            // Tạo SKU theo cú pháp id_sanpham-color-size
            $attributes = [];
            foreach ($variation['attributes'] as $attributeId => $valueId) {
                $attributeValue = ProductAttributeValue::find($valueId);
                if ($attributeValue) {
                    $attributes[] = $attributeValue->value;
                }
            }

            // Tạo SKU
            $sku = $product->id . '-' . implode('-', $attributes);

            // Kiểm tra SKU có tồn tại hay chưa
            if (ProductVariation::where('sku', $sku)->exists()) {
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

        return redirect()->back()->with('success', 'Sản phẩm đã được thêm thành công!');
    }

    public function index(Request $request)
    {
        $products = Product::with(['variations', 'category'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Sử dụng map để tùy chỉnh dữ liệu và duy trì phân trang
        $products->setCollection(
            $products->getCollection()->map(function ($product) {
                $totalStock = $product->variations->sum('stock_quantity');
                $image = $product->variations->first()->image ?? null;

                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'description' => $product->description,
                    'price_old' => $product->price_old,
                    'price_new' => $product->price_new,
                    'category' => $product->category->name ?? null,
                    'image' => $image,
                    'total_stock' => $totalStock,
                    'is_active' => $product->is_active,
                ];
            })
        );

        return view('admin.product.indexProduct', compact('products'));
    }



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

    // Kiên - sản phẩm nổi bật(bán chạy)
    // public function bestSelling()
    // {
    //     // Lấy sp đã bán theo cột sales
    //     $products = Product::orderBy('sales', 'desc')
    //         ->take(10)
    //         ->get();

    //     return view('products.best_selling', compact('products'));
    // }



}
