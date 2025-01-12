@extends('admin.app')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
   

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Quản lý banner
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="datatable-buttons" width="100%" cellspacing="0">
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
                                        <img src="{{ asset('storage/banners/' . $d->image) }}" width="250px"
                                            alt="">
                                    </td>
                                    <td>{{ $d->product->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.banners.edit', $d->id) }}"
                                            class="btn btn-warning btn-sm">Sửa</a>
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
      $(document).ready(function() {
          $('#datatable-buttons').DataTable({
              lengthChange: true, 
          });
      });
  </script>
  
@endsection
