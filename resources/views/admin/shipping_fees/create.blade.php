<!-- resources/views/admin/shipping_fees/create.blade.php -->

@extends("admin.app")

@section("content")
    <h1>Thêm Phí Ship</h1>


            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-warning">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

    <form action="{{ route('admin.shipping_fees.store') }}" method="POST">
        @csrf
        <label for="province_id">Tỉnh/Thành phố:</label>
        <select id="province_id" name="province_id">
            <option value="">-- Chọn --</option>
            @foreach ($provinces as $province)
                <option value="{{ $province->id }}">{{ $province->name }}</option>
            @endforeach
        </select>
    
        <label for="district_id">Quận/Huyện:</label>
            <select id="district_id" name="district_id" disabled>
                <option value="">-- Chọn --</option>
            </select>

        <div class="form-group">
            <label for="fee">Phí Ship (VNĐ)</label>
            <input type="number" name="fee" class="form-control" >
        </div>
        <div class="form-group">
            <label for="is_free">Miễn Phí Ship</label>
            <input type="checkbox" name="is_free" value="1">
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $('#province_id').change(function() {
        let provinceId = $(this).val();
        if (provinceId) {
            // Gọi API lấy danh sách quận/huyện theo tỉnh
            $.get(`/districts/${provinceId}`, function(data) {
                $('#district_id').html('<option value="">-- Chọn --</option>'); // Reset danh sách quận/huyện
                if (data.length > 0) {
                    data.forEach(d => {
                        // Thêm các quận/huyện vào select
                        $('#district_id').append(`<option value="${d.id}">${d.name}</option>`);
                    });
                    $('#district_id').prop('disabled', false); // Kích hoạt select
                } else {
                    $('#district_id').prop('disabled', true); // Nếu không có quận/huyện, disable select
                }
            }).fail(function() {
                // Nếu có lỗi khi gọi API
                alert('Không thể tải dữ liệu quận/huyện. Vui lòng thử lại!');
            });
        } else {
            $('#district_id').prop('disabled', true); // Nếu không có tỉnh được chọn, disable select
        }
    });


        // $('#district').change(function() {
        //     let districtId = $(this).val();
        //     if (districtId) {
        //         $.get(`/wards/${districtId}`, function(data) {
        //             $('#ward').html('<option value="">-- Chọn --</option>');
        //             data.forEach(w => {
        //                 $('#ward').append(`<option value="${w.id}">${w.name}</option>`);
        //             });
        //             $('#ward').prop('disabled', false);
        //         });
        //     }
        // });
    </script>
    {{-- đoạn này nếu chọn free ship thì không nhập được phí ship --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const isFreeCheckbox = document.querySelector('input[name="is_free"]');
            const feeInput = document.querySelector('input[name="fee"]');
    
            // Hàm xử lý trạng thái của trường phí ship
            function toggleFeeInput() {
                if (isFreeCheckbox.checked) {
                    feeInput.value = ''; // Xóa giá trị trong trường phí ship
                    feeInput.setAttribute('disabled', 'disabled'); // Vô hiệu hóa
                } else {
                    feeInput.removeAttribute('disabled'); // Kích hoạt lại
                }
            }
    
            // Lắng nghe sự kiện thay đổi trên checkbox
            isFreeCheckbox.addEventListener('change', toggleFeeInput);
    
            // Gọi hàm xử lý khi trang được tải
            toggleFeeInput();
        });
    </script>
    
@endsection


