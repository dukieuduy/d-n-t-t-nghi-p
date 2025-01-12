@extends('app')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="index.html">home</a></li>
                            <li>Wishlist</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wishlist_area mt-30">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table_desc wishlist">
                        <div class="cart_page table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="product"></th>
                                        <th class="product_img">Ảnh</th>
                                        <th class="product_name">Sản phẩm</th>
                                        <th class="product-price">Giá</th>
                                        <th class="product-action">bỏ thích</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($wishlistProducts as $product)
                                        @php
                                            // Truy vấn sản phẩm chính dựa trên product_id
                                            $mainProduct = \App\Models\Product::find($product->product_id);
                                        @endphp
                                        <tr>
                                            <td>

                                                <a href="{{ route('detail-product', ['id' => $mainProduct->id]) }}">
                                                    xem sản phẩm
                                                </a>
                                            </td>
                                            <td class="product_thumb"><img src="{{ Storage::url($product->image) }}"
                                                    alt="">
                                            </td>
                                            <td class="product_name">{{ $product->name }}</td>
                                            <td class="product-price">{{ $product->price }}</td>
                                            <td>
                                                <form method="POST"
                                                    action="{{ route('wishlist.destroy', ['id' => $product->id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm">xóa yêu
                                                        thích</button>
                                                </form>
                                            </td>

                                        </tr>
                                    @endforeach

                                    {{-- <tr>
                                            <td class="product_remove"><a href="#"></a></td>
                                            <td class="product_thumb"><a href="#"><img

                                                        src="assets/img/s-product/product2.jpg" alt=""></a></td>
                                            <td class="product_name"><a href="#">Handbags justo</a></td>
                                            <td class="product-price">£90.00</td>
                                            <td class="product_total"><a href="#">Add To Cart</a></td>

                                        </tr> --}}


                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="wishlist_share">
                        <h4>Share on:</h4>
                        <ul>
                            <li><a href="#"><i class="fa fa-rss"></i></a></li>
                            <li><a href="#"><i class="fa fa-vimeo"></i></a></li>
                            <li><a href="#"><i class="fa fa-tumblr"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
