<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>الجرد || العربي جروب</title>
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
    {{-- <link rel="stylesheet" href="{{ asset('files/barren.css') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('files/stocks.css') }}" />



</head>

<body>
    <!-- Start Body Home -->
    <div class="home overflow-hidden">
        <!-- Start Navbar -->
        <div class="navbar row m-0 text-white fs-5 px-2">
            <div class="col-3">
                <i class="fa-solid fa-bars ms-2 text-white"></i>
                الجرد
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
            <div class="content col-10 d-flex p-0 overflow-y-scroll h-100 flex-column">

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
                            <form action="{{ route('barren_code') }}" method="get" id="barren-form"
                                class="search w-100 position-relative d-flex">
                                <button type="submit" class="searchButton text-center text-white">
                                    <i class="fa fa-search"></i>
                                </button>
        
                                <input type="number" id="code-barren" name="code-barren"
                                    class="searchTerm w-50 border-end-0 text-center"
                                    placeholder="ابحث بالكود. . ."  value="{{ $code ?? '' }}" required  />

                                <div class="filter-date d-flex">
                                    <input type="date" id="from_date" name="from_date"
                                        class="btn date-input date-input-from" 
                                        value="{{ $from_date ?? '' }}" />
                                    <input type="date" id="to_date" name="to_date"
                                        class="btn date-input date-input-to"
                                        value="{{ $to_date ?? '' }}" />
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Start Popup Form -->
                    <!-- Button trigger modal -->
                    <div class="col-6 text-start">
                        <a href="{{ route('barrenpdf', ['code' => $code, 'from_date' => $from_date,  'to_date' => $to_date]) }}" class="btn btn-dark ms-2">
                            <i class="fa fa-download ms-2"></i>PDF
                        </a>
                    </div>
                </div>
                <!-- End Buttons -->
                <!-- Start Data -->
                <br>
                <div class="row">
                    <div class="col-md-6">
                        {!! $sellChart->container() !!}
                    </div>
                    <div class="col-md-6">
                        {!! $sellPieChart->container() !!}

                    </div>
                </div>

                <br><br>
                <hr class="w-75 mx-auto">
                <!-- start sell section -->
                <div class="d-flex justify-content-around align-items-center fs-4 fa font-monospace mb-2 pb-2">
                    <div class="text-bg-dark w-25 p-2 pb-3 rounded-bottom-4 fs-2 text-center sec-header">البيع <i
                            class="fa-solid fa-money-bills mt-2 me-2"></i></div>
                </div>
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
                                <th scope="col">ربح العملية</th>
                            </tr>
                            <!-- <div class="d-flex justify-content-around align-items-center">
                                <div class="">لا يوجد عمليات بيع لهذا المنتج . . .</div>
                            </div> -->
                        </thead>
                        <tbody id="data-body">
                            @foreach ($sales as $s)
                                <!-- <div class="col-md-12 purchas_tabel"> -->
                                <tr>
                                    <td>{{ $x++ }}</td>
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
                                    @if ($s->sell_price > $s->supply_price)
                                        <td class="text-bg-success">
                                            {{ $s->number_of_product * ($s->sell_price - $s->supply_price) }}</td>
                                    @elseif($s->sell_price < $s->supply_price)
                                        <td class="text-bg-danger">
                                            {{ $s->number_of_product * ($s->sell_price - $s->supply_price) }}</td>
                                    @endif
                                </tr>
                                <!-- </div><br><br> -->
                            @endforeach
                        </tbody>
                    </table>
                    <div class="paginate px-4" style="direction: ltr;">{{ $sales->links() }}</div>
                </div>
                <div class="d-flex align-items-center fw-bold justify-content-center">
                    <div class="d-flex justify-content-around">
                        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#totalsell">
                            <i class="fa-solid fa-money-bill"></i> الإجمالي
                        </button> 
                    </div>
    
                    <!-- Modal -->
                    <div class="modal fade" id="totalsell" tabindex="-1" aria-labelledby="totalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="totalLabel">
                                        الإجمالي <i class="fa-solid fa-money-bill"></i>
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                        style="margin-right: 20.5rem"></button>
                                </div>
                                <div class="modal-body fs-3 d-block text-center" id="total-window-body"> البيع:
                                    <span>{{ $total_sell }}</span>
                                </div>
                                <div class="modal-body fs-3 d-block text-center" id="total-window-body">الشراء:
                                    <span>{{ $total_supply }}</span>
                                </div>
                                <hr class="w-75 mx-auto">
                                <div class="modal-body fs-4 d-block text-center">
                                    @if ($total_sell > $total_supply)
                                        <p class="bg-success text-white w-50 mx-auto p-2">الربح: {{ $sum_sell_profit }}
                                        </p>
                                    @elseif($total_sell < $total_supply)
                                        <p class="bg-danger text-white w-50 mx-auto p-2">الخسارة: {{ $sum_sell_profit }}
                                        </p>
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
    
                </div>
                <br><br><br>
                <hr class="w-75 mx-auto">
                <!-- end sell section -->


                <div class="row">
                    <div class="col-md-6">
                        {!! $rentChart->container() !!}
                    </div>
                    <div class="col-md-6">
                        {!! $rentPieChart->container() !!}

                    </div>
                </div>


                <br><br>



                <hr class="w-75 mx-auto">
                <!-- start rental section -->
                <div class="d-flex justify-content-around align-items-center fs-4 fa font-monospace mb-2 pb-2">
                    <div class="text-bg-dark w-25 p-2 pb-3 rounded-bottom-4 fs-2 text-center sec-header">الإيجار <i
                            class="fa-solid fa-truck mt-2 me-2"></i></div>
                </div>
                <div class="table-data pe-1 h-auto">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th scope="col">رقم</th>
                                <th scope="col">كود</th>
                                <th scope="col">اسم</th>
                                <th scope="col">عدد المنتج</th>
                                <th scope="col">سعر التوريد</th>
                                <th scope="col">المستأجر</th>
                                <th scope="col">تليفون المستأجر</th>
                                <th scope="col">عنوان المستأجر</th>
                                <th scope="col">فترة الإيجار باليوم</th>
                                <th scope="col">سعر الإيجار</th>
                                <th scope="col">تاريخ الإيجار</th>
                                <!-- <th scope="col">اخر تحديث</th> -->
                                <th scope="col">المصدر</th>
                                <th scope="col">ربح العملية</th>
                            </tr>
                        </thead>
                        <tbody id="data-body">
                            @foreach ($rentals as $p)
                                <tr>
                                    <td>{{ $x++ }}</td>
                                    <td>{{ $p->pro_num }}</td>
                                    <td>{{ $p->pro_name }}</td>
                                    <td>{{ $p->number_of_product }}</td>
                                    <td>
                                        @if ($p->store_name === 'stock')
                                            {{ $p->pro_sup_price }}
                                        @elseif ($p->store_name === 'purchas')
                                            {{ $p->purchas_sup_price }}
                                        @endif
                                    </td>
                                    <td>{{ $p->Tenant_name }}</td>
                                    <td>{{ $p->Tenant_phone }}</td>
                                    <td>{{ $p->Tenant_address }}</td>
                                    <td>{{ $p->rent_period }}</td>
                                    <td>{{ $p->rent_price }}</td>
                                    <td>{{ $p->created_at }}</td>
                                    <td>
                                        @if ($p->store_name === 'stock')
                                            المخزن
                                        @elseif ($p->store_name === 'purchas')
                                            المشتريات
                                        @endif
                                    </td>
                                    <td class="text-bg-success align-middle">
                                        {{ $p->number_of_product * $p->rent_price  * $p->rent_period}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="paginate px-4" style="direction: ltr;">{{ $rentals->links() }}</div>
                </div>
                <div class="d-flex align-items-center fw-bold justify-content-center">
                    <div class="d-flex justify-content-around">
                        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#totalrent">
                            <i class="fa-solid fa-money-bill"></i> الإجمالي
                        </button> 
                    </div>
    
                    <!-- Modal -->
                    <div class="modal fade" id="totalrent" tabindex="-1" aria-labelledby="totalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="totalLabel">
                                        الإجمالي <i class="fa-solid fa-money-bill"></i>
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                        style="margin-right: 20.5rem"></button>
                                </div>
                                <div class="modal-body fs-3 d-block text-center" id="total-window-body"> الإيجار:
                                    <span>{{ $sum_rent_price }}</span>
                                </div>
                                <div class="modal-body fs-3 d-block text-center" id="total-window-body">الشراء:
                                    <span>{{ $total_supply_rent }}</span>
                                </div>
                                <hr class="w-75 mx-auto">
                                <div class="modal-body fs-4 d-block text-center">
                                    @if ($sum_rent_price > $total_supply_rent)
                                        <p class="bg-success text-white w-50 mx-auto p-2">الربح: {{ $sum_rent_price }}
                                        </p>
                                    @elseif($sum_rent_price < $total_supply_rent)
                                        <p class="bg-danger text-white w-50 mx-auto p-2">الخسارة: {{ $sum_rent_price }}
                                        </p>
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
    
                </div>
                <!-- end rental section -->
                <br><br><br>
                

                <hr class="w-75 mx-auto">
                <!-- start product section -->
                <div class="d-flex justify-content-around align-items-center fs-4 fa font-monospace mb-2 pb-2">
                    <div class="text-bg-dark p-2 pb-3 rounded-bottom-4 fs-3">المخزن</div>
                </div>
                <div class="table-data pe-1 h-auto">
                    <table class="table table-striped text-center" style="width: 100%">
                        <thead>
                            <tr>
                                <th scope="col">رقم</th>
                                <th scope="col">كود</th>
                                <th scope="col">اسم</th>
                                <th scope="col">الكمية</th>
                                {{-- <th scope="col">صورة المنتج</th> --}}
                                <th scope="col">سعر التوريد</th>
                                <th scope="col">اسم المورد</th>
                                <th scope="col">تليفون المورد</th>
                                <th scope="col">عنوان المورد</th>
                                <!-- <th scope="col">تاريخ الاضافة</th> -->
                                <th scope="col">اخر تحديث </th>
                            </tr>
                        </thead>
                        <tbody id="data-body">
                            @foreach ($suppliers as $supplier)
                                @foreach ($supplier->products as $product)
                                    <!-- <div class="col-md-12 purchas_tabel"> -->
                                    @if ($product->pro_num == $code)
                                        <tr>
                                            <td> {{ $x++ }}</td>
                                            <td> {{ $product->pro_num }}</td>
                                            <td> {{ $product->pro_name }}</td>
                                            <td> {{ $product->number_of_product }} </td>
                                            <td> {{ $product->price }} </td>
                                            <td> {{ $supplier->name }} </td>
                                            <td> {{ $supplier->phone }} </td>
                                            <td> {{ $supplier->address }} </td>
                                            <!-- <td>{{ $product->created_at }}</td> -->
                                            <td>{{ $product->updated_at }}</td>
                                        </tr>
                                    @endif
                                    <!-- </div><br><br> -->
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                    <div class="paginate px-4" style="direction: ltr;">{{ $suppliers->links() }}</div>
                </div>
                <!-- end product section -->


                <div class="d-flex align-items-center fw-bold justify-content-center">
                    <div class="d-flex justify-content-around">
                        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#totalstock">
                            <i class="fa-solid fa-money-bill"></i> الإجمالي
                        </button> 
                    </div>
    
                    <!-- Modal -->
                    <div class="modal fade" id="totalstock" tabindex="-1" aria-labelledby="totalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="totalLabel">
                                        الإجمالي <i class="fa-solid fa-money-bill"></i>
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                        style="margin-right: 20.5rem"></button>
                                </div>
                                <div class="modal-body fs-3 d-block text-center" id="total-window-body">الشراء:
                                    <span>{{ $total_stock }}</span>
                                </div>
    
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                        إنهاء
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
    
                </div>


                <br><br><br>


                {{-- <hr class="w-75 mx-auto"> --}}
                <!-- start purchas section -->
                {{-- <div class="d-flex justify-content-around align-items-center fs-4 fa font-monospace mb-2 pb-2">
                    <div class="text-bg-dark p-2 pb-3 rounded-bottom-4 fs-3">المشتريات</div>
                </div>
                <div class="table-data pe-1 h-auto">
                    <table class="table table-striped text-center" id="" style="width: 100%">
                        <thead>
                            <tr>
                                <th scope="col">رقم</th>
                                <th scope="col">كود</th>
                                <!-- <th scope="col">صورة المنتج</th> -->
                                <th scope="col">اسم</th>
                                <th scope="col">عدد المنتج</th>
                                <th scope="col">السعر</th>
                                <th scope="col">اسم المورد</th>
                                <th scope="col">تليفون المورد</th>
                                <th scope="col">عنوان المورد</th>
                                <!-- <th scope="col">تاريخ الاضافة</th> -->
                                <th scope="col">اخر تحديث </th>
                            </tr>
                        </thead>
                        <tbody id="data-body">
                            @foreach ($items as $item)
                                @foreach ($item->purchas as $purchas)
                                    @if ($purchas->pro_num == $code)
                                        <tr>
                                            <td>{{ $x++ }}</td>
                                            <td>{{ $purchas->pro_num }}</td>
                                            <td>{{ $purchas->pro_name }}</td>
                                            <td>{{ $purchas->number_of_product }}</td>
                                            <td>{{ $purchas->price }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>{{ $item->address }}</td>
                                            <!-- <td>{{ $purchas->created_at }}</td> -->
                                            <td>{{ $purchas->updated_at }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                    <div class="paginate px-4" style="direction: ltr;">{{ $items->links() }}</div>
                </div> --}}
                <!-- end purchas section -->


                {{-- <div class="d-flex align-items-center fw-bold justify-content-center">
                    <div class="d-flex justify-content-around">
                        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#totalpurchas">
                            <i class="fa-solid fa-money-bill"></i> الإجمالي
                        </button> 
                    </div>
    
                    <!-- Modal -->
                    <div class="modal fade" id="totalpurchas" tabindex="-1" aria-labelledby="totalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="totalLabel">
                                        الإجمالي <i class="fa-solid fa-money-bill"></i>
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                        style="margin-right: 20.5rem"></button>
                                </div>
                                <div class="modal-body fs-3 d-block text-center" id="total-window-body">الشراء:
                                    <span>{{ $total_purchas }}</span>
                                </div>
    
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                        إنهاء
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
    
                </div>



                <br><br><br> --}}


                <hr class="w-75 mx-auto">
                <!-- start scrap section -->
                <div class="d-flex justify-content-around align-items-center fs-4 fa font-monospace mb-2 pb-2">
                    <div class="text-bg-dark p-2 pb-3 rounded-bottom-4 fs-3">سكراب</div>
                </div>
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
                                <!-- <th scope="col">تاريخ الاضافة</th> -->
                                <th scope="col">اخر تحديث </th>
                            </tr>
                        </thead>
                        <tbody id="data-body">
                            @foreach ($suppliers_scraps as $supplier)
                                @foreach ($supplier->scraps as $scrap)
                                    <!-- <div class="col-md-12 purchas_tabel"> -->
                                    @if ($scrap->pro_num == $code)
                                        <tr>
                                            <td> {{ $x++ }}</td>
                                            <td> {{ $scrap->pro_num }}</td>
                                            <td> {{ $scrap->pro_name }}</td>
                                            <td> {{ $scrap->quantity }} </td>
                                            <td> {{ $scrap->price }} </td>
                                            <td> {{ $supplier->name }} </td>
                                            <td> {{ $supplier->phone }} </td>
                                            <td> {{ $supplier->address }} </td>
                                            <!-- <td>{{ $scrap->created_at }}</td> -->
                                            <td>{{ $scrap->updated_at }}</td>
                                        </tr>
                                        <!-- </div><br><br> -->
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                    <div class="paginate px-4" style="direction: ltr;">{{ $suppliers_scraps->links() }}</div>
                </div>
                <!-- end scrap section -->


                <div class="d-flex align-items-center fw-bold justify-content-center">
                    <div class="d-flex justify-content-around">
                        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#totalscrap">
                            <i class="fa-solid fa-money-bill"></i> الإجمالي
                        </button> 
                    </div>
    
                    <!-- Modal -->
                    <div class="modal fade" id="totalscrap" tabindex="-1" aria-labelledby="totalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="totalLabel">
                                        الإجمالي <i class="fa-solid fa-money-bill"></i>
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                        style="margin-right: 20.5rem"></button>
                                </div>
                                <div class="modal-body fs-3 d-block text-center" id="total-window-body">الشراء:
                                    <span>{{ $total_scrap }}</span>
                                </div>
    
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                        إنهاء
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
    
                </div>
               

                <br><br><br>
                <hr class="w-75 mx-auto">


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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    <script>
        $('a').each(function() {
            $(this).removeClass('active-page')
        });
        $('#barren').addClass('active-page');
    </script>
    {!! $sellChart->script() !!}
    {!! $sellPieChart->script() !!}
    {!! $rentChart->script() !!}
    {!! $rentPieChart->script() !!}



</body>

</html>
