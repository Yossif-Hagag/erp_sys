<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>إضافة عملية مشتريات || العربي جروب</title>
    <link rel="shortcut icon" href="./assets/logo.jpg" type="image/x-icon" />

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
    <link rel="stylesheet" href="{{ asset('files/editProduct.css') }}" />
    <link rel="stylesheet" href="{{ asset('files/stocks.css') }}" />
</head>

<body>
    <!-- Start Body Home -->
    <div class="home overflow-hidden">
        <!-- Start Navbar -->
        <div class="navbar row m-0 text-white fs-5 px-2">
            <div class="col-3">
                <i class="fa-solid fa-bars ms-2 text-white"></i>
                إضافة عملية "مشتريات"
            </div>
            <div class="col"></div>
            <div class="col text-start">
                <!-- Start Messages Section -->

                <!-- End Messages Section -->

                <!-- Start Emails Part -->

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

            <div class="content col-10 py-4 overflow-hidden">
              <div class="alerting"></div>
                @if (Session::has('done'))
                    <div class="alert alert-dismissible alert-success align-items-center h3em d-flex fade justify-content-between m-2 show"
                        role="alert">

                        <div>{{ Session::get('done') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form action="{{ route('store_operation_purchas') }}" method="POST"
                    class="w-25 h-100 mx-auto rounded-4 overflow-hidden p-4 text-center pt-5 d-flex flex-column justify-content-center"
                    enctype="multipart/form-data">
                    @csrf
                    {{-- <select class="w-100 rounded-2 p-2 mb-5" id="transaction"
                        name="operation_type">
                     
                        <option value="بيع">بيع (Sell)</option>
                        <option value="شراء">شراء (Buy)</option>
                    </select> --}}
                    {{-- @error('operation_type')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror --}}
                    <div class="mb-5 w-100 text-end">
                        <label for="item-pic" class="form-label">مستند العملية</label>
                        <input type="file" class="form-control" id="item-pic" name = "operation_document" />
                        @error('operation_document')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-5 w-100 d-inline-block text-end">
                        <label for="supplier-name" class="form-label">العميل</label>
                        <input type="text" class="form-control" id="supplier-name" name="client_name" />
                        @error('client_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-5 w-100 d-inline-block text-end">
                        <label for="supplier-phone" class="form-label">العنوان</label>
                        <input type="text" class="form-control" id="supplier-phone" name = "address" />
                        @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-5 w-100 d-inline-block text-end">
                        <label for="transportation" class="form-label">التكلفة</label>
                        <input type="number" class="form-control" id="transportation" name = "cost" />
                        @error('cost')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-danger btn-lg w-50 mx-auto">
                        إضافة
                        <i class="fa-solid fa-edit me-1" style="color: #ffffff"></i>
                    </button>
                </form>
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

    <script>
        $('a').each(function() {
            $(this).removeClass('active-page');
        });
        $('#purchas').addClass('active-page');
        $('.sidebar').addClass('h-auto');
    </script>
</body>

</html>
