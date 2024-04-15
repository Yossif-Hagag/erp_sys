<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>إضافة || العربي جروب</title>
    <link rel="shortcut icon" href="./assets/product.jpg" type="image/x-icon" />

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
    <link rel="stylesheet" href="{{asset('files/addProduct.css')}}" />
    <link rel="stylesheet" href="{{asset('files/purchases.css')}}" />
</head>

<body>
    <!-- Start Body Home -->
    <div class="home overflow-hidden">
        <!-- Start Navbar -->
        <div class="navbar row m-0 text-white fs-5 px-2">
            <div class="col-3">
                <i class="fa-solid fa-bars ms-2 text-white"></i>
                إضافة منتج جديد
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
                <a href="../../index.html" class="text-decoration-none text-white">
                    <i class="fa-solid fa-right-from-bracket ms-1" style="color: #ffffff"></i>
                    تسجيل الخروج
                </a>
                <!-- Start Messages Section -->
            </div>
        </div>
        <!-- End Navbar -->

        <div class="content-body row m-0">
            <!-- Start Sidebar -->
            {{ view('sidebar') }}
            <!-- End Sidebar -->

            <!-- Start Content -->
            <div
                class="content col-10 mt-5 overflow-y-scroll h-100">
                <div class="alerting"></div>
                @if (Session::has('done'))
                <div class="alert alert-dismissible alert-success align-items-center h3em d-flex fade justify-content-between m-2 show"
                        role="alert">
                        <svg class="bi flex-shrink-0 me-2 w-7 h-7" role="img" aria-label="Success:">
                            <use xlink:href="#check-circle-fill" />
                        </svg>
                        <div>{{ Session::get('done') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    @if($errors->count() > 0)
                    @foreach($errors->all() as $error)
                    <div class="alert alert-dismissible alert-danger align-items-center h3em d-flex fade justify-content-between m-2 show"
                        role="alert">
                        <svg class="bi flex-shrink-0 me-2 w-7 h-7" role="img" aria-label="Danger:">
                            <use xlink:href="#check-circle-fill" />
                        </svg>
                        <div>{{$error}}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endforeach
                    @endif
                    <div id="addproduct" style="margin-bottom: 5rem">
                    <form action="{{ route('store_purchas') }}"
                        class="w-50 h-100 mx-auto rounded-4 p-4 text-end" method="POST">
                        @csrf
                        <div class="mb-4 d-block">
                            <label for="name" class="form-label">اسم المورد <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" required />
                        </div>
                        <div class="mb-4 d-block">
                            <label for="phone" class="form-label">تليفون المورد <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="phone" name="phone" required />
                        </div>
                        <div class="mb-4 d-block">
                            <label for="address" class="form-label">عنوان المورد <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="address" name="address" required />
                        </div>
                        {{--<div class="mb-5 text-end">
                            <label for="item-pic" class="form-label">صورة المنتج</label>
                            <input type="file" class="form-control" id="item-pic" />
                        </div>--}}

                        <div class="mb-4 d-block text-end">
                            <label for="pro_num" class="form-label">اختر المنتج <span class="text-danger">*</span></label>
                            <select class="form-select" id="pro_num" aria-label="Default select example" name="pro_num"
                                required>
                                <option selected value=''>اختر</option>
                                @foreach ($products as $product)
                                <option value="{{$product->code}}">{{$product->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4 d-block">
                            <label for="price" class="form-label">سعر التوريد <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="price" name="price" required />
                        </div>
                        <div class="mb-4 d-block">
                            <label for="number_of_product" class="form-label">عدد المنتج <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="number_of_product" name="number_of_product"
                                required />
                        </div>
                        <div class="mx-auto w-50 text-center mt-5">
                            <button type="submit" class="btn btn-danger btn-lg" name="button_add_submit">
                                إضافة
                                <i class="fa-solid fa-plus me-1" style="color: #ffffff"></i>
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
    <script src="{{asset('files/addProduct.js')}}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $('a').each(function() {$(this).removeClass('active-page')});
        $('#purchas').addClass('active-page');
    </script>
</body>

</html>