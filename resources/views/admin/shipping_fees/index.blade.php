<!-- resources/views/admin/shipping_fees/index.blade.php -->

@extends("admin.app")

@section("content")
    <h1>Quản lý Phí Ship</h1>
    <a href="{{route('admin.shipping_fees.create')}}" class="btn btn-primary">Thêm Phí Ship</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Tên Quận/Huyện</th>
                <th>Phí Ship</th>
                <th>Miễn Phí Ship</th>
                <th>Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($shippingFees as $shippingFee)
                <tr>
                    <td>{{$shippingFee->province->name }} @if($shippingFee->district_id )- {{$shippingFee->district->name}}@endif</td>
                    <td>{{ number_format($shippingFee->fee, 2) }} VNĐ</td>
                    <td>{{ $shippingFee->is_free ? 'Có' : 'Không' }}</td>
                    <td>
                        <a href="{{ route('admin.shipping_fees.edit', $shippingFee->id) }}" class="btn btn-warning">Sửa</a>
                        <form action="{{ route('admin.shipping_fees.destroy', $shippingFee->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Xóa</button>
                        </form>
                        
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
