<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>المخزن || العربي جروب</title>
    <link rel="shortcut icon" href="./assets/elarby group logo.jpg" type="image/x-icon" />

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
    <link rel="stylesheet" href="{{ asset('files/stocks.css') }}" />
</head>

<body>
    <!-- Start Body Home -->
    <div class="home overflow-hidden">
        <!-- Start Navbar -->
        <div class="navbar row m-0 text-white fs-5 px-2">
            <div class="col-3">
                <i class="fa-solid fa-bars ms-2 text-white"></i>
                المخزن
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
                <form method="POST" action="{{ route('logout') }}" class="d-inline-block">
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
            <div class="content col-10 flex-column align-items-center d-flex  justify-content-between p-0 overflow-y-scroll h-100 flex-column">
                <div class="alerting"></div>
                <!-- Start buttons -->
                <div class="buttons position-relative row m-0 py-3">
                    <div class="col-4">
                        <div class="wrap w-75">
                            <form action="#" method="get" class="search w-100 position-relative d-flex">
                                <button type="submit" class="searchButton text-center text-white">
                                    <i class="fa fa-search"></i>
                                </button>
                                <input type="text" class="searchTerm w-100 border-end-0 text-center"
                                    placeholder="ما الذي تريد البحث عنه ؟!" />
                            </form>
                        </div>
                    </div>
                    <!-- Start Popup Form -->
                    <!-- Button trigger modal -->
                </div>

                <!-- End Buttons -->
                <!-- Start Data -->
                <div class="table-data pe-1 h-auto">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th scope="col">مسلسل</th>
                                <th scope="col">كود</th>
                                <th scope="col">اسم</th>
                                <th scope="col">الكمية</th>
                                {{-- <th scope="col">صورة المنتج</th> --}}
                                <th scope="col">سعر التوريد</th>
                                <th scope="col">سعر البيع</th>
                                <th scope="col">اسم المشتري</th>
                                <th scope="col">تليفون المشتري</th>
                                <th scope="col">عنوان المشتري</th>
                                <th scope="col">تاريخ الاضافة</th>
                                <!-- <th scope="col">اخر تحديث </th> -->
                                {{-- <th scope="col">تعديل</th> --}}
                                {{-- <th scope="col">حذف</th> --}}
                            </tr>
                        </thead>
                        <tbody id="data-body">
                            @foreach ($sales as $s)
                            <!-- <div class="col-md-12 purchas_tabel"> -->
                            <tr>
                                <td>{{$x++}}</td>
                                <td> {{ $s->pro_num }}</td>
                                <td> {{ $s->pro_name }} </td>
                                <td> {{ $s->number_of_product }} </td>
                                <td> {{ $s->supply_price }} </td>
                                <td> {{ $s->sell_price }} </td>
                                <td> {{ $s->seller }} </td>
                                <td> {{ $s->seller_phone }} </td>
                                <td> {{ $s->seller_address }} </td>
                                <td>{{ $s->created_at }}</td>
                                <!-- <td>{{ $s->updated_at }}</td> -->
                                <!-- </tr> -->
                            </tr>
                            <!-- </div><br><br> -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
             </div>
            <!-- End Data -->
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
    <script>
        $('a').each(function() {$(this).removeClass('active-page')});
        $('#sales').addClass('active-page');
    </script>
</body>

</html>