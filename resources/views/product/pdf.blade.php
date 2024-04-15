<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>المخزن || العربي جروب</title>
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
            <!-- Start Content -->
            <div class="content col-10 flex-column align-items-center d-flex  justify-content-between p-0 overflow-y-scroll h-100 flex-column">
                <div class="alerting">
                    @if(session()->has('error'))
                    <div class="alert alert-dismissible alert-danger align-items-center h3em d-flex fade justify-content-between m-2 show"
                        role="alert">
                        <svg class="bi flex-shrink-0 me-2 w-7 h-7" role="img" aria-label="Danger:">
                            <use xlink:href="#check-circle-fill" />
                        </svg>
                        <div>{{ session()->get('error') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    @if(session()->has('done'))
                    <div class="alert alert-dismissible alert-success align-items-center h3em d-flex fade justify-content-between m-2 show"
                        role="alert">
                        <svg class="bi flex-shrink-0 me-2 w-7 h-7" role="img" aria-label="Success:">
                            <use xlink:href="#check-circle-fill" />
                        </svg>
                        <div>{{ session()->get('done') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                </div>
                <div class="alerting">
                    @if(session()->has('wrong'))
                    <div class="alert alert-dismissible alert-danger align-items-center h3em d-flex fade justify-content-between m-2 show"
                        role="alert">
                        <svg class="bi flex-shrink-0 me-2 w-7 h-7" role="img" aria-label="Danger:">
                            <use xlink:href="#check-circle-fill" />
                        </svg>
                        <div>{{ session()->get('wrong') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    @if(session()->has('okay'))
                    <div class="alert alert-dismissible alert-success align-items-center h3em d-flex fade justify-content-between m-2 show"
                        role="alert">
                        <svg class="bi flex-shrink-0 me-2 w-7 h-7" role="img" aria-label="Success:">
                            <use xlink:href="#check-circle-fill" />
                        </svg>
                        <div>{{ session()->get('okay') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                </div>
                <!-- Start buttons -->
                <div class="buttons position-relative row m-0 py-3">
                    <div class="col-4">
                        <div class="wrap w-75">
                            <input type="text" id="search-product" placeholder="Search products...">
                            <ul id="search-results"></ul>
                        </div>
                    </div>
                    <!-- Start Popup Form -->
                    <!-- Button trigger modal -->
                    <div class="col-8 text-start">
                        <a id="add_product" href="{{route('add_product')}}" class="btn btn-dark"
                            data-bs-target="#staticBackdrop">
                            <i class="fa-solid fa-plus"></i>
                            إضافة منتج جديد
                        </a>
                    </div>
                    <button id="download-pdf" class="btn btn-primary">تحميل كملف PDF</button>
                </div>

                <!-- End Buttons -->
                <!-- Start Data -->
                <div class="table-data pe-1 h-auto">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                               
                                <th scope="col">كود</th>
                                <th scope="col">اسم</th>
                                <th scope="col">الكمية</th>
                                {{-- <th scope="col">صورة المنتج</th> --}}
                                <th scope="col">سعر التوريد</th>
                                <th scope="col">اسم المورد</th>
                                <th scope="col">تليفون المورد</th>
                                <th scope="col">عنوان المورد</th>
                                <th scope="col">تاريخ الاضافة</th>
                                <!-- <th scope="col">اخر تحديث </th> -->
                              
                                {{-- <th scope="col">حذف</th> --}}
                            </tr>
                        </thead>
                        <tbody id="data-body">
                            @foreach ($suppliers as $supplier)
                            @foreach ($supplier->products as $product)
                            <!-- <div class="col-md-12 purchas_tabel"> -->
                            <tr>
                                
                                <td> {{ $product->pro_num }}</td>
                                <td> {{ $product->pro_name }} </td>
                                <td> {{ $product->number_of_product }} </td>
                                <td> {{ $product->price }} </td>
                                <td> {{ $supplier->name }} </td>
                                <td> {{ $supplier->phone }} </td>
                                <td> {{ $supplier->address }} </td>
                                <td>{{ $supplier->created_at }}</td>
                                <!-- <td>{{ $supplier->updated_at }}</td> -->
                              
                             
                                <!-- </tr> -->
                                <!-- modal -->
                                
                                
                                <!-- end modalsell -->
                            </tr>
                            <!-- </div><br><br> -->
                            @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
 


</body>

</html>