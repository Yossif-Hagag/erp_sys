<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>المشتريات || العربي جروب</title>
    <link rel="shortcut icon" href="./assets/elarby group logo.jpg" type="image/x-icon" />

    <!-- Importing fontawesome library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- Importing Bootstrap library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css"
        integrity="sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">


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
                النـثـريــات
            </div>
            <div class="col"></div>
            <div class="col text-start">
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
            <div class="content col-10 justify-content-between p-0 overflow-y-scroll h-100">
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
                            <form action="{{ route('purchas.search') }}" method="get" id="purchas-form"
                                class="search w-100 position-relative d-flex">
                                <button type="submit" class="searchButton text-center text-white">
                                    <i class="fa fa-search"></i>
                                </button>
                                <input type="text" id="purchas_search"
                                    class="searchTerm w-50 border-end-0 text-center"
                                    placeholder="ابحث بالعدد أو الإجمالي . . ." />
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
                        <a href="{{ route('purchaspdf') }}" class="btn btn-dark ">
                            <i class="fa fa-download "></i>PDF
                        </a>



                        <a type="button" class="btn btn-dark " data-bs-toggle="modal"
                            data-bs-target="#totalpurchas">
                            <i class="fa-solid fa-money-bill"></i> الإجمالي
                        </a>

                        <!-- Modal -->
                        <div class="modal fade" id="totalpurchas" tabindex="-1" aria-labelledby="totalLabel"
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
                                    <div class="modal-body fs-3 d-block text-center" id="total-price">التوريدة:
                                        <span>{{ $total_purchas }}</span>
                                    </div>
                                    <div class="modal-body fs-3 d-block text-center" id="total-number-product">عدد المنتجات:
                                        <span>{{ $total_number_product }}</span>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                            إنهاء
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <a type="button" class="btn btn-dark" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">
                            <i class="fa-solid fa-plus"></i>
                            إضافة توريدة جديدة
                        </a>



                        <a href="{{ route('operation_purchas') }}" class="btn btn-dark">إدارة التشغيل <i
                            class="fa-solid fa-gears me-1"></i></a>



                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">
                                            إضافة
                                        </h5>
                                        <button type="button" class="btn-close" style="margin-left: 0"
                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-end">
                                        <form method="post" action="{{ route('store_purchas') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <label class="form-label" for="item-img">ملف التوريدة</label>
                                                <input type="file" class="form-control" id="item-img"
                                                    name="supply_file" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="product-name" class="form-label">عدد المنتجات</label>
                                                <input type="number" class="form-control" id="product-name"
                                                    name="num_of_products" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="supply-price" class="form-label">إجمالي السعر</label>
                                                <input type="number" class="form-control" id="supply-price"
                                                    name="total_price" />
                                            </div>
                                            <button type="submit" class="btn btn-success">
                                                إضافة
                                            </button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                            إنهاء
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Popup Form-->



                    </div>
                </div>
                <!-- End Buttons -->
                <!-- Start Data -->
                <div class="table-data pt-3 pe-1 h-auto">
                    <table class="table table-striped text-center" id="example">
                        <thead>
                            <tr>
                                <th scope="col">رقم</th>
                                <th scope="col">ملف التوريدة</th>
                                <th scope="col">عدد المنتجات</th>
                                <th scope="col">إجمالي السعر</th>
                                <th scope="col">تعديل</th>
                                <!-- <th scope="col">حذف</th> -->
                            </tr>
                        </thead>
                        <tbody id="data-body">
                            @foreach ($purchas as $p)
                                <tr>
                                    <td>{{ $x++ }}</td>
                                    <td>
                                        <a class="btn btn-sm collection text-primary"
                                            href="{{ asset('storage/' . $p->supply_file) }}" target="_blank"
                                            type="button"><i class="fa-solid fa-search"></i></a>
                                    </td>
                                    <td>{{ $p->num_of_products }}</td>
                                    <td>{{ $p->total_price }}</td>
                                    <td>
                                        <a type="button" id="edt_product" 
                                            data-bs-toggle="modal"
                                            data-bs-target="#edt_product{{ $p->id }}"
                                            class="btn btn-sm collection text-primary lh-1 p-2"><i
                                                class="fa-solid fa-edit"></i></a>

                                        <!-- Modal -->
                                        <div class="modal fade" id="edt_product{{ $p->id }}" data-bs-backdrop="static"
                                            data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">
                                                        تعديل
                                                        </h5>
                                                        <button type="button" class="btn-close m-0"
                                                            style="margin-right: 18.65rem" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-end">
                                                        <form method="post" action="{{ route('update_purchas', $p->id) }}"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                             
                                                            <div class="mb-3">
                                                                <label class="form-label" for="item-img">ملف
                                                                    التوريدة</label>
                                                                <input type="file" class="form-control"
                                                                    id="item-img" name="supply_file" value="{{ old('supply_file', $p->supply_file) }}" />
                                                            </div>
                                                            <div class="mb-4 d-block">
                                                                <label for="" class="form-label">عرض مرفق ال ملف التوريدة المحفوظ <span
                                                                        class="text-danger">*</span></label>
                                                                @if (isset($p->supply_file))
                                                                    <a href="{{ asset('storage/' . $p->supply_file) }}" target="_blank"
                                                                        class="form-control text-bg-dark text-decoration-none">{{ substr($p->supply_file, 8) }}</a>
                                                                @endif
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="product-name" class="form-label">عدد
                                                                    المنتجات</label>
                                                                <input type="number" class="form-control"
                                                                    id="product-name" name="num_of_products" value="{{ old('num_of_products', $p->num_of_products) }}"  />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="supply-price" class="form-label">إجمالي
                                                                    السعر</label>
                                                                <input type="number" class="form-control"
                                                                    id="supply-price" name="total_price" value="{{ old('total_price', $p->total_price  ) }}" />
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">
                                                                تعديل
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-dismiss="modal">
                                                            إنهاء
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Popup Form-->


                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="paginate px-4" style="direction: ltr;">{{ $purchas->links() }}</div>
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
    <script src="{{ asset('files/purchases.js') }}"></script>
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $('a').each(function() {
            $(this).removeClass('active-page')
        });
        $('#purchas').addClass('active-page');
    </script>
</body>

</html>
