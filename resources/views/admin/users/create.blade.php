@extends('admin.layouts.master')

@section('title')
    Thêm mới tài khoản
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thêm mới tài khoản quản trị viên</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Danh sách</a></li>
                        <li class="breadcrumb-item active ">Thêm mới</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <!-- thông tin -->
    <div class="row">
        <div class="col-md-12">
            @if (session()->has('error'))
                <div class="alert alert-danger m-3">
                    {{ session()->get('error') }}
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Thông tin tài khoản</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <form action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="email_verified_at" value="{{ \Carbon\Carbon::now()->toDateTimeString() }}">
                            <div class="tab-content">
                                <div class="" id="pills-info-desc" role="tabpanel"
                                    aria-labelledby="pills-info-desc-tab">
                                    <div>
                                        <div class="text-center">
                                            <div
                                                class="profile-user position-relative d-inline-block mx-auto mb-2 img-fluid">
                                                <img src="{{ asset('theme/admin/assets/images/users/user-dummy-img.jpg') }}"
                                                    class="rounded-circle avatar-lg img-thumbnail user-profile-image"
                                                    alt="user-profile-image">
                                                <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                                    <input id="profile-img-file-input" type="file"
                                                        class="profile-img-file-input" accept="image/png, image/jpeg"
                                                        name="img_thumbnail">
                                                    <label for="profile-img-file-input"
                                                        class="profile-photo-edit avatar-xs">
                                                        <span class="avatar-title rounded-circle bg-light text-body">
                                                            <i class="ri-camera-fill"></i>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                            <h5 class="fs-14">Hình ảnh</h5>

                                        </div>
                                        <div>
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4">
                                                    <div class="mb-3">
                                                        <span class='text-danger'>*</span>
                                                        <label class="form-label">Họ và tên</label>
                                                        <input type="text" class="form-control" placeholder="Họ và tên"
                                                            name="name" value="{{ old('name') }}">
                                                        @error('name')
                                                            <div class='mt-1'>
                                                                <span class="text-danger">{{ $message }}</span>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4">
                                                    <div class="mb-3">
                                                        <span class='text-danger'>*</span>
                                                        <label class="form-label">Email</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="user123@gmail.com" name="email"
                                                            value="{{ old('email') }}">
                                                        @error('email')
                                                            <div class='mt-1'>
                                                                <span class="text-danger">{{ $message }}</span>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4">
                                                    <div class="mb-3">
                                                        <span class='text-danger'>*</span>
                                                        <label class="form-label">Số điện thoại</label>
                                                        <input type="text" class="form-control" placeholder="0965263725"
                                                            name="phone" value="{{ old('phone') }}">
                                                        @error('phone')
                                                            <div class='mt-1'>
                                                                <span class="text-danger">{{ $message }}</span>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="mb-3">
                                                        <span class='text-danger'>*</span>
                                                        <label class="form-label">Mật khẩu</label>
                                                        <input type="password" class="form-control" placeholder="Mật khẩu"
                                                            name="password">
                                                        @error('password')
                                                            <div class='mt-1'>
                                                                <span class="text-danger">{{ $message }}</span>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="mb-3">
                                                        <span class='text-danger'>*</span>
                                                        <label class="form-label">Xác nhận mật khẩu</label>
                                                        <input type="password" class="form-control"
                                                            placeholder="Xác nhận mật khẩu" name="password_confirmation">
                                                        @error('password_confirmation')
                                                            <div class='mt-1'>
                                                                <span class="text-danger">{{ $message }}</span>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-3 col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">Ngày sinh</label>
                                                        <input type="date" class="form-control" name="birthday"
                                                            value="{{ old('birthday') }}">
                                                        @error('birthday')
                                                            <div class='mt-1'>
                                                                <span class="text-danger">{{ $message }}</span>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">Giới tính</label>
                                                        <select name="gender" id="" class="form-select">
                                                            @foreach ($genders as $gender)
                                                                <option value="{{ $gender }}"
                                                                    @selected(old('gender') == $gender)>{{ $gender }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('gender')
                                                            <div class='mt-1'>
                                                                <span class="text-danger">{{ $message }}</span>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                          
                                                <div class="col-lg-3 col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">Vai trò</label>
                                                        <select class="js-example-basic-multiple" name="role_id[]"
                                                            multiple="multiple">
                                                            {{-- <option value="">Chọn vai trò</option> --}}
                                                            @foreach ($roles as $role)
                                                                @if ($role->name != 'System Admin')
                                                                    <option value="{{ $role->name }}" title="">
                                                                        {{ $role->name }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        @error('gender')
                                                            <div class='mt-1'>
                                                                <span class="text-danger">{{ $message }}</span>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3">

                                                    <div class="mb-3">
                                                        <label class="form-label">Tại</label>
                                                        <select name="cinema_id" id="" class="form-select">
                                                            @foreach ($cinemas as $cinema)
                                                                <option value="{{ $cinema->id }}">{{ $cinema->name }}
                                                                </option>
                                                            @endforeach

                                                        </select>
                                                        @error('cinema_id')
                                                            <div class='mt-1'>
                                                                <span class="text-danger">{{ $message }}</span>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Địa chỉ</label>
                                                        <textarea name="address" id="" cols="2" rows="2" class="form-control"
                                                            placeholder="Tòa FPT, Trịnh Văn Bô, Nam Từ Liêm, Hà Nội.">{{ old('address') }}</textarea>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-start gap-3 mt-4">
                                        <a href="{{ route('admin.users.index') }}"
                                            class="btn btn btn-link text-decoration-none btn-label previestab"> <i
                                                class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>Trở
                                            về</a>
                                        <button type="submit"
                                            class="btn btn-primary btn-label right ms-auto nexttab nexttab"
                                            data-nexttab="pills-success-tab"><i
                                                class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Thêm
                                            mới</button>
                                    </div>
                                </div>

                            </div>
                            <!-- end tab content -->
                        </form>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
        </div>
    </div>
@endsection





@section('style-libs')
    <script src="{{ asset('theme/admin/assets/js/pages/form-wizard.init.js') }}"></script>
    <!-- App favicon -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Layout config Js -->
    <script src="assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('script-libs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <!--select2 cdn-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ asset('theme/admin/assets/js/pages/select2.init.js') }}"></script>
    <script>
        new DataTable("#example", {
            order: [
                // [0, 'desc']
            ]
        });
    </script>
@endsection