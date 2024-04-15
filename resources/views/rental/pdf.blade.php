
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>التأجير || العربي جروب</title>
    <link rel="shortcut icon" href="./assets/elarby group logo.jpg" type="image/x-icon" />

    <!-- Importing fontawesome library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- Importing Bootstrap library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css"
        integrity="sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
        p {
            direction: rtl;
            text-align: right;
            }
            </style>
    <!-- Importing 'Cairo' Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('files/renting.css')}}" />
</head>

<body>
    <!-- Start Body Home -->
    <div class="home overflow-hidden">
        <!-- Start Navbar -->
        <div class="navbar row m-0 text-white fs-5 px-2">
            <div class="col-3">
                <i class="fa-solid fa-bars ms-2 text-white"></i>
                التأجير
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
                <!-- Start buttons -->
                <div class="buttons position-relative row m-0 py-3">
                    <div class="col-4">
                        <div class="wrap w-75">
                            <form action="#" method="get" class="search w-100 position-relative d-flex">
                                <button type="submit" class="searchButton text-center text-white">
                                    <i class="fa fa-search"></i>
                                </button>
                                <input type="text" id = "rent-search" class="searchTerm w-100 border-end-0 text-center"
                                    placeholder="ما الذي تريد البحث عنه ؟!" />
                            </form>
                        </div>
                    </div>
                </div>
                <a href="{{route('rent.pdf')}}" class="btn btn-dark ms-2">
                    <i class="fa fa-download ms-2"></i>PDF
                </a>
                <!-- Start Data -->
                <div class="table-data mt-3 pt-3 pe-1 h-auto">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th scope="col">رقم</th>
                                <th scope="col">كود</th>
                                <th scope="col">اسم</th>
                                <th scope="col">الكمية</th>
                                <th scope="col">المستأجر</th>
                                <th scope="col">تليفون المستأجر</th>
                                <th scope="col">عنوان المستأجر</th>
                                <th scope="col">مدة الإيجار</th>
                                <th scope="col">سعر الإيجار</th>
                                <th scope="col">تاريخ الإيجار</th>
                                <th scope="col">اخر تحديث</th>
                                <th scope="col">المصدر</th>

                                <th scope="col">إرجاع</th>
                                <th scope="col">إرسال للمخزن</th>
                                <th scope="col">تعديل</th>
                            </tr>
                        </thead>
                        <tbody id="data-body">
                            @foreach ($allData as $p)
                            <tr>
                                <td>{{ $p->id }}</td>
                                <td>{{ $p->pro_num }}</td>
                                <td>{{ $p->pro_name }}</td>
                                <td>{{ $p->number_of_product }}</td>
                                <td>{{ $p->Tenant_name }}</td>
                                <td>{{ $p->Tenant_phone }}</td>
                                <td>{{ $p->Tenant_address }}</td>
                                <td>{{ $p->rent_period }}</td>
                                <td>{{ $p->rent_price }}</td>
                                <td>{{ $p->created_at }}</td>
                                <td>{{ $p->updated_at }}</td>
                                <td>
                                    @if ($p->store_name ==='stock')
                                    المخزن
                                    @elseif ($p->store_name ==='purchas')
                                    المشتريات
                                    @endif
                                </td>
                                <td>
                                    @if ($p->store_name === 'stock')
                                        <button type="button" class="btn lh-1 p-1 btn btn-sm btn-dark back-to-stock" id="back" data-id="{{ $p->id }}">للمخزن</button>
                                    @elseif ($p->store_name === 'purchas')
                                        <button type="button" class="btn lh-1 p-1 btn btn-sm btn-dark back-to-purchas" data-id="{{ $p->id }}">للمشتريات</button>
                                    @endif
                                </td>
                                <td>
                                    @if ($p->store_name ==='stock')
                                    <button type="button" class="btn lh-1 p-1 btn btn-sm btn-dark" data-bs-toggle="modal"
                                    data-bs-target="#modal11{{ $p->id }}" >ارسال</button>
                                    @elseif ($p->store_name ==='purchas')
                                    -
                                    @endif
                                </td>
                                <td>
                                    <button type="button" id="edt_rental" link="{{ route('edt_rental', $p->id) }}"
                                        class="btn lh-1 p-1 btn btn-sm btn-dark">تعديل</button>
                                </td>
                                <div class="modal fade" id="modal11{{ $p->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="bg-danger d-flex justify-content-center text-white">Pro ID ::
                                                {{ $p->id }}</div>
                                            <div class="modal-header">
                                                <h5 class="modal-title">ارسال المنتج الى المخزن</h5>
                                                <button type="button" class="m-0 btn-close fw-bold"
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div id="send_to_rent">
                                                    <form class="row g-3" method="post"
                                                        action="{{ route('send-to-stock', $p->id) }}">
                                                        @csrf
                                                        <div class="row g-3">
                                                            <div class="col">
                                                                <input type="number" name="number_of_product"
                                                                    class="form-control mt-3 mb-3"
                                                                    placeholder="عدد المنتج" aria-label="" required>
                                                            </div>
                                                        </div>
                                                        <div class="row g-3">
                                                            <div class="col">
                                                                <input type="number" name="price"
                                                                    class="form-control mb-3" placeholder="سعر المنتج  "
                                                                    aria-label="" required>
                                                            </div>
                                                          
                                                        </div>

                                                        <div class="row g-3">
                                                            <div class="col">
                                                                <input type="text" name="supplier_name"
                                                                    class="form-control mb-3" placeholder="اسم المورد"
                                                                    aria-label="" required>
                                                            </div>

                                                            <div class="col">
                                                                <input type="number" name="supplier_phone"
                                                                    class="form-control mb-3" placeholder="رقم المورد"
                                                                    aria-label="" required>
                                                            </div>
                                                        </div>

                                                        <div class="row g-3">
                                                            <div class="col">
                                                                <input type="text" name="supplier_address"
                                                                    class="form-control mb-3"
                                                                    placeholder="عنوان المورد" aria-label="" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-outline-primary"
                                                                name="button_add_submit">ارسال المنتج
                                                                الى المخزن</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
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
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('files/renting.js') }}"></script>
    <script>
        $('a').each(function() {$(this).removeClass('active-page')});
        $('#rental').addClass('active-page');
    </script>
</body>

</html>