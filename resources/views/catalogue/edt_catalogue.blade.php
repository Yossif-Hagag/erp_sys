<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>تعديل || العربي جروب</title>
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
                تعديل فهرس
            </div>
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
            <div class="content col-10 mt-5 overflow-y-scroll h-100">
                <div class="alerting"></div>
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
                        <div class="alert alert-danger" role="alert">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
                <div id="edtcatalogue" style="margin-bottom: 5rem">
                    <form action="{{ route('update_catalogue', $catalogue->id) }}" method="POST"
                        class="w-50 h-100 mx-auto rounded-4 p-4 text-end">
                        @csrf

                        <div class="mb-4">
                            <label for="product_num" class="form-label">كود المنتج</label>
                            <input type="number" class="form-control" id="product_num" name="code"
                                value = "{{ old('code', $catalogue->code) }}" required />
                        </div>

                        <div class="mb-4">
                            <label for="product_name" class="form-label">أسم المنتج</label>
                            <input type="text" class="form-control" id="product_name" name="name"
                                value = "{{ old('name', $catalogue->name) }}" required />
                        </div>

                        <div class="mb-4">
                            <label for="suppliers" class="form-label">الموردين</label>
                            <textarea class="form-control" id="suppliers" rows="5" name="suppliers">{{ old('suppliers', $catalogue->suppliers) }}</textarea>
                        </div>


                        <div class="form-check form-switch" style="width: fit-content;">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="scrap"
                                value = "{{ old('scrap', $catalogue->scrap) }}" @checked(old('scrap', $catalogue->scrap))>
                            <label class="form-check-label" for="flexSwitchCheckDefault"> سكراب </label>
                        </div>

                        <div class="mx-auto w-50 text-center mt-5">
                            <button type="submit" class="btn btn-primary btn-lg" name="button_edt_submit">
                                تعديل
                                {{-- <i class="fa-solid fa-plus me-1" style="color: #ffffff"></i> --}}
                            </button>
                        </div>

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
        $('#catalogue').addClass('active-page');
    </script>
    <script>
        document.getElementById('flexSwitchCheckDefault').addEventListener('change', function() {
            this.value = this.checked ? "on" : 0;
        });
    </script>
</body>

</html>
