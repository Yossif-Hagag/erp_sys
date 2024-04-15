<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>الفهرس || العربي جروب</title>
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
                الفهرس
            </div>
            <div class="col"></div>
            <div class="col text-start">
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
            <div class="content col-10 p-0 overflow-y-scroll h-100 flex-column">

                <!-- Start buttons -->
                <div class="buttons position-relative row m-0 py-3">
                    <div class="col-6">
                        <div class="wrap w-100">
                            <form action="{{ route('catalogue.search') }}" method="get" id="catalogue-form"
                                class="search w-100 position-relative d-flex">
                                <button type="submit" class="searchButton text-center text-white">
                                    <i class="fa fa-search"></i>
                                </button>
                                <input type="text" id="catalogue_keyword"
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
                        <a href="{{ route('cataloguepdf') }}" class="btn btn-dark ms-2">
                            <i class="fa fa-download ms-2"></i>PDF
                        </a>
                        <a id="add_catalogue" href="{{ route('add_catalogue') }}" class="btn btn-dark"
                            data-bs-target="#staticBackdrop">
                            <i class="fa-solid fa-plus"></i>
                            إضافة منتج جديد
                        </a>
                    </div>
                </div>
                <!-- End Buttons -->
                <!-- Start Data -->
                <div class="table-data pe-1 h-auto">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>

                                <th scope="col">مسلسل</th>
                                <th scope="col">إسم المنتج</th>
                                <th scope="col">الكود</th>
                                <th scope="col">الموردين</th>
                                <th scope="col">تعديل</th>
                                <th scope="col">جرد</th>
                                {{-- <th scope="col">حذف</th> --}}
                            </tr>
                        </thead>
                        <tbody id="data-body">

                            @foreach ($catalogues as $catalogue)
                                <tr>

                                    <td> {{ $x++ }}</td>
                                    <td> {{ $catalogue->name }}</td>
                                    <td> {{ $catalogue->code }}</td>

                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#suppliers{{ $catalogue->code }}">
                                            <i class="fa-solid fa-search text-primary"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="suppliers{{ $catalogue->code }}" tabindex="-1"
                                            aria-labelledby="suppliersLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h5>
                                                            @if ($catalogue->suppliers)
                                                                {{ $catalogue->suppliers }}
                                                            @else
                                                                لا يوجد بيانات . . .
                                                            @endif
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <a type="button" id="edt_catalogue"
                                            href="{{ route('edt_catalogue', $catalogue->id) }}"
                                            class="btn btn-sm collection text-primary"><i
                                                class="fa-solid fa-edit"></i></a>
                                    </td>

                                    <td>
                                        <a href="{{ route('barren_code', ['code-barren' => $catalogue->code]) }}"
                                            class="btn btn-sm collection text-primary" target="_blank">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>
                                    </td>


                                </tr>
                                <!-- </div><br><br> -->
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="paginate px-4" style="direction: ltr;">{{ $catalogues->links() }}</div>
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
        $('#catalogue').addClass('active-page');
    </script>
</body>

</html>
