<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>صلاحيات || العربي جروب</title>
    <link rel="shortcut icon" href="{{ asset('assets/product.jpg') }}" type="image/x-icon" />

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
    <link rel="stylesheet" href="{{ asset('files/addProduct.css') }}" />
    <link rel="stylesheet" href="{{ asset('files/stocks.css') }}" />
</head>

<body>
    <!-- Start Body Home -->
    <div class="home overflow-hidden">
        <!-- Start Navbar -->
        <div class="navbar row m-0 text-white fs-5 px-2">
            <div class="col-3">
                <i class="fa-solid fa-bars ms-2 text-white"></i>
                صلاحيات <span class="px-2 fw-bold">"
                    {{ $user->name }}
                    "</span>
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
            <div class="content col-10 mt-5 mb-2 overflow-y-scroll h-100">
                <div class="alerting"></div>
                @if (Session::has('done'))
                    <div class="alert alert-dismissible alert-success align-items-center h3em d-flex fade justify-content-between m-2 show"
                        role="alert">
                        <svg class="bi flex-shrink-0 me-2 w-7 h-7" role="img" aria-label="Success:">
                            <use xlink:href="#check-circle-fill" />
                        </svg>
                        <div>{{ Session::get('done') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (Session::has('edtdone'))
                    <div class="alert alert-dismissible alert-success align-items-center h3em d-flex fade justify-content-between m-2 show"
                        role="alert">
                        <svg class="bi flex-shrink-0 me-2 w-7 h-7" role="img" aria-label="Success:">
                            <use xlink:href="#check-circle-fill" />
                        </svg>
                        <div>{{ Session::get('edtdone') }}</div>
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

                <div>
                    <form action="{{ route('update_user_perm', $user->id) }}" method="POST"
                        enctype="multipart/form-data"
                        class="h-auto mx-auto rounded-4 overflow-hidden text-center w-75 container py-5">
                        @csrf
                        <div class="d-block">
                            <div class="text-center d-inline-block p-2 rounded mb-2" style="background-color:#d96464;">
                                <input type="checkbox" class="form-check-input" style="cursor: pointer;"
                                    id="stock{{ $user->id }}" name="stock{{ $user->id }}"
                                    {{ isset($role_stock[0]->perm) && $role_stock[0]->perm == "on" ? 'checked' : '' }} />
                                <label for="stock{{ $user->id }}" class="form-check-label"
                                    style="cursor: pointer;">المخزن</label>
                            </div>
                            <div class="text-center d-inline-block p-2 rounded mb-2" style="background-color:#d96464;">
                                <input type="checkbox" class="form-check-input" style="cursor: pointer;"
                                    id="purchas{{ $user->id }}" name="purchas{{ $user->id }}"
                                    {{ isset($role_purchas[0]->perm) && $role_purchas[0]->perm == "on" ? 'checked' : '' }} />
                                <label for="purchas{{ $user->id }}" class="form-check-label"
                                    style="cursor: pointer;">المشتريات</label>
                            </div>
                            <div class="text-center d-inline-block p-2 rounded mb-2" style="background-color:#d96464;">
                                <input type="checkbox" class="form-check-input" style="cursor: pointer;"
                                    id="quotations{{ $user->id }}" name="quotations{{ $user->id }}"
                                    {{ isset($role_quotations[0]->perm) && $role_quotations[0]->perm == "on" ? 'checked' : '' }} />
                                <label for="quotations{{ $user->id }}" class="form-check-label"
                                    style="cursor: pointer;">عروض الأسعار</label>
                            </div>
                            <div class="text-center d-inline-block p-2 rounded mb-2" style="background-color:#d96464;">
                                <input type="checkbox" class="form-check-input" style="cursor: pointer;"
                                    id="scrap{{ $user->id }}" name="scrap{{ $user->id }}"
                                    {{ isset($role_scrap[0]->perm) && $role_scrap[0]->perm == "on" ? 'checked' : '' }} />
                                <label for="scrap{{ $user->id }}" class="form-check-label"
                                    style="cursor: pointer;">سكراب</label>
                            </div>
                            <div class="text-center d-inline-block p-2 rounded mb-2" style="background-color:#d96464;">
                                <input type="checkbox" class="form-check-input" style="cursor: pointer;"
                                    id="rental{{ $user->id }}" name="rental{{ $user->id }}"
                                    {{ isset($role_rental[0]->perm) && $role_rental[0]->perm == "on" ? 'checked' : '' }} />
                                <label for="rental{{ $user->id }}" class="form-check-label"
                                    style="cursor: pointer;">التأجير</label>
                            </div>
                            <div class="text-center d-inline-block p-2 rounded mb-2"
                                style="background-color:#d96464;">
                                <input type="checkbox" class="form-check-input" style="cursor: pointer;"
                                    id="users{{ $user->id }}" name="users{{ $user->id }}"
                                    {{ isset($role_users[0]->perm) && $role_users[0]->perm == "on" ? 'checked' : '' }} />
                                <label for="users{{ $user->id }}" class="form-check-label"
                                    style="cursor: pointer;">شئون
                                    العاملين</label>
                            </div>
                            <div class="text-center d-inline-block p-2 rounded mb-2"
                                style="background-color:#d96464;">
                                <input type="checkbox" class="form-check-input" style="cursor: pointer;"
                                    id="agents{{ $user->id }}" name="agents{{ $user->id }}"
                                    {{ isset($role_agents[0]->perm) && $role_agents[0]->perm == "on" ? 'checked' : '' }} />
                                <label for="agents{{ $user->id }}" class="form-check-label"
                                    style="cursor: pointer;">العملاء</label>
                            </div>
                            <div class="text-center d-inline-block p-2 rounded mb-2"
                                style="background-color:#d96464;">
                                <input type="checkbox" class="form-check-input" style="cursor: pointer;"
                                    id="po{{ $user->id }}" name="po{{ $user->id }}"
                                    {{ isset($role_po[0]->perm) && $role_po[0]->perm == "on" ? 'checked' : '' }} />
                                <label for="po{{ $user->id }}" class="form-check-label"
                                    style="cursor: pointer;">الـ
                                    PO</label>
                            </div>
                            <div class="text-center d-inline-block p-2 rounded mb-2"
                                style="background-color:#d96464;">
                                <input type="checkbox" class="form-check-input" style="cursor: pointer;"
                                    id="po_collected{{ $user->id }}" name="po_collected{{ $user->id }}"
                                    {{ isset($role_po_collected[0]->perm) && $role_po_collected[0]->perm == "on" ? 'checked' : '' }} />
                                <label for="po_collected{{ $user->id }}" class="form-check-label"
                                    style="cursor: pointer;">تحصيل
                                    الــ
                                    PO</label>
                            </div>
                            <div class="text-center d-inline-block p-2 rounded mb-2"
                                style="background-color:#d96464;">
                                <input type="checkbox" class="form-check-input" style="cursor: pointer;"
                                    id="custody{{ $user->id }}" name="custody{{ $user->id }}"
                                    {{ isset($role_custody[0]->perm) && $role_custody[0]->perm == "on" ? 'checked' : '' }} />
                                <label for="custody{{ $user->id }}" class="form-check-label"
                                    style="cursor: pointer;">العهدة</label>
                            </div>
                            <div class="text-center d-inline-block p-2 rounded mb-2"
                                style="background-color:#d96464;">
                                <input type="checkbox" class="form-check-input" style="cursor: pointer;"
                                    id="barren{{ $user->id }}" name="barren{{ $user->id }}"
                                    {{ isset($role_barren[0]->perm) && $role_barren[0]->perm == "on" ? 'checked' : '' }} />
                                <label for="barren{{ $user->id }}" class="form-check-label"
                                    style="cursor: pointer;">الجرد</label>
                            </div>
                            <div class="text-center d-inline-block p-2 rounded mb-2"
                                style="background-color:#d96464;">
                                <input type="checkbox" class="form-check-input" style="cursor: pointer;"
                                    id="prochis{{ $user->id }}" name="prochis{{ $user->id }}"
                                    {{ isset($role_prochis[0]->perm) && $role_prochis[0]->perm == "on" ? 'checked' : '' }} />
                                <label for="prochis{{ $user->id }}" class="form-check-label"
                                    style="cursor: pointer;">تاريخ
                                    العمليات</label>
                            </div>
                            <div class="text-center d-inline-block p-2 rounded mb-2"
                                style="background-color:#d96464;">
                                <input type="checkbox" class="form-check-input" style="cursor: pointer;"
                                    id="catalogue{{ $user->id }}" name="catalogue{{ $user->id }}"
                                    {{ isset($role_catalogue[0]->perm) && $role_catalogue[0]->perm == "on" ? 'checked' : '' }} />
                                <label for="catalogue{{ $user->id }}" class="form-check-label"
                                    style="cursor: pointer;">الفهرس</label>
                            </div>
                        </div>


                        <button type="submit" class="mt-5 btn btn-danger btn-lg" onclick="submitted()">
                            حفظ
                            <i class="fa-solid fa-check-double me-1"></i>
                        </button>
                    </form>
                </div>

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
    <script src="{{ asset('files/script.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- <script src="{{ asset('files/addProduct.js') }}"></script> -->
    <script>
        $('a').each(function() {
            $(this).removeClass('active-page')
        });
        $('#users').addClass('active-page');
    </script>
</body>

</html>
