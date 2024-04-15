<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>تعديل التوريدات الثابتة || العربي جروب</title>
  <link rel="shortcut icon" href="./assets/product.jpg" type="image/x-icon" />

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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

</head>

<body>
  <!-- Start Body Home -->
  <div class="home overflow-hidden">
    <!-- Start Navbar -->
    <div class="navbar row m-0 text-white fs-5 px-2">
      <div class="col-3">
        <i class="fa-solid fa-bars ms-2 text-white"></i>
        تعديل التوريدات الثابتة
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

    <div class="content-body row m-0">
      <!-- Start Sidebar -->
      {{ view('sidebar') }}
      <!-- End Sidebar -->

      <!-- Start Content -->
      <div class="content col-10 flex-column d-flex py-5 overflow-y-scroll h-100">
        <div id="edtproduct">
          @if (Session::has('done'))
          <div
            class="alert alert-dismissible alert-success align-items-center h3em d-flex fade justify-content-between m-2 show"
            role="alert">
            <div>{{ Session::get('done') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif
          @if (Session::has('edtdone'))
          <div
            class="alert alert-dismissible alert-success align-items-center h3em d-flex fade justify-content-between m-2 show"
            role="alert">
            <div>{{ Session::get('edtdone') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif
          @if($errors->count() > 0)
          @foreach($errors->all() as $error)
          <div
            class="alert alert-dismissible alert-danger align-items-center h3em d-flex fade justify-content-between m-2 show"
            role="alert">
            <svg class="bi flex-shrink-0 me-2 w-7 h-7" role="img" aria-label="Danger:">
              <use xlink:href="#check-circle-fill" />
            </svg>
            <div>{{$error}}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endforeach
          @endif
          <form method="POST" action="{{route('update_fixed_supplies',$fixed_supplies->id)}}"
            class="w-25 mx-auto rounded-4 p-4 text-center">
            @csrf
            <div class="mb-3">
              <label for="pro_num" class="form-label fs-4 mb-5"><i class="fa-solid fa-edit"></i>  تعديل التوريدات الثابتة</label>
              {{-- <select class="form-select" id="pro_num" aria-label="Default select example" name="pro_num" required>
                  <option value="{{old('pro_num', $fixed_supplies->pro_num)}} " >اختر</option>
                  @foreach ($products as $product)
                  <option value="{{$product->code}}">{{$product->name}}</option>
                  @endforeach
              </select> --}}
              <select class="form-select w-100 mb-4 select2" id="pro_num" aria-label="Default select example" name="pro_num" required>
                <option value="">اختر</option>
                @foreach ($products as $product)
                    <option value="{{ $product->code }}" @if(old('pro_num', $fixed_supplies->pro_num) == $product->code) selected @endif>{{ $product->name }}</option>
                @endforeach
            </select>
          </div>
           
            <div class="mb-4 text-end">
                            <label for="number_of_product" class="form-label">
                              <span class="text-danger">*</span>
                              عدد المنتج
                            </label>
                    <input type="number" name="number_of_product"
                        class="form-control mb-3"
                        placeholder="عدد المنتج" aria-label=""  value="{{ old('number_of_product', $fixed_supplies->number_of_product) }}"

                        required>
            </div>
            <div class="mb-4 text-end">
              <label for="sell_price" class="form-label">
                <span class="text-danger">*</span>
                سعر البيع
              </label>
      <input type="number" name="sell_price"
                        class="form-control mb-3"
                        placeholder="سعر البيع" aria-label="" value="{{ old('sell_price', $fixed_supplies->sell_price) }}"
                        required>
            </div>
            <div class="mb-4 text-end">
              <label for="buy_price" class="form-label">
                <span class="text-danger">*</span>
                سعر الشراء
              </label>
      <input type="number" name="buy_price"
                        class="form-control mb-3"
                        placeholder="سعر الشراء" aria-label="" value="{{ old('buy_price', $fixed_supplies->buy_price) }}"
                        required>
            </div>
      
                <button type="submit" class="btn btn-primary w-100 my-4"
                    name="button_add_submit">تعديل <i class="fa-solid fa-edit"></i></button>
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
  <script src="{{ asset('files/editProduct.js') }}"></script>
  <script src="{{ asset('files/script.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        $('a').each(function() {
            $(this).removeClass('active-page')
        });
        $('#agents').addClass('active-page');
        $(document).ready(function() {
        $('#pro_num').select2({
            placeholder: "اختر المنتج",
            allowClear: true,
            language: "ar"
        });
        });
    </script>
</body>

</html>