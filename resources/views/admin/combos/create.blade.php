@extends('admin.layouts.master')

@section('title')
    Thêm mới combo
@endsection

@section('content')
    <form id="comboForm" action="{{ route('admin.combos.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Quản lý combo</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.combos.index') }}">Danh sách</a></li>
                            <li class="breadcrumb-item active">Thêm mới</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- thông tin -->
        <div class="row">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Thông tin combo</h4>
                    </div><!-- end card header -->

                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <meta name="validation-errors" content="{{ json_encode($errors->messages()) }}">
                    @endif

                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-12 px-4">
                                    <div class="row">
                                        <div class="col-md-12 d-flex justify-content-between">
                                            <label for="" class="form-label"></label>
                                            <button type="button" class="btn btn-primary" onclick="addFood()">Thêm đồ
                                                ăn</button>
                                        </div>
                                        <div id="food_list" class="col-md-12">
                                            <!-- Các phần tử food sẽ được thêm vào đây -->
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="name" class="form-label "> <span class="text-danger">*</span>Tên
                                                combo</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ old('name') }}" placeholder="Nhập tên combo">
                                            <span class="error-message" id="error-name"></span>
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="price" class="form-label ">Giá gốc</label>
                                            <input type="number" class="form-control" id="price" name="price"
                                                value="0" disabled>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="price_sale" class="form-label "> <span
                                                    class="text-danger">*</span>Giá bán</label>
                                            <input type="number" class="form-control" id="price_sale" name="price_sale"
                                                value="{{ old('price_sale') }}" placeholder="Nhập giá bán">
                                            @error('price_sale')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="description" class="form-label"> <span
                                                    class="text-danger">*</span>Mô tả ngắn</label>
                                            <textarea class="form-control" rows="3" name="description" placeholder="Nhập mô tả">{{ old('description') }}</textarea>
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end row-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-2">
                                    <label for="img_thumbnail" class="form-label"> <span class="text-danger">*</span>Hình
                                        ảnh</label>
                                    <input type="file" name="img_thumbnail" id="img_thumbnail" class="form-control">
                                    @error('img_thumbnail')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-2">
                                            <label class="form-check-label" for="is_active">Is active:</label>
                                            <div class="form-check form-switch form-switch-default">
                                                <input class="form-check-input" type="checkbox" role=""
                                                    name="is_active" checked value="1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <a href="{{ route('admin.combos.index') }}" class="btn btn-info">Danh sách</a>
                        <button type="submit" class="btn btn-primary mx-1">Thêm mới</button>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
    </form>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let foodCount = 0;
            const minFoodItems = 2;
            const maxFoodItems = 8;

            const foodList = document.getElementById('food_list');

            // Thay thế `@json($foodPrice->pluck('price', 'id'))` với dữ liệu thực tế từ backend
            const foodPrices = @json($foodPrice->pluck('price', 'id'));

            // Thêm sẵn tối thiểu 2 món ăn
            for (let i = 0; i < minFoodItems; i++) {
                addFood(i);
            }

            function addFood(index) {
                if (foodCount >= maxFoodItems) {
                    alert('Chỉ được thêm tối đa ' + maxFoodItems + ' đồ ăn.');
                    return;
                }

                const id = 'gen_' + Math.random().toString(36).substring(2, 15).toLowerCase();
                const html = `
                    <div class="col-md-12 mb-3" id="${id}_item">
                        <div class="d-flex">
                            <div class="col-md-7">
                                <label for="${id}_select" class="form-label">Đồ ăn</label>
                                <select name="combo_food[]" id="${id}_select" class="form-control food-select">
                                    <option value="">--Chọn đồ ăn--</option>
                                    @foreach ($food as $itemId => $itemName)
                                        <option value="{{ $itemId }}">{{ $itemName }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback fs-6" id="${index}_food_error"></div> <!-- Div lỗi cho combo_food -->
                            </div>
                            <div class="col-md-3 mx-4">
                                <label for="${id}" class="form-label">Số lượng</label>
                                <div class="d-flex flex-wrap align-items-start">
                                    <div class="input-step step-primary full-width p-1">
                                        <button type="button" class="minuss">-</button>
                                        <input type="number" name="combo_quantity[]"
                                            class="food-quantity" id="${id}" value="0" min="0" max="10" readonly>
                                        <button type="button" class="pluss">+</button>
                                    </div>
                                </div>
                                <div class="invalid-feedback fs-6" id="${index}_quantity_error"></div> <!-- Div lỗi cho combo_quantity -->
                            </div>

                            <div class="col-md-5 pt-4 mt-1">
                                <button type="button" class="btn btn-danger remove-btn">
                                    <span class="bx bx-trash"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                `;

                foodList.insertAdjacentHTML('beforeend', html);

                // Gán sự kiện cho nút xóa và select box
                foodList.querySelector(`#${id}_item .remove-btn`).addEventListener('click', function() {
                    removeFood(`${id}_item`);
                });

                const newSelect = foodList.querySelector(`#${id}_select`);
                newSelect.addEventListener('change', updateTotalPrice);
                newSelect.addEventListener('change', updateSelectOptions);

                foodList.querySelector(`#${id}_item .food-quantity`).addEventListener('input', updateTotalPrice);

                foodCount++;
                
                updateSelectOptions(); // Cập nhật các tùy chọn sau khi thêm món ăn mới
            }

            // Lắng nghe sự kiện tăng/giảm số lượng cho tất cả các nút + và -
            document.addEventListener('click', function(event) {
                if (event.target.classList.contains('pluss')) {
                    let quantityInput = event.target.closest('.input-step').querySelector('.food-quantity');
                    let currentValue = parseInt(quantityInput.value);
                    quantityInput.value = currentValue + 1; // Tăng số lượng
                    updateTotalPrice(); // Tính lại giá
                }

                if (event.target.classList.contains('minuss')) {
                    let quantityInput = event.target.closest('.input-step').querySelector('.food-quantity');
                    let currentValue = parseInt(quantityInput.value);
                    if (currentValue > 0) {
                        quantityInput.value = currentValue - 1; // Giảm số lượng
                        updateTotalPrice(); // Tính lại giá
                    }
                }
            });

            function removeFood(id) {
                if (foodCount > minFoodItems) {
                    if (confirm('Bạn có chắc muốn xóa không?')) {
                        const element = document.getElementById(id);
                        element.style.transition = 'opacity 0.5s ease';
                        element.style.opacity = '0';

                        setTimeout(() => {
                            element.remove();
                            foodCount--;
                            updateTotalPrice();
                            updateSelectOptions();
                        }, 400);
                    }
                } else {
                    alert('Phải có ít nhất ' + minFoodItems + ' đồ ăn.');
                }
            }

            function updateSelectOptions() {
                const selectedValues = Array.from(document.querySelectorAll('.food-select'))
                    .map(select => select.value)
                    .filter(value => value !== "");

                document.querySelectorAll('.food-select').forEach(select => {
                    const currentValue = select.value;
                    Array.from(select.options).forEach(option => {
                        if (option.value !== currentValue) {
                            option.disabled = selectedValues.includes(option.value);
                        } else {
                            option.disabled = false;
                        }
                    });
                });
            }

            function updateTotalPrice() {
                let totalPrice = 0;

                document.querySelectorAll('.food-select').forEach((select, index) => {
                    const foodId = select.value;
                    const quantityInput = document.querySelectorAll('.food-quantity')[index];
                    const quantity = parseInt(quantityInput.value) || 0;

                    if (foodId && quantity > 0) {
                        totalPrice += foodPrices[foodId] * quantity;
                    }
                });

                const priceInput = document.getElementById('price');
                priceInput.value = totalPrice;

                const priceSaleInput = document.getElementById('price_sale');
                priceSaleInput.value = totalPrice;
            }

            document.querySelector('button[onclick="addFood()"]').addEventListener('click', function() {
                addFood(foodCount);
            });

            

            function displayValidationErrors(errors) {
                // Xóa thông báo lỗi cũ
                $('.invalid-feedback').empty();

                // hiển thị validate của trường combo_food + combo_quantity
                for (let field in errors) {
                    let fieldErrors = errors[field];

                    // Tìm id combo_food và combo_quantity
                    let errorDiv;

                    if (field.startsWith('combo_food')) {

                        let index = field.match(/\d+/)[0];    //output:3
                        errorDiv = $(`#${index}_food_error`);       //output: gán id = 3_food_error
                        
                    } else if (field.startsWith('combo_quantity')) {
                        let index = field.match(/\d+/)[0];
                        errorDiv = $(`#${index}_quantity_error`);
                    }

                    if (errorDiv && errorDiv.length) {
                        errorDiv.text(fieldErrors[0]); // Gán lỗi vào div
                        errorDiv.show();
                    }
                    // console.log(errorDiv);
                    
                }

                // hiển thị validate của các trường còn lại (name, description, img_thumbnail)
                $('.error-message').remove();
                // Hiển thị thông báo lỗi mới
                for (let field in errors) {
                    let fieldErrors = errors[field]; // Array lỗi của từng field
                    let input = $(`[name="${field}"]`); // Tìm input theo tên

                    // Thêm lỗi phía dưới input
                    if (input.length > 0) {
                        input.after(`<div class="error-message text-danger">${fieldErrors[0]}</div>`);
                    }
                }
            }

            $('#comboForm').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            // alert(response.message);
                            window.location.href = '/admin/combos';
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {

                            let errors = xhr.responseJSON.errors;
                            console.log(errors); // Kiểm tra lỗi
                            displayValidationErrors(errors);
                        } else {
                            alert('Đã xảy ra lỗi, vui lòng thử lại!');
                        }
                    }
                });
            });


        });
    </script>
@endsection
