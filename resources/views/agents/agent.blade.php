<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>العملاء || العربي جروب</title>
    <link rel="shortcut icon" href="../assets/logo.jpg" type="image/x-icon" />

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
    <link rel="stylesheet" href="{{ asset('files/client.css') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

</head>

<body>
    <!-- Start Body Home -->
    <div class="home overflow-hidden">
        <!-- Start Navbar -->
        <div class="navbar row m-0 text-white fs-5 px-2">
            <div class="col-3">
                <i class="fa-solid fa-bars ms-2 text-white"></i>
                العملاء
            </div>
            <div class="col"></div>
            <div class="col text-start">
                <!-- Start Messages Section -->

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

        <div class="content-body row m-0 overflow-y-scroll">
            <!-- Start Sidebar -->
            {{ view('sidebar') }}
            <!-- End Sidebar -->

            <!-- Start Content -->
            <div class="content col-10 p-0 text-center">

                @if (session()->has('error'))
                    <div class="alert alert-dismissible alert-danger align-items-center h3em d-flex fade justify-content-between m-2 show"
                        role="alert">
                        {{-- <svg class="bi flex-shrink-0 me-2 w-7 h-7" role="img" aria-label="Danger:">
                            <use xlink:href="#check-circle-fill" />
                        </svg> --}}
                        <div>{{ session()->get('error') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session()->has('done'))
                    <div class="alert alert-dismissible alert-success align-items-center h3em d-flex fade justify-content-between m-2 show"
                        role="alert">
                        {{-- <svg class="bi flex-shrink-0 me-2 w-7 h-7" role="img" aria-label="Success:">
                            <use xlink:href="#check-circle-fill" />
                        </svg> --}}
                        <div>{{ session()->get('done') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if ($errors->count() > 0)
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-dismissible alert-danger align-items-center h3em d-flex fade justify-content-between m-2 show"
                            role="alert">
                            {{-- <svg class="bi flex-shrink-0 me-2 w-7 h-7" role="img" aria-label="Danger:">
                                <use xlink:href="#check-circle-fill" />
                            </svg> --}}
                            <div>{{ $error }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endforeach
                @endif
                <!-- Start Client's Data -->
                <div class="client-data">
                    <h3 class="my-4 bg-primary m-auto p-3 rounded section-data-header">
                        بيانات العميل <i class="fa-solid fa-person me-1"></i>
                    </h3>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col"> البيانات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">الاسم</th>
                                <td> {{ $agent->name }} </td>
                            </tr>
                            <tr>
                                <th scope="row">العنوان</th>
                                <td> {{ $agent->address }} </td>
                            </tr>
                            <tr>
                                <th scope="row">رقم الهاتف</th>
                                <td>{{ $agent->phone }}</td>
                            </tr>
                            <tr>
                                <th scope="row">البريد الالكتروني</th>
                                <td>{{ $agent->email }}</td>
                            </tr>
                            <tr>
                                <th scope="row">عرض السعر</th>
                                <td>
                                    <a class="btn collection text-primary"
                                        href="{{ asset('storage/' . $agent->price_offer) }}" target="_blank"
                                        type="button"><i class="fa-solid fa-search"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">ال POs</th>
                                <td>
                                    <a id="pos" href="" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#agent_pos">
                                        <i class="fa-solid fa-search"></i>
                                    </a>

                                    <div class="modal fade" id="agent_pos" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="agent_posLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="bg-primary modal-header text-white">
                                                    <h5 class="modal-title" id="agent_posLabel">
                                                        الــ POs خاصة <span class="px-2 fw-bold">" {{ $agent->name }}
                                                            "</span>
                                                    </h5>
                                                    <button type="button" class="btn-close m-0" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="table-data pe-1 h-auto pt-3">
                                                        <table class="table table-striped text-center">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">رقم</th>
                                                                    <th scope="col">مرفق ال PO</th>
                                                                    <th scope="col">العميل</th>
                                                                    <th scope="col">عرض السعر</th>
                                                                    <th scope="col">S/N</th>
                                                                    <th scope="col">القيمة</th>
                                                                    <th scope="col">تاريخ التحصيل</th>
                                                                    <th scope="col">تاريخ الإنشاء</th>
                                                                    <th scope="col">محصل</th>
                                                                    {{-- <th scope="col">تعديل</th> --}}
                                                                </tr>
                                                            </thead>
                                                            <tbody id="data-body">
                                                                @foreach ($pos as $po)
                                                                    @if ($po->from == $agent->id)
                                                                        <tr>
                                                                            <td> {{ $x++ }}</td>
                                                                            <td>
                                                                                <a class="btn btn-sm collection text-primary"
                                                                                    href="{{ asset('storage/' . $po->po_file) }}"
                                                                                    target="_blank" type="button"><i
                                                                                        class="fa-solid fa-search"></i></a>
                                                                            </td>
                                                                            <td>
                                                                                {{ $agent->name }}
                                                                            </td>
                                                                            <td>
                                                                                <a class="btn btn-sm collection text-primary"
                                                                                    href="{{ asset('storage/' . $po->sale_present_file) }}"
                                                                                    target="_blank" type="button"><i
                                                                                        class="fa-solid fa-search"></i></a>
                                                                            </td>
                                                                            <td> {{ $po->snum }} </td>
                                                                            <td class="small fw-bold">
                                                                                {{ $po->po_value }}
                                                                            </td>
                                                                            <td class="small">
                                                                                {{ $po->collection_date }}
                                                                            </td>
                                                                            <td class="small"> {{ $po->created_at }}
                                                                            </td>

                                                                            @if ($po->status == 1)
                                                                                <td><i class='fa-solid fa-check'
                                                                                        style='color: #00803e;'></i>
                                                                                </td>
                                                                            @elseif($po->status == 0)
                                                                                <td><i
                                                                                        class='fa-solid fa-close text-danger'></i>
                                                                                </td>
                                                                            @endif
                                                                            {{-- <td>
                                                                        <a type="button" id="edt_po" href="{{ route('edt_po', $po->id) }}"
                                                                            class="lh-1 p-2 btn btn-sm btn-dark">تعديل</a>
                                                                    </td> --}}
                                                                        </tr>
                                                                    @endif
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <!-- End Client's Data -->

                <hr class="d-block mt-5 w-75 m-auto" />

                <!-- Start Fixed Supplies -->
                <div class="fixed-supplies">
                    <h3 class="my-4 bg-danger m-auto p-3 rounded section-data-header">
                        التوريدات الثابتة <i class="fa-solid fa-truck me-1"></i>
                    </h3>
                    <div class="row mb-2 mx-2">
                        <div class="col-6">
                            <div class="wrap w-100">
                                <form action="{{ route('fixedsup.search') }}" method="get" id="fixedsup-form"
                                    class="search w-100 position-relative d-flex">
                                    <button type="submit" class="searchButton text-center text-white">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    <input type="text" id="search_fixedsup"
                                        class="searchTerm w-50 border-end-0 text-center"
                                        placeholder="ابحث بالمنتج أو الكمية . . ." />
                                    <div class="filter-date d-flex">
                                        <input type="date" id="from_date" name="from_date"
                                            class="btn date-input date-input-from" />
                                        <input type="date" id="to_date" name="to_date"
                                            class="btn date-input date-input-to" />
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-6 text-start">

                            <a href="{{ route('fixedsuppliespdf', $agent->id) }}" class="btn btn-dark ms-2">
                                <i class="fa fa-download ms-2"></i>PDF
                            </a>

                            <a class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#fixedSupply">
                                <i class="fa-solid fa-plus"></i>
                                إضافة توريد ثابت
                            </a>

                            <div class="modal fade" id="fixedSupply" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="fixedSupplyLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="fixedSupplyLabel">إضافة توريد ثابت</h5>
                                            <button type="button" class="btn-close m-0" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="row g-3" method="post"
                                                action="{{ route('store_fixed_supplies', $agent->id) }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                {{-- <div class="mb-3 g-3 d-flex justify-content-around align-items-center">
                                                    <label for="pro_num" class="form-label">اختر المنتج</label>
                                                    <select class="form-select w-50 select2" id="pro_num"
                                                        aria-label="Default select example" name="pro_num" required>
                                                        <option selected value=''>اختر</option>
                                                        @foreach ($products as $product)
                                                            <option value="{{ $product->code }}">{{ $product->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div> --}}
                                                <div class="mb-3 g-3 d-flex justify-content-around align-items-center">
                                                    <label for="pro_num" class="form-label">اختر المنتج</label>
                                                    <select class="form-select w-50 select2" id="pro_num" aria-label="Default select example" name="pro_num" required>
                                                        <option selected value=''>اختر</option>
                                                        @foreach ($products as $product)
                                                            <option value="{{ $product->code }}">{{ $product->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="number" name="number_of_product"
                                                            class="form-control mt-3 mb-3" placeholder="عدد المنتج"
                                                            aria-label="" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="number" name="sell_price"
                                                            class="form-control mt-3 mb-3" placeholder="سعر البيع"
                                                            aria-label="" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="number" name="buy_price"
                                                            class="form-control mt-3 mb-3" placeholder="سعر الشراء"
                                                            aria-label="" required>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">

                                                    <button type="submit" class="btn btn-primary"
                                                        name="button_add_submit">إضافة
                                                    </button>
                                                    <button type="button" class="btn btn-danger"
                                                        data-bs-dismiss="modal">
                                                        إنهاء
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">المنتج</th>
                                <th scope="col">الكمية</th>
                                <th scope="col">سعر البيع</th>
                                <th scope="col">سعر الشراء</th>
                                <th scope="col">تعديل</th>
                                <th scope="col">حذف</th>
                            </tr>
                        </thead>
                        <tbody id="data-body-fixed">
                            {{-- @foreach ($agents_fixed as $agentt) --}}
                            @foreach ($agents_fixed as $Fixed_supplie)
                                <!-- <div class="col-md-12 purchas_tabel"> -->
                                <tr>
                                    <td> {{ $x++ }}</td>
                                    <td> {{ $Fixed_supplie->pro_name }}</td>
                                    <td> {{ $Fixed_supplie->number_of_product }} </td>
                                    <td> {{ $Fixed_supplie->sell_price }} </td>
                                    <td> {{ $Fixed_supplie->buy_price }} </td>


                                    <td>
                                        <button
                                            onclick="window.location='{{ route('edit_fixed_supplies', $Fixed_supplie->id) }}'">
                                            <i class="fa-solid fa-pen-to-square text-primary"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <form method="POST"
                                            action="{{ route('delete_supply', ['id' => $Fixed_supplie->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('هل انت متاكد من حذف هذا التوريد')"
                                                style="border:none; background-color:transparent;">
                                                <i class="fa-solid fa-trash text-danger"></i>
                                            </button>
                                        </form>

                                    </td>
                            @endforeach
                            {{-- @endforeach --}}
                        </tbody>
                    </table>
                    <div class="paginate px-4" style="direction: ltr;">{{ $agents_fixed->links() }}</div>
                </div>
                <!-- End Fixed Supplies -->

                <hr class="d-block mt-5 w-75 m-auto" />

                <!-- Start Variable Supplies -->
                <div class="variable-supplies mb-5">
                    <h3 class="my-4 bg-success m-auto p-3 rounded section-data-header">
                        ما تم توريده <i class="fa-solid fa-truck-ramp-box me-1"></i>
                    </h3>
                    <div class="row mb-2 mx-2">
                        <div class="col-6">
                            <div class="wrap w-100">
                                <form action="{{ route('eachsup.search') }}" method="get" id="eachsup-form"
                                    class="search w-100 position-relative d-flex">
                                    <button type="submit" class="searchButton text-center text-white">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    <input type="text" id="search_eachsup"
                                        class="searchTerm w-50 border-end-0 text-center"
                                        placeholder="ابحث بالمنتج أو الكمية . . ." />
                                    <div class="filter-date d-flex">
                                        <input type="date" id="from_date" name="from_date"
                                            class="btn date-input date-input-from" />
                                        <input type="date" id="to_date" name="to_date"
                                            class="btn date-input date-input-to" />
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-6 text-start">

                            <a href="{{ route('eachsuppliespdf', $agent->id) }}" class="btn btn-dark ms-2">
                                <i class="fa fa-download ms-2"></i>PDF
                            </a>

                            <a class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#variableSupply">
                                <i class="fa-solid fa-plus"></i>
                                إضافة توريد جديد
                            </a>

                            <div class="modal fade" id="variableSupply" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="variableSupplyLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="variableSupplyLabel">إضافة توريد جديد</h5>
                                            <button type="button" class="btn-close m-0" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="row" method="post"
                                                action="{{ route('store_each_supplies', $agent->id) }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="mb-3 g-3 d-flex justify-content-around align-items-center">
                                                    <label for="pro_num" class="form-label">اختر المنتج</label>
                                                    <select class="form-select w-50 select2" id="pro_num"
                                                        aria-label="Default select example" name="pro_num" required>
                                                        <option selected value=''>اختر</option>
                                                        @foreach ($products as $product)
                                                            <option value="{{ $product->code }}">{{ $product->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="number" name="number_of_product"
                                                            class="form-control mt-3 mb-3" placeholder="عدد المنتج"
                                                            aria-label="" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="number" name="sell_price"
                                                            class="form-control mt-3 mb-3" placeholder="سعر البيع"
                                                            aria-label="" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="number" name="buy_price"
                                                            class="form-control mt-3 mb-3" placeholder="سعر الشراء"
                                                            aria-label="" required>
                                                    </div>

                                                    <div class="modal-footer">

                                                        <button type="submit" class="btn btn-primary"
                                                            name="button_add_submit">إضافة
                                                        </button>
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-dismiss="modal">
                                                            إنهاء
                                                        </button>
                                                    </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">المنتج</th>
                                <th scope="col">الكمية</th>
                                <th scope="col">سعر البيع</th>
                                <th scope="col">سعر الشراء</th>
                                <th scope="col">تعديل</th>
                                <th scope="col">حذف</th>
                            </tr>
                        </thead>
                        <tbody id="data-body-each">
                            @foreach ($agents_each as $each_supplie)
                                <tr>
                                    <td> {{ $y++ }}</td>
                                    <td> {{ $each_supplie->pro_name }}</td>
                                    <td> {{ $each_supplie->number_of_product }} </td>
                                    <td> {{ $each_supplie->sell_price }} </td>
                                    <td> {{ $each_supplie->buy_price }} </td>


                                    <td>
                                        <button
                                            onclick="window.location='{{ route('edit_each_supplies', $each_supplie->id) }}'"">
                                            <i class="fa-solid fa-pen-to-square text-primary"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <form method="POST"
                                            action="{{ route('delete_Eachsupply', ['id' => $each_supplie->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Are you sure you want to delete this supply?')"
                                                style="border:none; background-color:transparent;">
                                                <i class="fa-solid fa-trash text-danger"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="paginate px-4" style="direction: ltr;">{{ $agents_each->links() }}</div>
                </div>
                <!-- End Variable Supplies -->
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
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('files/script.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        $('a').each(function() {
            $(this).removeClass('active-page')
        });
        $('#agents').addClass('active-page');
        $(document).ready(function() {
        $('.select2').select2({
            placeholder: "ابحث هنا...",
            allowClear: true, // Allows the "clear" option
            language: "ar" // Sets language to Arabic
        });
    });
    
    </script>
</body>

</html>
