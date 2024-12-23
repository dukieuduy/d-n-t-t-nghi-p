// $(document).ready(function () {
//     $('#checkout').on('click', function () {
//         // let address = $('input[name="address"]:checked').val();
//         let paymentMethod = $('input[name="payment_method"]:checked').val();
//         let totalAmount = $('.total-amount').text();
//         let products = [];

//         $('.cart_item_id').each(function(index) {
//             let product = {
//                 id: $(this).text().trim(),
//                 quantity: $('.quantity-input').eq(index).val().trim(),
//                 price: $('.price').eq(index).text().trim(),
//                 subtotal: $('.subtotal').eq(index).text().trim()
//             };

//             products.push(product);
//         });

//         console.log(products)

//         // $('#error_address').text('');
//         $('#error_payment').text('');

//         let isValid = true;

//         // if (!address) {
//         //     $('#error_address').text('Vui lòng chọn 1 địa chỉ nhận hàng !');
//         //     isValid = false;
//         // }

//         if (!paymentMethod) {
//             $('#error_payment').text('Vui lòng chọn 1 phương thức thanh toán !');
//             isValid = false;
//         }

//         if (products.length === 0) {
//             $('#error_cart_items').text('Vui lòng chọn ít nhất một sản phẩm !');
//             isValid = false;
//         }

//         if (isValid) {
//             let data = {
//                 shipping_address: address,
//                 payment_method: paymentMethod,
//                 total_amount: totalAmount,
//                 products: products
//             };

//             console.log(data);

//             $.ajax({
//                 url: $('#checkout').attr('data-url'),
//                 type: 'POST',
//                 headers: {
//                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                 },
//                 contentType: 'application/json',
//                 data: JSON.stringify(data),
//                 success: function (response) {
//                     alert('Thanh toán thành công, vui lòng kiểm tra đơn hàng của bạn trong phần "Đơn hàng của tôi"')
//                     window.location.href = '/'
//                 },
//                 error: function (err) {
//                     console.log('Error occurred: ' + err);
//                 }
//             });
//         }
//     });
// });


$(document).ready(function () {
    // Lắng nghe sự kiện khi người dùng chọn Tỉnh/Thành phố
    $('#province').change(function() {
        let provinceId = $(this).val();
        console.log('Province ID:', provinceId); // Kiểm tra giá trị provinceId
        
        if (provinceId) {
            $.get(`/districts/${provinceId}`, function(data) {
                $('#district').html('<option value="">-- Chọn --</option>');
                data.forEach(d => {
                    $('#district').append(`<option value="${d.id}">${d.name}</option>`);
                });
                $('#district').prop('disabled', false);
                // Reset and disable ward after changing province
                $('#ward').html('<option value="">-- Chọn --</option>').prop('disabled', true);
            });
        } else {
            // Disable district and ward if no province is selected
            $('#district').prop('disabled', true).html('<option value="">-- Chọn --</option>');
            $('#ward').prop('disabled', true).html('<option value="">-- Chọn --</option>');
        }
    });
    

    // Lắng nghe sự kiện khi người dùng chọn Quận/Huyện
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
        } else {
            // Disable ward if no district is selected
            $('#ward').prop('disabled', true).html('<option value="">-- Chọn --</option>');
        }
    });

    // Xử lý sự kiện thanh toán
    $('#checkout').on('click', function () {
        let paymentMethod = $('input[name="payment_method"]:checked').val();
        let totalAmount = $('.total-amount').text().replace(/[^0-9]/g, ''); // Xử lý số tiền
        let products = [];

        // Lấy thông tin sản phẩm trong giỏ hàng
        $('.cart_item_id').each(function(index) {
            let product = {
                id: $(this).text().trim(),
                quantity: $('.quantity-input').eq(index).val().trim(),
                price: $('.price').eq(index).text().trim().replace(/[^0-9]/g, ''), // Loại bỏ ký tự không phải số
                subtotal: $('.subtotal').eq(index).text().trim().replace(/[^0-9]/g, '') // Loại bỏ ký tự không phải số
            };

            products.push(product);
        });

        // Reset thông báo lỗi
        $('#error_payment').text('');
        $('#error_cart_items').text('');
        $('#error_province').text('');
        $('#error_district').text('');
        $('#error_ward').text('');

        let isValid = true;

        // Kiểm tra thanh toán
        if (!paymentMethod) {
            $('#error_payment').text('Vui lòng chọn 1 phương thức thanh toán!');
            isValid = false;
        }

        // Kiểm tra giỏ hàng
        if (products.length === 0) {
            $('#error_cart_items').text('Vui lòng chọn ít nhất một sản phẩm!');
            isValid = false;
        }

        // Lấy giá trị Tỉnh/Thành phố, Quận/Huyện, Xã/Phường
        let province = $('#province').val();
        let district = $('#district').val();
        let ward = $('#ward').val();

        // Kiểm tra xem đã chọn Tỉnh, Quận, Xã chưa
        if (!province) {
            $('#error_province').text('Vui lòng chọn Tỉnh/Thành phố!');
            isValid = false;
        }
        if (!district) {
            $('#error_district').text('Vui lòng chọn Quận/Huyện!');
            isValid = false;
        }
        if (!ward) {
            $('#error_ward').text('Vui lòng chọn Xã/Phường!');
            isValid = false;
        }

        // Nếu tất cả đều hợp lệ, gửi dữ liệu
        if (isValid) {
            let data = {
                province: province,
                district: district,
                ward: ward,
                payment_method: paymentMethod,
                total_amount: totalAmount,
                products: products
            };

            console.log(data); // In ra dữ liệu để kiểm tra

            $.ajax({
                url: $('#checkout').attr('data-url'),
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                contentType: 'application/json',
                data: JSON.stringify(data),
                success: function (response) {
                    alert('Thanh toán thành công, vui lòng kiểm tra đơn hàng của bạn trong phần "Đơn hàng của tôi"');
                    window.location.href = '/';
                },
                error: function (err) {
                    console.log('Error occurred: ' + err);
                }
            });
        }
    });
});









