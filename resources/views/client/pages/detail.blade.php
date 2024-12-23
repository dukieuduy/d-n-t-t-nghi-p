{{-- @dd($colors,$sizes) --}}
@extends('app')
@section('content')

@if (session('error'))
    <script>
        alert("{{ session('error') }}");
    </script>
@endif
    <div class="product_details mt-20">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product-details-tab">

                        <div id="img-1" class="zoomWrapper single-zoom">
                            <a href="#">
                                {{-- <img id="zoom1" src="{{ asset('assets/img/product/product15.jpg') }}" data-zoom-image="assets/img/product/product15.jpg" alt="big-1"> --}}
                                <img id="zoom1" src="{{ asset('storage/' . $product->image_prd)}}" data-zoom-image="{{ asset('storage/' . $product->image_prd)}}" alt="big-1">

                            </a>
                        </div>

                        <div class="single-zoom-thumb">
                              
                                

                        
                            <ul class="s-tab-zoom owl-carousel single-product-active" id="gallery_01">
                                <li>
                                    <a href="#" class="elevatezoom-gallery active" data-update="" data-image="{{ asset('storage/' .  $product->image_prd)}}" data-zoom-image="{{ asset('storage/' .  $product->image_prd)}}">
                                        <img src="{{ asset('storage/' .  $product->image_prd)}}" alt="zo-th-1" />
                                    </a>

                                </li>
                                @foreach($variations as $item)
                                <li>
                                    <a href="#" class="elevatezoom-gallery active" data-update="" data-image="{{ asset('storage/' . $item->image)}}" data-zoom-image="{{ asset('storage/' . $item->image)}}">
                                        <img src="{{ asset('storage/' . $item->image)}}" alt="zo-th-1" />
                                    </a>

                                </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>


                <div class="col-lg-6 col-md-6">
                    <div class="product_d_right">
                        <form action="{{route('cart.add')}}" method="POST">
                            @csrf
                            <h1>{{$product->name}}</h1>
                            <div class="product_nav">
                                <ul>
                                    <li class="prev"><a href="product-details.html"><i class="fa fa-angle-left"></i></a></li>
                                    <li class="next"><a href="variable-product.html"><i class="fa fa-angle-right"></i></a></li>
                                </ul>
                            </div>
                            <div class=" product_ratting">
                                <ul>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li class="review"><a href="#"> (customer review ) </a></li>
                                </ul>

                            </div>
                            <div class="price_box">
                                <span class="current_price">{{$product->price_new}}vnđ</span>
                                <span class="old_price">{{$product->price_old}}</span>

                            </div>
                            <div class="product_desc">
                                <p>{{$product->description}} </p>
                            </div>
                            <div class="product_variant color">
                                <h3>Chọn màu</h3>
                                <ul>
                                        <!-- Checkbox để chọn màu biến thể -->
                                        
                                        @foreach($colors as $value)
                                            {{-- <input type="checkbox" name="selectedColor[]" value="red" style="background-color: red; border: none;"> {{$value}} --}}
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="selectedColor" id="{{$value}}" value="{{$value}}">
                                                <label class="form-check-label color-option">{{$value}}</label>
                                            </div>
                                        @endforeach
                                        {{-- @foreach($colors as $value)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="selectedColor" id="{{$value}}" value="{{$value}}">
                                            </div>
                                        @endforeach --}}

                                </ul>
                                <div class="mb-4">
                                    <h3>Chọn kích cỡ</h3>
                                    @foreach($sizes as $value)
                                    <div class="form-check form-check-inline">
                                        <input class="size-option" data-size="{{$value}}" type="radio" name="selectedSize" id="{{$value}}" value="{{$value}}" placeholder="">
                                        <label class="size-option" data-size="{{$value}}" for="size_{{$value}}">{{$value}}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="product_variant quantity">
                                <label>Số Lượng</label>
                                <input name="quantity" min="1" max="100" value="1" type="number" >
                                <input type="hidden" name="product_name" value="{{$product->name}}">
                                <input type="hidden" name="product_id" value="{{$product->id}}">


                                <button class="button" type="submit">Thêm vào Giỏ Hàng</button>
                            </div>
                        </form>
                            <div class=" product_d_action">
                                <ul>
                                    <li><a href="#" title="Add to wishlist">+ Thêm vào danh mục yêu thích </a></li>
                                    <li><a href="#" title="Add to wishlist">+ Compare</a></li>
                                </ul>
                            </div>
                            <div class="product_meta">
                                <span>Danh mục: <a href="#">{{$category->name}}</a></span>
                                <div style="margin-top: 15px">
                                    <label>Số lượng sản phẩm trong kho {{$stockQuantity}}</label>
                                </div>
                            </div>

                        </form>
                        <div class="priduct_social">
                            <ul>
                                <li><a class="facebook" href="#" title="facebook"><i class="fa fa-facebook"></i> Like</a></li>
                                <li><a class="twitter" href="#" title="twitter"><i class="fa fa-twitter"></i> tweet</a></li>
                                <li><a class="pinterest" href="#" title="pinterest"><i class="fa fa-pinterest"></i> save</a></li>
                                <li><a class="google-plus" href="#" title="google +"><i class="fa fa-google-plus"></i> share</a></li>
                                <li><a class="linkedin" href="#" title="linkedin"><i class="fa fa-linkedin"></i> linked</a></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var sizesWithColors = @json($sizesWithColors);  // Dữ liệu từ controller
    
        // Khi chọn màu, lọc kích thước phù hợp
        document.querySelectorAll('input[name="selectedColor"]').forEach(function(colorInput) {
            colorInput.addEventListener('change', function() {
                var selectedColor = this.value;  // Màu đã chọn
    
                // Ẩn tất cả các size trước
                document.querySelectorAll('.size-option').forEach(function(sizeOption) {
                    sizeOption.parentElement.style.display = 'none'; // Ẩn cả input và label
                });
    
                // Hiển thị size tương ứng với màu đã chọn
                for (var size in sizesWithColors) {
                    if (sizesWithColors[size].includes(selectedColor)) {
                        // Tìm phần tử label tương ứng với size
                        var sizeOptionLabel = document.querySelector('.size-option[data-size="' + size + '"]');
                        
                        // Kiểm tra sự tồn tại của phần tử sizeOption trước khi hiển thị
                        if (sizeOptionLabel) {
                            sizeOptionLabel.parentElement.style.display = 'inline-block';  // Hiển thị cả input và label
                        }
                    }
                }
            });
        });
    </script>
    
    
    
    
@endsection
