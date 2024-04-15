<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>إدارة تشغيل سكراب || العربي جروب</title>
    <link rel="shortcut icon" href="./assets/logo.jpg" type="image/x-icon" />

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
    <link rel="stylesheet" href="{{asset('files/operatingStock.css')}}"/>
</head>

<body>
    <!-- Start Body Home -->
    <div class="home overflow-hidden">
        <!-- Start Navbar -->
        <div class="navbar row m-0 text-white fs-5 px-2">
            <div class="col-3">
                <i class="fa-solid fa-bars ms-2 text-white"></i>
                إدارة تشغيل سكراب
            </div>
            <div class="col"></div>
            <div class="col text-start">
                <!-- Start Messages Section -->

                <!-- End Messages Section -->

                <!-- Start Emails Part -->

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

        <div class="content-body row m-0 overflow-y-scroll">
            <!-- Start Sidebar -->
            {{ view('sidebar') }}
            <!-- End Sidebar -->

            <!-- Start Content -->
            <div class="content col-10 py-1 overflow-hidden">

                <!-- Start buttons -->
                <div class="buttons position-relative row m-0 py-3">
                    <div class="col-6">
                        <div class="wrap w-100">
                            <form action="{{ route('operation_scrap.search') }}" method="get"
                                id="operation_scrap-form" class="search w-100 position-relative d-flex">
                                <button type="submit" class="searchButton text-center text-white">
                                    <i class="fa fa-search"></i>
                                </button>
                                <input type="text" id="operation_scrap_keyword"
                                    class="searchTerm w-50 border-end-0 text-center"
                                    placeholder="ابحث بالعميل أو النوع . . ." />
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
                    <div class="col-6 text-start">
                        <a href="{{route('operatingScrapepdfd')}}" class="btn btn-dark">
                            <i class="fa fa-download ms-2"></i>PDF
                        </a>
                        <a href="{{ route('add_operation_scrap') }}" class="btn btn-dark">
                            <i class="fa-solid fa-plus ms-1"></i>
                            إضافة عملية جديد
                        </a>
                        <!-- Start Total Tag -->
                        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#total">
                            <i class="fa-solid fa-money-bill"></i> الإجمالي
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="total" tabindex="-1" aria-labelledby="totalLabel"
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
                                    <div class="modal-body fs-3 d-block text-center" id="total-sell-price"> البيع:
                                        <span>{{ $totalSellPrice }}</span>
                                    </div>
                                    <div class="modal-body fs-3 d-block text-center" id="total-buy-price">الشراء:
                                        <span>{{ $totalbuyPrice }}</span>
                                    </div>
                                    <hr class="w-75 mx-auto">
                                    <div class="modal-body fs-4 d-block text-center" id="profit">
                                        @if ($totalSellPrice > $totalbuyPrice)
                                            <p class="bg-success text-white w-50 mx-auto p-2">الربح:
                                                {{ $profit }}</p>
                                        @elseif($totalSellPrice < $totalbuyPrice)
                                            <p class="bg-danger text-white w-50 mx-auto p-2">الخسارة:
                                                {{ $loss }}</p>
                                        @else
                                            <p>لا يوجد ربح أو خسارة</p>
                                        @endif
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                            إنهاء
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Total Tag -->
                        <a href="{{ route('scrap') }}" class="btn btn-dark">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        </a>
                    </div>
                </div>

                <!-- Start Data -->
                <div class="table-data pe-1 h-auto">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                {{-- <th scope="col">رقم</th> --}}
                                <th scope="col">نوع العملية</th>
                                <th scope="col">مستند العملية</th>
                                <th scope="col">العميل</th>
                                <th scope="col">العنوان</th>
                                <th scope="col">تاريخ العملية</th>
                                <th scope="col">التكلفة</th>
                                <th scope="col">تعديل</th>
                            </tr>
                        </thead>
                        <tbody id="data-body">
                            @foreach ($OperationgScrape as $op_scrap)
                                <tr>
                                    <td>{{ $op_scrap->operation_type }}</td>
                                    <td>
                                        <a class="btn btn-sm collection text-primary"
                                            href="{{ asset('storage/' . $op_scrap->operation_document) }}"
                                            target="_blank" type="button"><i class="fa-solid fa-search"></i></a>
                                    </td>
                                    <td>{{ $op_scrap->client_name }}</td>
                                    <td>{{ $op_scrap->address }}</td>
                                    <td>{{ $op_scrap->created_at }}</td>
                                    <td>{{ $op_scrap->cost }}</td>
                                    <td>
                                        <a type="button" id="edt_operation_purchas"
                                            href="{{ route('edt_operation_scrap', $op_scrap->id) }}"
                                            class="lh-1 p-2 btn btn-sm btn-dark"><i
                                            class="fa-solid fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="paginate px-4" style="direction: ltr;">{{ $OperationgScrape->links() }}</div>
                </div>
                <!-- End Data -->
            </div>
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
            $(this).removeClass('active-page');
        });
        $('#scrap').addClass('active-page');
        $('.sidebar').addClass('h-auto');
    </script>
</body>

</html>
