<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>إضافة عميل جديد || العربي جروب</title>
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
                إضافة عميل جديد
            </div>
            <div class="col"></div>
            <div class="col text-start">
                <!-- Start Messages Section -->
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
                <!-- Start Messages Section -->
            </div>
        </div>
        <!-- End Navbar -->

        <div class="content-body row m-0">
            <!-- Start Sidebar -->
           {{ view('sidebar') }}
            <!-- End Sidebar -->

            <!-- Start Content -->
            <div class="content col-10 flex-column d-flex overflow-y-scroll h-100">
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
                @if($errors->count() > 0)
                @foreach($errors->all() as $error)
                <div class="alert alert-dismissible alert-danger align-items-center h3em d-flex fade justify-content-between m-2 show"
                    role="alert">
                    <svg class="bi flex-shrink-0 me-2 w-7 h-7" role="img" aria-label="Danger:">
                        <use xlink:href="#check-circle-fill" />
                    </svg>
                    <div>{{$error}}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endforeach
                @endif
                <div class="content col-10 pb-5 overflow-hidden mx-auto">
                    <form
                     action="{{ route('store_agent') }}" 
                      method="POST" enctype="multipart/form-data"
                      class="w-50 h-auto mx-auto rounded-4 overflow-hidden p-4 text-center pt-5 mt-5"
                    >
                    @csrf
                      <div class="mb-5 text-end">
                        <label for="client-name" class="form-label">أسم العميل</label>
                        <input type="text" class="form-control" id="client-name" name="name" required/>
                      </div>
                      <div class="mb-5 d-inline-block w-100 text-end">
                        <label for="client-address" class="form-label">العنوان</label>
                        <input type="text" class="form-control" id="client-address" name="address" required/>
                      </div>
                      <div class="mb-5 d-inline-block w-100 text-end">
                        <label for="client-phone" class="form-label">رقم الهاتف</label>
                        <input type="number" class="form-control" id="client-phone" name="phone"required/ >
                      </div>
                      <div class="mb-5 d-inline-block w-100 text-end">
                        <label for="client-email" class="form-label"
                          >البريد الالكتروني</label
                        >
                        <input type="email" class="form-control" id="client-email" name="email" required/>
                      </div>
                      <div class="mb-5 d-inline-block w-100 text-end">
                        <label for="accepted-offer" class="form-label"
                          >عرض السعر الموافق عليه</label
                        >
                        <input type="file" class="form-control" id="accepted-offer"  name = "price_offer" required/>
                      </div>
                      <button
                        type="submit"
                        class="btn btn-danger btn-lg"
                        onclick="submitted()"
                      >
                        إضافة
                        <i class="fa-solid fa-plus me-1" style="color: #ffffff"></i>
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
    {{-- <!-- <script src="{{asset('files/addProduct.js')}}"></script> --> --}}
    <script>
        $('a').each(function() {$(this).removeClass('active-page')});
        $('#agents').addClass('active-page');
    </script>
</body>

</html>