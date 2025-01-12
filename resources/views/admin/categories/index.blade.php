@extends('admin.app')

@section('content')

 @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    
 <!-- Begin Page Content -->
          <div class="container-fluid">
            
            <form method="GET" action="{{ route('admin.categories.index') }}" class="row g-3">
        <div class="col-md-8">
            <input type="text" name="search" placeholder="Tìm kiếm danh mục" value="{{ request('search') }}" class="form-control">
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
    </form>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                  Quản lý danh mục
                </h6>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table
                    class="table table-bordered"
                    id="dataTable"
                    width="100%"
                    cellspacing="0"
                  >
                    <thead>
                      <tr>
                        <th>Tên danh mục</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                      </tr>
                    </thead>
                    
                    <tbody>
                    @foreach($categories as $category)
                      <tr>
                        <td>{{$category->name}}</td>
                    
                        <td>{{$category->is_active == 1 ?"Hiển thị":"Ẩn"}}</td>
                        <td>
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning btn-sm" onclick="return confirm('Bạn có chắc chắn muốn sửa danh mục này không ?')" >Sửa</a>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')">Xóa</button>
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