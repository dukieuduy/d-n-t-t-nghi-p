<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chọn địa phương</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Chọn địa phương</h1>

    <label for="province">Tỉnh/Thành phố:</label>
    <select id="province">
        <option value="">-- Chọn --</option>
        @foreach ($provinces as $province)
            <option value="{{ $province->id }}">{{ $province->name }}</option>
        @endforeach
    </select>

    <label for="district">Quận/Huyện:</label>
    <select id="district" disabled>
        <option value="">-- Chọn --</option>
    </select>

    <label for="ward">Xã/Phường:</label>
    <select id="ward" disabled>
        <option value="">-- Chọn --</option>
    </select>

    <script>
        $('#province').change(function() {
            let provinceId = $(this).val();
            if (provinceId) {
                $.get(`/districts/${provinceId}`, function(data) {
                    $('#district').html('<option value="">-- Chọn --</option>');
                    data.forEach(d => {
                        $('#district').append(`<option value="${d.id}">${d.name}</option>`);
                    });
                    $('#district').prop('disabled', false);
                });
            }
        });

        $('#district').change(function() {
            let districtId = $(this).val();
            if (districtId) {
                $.get(`/wards/${districtId}`, function(data) {
                    $('#ward').html('<option value="">-- Chọn --</option>');
                    data.forEach(w => {
                        $('#ward').append(`<option value="${w.id}">${w.name}</option>`);
                    });
                    $('#ward').prop('disabled', false);
                });
            }
        });
    </script>
</body>
</html>
