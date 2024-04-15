<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>سكراب || العربي جروب</title>
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
                سكراب
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
            <div class="content col-10 p-0 overflow-y-scroll h-100">

                @if (session()->has('error'))
                    <div class="alert alert-dismissible alert-danger align-items-center h3em d-flex fade justify-content-between m-2 show"
                        role="alert">
                        <svg class="bi flex-shrink-0 me-2 w-7 h-7" role="img" aria-label="Danger:">
                            <use xlink:href="#check-circle-fill" />
                        </svg>
                        <div>{{ session()->get('error') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session()->has('done'))
                    <div class="alert alert-dismissible alert-success align-items-center h3em d-flex fade justify-content-between m-2 show"
                        role="alert">
                        <svg class="bi flex-shrink-0 me-2 w-7 h-7" role="img" aria-label="Success:">
                            <use xlink:href="#check-circle-fill" />
                        </svg>
                        <div>{{ session()->get('done') }}</div>
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

                <!-- Start buttons -->
                <div class="buttons position-relative row m-0 py-3">
                    <div class="col-6">
                        <div class="wrap w-100">
                            <form action="{{ route('scrap.search') }}" method="get" id="scrap-form"
                                class="search w-100 position-relative d-flex">
                                <button type="submit" class="searchButton text-center text-white">
                                    <i class="fa fa-search"></i>
                                </button>
                                <input type="text" id="scrap_keyword"
                                    class="searchTerm w-50 border-end-0 text-center"
                                    placeholder="ابحث بالكود او الاسم . . ." />
                                <div class="filter-date d-flex">
                                    <input type="date" id="from_date" name="from_date"
                                        class="btn date-input date-input-from" />
                                    <input type="date" id="to_date" name="to_date"
                                        class="btn date-input date-input-to" />
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Start Popup Form -->
                    <!-- Button trigger modal -->
                    <div class="col-6 text-start">
                        <a href="{{ route('scrappdf') }}" class="btn btn-dark ms-2">
                            <i class="fa fa-download ms-2"></i>PDF
                        </a>




                        <a type="button" class="btn btn-dark ms-2" data-bs-toggle="modal" data-bs-target="#totalscrap">
                            <i class="fa-solid fa-money-bill"></i> الإجمالي
                        </a>

                        <!-- Modal -->
                        <div class="modal fade" id="totalscrap" tabindex="-1" aria-labelledby="totalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="totalLabel">
                                            الإجمالي <i class="fa-solid fa-money-bill"></i>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close" style="margin-right: 20.5rem"></button>
                                    </div>
                                    <div class="modal-body fs-3 d-block text-center" id="total-window-body">الشراء:
                                        <span>{{ $total_scrap }}</span>
                                    </div>
                                    <div class="modal-body fs-3 d-block text-center" id="total-number-scrap">عدد المنتجات :
                                        <span>{{ $total_scrap_number }}</span>
  
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                            إنهاء
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>





                        <a id="add_scrap" href="{{ route('add_scrap') }}" class="btn btn-dark"
                            data-bs-target="#staticBackdrop">
                            <i class="fa-solid fa-plus"></i>
                            إضافة منتج جديد
                        </a>
                        <a href="{{ route('operation_scrap') }}" class="btn btn-dark">إدارة التشغيل <i
                            class="fa-solid fa-gears me-1"></i></a>
                    </div>
                </div>
                <!-- End Buttons -->
                <!-- Start Data -->
                <div class="table-data pe-1 h-auto">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>

                                <th scope="col">رقم</th>
                                <th scope="col">كود</th>
                                <th scope="col">اسم</th>
                                <th scope="col">الكمية</th>
                                <th scope="col">سعر التوريد</th>
                                <th scope="col">اسم المورد</th>
                                <th scope="col">تليفون المورد</th>
                                <th scope="col">عنوان المورد</th>
                                <th scope="col">تاريخ الاضافة</th>
                                <th scope="col">إشعار سداد</th>
                                {{-- <th scope="col">اخر تحديث </th> --}}
                                <th scope="col">بيع</th>
                                <th scope="col">تعديل</th>
                            </tr>
                        </thead>
                        <tbody id="data-body">
                            @foreach ($suppliers as $supplier)
                                @foreach ($supplier->scraps as $scrap)
                                    <!-- <div class="col-md-12 purchas_tabel"> -->
                                    <tr>
                                        <td> {{ $x++ }}</td>
                                        <td> {{ $scrap->pro_num }}</td>
                                        <td> {{ $scrap->pro_name }}</td>
                                        <td> {{ $scrap->quantity }} </td>
                                        <td> {{ $scrap->price }} </td>
                                        <td> {{ $supplier->name }} </td>
                                        <td> {{ $supplier->phone }} </td>
                                        <td> {{ $supplier->address }} </td>
                                        <td>{{ $scrap->created_at }}</td>
                                        @if ($scrap->pay == 0)
                                            <td>
                                                <button type="button" id=""
                                                    class="btn btn-sm btn-success py-0 px-1" data-bs-toggle="modal"
                                                    data-bs-target="#{{ $scrap->id }}colmodal">سداد</button>

                                                <div class="modal fade" id="{{ $scrap->id }}colmodal"
                                                    tabindex="-1" aria-labelledby="colmodalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div
                                                                class="modal-body d-flex justify-content-between lead">
                                                                <p>هل أنت متأكد من التحصيل</p>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form
                                                                    action="{{ route('collect_scrap', $scrap->id) }}"method="POST">
                                                                    @csrf
                                                                    <button type="submit" id="collect_scrap"
                                                                        class="lh-1 p-2 btn btn-sm btn-primary">نعم
                                                                        متأكد</button>
                                                                </form>
                                                                <button type="button"
                                                                    class="btn btn-danger lh-1 p-2 btn btn-sm"
                                                                    data-bs-dismiss="modal">إلغاء</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        @elseif($scrap->pay == 1)
                                            <td><i class='fa-solid fa-check' style='color: #00803e;'></i></td>
                                        @endif
                                        {{-- <td>{{ $scrap->updated_at }}</td> --}}
                                        <td>
                                            <button type="button" class="btn btn-sm collection text-success btnsell"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalsell{{ $scrap->id }}"><i
                                                    class="fa-solid fa-dollar"></i></button>
                                        </td>
                                        <td>
                                            <a type="button" id="edt_scrap"
                                                href="{{ route('edt_scrap', [$supplier->id, $scrap->id]) }}"
                                                class="btn btn-sm collection text-primary"><i
                                                    class="fa-solid fa-edit"></i></a>
                                        </td>
                                        <!-- </tr> -->
                                        <!-- modalsell -->
                                        <div class="modal fade" id="modalsell{{ $scrap->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="alerting_modal"></div>
                                                    {{-- <div class="bg-danger d-flex justify-content-center text-white">Pro ID ::
                                                {{ $scrap->id }}</div> --}}

                                                    <div class="modal-header">
                                                        <h5 class="modal-title">بيع المنتج</h5>
                                                        <button type="button" class="m-0 btn-close fw-bold"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div id="addsales">
                                                            <form class="row g-3" method="post"
                                                                action="{{ route('send_scrap_sales', [$supplier->id, $scrap->id]) }}">
                                                                @csrf
                                                                <div class="row g-3">
                                                                    <div class="col">
                                                                        <input type="number" name="number_of_product"
                                                                            class="form-control mt-3 mb-3 sellamount"
                                                                            placeholder="عدد المنتج" aria-label=""
                                                                            required>
                                                                    </div>
                                                                </div>
                                                                <div class="row g-3">
                                                                    <div class="col">
                                                                        <input type="number" name="sell_price"
                                                                            class="form-control mb-3"
                                                                            placeholder="سعر البيع" aria-label=""
                                                                            required>
                                                                    </div>
                                                                </div>

                                                                <div class="row g-3">
                                                                    <div class="col">
                                                                        <input type="text" name="buyer_name"
                                                                            class="form-control mb-3"
                                                                            placeholder="اسم المشتري" aria-label=""
                                                                            required>
                                                                    </div>

                                                                    <div class="col">
                                                                        <input type="number" name="seller_phone"
                                                                            class="form-control mb-3"
                                                                            placeholder="رقم المشتري" aria-label=""
                                                                            required>
                                                                    </div>
                                                                </div>

                                                                <div class="row g-3">
                                                                    <div class="col">
                                                                        <input type="text" name="buyer_address"
                                                                            class="form-control mb-3"
                                                                            placeholder="عنوان المشتري" aria-label=""
                                                                            required>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="modal-footer d-flex justify-content-between">
                                                                    <div class="form-check">
                                                                        <input type="checkbox" name="all"
                                                                            class="form-check-input checkboxsell"
                                                                            id="checkboxsell{{ $scrap->quantity }}"
                                                                            value="{{ $scrap->quantity }}"
                                                                            aria-label="">
                                                                        <label
                                                                            for="checkboxsell{{ $scrap->quantity }}"
                                                                            class="form-check-label">الكل</label>
                                                                    </div>

                                                                    <div>
                                                                        <button type="submit" class="btn btn-primary"
                                                                            name="button_add_submit">بيع</button>
                                                                        <button type="button" class="btn btn-danger"
                                                                            data-bs-dismiss="modal">إغلاق</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end modalsell -->
                                    </tr>
                                    <!-- </div><br><br> -->
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="paginate px-4" style="direction: ltr;">{{ $suppliers->links() }}</div>
            </div>
            <!-- End Data -->
            <!-- End Content -->
        </div>
    </div>
    <!-- End Body Home -->

    <!-- Importing Scripts -->
    <script src="{{ asset('js/jq/jq.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"
        integrity="sha512-3dZ9wIrMMij8rOH7X3kLfXAzwtcHpuYpEgQg1OA4QAob1e81H8ntUQmQm3pBudqIoySO5j0tHN4ENzA6+n2r4w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('files/script.js') }}"></script>

    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $('a').each(function() {
            $(this).removeClass('active-page')
        });
        $('#scrap').addClass('active-page');
    </script>
    <script>
        $('.btnsell').on('click', function() {
            $('.sellamount').val("");
            $('.checkboxsell').prop('checked', false);
        });
        $('.checkboxsell').on('click', function() {
            if ($(this).is(':checked')) {
                $('.sellamount').val($(this).val());
            } else {
                $('.sellamount').val("");
            }
        });
    </script>
</body>

</html>
