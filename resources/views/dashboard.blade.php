<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>الصفحة الرئيسية || العربي جروب</title>
    <link rel="shortcut icon" href="{{ URL::asset('assets/elarby group logo.jpg') }}" type="image/x-icon" />

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
    <link rel="stylesheet" href="{{ URL::asset('files/dashboard.css') }}" />
</head>

<body class="h-100">
    <!-- Start Body Home -->
    <div class="home overflow-hidden">
        <!-- Start Navbar -->
        <div class="navbar row m-0 text-white fs-5 px-2">
            <div class="col-3">
                <i class="fa-solid fa-bars ms-2" style="color: #ffffff"></i>اللوحة
                الرئيسية
            </div>
            <div class="col"></div>
            <div class="col-3 text-start">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link class="text-decoration-none text-white w-auto p-0 m-0" :href="route('logout')"
                        onclick="event.preventDefault();
                      this.closest('form').submit();">
                        <i class="fa-solid fa-right-from-bracket ms-1"></i>
                        {{ __('تسجيل الخروج') }}
                    </x-dropdown-link>
                </form>
            </div>
        </div>
        <!-- End Navbar -->

        <!-- Start Content -->
        <div class="content text-center">

            <div class="row m-0">
                @if (checkPerm(0) == 'on' || Auth::guard('admin')->check())
                    <div class="col">
                        <a class="card py-4 text-decoration-none rounded-4" href="{{ route('product') }}"
                            target="_blank">
                            <i class="fa-solid fa-warehouse card-img-top"></i>
                            <hr class="w-100" />
                            <div class="card-body">
                                <p class="card-text">المخزن</p>

                            </div>
                        </a>
                    </div>
                @endif
                @if (checkPerm(1) == 'on' || Auth::guard('admin')->check())
                    <div class="col">
                        <a class="card py-4 text-decoration-none rounded-4" href="{{ route('purchas') }}"
                            target="_blank">
                            <i class="fa-solid fa-cart-shopping card-img-top"></i>
                            <hr class="w-100" />
                            <div class="card-body">
                                <p class="card-text">المشتريات</p>
                            </div>
                        </a>
                    </div>
                @endif
                @if (checkPerm(12) == 'on' || Auth::guard('admin')->check())
                    <div class="col">
                        <a class="card py-4 text-decoration-none rounded-4" href="{{ route('quotations') }}"
                            target="_blank">
                            <i class="fa-solid fa-hand-holding-dollar card-img-top"></i>
                            <hr class="w-100" />
                            <div class="card-body">
                                <p class="card-text">عروض الأسعار</p>
                            </div>
                        </a>
                    </div>
                @endif
                @if (checkPerm(8) == 'on' || Auth::guard('admin')->check())
                    <div class="col">
                        <a class="card py-4 text-decoration-none rounded-4" href="{{ route('custody') }}"
                            target="_blank">
                            <i class="fa-solid fa-vault card-img-top"></i>
                            <hr class="w-100" />
                            <div class="card-body">
                                <p class="card-text">العهدة</p>
                            </div>
                        </a>
                    </div>
                @endif
                @if (checkPerm(5) == 'on' || Auth::guard('admin')->check())
                    <div class="col">
                        <a class="card py-4 text-decoration-none rounded-4" href="{{ route('allagent') }}"
                            target="_blank">
                            <i class="fa-solid fa-user-group card-img-top"></i>
                            <hr class="w-100" />
                            <div class="card-body">
                                <p class="card-text">العملاء</p>
                            </div>
                        </a>
                    </div>
                @endif
                @if (checkPerm(6) == 'on' || Auth::guard('admin')->check())
                    <div class="col">
                        <a class="card py-4 text-decoration-none rounded-4" href="{{ route('po') }}" target="_blank">
                            <i class="fa-solid fa-money-check-dollar card-img-top"></i>
                            <hr class="w-100" />
                            <div class="card-body">
                                <p class="card-text">PO</p>
                            </div>
                        </a>
                    </div>
                @endif
                @if (checkPerm(2) == 'on' || Auth::guard('admin')->check())
                    <div class="col">
                        <a class="card py-4 text-decoration-none rounded-4" href="{{ route('scrap') }}" target="_blank">
                            <i class="fa-solid fa-prescription-bottle card-img-top"></i>
                            <hr class="w-100" />
                            <div class="card-body">
                                <p class="card-text">سكراب</p>
                            </div>
                        </a>
                    </div>
                @endif
            </div>
            <div class="row m-0">
                @if (checkPerm(4) == 'on' || Auth::guard('admin')->check())
                    <div class="col-2">
                        <a class="card py-4 text-decoration-none rounded-4" href="{{ route('users') }}"
                            target="_blank">
                            <i class="fa-solid fa-user-large card-img-top"></i>
                            <hr class="w-100" />
                            <div class="card-body">
                                <p class="card-text fs-5">شئون العاملين</p>
                            </div>
                        </a>
                    </div>
                @endif
                @if (checkPerm(9) == 'on' || Auth::guard('admin')->check())
                    <div class="col-2">
                        <a class="card py-4 text-decoration-none rounded-4" href="{{ route('barren') }}"
                            target="_blank">
                            <i class="fa-solid fa-edit card-img-top"></i>
                            <hr class="w-100" />
                            <div class="card-body">
                                <p class="card-text">الجرد</p>
                            </div>
                        </a>
                    </div>
                @endif
                @if (checkPerm(10) == 'on' || Auth::guard('admin')->check())
                    <div class="col-2">
                        <a class="card py-4 text-decoration-none rounded-4" href="{{ route('prochis') }}"
                            target="_blank">
                            <i class="fa-solid fa-clock-rotate-left card-img-top"></i>
                            <hr class="w-100" />
                            <div class="card-body">
                                <p class="card-text">تاريخ العمليات</p>
                            </div>
                        </a>
                    </div>
                @endif
                @if (checkPerm(3) == 'on' || Auth::guard('admin')->check())
                    <div class="col-2">
                        <a class="card py-4 text-decoration-none rounded-4" href="{{ route('rental') }}"
                            target="_blank">
                            <i class="fa-solid fa-truck-ramp-box card-img-top"></i>
                            <hr class="w-100" />
                            <div class="card-body">
                                <p class="card-text">التأجير</p>
                            </div>
                        </a>
                    </div>
                @endif
                @if (checkPerm(7) == 'on' || Auth::guard('admin')->check())
                    <div class="col-2">
                        <a class="card py-4 text-decoration-none rounded-4" href="{{ route('po_collected') }}"
                            target="_blank">
                            <i class="fa-solid fa-money-bill card-img-top"></i>
                            <hr class="w-100" />
                            <div class="card-body">
                                <p class="card-text">تحصيل ال PO</p>
                            </div>
                        </a>
                    </div>
                @endif
                @if (checkPerm(11) == 'on' || Auth::guard('admin')->check())
                    <div class="col-2">
                        <a class="card py-4 text-decoration-none rounded-4" href="{{ route('catalogue') }}"
                            target="_blank">
                            <i class="fa-solid fa-address-book card-img-top"></i>
                            <hr class="w-100" />
                            <div class="card-body">
                                <p class="card-text">الفهرس</p>
                            </div>
                        </a>
                    </div>
                @endif
            </div>
        </div>
        <!-- End Content -->
    </div>
    <!-- End Body Home -->

    <!-- Importing Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"
        integrity="sha512-3dZ9wIrMMij8rOH7X3kLfXAzwtcHpuYpEgQg1OA4QAob1e81H8ntUQmQm3pBudqIoySO5j0tHN4ENzA6+n2r4w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ URL::asset('files/script.js') }}"></script>
</body>

</html>
