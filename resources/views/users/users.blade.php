<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>شئون العاملين || العربي جروب</title>
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
                شئون العاملين
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
                            <form action="{{ route('user.search') }}" method="get" id="user-form"
                                class="search w-100 position-relative d-flex">
                                <button type="submit" class="searchButton text-center text-white">
                                    <i class="fa fa-search"></i>
                                </button>
                                <input type="text" id="user_keyword" class="searchTerm w-50 border-end-0 text-center"
                                    placeholder="ابحث بالوظيفة او الاسم . . ." />
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
                        <a href="{{ route('userspdf') }}" class="btn btn-dark ms-2">
                            <i class="fa fa-download ms-2"></i>PDF
                        </a>
                        <a id="add_user" href="{{ route('add_user') }}" class="btn btn-dark"
                            data-bs-target="#staticBackdrop">
                            <i class="fa-solid fa-plus"></i>
                            إضافة موظف جديد
                        </a>
                    </div>
                </div>
                <!-- End Buttons -->
                <!-- Start Data -->
                <div class="table-data pe-1 h-auto pt-3">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th scope="col">رقم</th>
                                <th scope="col">الإسم</th>
                                <th scope="col">البريد الإلكتروني</th>
                                <th scope="col">التليفون</th>
                                <th scope="col">الوظيفة</th>
                                <th scope="col">المرتب</th>
                                <th scope="col">الأجازات</th>
                                <th scope="col">باقي الأجازات</th>
                                <th scope="col">وقت إضافي</th>
                                <th scope="col">صلاحيات</th>
                                <th scope="col">مرفقات</th>
                                <!-- <th scope="col">تاريخ الاضافة</th> -->
                                {{-- <th scope="col">اخر تحديث </th> --}}
                                <th scope="col">تعديل</th>
                            </tr>
                        </thead>
                        <tbody id="data-body">
                            @foreach ($users as $user)
                                <tr>
                                    <td> {{ $x++ }}</td>
                                    <td> {{ $user->name }}</td>
                                    <td> {{ $user->email }}</td>
                                    <td> {{ $user->phone }}</td>
                                    <td> {{ $user->job_type }}</td>
                                    <td> {{ $user->salary }}</td>
                                    <td> {{ $user->holidays }}</td>
                                    <td> {{ $user->holi_rest }}</td>
                                    <td> {{ $user->over_time }}</td>
                                    <td>
                                        <a class="btn btn-sm collection text-danger"
                                            href="{{ route('user_perm', $user->id) }}" target="_blank"
                                            type="button"><i class="fa-solid fa-key"></i></a>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm collection text-primary"
                                            href="{{ asset('storage/' . $user->emp_file) }}" target="_blank"
                                            type="button"><i class="fa-solid fa-search"></i></a>
                                    </td>
                                    {{-- <td> {{ $user->updated_at }}</td> --}}

                                    <td>
                                        <a type="button" id="edt_user" href="{{ route('edt_user', $user->id) }}"
                                            class="btn btn-sm collection text-primary"><i
                                                class="fa-solid fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="paginate px-4" style="direction: ltr;">{{ $users->links() }}</div>
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
        $('#users').addClass('active-page');
    </script>
</body>

</html>
