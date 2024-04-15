<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>تعديل || العربي جروب</title>
    <link rel="shortcut icon" href="{{ asset('assets/product.jpg') }}" type="image/x-icon" />

    <!-- Importing fontawesome library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- Importing Bootstrap library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css"
        integrity="sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Importing 'Cairo' Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('files/addProduct.css') }}" />
    <link rel="stylesheet" href="{{ asset('files/stocks.css') }}" />
</head>

<body>
    <!-- Start Body Home -->
    <div class="home overflow-hidden">
        <!-- Start Navbar -->
        <div class="navbar row m-0 text-white fs-5 px-2">
            <div class="col-3">
                <i class="fa-solid fa-bars ms-2 text-white"></i>
                تعديل بيانات موظف
            </div>
            <div class="col"></div>
            <div class="col text-start">
                <!-- Start Messages Section -->
                {{-- <div class="dropdown d-inline-block position-relative">
                    <button type="button" class="btn position-relative">
                        <i class="fa-solid fa-lightbulb text-white fs-5"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                            id="messages-count">
                        </span>
                    </button>
                    <div class="dropdown-content position-absolute start-0 h-auto text-dark text-end py-2 px-4"
                        id="messages"></div>
                </div> --}}
                <!-- End Messages Section -->

                <!-- Start Emails Part -->
                {{-- <div class="dropdown d-inline-block position-relative">
                    <button type="button" class="btn position-relative">
                        <i class="fa-solid fa-envelope text-white fs-5"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                            id="emails-count">
                        </span>
                    </button>
                    <div class="dropdown-content position-absolute start-0 h-auto text-dark text-end py-2 px-4"
                        id="emails"></div>
                </div> --}}
                <!-- End Emails Part -->

                <!-- Start Messages Section -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link class="text-decoration-none text-white w-auto p-0 m-0" :href="route('logout')"
                        onclick="event.preventDefault();
                      this.closest('form').submit();">
                        <i class="fa-solid fa-right-from-bracket ms-1"></i>
                        {{ __('تسجيل الخروج') }}
                    </x-dropdown-link>
                </form>
                <!-- Start Messages Section -->
            </div>
        </div>
        <!-- End Navbar -->

        <div class="content-body row m-0">
            <!-- Start Sidebar -->
            {{ view('sidebar') }}
            <!-- End Sidebar -->

            <!-- Start Content -->
            <div class="content col-10 mt-5 overflow-y-scroll h-100">
                <div class="alerting"></div>
                @if (Session::has('edtdone'))
                    <div class="alert alert-dismissible alert-success align-items-center h3em d-flex fade justify-content-between m-2 show"
                        role="alert">
                        <svg class="bi flex-shrink-0 me-2 w-7 h-7" role="img" aria-label="Success:">
                            <use xlink:href="#check-circle-fill" />
                        </svg>
                        <div>{{ Session::get('edtdone') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if ($errors->count() > 0)
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-dismissible alert-danger align-items-center h3em d-flex fade justify-content-between m-2 show"
                            role="alert">
                            <svg class="bi flex-shrink-0 me-2 w-7 h-7" role="img" aria-label="Danger:">
                                <use xlink:href="#check-circle-fill" />
                            </svg>
                            <div>{{ $error }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endforeach
                @endif

                <div id="edtuser">
                    <form action="{{ route('update_user', $user->id) }}" enctype="multipart/form-data" method="POST"
                        class="w-50 h-100 mx-auto rounded-4 p-4 text-end" style="margin-bottom: 5rem">
                        @csrf
                        <div class="mb-4 d-block">
                            <label for="name" class="form-label">الإسم <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" required
                                value="{{ old('name', $user->name) }}" />
                        </div>
                        <div class="mb-4 d-block">
                            <label for="email" class="form-label">البريد الإلكتروني <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" required
                                value="{{ old('email', $user->email) }}" />
                        </div>
                        <div class="mb-4 d-block">
                            <label for="password" class="form-label">كلمة المرور <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password" name="password" required
                                value="" />
                        </div>
                        <div class="mb-4 d-block">
                            <label for="job_type" class="form-label">الوظيفة <span class="text-danger">*</span></label>
                            <select class="form-select" id="job_type" aria-label="Default select example"
                                name="job_type" required>
                                <option selected value="{{ $user->job_type }}">{{ $user->job_type }}</option>
                                @if ($user->job_type != 'إداري')
                                    <option value="إداري">إداري</option>
                                @endif
                                @if ($user->job_type != 'محاسب')
                                    <option value="محاسب">محاسب</option>
                                @endif
                                @if ($user->job_type != 'مندوب المبيعات')
                                    <option value="مندوب المبيعات">مندوب المبيعات</option>
                                @endif
                                @if ($user->job_type != 'أخصائي تسويق')
                                    <option value="أخصائي تسويق">أخصائي تسويق</option>
                                @endif
                                @if ($user->job_type != 'أخصائي مالية')
                                    <option value="أخصائي مالية">أخصائي مالية</option>
                                @endif
                                @if ($user->job_type != 'أخصائي موارد بشرية')
                                    <option value="أخصائي موارد بشرية">أخصائي موارد بشرية</option>
                                @endif
                            </select>
                        </div>
                        <div class="mb-4 d-block">
                            <label for="phone" class="form-label">التليفون <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="phone" name="phone" required
                                value="{{ old('phone', $user->phone) }}" />
                        </div>
                        {{-- <div class="mb-5 text-end">
                            <label for="item-pic" class="form-label">صورة المنتج</label>
                            <input type="file" class="form-control" id="item-pic" />
                        </div> --}}
                        <div class="mb-4 d-block">
                            <label for="salary" class="form-label">المرتب <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="salary" name="salary" required
                                value="{{ old('salary', $user->salary) }}" />
                        </div>
                        <div class="mb-4 d-block">
                            <label for="holidays" class="form-label">الأجازات <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="holidays" name="holidays" required
                                value="{{ old('holidays', $user->holidays) }}" />
                        </div>
                        <div class="mb-4 d-block">
                            <label for="holi_rest" class="form-label">باقي الأجازات <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="holi_rest" name="holi_rest" required
                                value="{{ old('holi_rest', $user->holi_rest) }}" />
                        </div>
                        <div class="mb-4 d-block">
                            <label for="over_time" class="form-label">وقت إضافي (دقائق) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="over_time" name="over_time" required
                                value="{{ old('over_time', $user->over_time) }}" />
                        </div>
                        <div class="mb-4 d-block">
                            <label for="emp_file" class="form-label">مرفقات <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="emp_file" name="emp_file" />
                        </div>
                        <div class="mb-4 d-block">
                            <label for="" class="form-label">عرض المرفق المحفوظ <span class="text-danger">*</span></label>
                            @if (isset($user->emp_file))
                                <a href="{{ asset('storage/' . $user->emp_file) }}"
                                    target="_blank" class="form-control text-bg-dark text-decoration-none">{{ substr($user->emp_file, 9) }}</a>
                            @endif
                        </div>


                        <div class="mx-auto w-50 text-center mt-5">                        
                            <button type="submit" class="btn btn-primary btn-lg" name="button_edt_submit">
                                تعديل
                                <i class="fa-solid fa-edit me-1" style="color: #ffffff"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Content -->
        </div>
    </div>
    <!-- End Body Home -->

    <!-- Importing Scripts -->
    <script src="{{ asset('js/jq/jq.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"
        integrity="sha512-3dZ9wIrMMij8rOH7X3kLfXAzwtcHpuYpEgQg1OA4QAob1e81H8ntUQmQm3pBudqIoySO5j0tHN4ENzA6+n2r4w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('files/script.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- <script src="{{ asset('files/addProduct.js') }}"></script> -->
    <script>
        $('a').each(function() {
            $(this).removeClass('active-page')
        });
        $('#users').addClass('active-page');
    </script>
</body>

</html>
