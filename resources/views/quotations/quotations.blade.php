<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>عروض الأسعار || العربي جروب</title>
    <link rel="shortcut icon" href="./assets/elarby group logo.jpg" type="image/x-icon" />

    <!-- Importing fontawesome library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- Importing Bootstrap library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" integrity="sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                عروض الأسعار
            </div>
            <div class="col"></div>
            <div class="col text-start">
                <form method="POST" action="{{ route('logout') }}" class="d-inline-block">
                    @csrf
                    <x-dropdown-link class="text-decoration-none text-white w-auto p-0 m-0" :href="route('logout')" onclick="event.preventDefault();
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
            <div class="content col-10 p-0">
                <div class="alerting"></div>
                @if (Session::has('done'))
                <div class="alert alert-dismissible alert-success align-items-center h3em d-flex fade justify-content-between m-2 show" role="alert">
                    <svg class="bi flex-shrink-0 me-2 w-7 h-7" role="img" aria-label="Success:">
                        <use xlink:href="#check-circle-fill" />
                    </svg>
                    <div>{{ Session::get('done') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if (Session::has('edtdone'))
                <div class="alert alert-dismissible alert-success align-items-center h3em d-flex fade justify-content-between m-2 show" role="alert">
                    <svg class="bi flex-shrink-0 me-2 w-7 h-7" role="img" aria-label="Success:">
                        <use xlink:href="#check-circle-fill" />
                    </svg>
                    <div>{{ Session::get('edtdone') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if (Session::has('priced'))
                <div class="alert alert-dismissible alert-success align-items-center h3em d-flex fade justify-content-between m-2 show" role="alert">
                    <svg class="bi flex-shrink-0 me-2 w-7 h-7" role="img" aria-label="Success:">
                        <use xlink:href="#check-circle-fill" />
                    </svg>
                    <div>{{ Session::get('priced') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if ($errors->count() > 0)
                @foreach ($errors->all() as $error)
                <div class="alert alert-dismissible alert-danger align-items-center h3em d-flex fade justify-content-between m-2 show" role="alert">
                    <svg class="bi flex-shrink-0 me-2 w-7 h-7" role="img" aria-label="Danger:">
                        <use xlink:href="#check-circle-fill" />
                    </svg>
                    <div>{{ $error }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endforeach
                @endif
                <!-- Start buttons -->
                <div class="buttons position-relative row m-0 py-3">
                    <div class="col-6">
                        <div class="wrap w-100">
                            <form action="{{ route('quotations.search') }}" method="get" id="quotation-form" class="search w-100 position-relative d-flex">
                                <button type="submit" class="searchButton text-center text-white">
                                    <i class="fa fa-search"></i>
                                </button>
                                <input type="text" id="quotation_keyword" class="searchTerm w-50 border-end-0 text-center" placeholder="ابحث بالعميل او العنوان . . ." />
                                <div class="filter-date d-flex">
                                    <input type="date" id="from_date" name="from_date" class="btn date-input date-input-from" />
                                    <input type="date" id="to_date" name="to_date" class="btn date-input date-input-to" />
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Start Popup Form -->
                    <div class="col-6 text-start">
                        <!-- Button trigger modal -->
                        <a href="{{ route('quotationpdf') }}" class="btn btn-dark ms-2">
                            <i class="fa fa-download ms-2"></i>PDF
                        </a>

                        <a type="button" class="btn btn-dark sm-2" data-bs-toggle="modal" data-bs-target="#total_price">
                            <i class="fa-solid fa-money-bill"></i> الإجمالي
                        </a>

                        <div class="modal fade" id="total_price" tabindex="-1" aria-labelledby="totalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="totalLabel">
                                            الإجمالي <i class="fa-solid fa-money-bill"></i>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="margin-right: 20.5rem"></button>
                                    </div>
                                    <div class="modal-body fs-3 d-block text-center" id="total-price">السعر :
                                        <span>{{ $total_price }}</span>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                            إنهاء
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addNewOffer">
                            إضافة عرض <i class="fa-solid fa-plus me-1"></i>
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="addNewOffer" tabindex="-1" aria-labelledby="addNewOfferLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addNewOfferLabel">
                                            <i class="fa-solid fa-envelope-open-text me-1"></i>
                                            إضافة عرض جديد
                                        </h5>
                                        <button type="button" class="btn-close" style="margin-right: 16rem" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="text-end" action="{{ route('store_quotation') }}" enctype="multipart/form-data" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="clientName" class="form-label">اسم العميل</label>
                                                <input type="text" class="form-control" id="client" name="client" required />
                                            </div>
                                            <div class="mb-3">
                                                <label for="clientAddress" class="form-label">العنوان</label>
                                                <input type="text" class="form-control" id="clientAddress" name="address" required />
                                            </div>
                                            <div class="mb-3">
                                                <label for="priceOffer" class="form-label">عرض السعر</label>
                                                <input type="file" class="form-control" id="priceOffer" name="quotation_file" required />
                                            </div>
                                            <div class="mb-3">
                                                <label for="price" class="form-label">السعر</label>
                                                <input type="number" class="form-control" id="price" name="price" />
                                            </div>
                                            <button type="submit" class="btn btn-primary w-100 mt-3">
                                                إضافة
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Start Data -->
                <div class="table-data mt-3 pt-3 pe-1 h-auto">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th scope="col">رقم</th>
                                <th scope="col">كود</th>
                                <th scope="col">إسم العميل</th>
                                <th scope="col">عرض السعر</th>
                                <th scope="col">العنوان</th>
                                <th scope="col">التاريخ</th>
                                <th scope="col">السعر</th>
                                <th scope="col">تم التسعير</th>
                                <th scope="col">تمت الموافقة</th>
                                <th scope="col">تعديل</th>
                                <th scope="col">حذف</th>
                            </tr>
                        </thead>
                        <tbody id="data-body">
                            @foreach ($quotations as $q)
                            <tr>
                                <td>{{ $x++ }}</td>
                                <td>{{ $q->id }}</td>
                                <td>{{ $q->client }}</td>
                                <td>
                                    @if ($q->quotation_file != null)
                                    <a class="btn btn-sm collection text-primary" href="{{ asset('storage/' . $q->quotation_file) }}" target="_blank" type="button"><i class="fa-solid fa-search"></i></a>
                                    @endif
                                </td>
                                <td>{{ $q->address }}</td>
                                <td>{{ $q->created_at }}</td>
                                <td>{{ $q->price }}</td>
                                <td>
                                    @if ($q->price != null || $q->price != 0)
                                    <button class="btn btn-sm">
                                        <i class="fa-solid text-primary fa-check"></i>
                                    </button>
                                    @else
                                    <button class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#pricing{{ $q->id }}">
                                        <i class="fa-solid fa-hand-holding-dollar text-primary"></i>
                                    </button>

                                    <div class="modal fade" id="pricing{{ $q->id }}" tabindex="-1" aria-labelledby="colmodalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header d-flex justify-content-between lead">
                                                    <p>تسعـير العرض</p>
                                                    <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('pricing', $q->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            {{-- <label for="price" class="form-label">السعر</label> --}}
                                                            <input type="number" class="form-control" id="price" name="price_add" placeholder="السعر" required />
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" id="pricing" class="lh-1 p-2 btn btn-sm btn-primary">حفظ</button>
                                                        <button type="button" class="btn btn-danger lh-1 p-2 btn btn-sm" data-bs-dismiss="modal">إلغاء</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#agree{{ $q->id }}">
                                        <i class="fa-solid text-primary fa-truck-fast agree"></i>
                                    </button>
                                    @if ($q->price != null || $q->price != 0)
                                    <div class="modal fade" id="agree{{ $q->id }}" tabindex="-1" aria-labelledby="colmodalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body d-flex justify-content-between lead">
                                                    <p>أدخل السعر النهائي للموافقة</p>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('agree', $q->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <input type="number" class="form-control final_price" id="final_price" name="final_price" placeholder="السعر النهائي" required />
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer d-flex justify-content-between">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="same_price" class="form-check-input checkboxsame_price" id="checkboxsame_price{{ $q->price }}" value="{{ $q->price }}" aria-label="">
                                                            <label for="checkboxsame_price{{ $q->price }}" class="form-check-label">نفس السعر المبدئي</label>
                                                        </div>
                                                        <div>
                                                            <button type="submit" id="agree_qutation" class="agree_qutation lh-1 p-2 btn btn-sm btn-primary">موافق</button>
                                                            <button type="button" class="btn btn-danger lh-1 p-2 btn btn-sm" data-bs-dismiss="modal">إلغاء</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#editFirstOffer{{ $q->id }}">
                                        <i class="fa-solid text-primary fa-edit"></i>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="editFirstOffer{{ $q->id }}" tabindex="-1" aria-labelledby="editFirstOfferLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="editFirstOfferLabel">
                                                        تعديل عرض السعر
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="margin-right: 18rem" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="text-end" action="{{ route('update_quotation', $q->id) }}" enctype="multipart/form-data" method="POST">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label for="client" class="form-label">اسم
                                                                العميل</label>
                                                            <input type="text" class="form-control" id="client" name="client" required value="{{ old('client', $q->client) }}" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="clientAddress" class="form-label">العنوان</label>
                                                            <input type="text" class="form-control" id="clientAddress" name="address" required value="{{ old('address', $q->address) }}" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="priceOffer" class="form-label">عرض
                                                                السعر</label>
                                                            <input type="file" class="form-control" id="priceOffer" name="quotation_file" value="{{ old('quotation_file', $q->quotation_file) }}" />
                                                        </div>
                                                        <div class="mb-4 d-block">
                                                            <label for="" class="form-label">عرض السعر
                                                                المحفوظ<span class="text-danger">*</span></label>
                                                            @if (isset($q->quotation_file))
                                                            <a href="{{ asset('storage/' . $q->quotation_file) }}" target="_blank" class="form-control text-bg-secondary text-decoration-none">{{ substr($q->quotation_file, 11) }}</a>
                                                            @endif
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="price" class="form-label">السعر</label>
                                                            <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $q->price) }}" />
                                                        </div>
                                                        <button type="submit" class="btn btn-dark w-100 mt-3">
                                                            تعديل
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('delete_quotation', ['id' => $q->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('هل انت متأكد من حذف عرض السعر ؟')" style="border:none; background-color:transparent;">
                                            <i class="fa-solid fa-trash text-danger"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="paginate px-4" style="direction: ltr;">{{ $quotations->links() }}</div>
                <!-- End Data -->
            </div>
            <!-- End Content -->
        </div>
    </div>
    <!-- End Body Home -->

    <!-- Importing Scripts -->
    <script src="{{ asset('js/jq/jq.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js" integrity="sha512-3dZ9wIrMMij8rOH7X3kLfXAzwtcHpuYpEgQg1OA4QAob1e81H8ntUQmQm3pBudqIoySO5j0tHN4ENzA6+n2r4w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('files/purchases.js') }}"></script>
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $('a').each(function() {
            $(this).removeClass('active-page')
        });
        $('#quotations').addClass('active-page');

        $('.agree').on('click', function() {
            $('.final_price').val("");
            $('.checkboxsame_price').prop('checked', false);
        });
        $('.checkboxsame_price').on('click', function() {
            if ($(this).is(':checked')) {
                $('.final_price').val($(this).val());
            } else {
                $('.final_price').val("");
            }
        });
    </script>
</body>

</html>