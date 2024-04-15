<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>العهدة || العربي جروب</title>
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
            <div class="col-9 d-flex align-items-center">
                {{-- <i class="fa-solid fa-bars ms-2 text-white"></i> --}}
                <div class="col-12">
                    <div class="wrap d-flex col-12">
                        <div class="d-flex fs-4 mx-2">العهدة</div>
                        <div class="d-flex fs-5 px-2 mx-1 text-white rounded p-1"
                            style="background-color:#ffffffeb;color:#54621a !important;overflow:overlay;max-width: 80%;">
                            {{ $custody }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-3 text-start">
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
                <div class="buttons position-relative row m-0 pt-3">
                    <div class="col-6">
                        <div class="wrap w-100">
                            <form action="{{ route('expenses.search') }}" method="get" id="expenses-form"
                                class="search w-100 position-relative d-flex">
                                <button type="submit" class="searchButton text-center text-white">
                                    <i class="fa fa-search"></i>
                                </button>
                                <input type="text" id="expenses_keyword"
                                    class="searchTerm w-50 border-end-0 text-center"
                                    placeholder="ابحث بالمبلغ او المستلم . . ." />
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

                        <a href="{{ route('custodypdf') }}" class="btn btn-dark">
                            <i class="fa fa-download ms-2"></i>PDF
                        </a>

                        <a type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalcustody">
                            <i class="fa-solid fa-plus ms-2"></i>إضافة للعهدة
                        </a>

                        <a type="button" class="btn btn-dark" data-bs-toggle="modal"
                            data-bs-target="#modalexpense">
                            <i class="fa-solid fa-plus ms-2"></i>
                            إضافة مصروفات
                        </a>

                        <!-- Start reset -->
                        <a type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#reset">
                            تهيئة
                        </a>

                        <!-- Modal -->
                        <div class="modal fade" id="reset" tabindex="-1" aria-labelledby="resetLabel"
                            aria-hidden="true">
                            <div class="modal-dialog text-center">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h4>هل تريد إعادة تهيئة العهدة إلي صفر ؟!</h4>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-danger"
                                            data-bs-dismiss="modal">
                                            إلغاء
                                        </button>
                                        <form class="" method="post" action="{{ route('reset_custody') }}">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary">
                                                تأكيد
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- modalcustody -->
                        <div class="modal fade" id="modalcustody" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="alerting_modal"></div>
                                    <div class="modal-header">
                                        <h5 class="modal-title">إضافة عهدة</h5>
                                        <button type="button" class="m-0 btn-close fw-bold" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div id="addsales">
                                            <form class="row g-3" method="post"
                                                action="{{ route('add_custody') }}">
                                                @csrf
                                                <div class="row g-3">
                                                    <div class="col">
                                                        <input type="number" name="value" class="form-control"
                                                            placeholder="قيمة العهدة" aria-label="" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success"
                                                        name="button_add_submit">إضافة</button>
                                                    <button type="button" class="btn btn-danger"
                                                        data-bs-dismiss="modal">إغلاق</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end modalcustody -->
                        <!-- modalexpense -->
                        <div class="modal fade" id="modalexpense" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="alerting_modal"></div>
                                    <div class="modal-header">
                                        <h5 class="modal-title">إضافة مصروفات</h5>
                                        <button type="button" class="m-0 btn-close fw-bold" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div id="addsales">
                                            <form class="row g-3" method="post"
                                                action="{{ route('add_expense') }}">
                                                @csrf
                                                <div class="row g-3">
                                                    <div class="col">
                                                        <input type="number" name="amount" class="form-control"
                                                            placeholder="المبلغ" aria-label="" required>
                                                    </div>
                                                </div>
                                                <div class="row g-3">
                                                    <div class="col">
                                                        <textarea name="reason" class="form-control" placeholder="سبب الصرف" required cols="5" rows="3"></textarea>
                                                    </div>
                                                </div>
                                                <div class="row g-3">
                                                    <div class="col">
                                                        <input type="text" name="recipient" class="form-control"
                                                            placeholder="المستلم" aria-label="" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success"
                                                        name="button_add_submit">إضافة</button>
                                                    <button type="button" class="btn btn-danger"
                                                        data-bs-dismiss="modal">إغلاق</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end modalexpense -->
                    </div>
                </div>
                <!-- End Buttons -->
                <!-- Start Data -->
                <div class="table-data pe-1 h-auto mt-2">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th scope="col">مسلسل</th>
                                <th scope="col">المبلغ</th>
                                <th scope="col">سبب الصرف</th>
                                <th scope="col">المستلم</th>
                                <th scope="col">تاريخ الإنشاء</th>
                                <th scope="col">تعديل</th>
                            </tr>
                        </thead>
                        <tbody id="data-body">
                            @foreach ($expenses as $expense)
                                <tr>
                                    <td> {{ $x++ }}</td>
                                    <td> {{ $expense->amount }}</td>
                                    <td> {{ $expense->reason }}</td>
                                    <td> {{ $expense->recipient }}</td>
                                    <td> {{ $expense->created_at }}</td>
                                    <td>
                                        <a type="button" id="edt_expense" data-bs-toggle="modal"
                                            data-bs-target="#modalexpense{{ $expense->id }}"
                                            class="btn btn-sm collection text-primary"><i
                                                class="fa-solid fa-edit"></i></a>


                                        <!-- edt modalexpense -->
                                        <div class="modal fade" id="modalexpense{{ $expense->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="alerting_modal"></div>
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">تعديل مصروفات</h5>
                                                        <button type="button" class="m-0 btn-close fw-bold"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div id="addsales">
                                                            <form class="row g-3" method="post"
                                                                action="{{ route('edt_expense', $expense->id) }}">
                                                                @csrf
                                                                <div class="row g-3">
                                                                    <div class="col">
                                                                        <input type="number" name="amount"
                                                                            class="form-control" placeholder="المبلغ"
                                                                            value = "{{ old('amount', $expense->amount) }}"
                                                                            required>
                                                                    </div>
                                                                </div>
                                                                <div class="row g-3">
                                                                    <div class="col">
                                                                        <textarea name="reason" class="form-control" placeholder="سبب الصرف" required cols="5" rows="3">{{ old('reason', $expense->reason) }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="row g-3">
                                                                    <div class="col">
                                                                        <input type="text" name="recipient"
                                                                            class="form-control" placeholder="المستلم"
                                                                            value = "{{ old('recipient', $expense->recipient) }}"
                                                                            required>
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary"
                                                                        name="button_add_submit">تعديل</button>
                                                                    <button type="button" class="btn btn-danger"
                                                                        data-bs-dismiss="modal">إغلاق</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end edt modalexpense -->

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="paginate px-4" style="direction: ltr;">{{ $expenses->links() }}</div>
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
        $('#custody').addClass('active-page');
    </script>
</body>

</html>
