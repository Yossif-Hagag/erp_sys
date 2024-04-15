<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>تاريخ العمليات || العربي جروب</title>
    <link rel="shortcut icon" href="{{ asset('assets/elarby group logo.jpg') }}" type="image/x-icon" />

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
    <link rel="stylesheet" href="{{ asset('files/operationsHistory.css') }}" />
</head>

<body>
    <!-- Start Body Home -->
    <div class="home overflow-hidden">
        <!-- Start Navbar -->
        <div class="navbar row m-0 text-white fs-5 px-2">
            <div class="col-3">
                <i class="fa-solid fa-bars ms-2 text-white"></i>
                تاريخ العمليات
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
            <div class="content col-10 flex-column align-items-center d-flex  justify-content-between p-0 h-auto">
                <!-- Start Options -->
                <div class="options text-center w-100" id="options">
                    <ul id="options-list">
                        <li>
                            <a href="{{ route('audit_product') }}" id="audit_product" class="btn btn-sm btn-light ms-2">
                                المخزن
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('audit_supplier') }}" id="audit_supplier"
                                class="btn btn-sm btn-light ms-2">
                                الموردين
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('audit_purchas') }}" id="audit_purchas" class="btn btn-sm btn-light ms-2">
                                المشتريات
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('audit_rental') }}" id="audit_rental" class="btn btn-sm btn-light ms-2">
                                التأجير
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('audit_user') }}" id="audit_user" class="btn btn-sm btn-light ms-2">
                                العاملين
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('audit_agents') }}" id="audit_agents"
                                class="btn btn-sm btn-light ms-2">
                                العملاء
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('audit_po') }}" id="audit_po" class="btn btn-sm btn-light ms-2">
                                PO
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('audit_scrap') }}" id="audit_scrap"
                                class="btn btn-sm btn-light ms-2 active-btn-hisproc">
                                سكراب
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('audit_custody') }}" id="audit_custody"
                                class="btn btn-sm btn-light ms-2">
                                العهدة
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('audit_expense') }}" id="audit_expense"
                                class="btn btn-sm btn-light ms-2">
                                المصروفات
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Start Data -->
                <div class="table-data pe-1 overflow-y-scroll w-100">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr id="data-head">
                                <th scope="col">مسلسل</th>
                                <th scope="col">نوع المستخدم</th>
                                <th scope="col">المستخدم</th>
                                <th scope="col">العملية</th>
                                <th scope="col">اسم المنتج</th>
                                <th scope="col">القيم القديمة</th>
                                <th scope="col">القيم الحديثة</th>
                                <th scope="col">تاريخ العملية</th>
                            </tr>
                        </thead>
                        <tbody id="data-body">
                            @foreach ($scraps_audits as $x)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ str_replace('App\\Models\\', '', $x->user_type) }}</td>
                                    <td>
                                        @if ($x->user_type == 'App\Models\Admin')
                                            @foreach ($admins as $admin)
                                                @if ($x->user_id == $admin->id)
                                                    {{ $admin->name }}
                                                @endif
                                            @endforeach
                                        @elseif($x->user_type == 'App\Models\User')
                                            @foreach ($users as $user)
                                                @if ($x->user_id == $user->id)
                                                    {{ $user->name }}
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>{{ $x->event }}</td>
                                    <td>
                                        @foreach ($scraps as $scrap)
                                            @if ($x->auditable_id == $scrap->id)
                                                {{ $scrap->pro_name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($x->old_values as $key => $value)
                                            <div>
                                                @if ($key == 'number_of_product')
                                                    <span class="text-danger">عدد المنتج</span>
                                                @elseif ($key == 'pro_num')
                                                    <span class="text-danger">كود المنتج</span>
                                                @elseif ($key == 'pro_name')
                                                    <span class="text-danger">اسم المنتج</span>
                                                @elseif ($key == 'price')
                                                    <span class="text-danger">سعر المنتج</span>
                                                @elseif ($key == 'quantity')
                                                    <span class="text-danger">الكمية</span>
                                                @elseif ($key == 'id')
                                                    @continue;
                                                @else
                                                    <span class="text-danger">{{ $key }}</span>
                                                @endif
                                                : {{ $value }}
                                            </div>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($x->new_values as $key => $value)
                                            <div>
                                                @if ($key == 'number_of_product')
                                                    <span class="text-danger">عدد المنتج</span>
                                                @elseif ($key == 'pro_num')
                                                    <span class="text-danger">كود المنتج</span>
                                                @elseif ($key == 'pro_name')
                                                    <span class="text-danger">اسم المنتج</span>
                                                @elseif ($key == 'price')
                                                    <span class="text-danger">سعر المنتج</span>
                                                @elseif ($key == 'quantity')
                                                    <span class="text-danger">الكمية</span>
                                                @elseif ($key == 'id')
                                                    @continue;
                                                @else
                                                    <span class="text-danger">{{ $key }}</span>
                                                @endif
                                                : {{ $value }}
                                            </div>
                                        @endforeach
                                    </td>
                                    <td>{{ $x->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="paginate px-4" style="direction: ltr;">{{ $scraps_audits->links() }}</div>
                </div>
                <!-- End Data -->

            </div>
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
    <script src="{{ asset('files/operationsHistory.js') }}"></script>
    <script>
        $('a').each(function() {
            $(this).removeClass('active-page')
        });
        $('#prochis').addClass('active-page');
    </script>
</body>

</html>
