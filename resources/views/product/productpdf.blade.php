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

    <table class="table table-striped text-center" style="width: 100%">
        <thead>
            <tr>
                <th scope="col">رقم</th>
                <th scope="col">كود</th>
                <th scope="col">اسم</th>
                <th scope="col">الكمية</th>
                {{-- <th scope="col">صورة المنتج</th> --}}
                <th scope="col">سعر التوريد</th>
                <th scope="col">اسم المورد</th>
                <th scope="col">تليفون المورد</th>
                <th scope="col">عنوان المورد</th>
                <!-- <th scope="col">تاريخ الاضافة</th> -->
                <th scope="col">اخر تحديث </th>
            </tr>
        </thead>
        <tbody id="data-body">
            @foreach ($suppliers as $supplier)
            @foreach ($supplier->products as $product)
            <!-- <div class="col-md-12 purchas_tabel"> -->
            <tr>
                <td> {{ $x++ }}</td>
                <td> {{ $product->pro_num }}</td>
                <td> {{ $product->pro_name }}</td>
                <td> {{ $product->number_of_product }} </td>
                <td> {{ $product->price }} </td>
                <td> {{ $supplier->name }} </td>
                <td> {{ $supplier->phone }} </td>
                <td> {{ $supplier->address }} </td>
                <!-- <td>{{ $product->created_at }}</td> -->
                <td>{{ $product->updated_at }}</td>
            </tr>
            <!-- </div><br><br> -->
            @endforeach
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-around align-items-center mt-4">
        <a type="button" id="" href="{{route('product')}}"
            class="btn btn-dark p-2">رجوع</a>
    </div>


    <script src="{{ asset('js/jq/jq.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"
        integrity="sha512-3dZ9wIrMMij8rOH7X3kLfXAzwtcHpuYpEgQg1OA4QAob1e81H8ntUQmQm3pBudqIoySO5j0tHN4ENzA6+n2r4w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>



    <script>window.print();</script>

    <body>

</html>