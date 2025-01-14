$(document).ready(function () {
    // Đặt phí vận chuyển mặc định là 0đ
    $('.shipping-fee').text('0đ');
    $('.shipping-fee-container').hide(); // Ẩn phí vận chuyển khi chưa chọn gì

    // Lắng nghe sự kiện khi người dùng chọn Tỉnh/Thành phố
    $('#province').change(function() {
        let provinceId = $(this).val();
        console.log('Province ID:', provinceId); // Kiểm tra giá trị provinceId

        // Tải danh sách quận/huyện cho tỉnh đã chọn
        $.get(`/districts/${provinceId}`, function(data) {
            $('#district').html('<option value="">-- Chọn --</option>');
            data.forEach(d => {
                $('#district').append(`<option value="${d.id}">${d.name}</option>`);
            });
            $('#district').prop('disabled', false);
            // Reset và hiển thị xã/phường
            $('#ward').html('<option value="">-- Chọn --</option>').prop('disabled', false);
        });

        // Lấy phí vận chuyển khi chọn tỉnh
        $.get(`/shipping-fee/${provinceId}`, function(data) {
            if (data) {
                let shippingFee = data.fee;
                $('.shipping-fee').text(shippingFee.toLocaleString() + 'đ');
                $('.shipping-fee-container').show(); // Hiển thị phí vận chuyển
                $('#ship').val(shippingFee);  // Gán giá trị phí vận chuyển vào input
            } else {
                // Nếu không có phí vận chuyển, vẫn hiển thị 0đ
                $('.shipping-fee').text('0đ');
                $('.shipping-fee-container').show(); // Hiển thị phí vận chuyển
            }
        });
    });


    // Lắng nghe sự kiện khi người dùng chọn Quận/Huyện
    $('#district').change(function() {
        let districtId = $(this).val();
        let provinceId = $('#province').val();

        // Lấy phí vận chuyển khi chọn Quận/Huyện
        if (provinceId === '3' && districtId) {
            // Nếu chọn Hà Nội và có district, lấy phí vận chuyển từ province_id và district_id
            $.get(`/shipping-fee/${provinceId}/${districtId}`, function(data) {
                if (data) {
                    let shippingFee = data.fee;
                    $('.shipping-fee').text(shippingFee.toLocaleString() + 'đ');
                    $('.shipping-fee-container').show(); // Hiển thị phí vận chuyển
                } else {
                    // Nếu không có phí vận chuyển, vẫn hiển thị 0đ
                    $('.shipping-fee').text('0đ');
                    $('.shipping-fee-container').show(); // Hiển thị phí vận chuyển
                }
            });
        } else if (provinceId !== '3' && districtId) {
            // Nếu tỉnh khác Hà Nội, chỉ cần kiểm tra phí vận chuyển qua province_id
            $.get(`/shipping-fee/${provinceId}`, function(data) {
                if (data) {
                    let shippingFee = data.fee;
                    $('.shipping-fee').text(shippingFee.toLocaleString() + 'đ');
                    $('.shipping-fee-container').show(); // Hiển thị phí vận chuyển
                } else {
                    // Nếu không có phí vận chuyển, vẫn hiển thị 0đ
                    $('.shipping-fee').text('0đ');
                    $('.shipping-fee-container').show(); // Hiển thị phí vận chuyển
                }
            });
        }

        // Tải danh sách xã/phường cho Quận/Huyện đã chọn
        if (districtId) {
            $.get(`/wards/${districtId}`, function(data) {
                $('#ward').html('<option value="">-- Chọn --</option>');
                data.forEach(w => {
                    $('#ward').append(`<option value="${w.id}">${w.name}</option>`);
                });
                $('#ward').prop('disabled', false);
            });
        } else {
            $('#ward').html('<option value="">-- Chọn --</option>').prop('disabled', true);
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

        // Nếu tất cả đều hợp lệ, hiển thị thông báo thanh toán thành công
        if (isValid) {
            alert('Thanh toán thành công, vui lòng kiểm tra đơn hàng của bạn trong phần "Đơn hàng của tôi"');
        }
    });

    $('#discount-options').on('change', function () {
        let selectedOption = $(this).val();

        if (selectedOption === '0') {
            let originalTotal = parseInt($('#total_amount_product').text().replace(/\./g, '').replace('đ', ''));
            $('.discount_value').text('0');
            $('.total').text(originalTotal.toLocaleString());
            $('#discount').val('');
            return;
        }

        $.ajax({
            url: '/get-data-discount/' + selectedOption,
            method: 'GET',
            success: function (response) {
                let originalTotal = parseInt($('#total_amount_product').text().replace(/\./g, '').replace('đ', ''));
                let minAmount = parseInt(response.data.min_purchase_amount);
                let discountValue = parseInt(response.data.value);
                let discountType = response.data.type;
                let maxDiscount = response.data.max_purchase_amount
                    ? parseInt(response.data.max_purchase_amount)
                    : null;

                if (originalTotal < minAmount) {
                    alert(`Không áp dụng cho đơn hàng có tổng tiền nhỏ hơn ${minAmount.toLocaleString()} đ`);
                    $('#discount-options').val('0');
                    return;
                }

                let discountAmount = discountType === 'percentage'
                    ? (originalTotal * discountValue) / 100
                    : discountValue;

                if (maxDiscount && discountAmount > maxDiscount) {
                    discountAmount = maxDiscount;
                }

                let newTotal = originalTotal - discountAmount;

                $('.discount_value').text(discountAmount.toLocaleString());
                $('.total').text(newTotal.toLocaleString());
                $('#discount').val(discountAmount.toLocaleString());
                $('#total_amount').val(newTotal);

                alert(`Áp mã giảm giá thành công, giảm ${discountAmount.toLocaleString()} đ`);
            },
            error: function (xhr, status, error) {
                console.error('Lỗi khi lấy dữ liệu mã giảm giá:', error);
            }
        });
    });


});
