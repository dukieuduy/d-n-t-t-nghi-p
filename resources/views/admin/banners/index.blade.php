@extends('admin.app')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


    <!-- Begin Page Content -->
    <div class="container-fluid">

        {{-- <form method="GET" action="{{ route('admin.categories.index') }}" class="row g-3">
            <div class="col-md-8">
                <input type="text" name="search" placeholder="Tìm kiếm danh mục" value="{{ request('search') }}"
                    class="form-control">
            </div>
            <div class="col-md-4">
                <select name="sort_by" class="custom-select">
                    <option value="asc" {{ request('sort_by') == 'asc' ? 'selected' : '' }}>A-Z</option>
                    <option value="desc" {{ request('sort_by') == 'desc' ? 'selected' : '' }}>Z-A</option>
                </select>
            </div>
            <div class="col-md-12 mt-3">
                <button type="submit" class="btn btn-primary mb-3">Tìm kiếm</button>
            </div>
        </form> --}}
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Quản lý banner
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tiêu đề</th>
                                <th>Nội dung</th>
                                <th>Ảnh</th>
                                <th>Sản phẩm</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $d)
                                <tr>
                                    <td>{{ $d->id }}</td>
                                    <td>{{ $d->title }}</td>
                                    <td>{!! $d->content !!}</td>
                                    <td>
                                      <img src="{{ asset('storage/banners/'.$d->image) }}" width="250px" alt="">
                                    </td>
                                    <td>{{ $d->product->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.banners.edit', $d->id) }}"
                                            class="btn btn-warning btn-sm"
                                          >Sửa</a>
                                        <form action="{{ route('admin.banners.destroy', $d->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa banners này không?')">Xóa</button>
                                        </form>
                                    </td>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->
@endsection
