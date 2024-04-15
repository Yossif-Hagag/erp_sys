<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>إدارة تشغيل المشتريات || العربي جروب</title>
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
    <link rel="stylesheet" href="{{ asset('files/operatingStock.css') }}" />
</head>

<body>

    <table class="table table-striped text-center">
        <thead>
            <tr>
                {{-- <th scope="col">نوع العملية</th> --}}
                <th scope="col">مستند العملية</th>
                <th scope="col">العميل</th>
                <th scope="col">العنوان</th>
                <th scope="col">تاريخ العملية</th>
                <th scope="col">التكلفة</th>
            </tr>
        </thead>
        <tbody id="data-body">
            @foreach ($OperationgPurchas as $op_purchas)
                <tr>
                    {{-- <td>{{ $op_purchas->operation_type }}</td> --}}
                    <td>
                        <a class="btn btn-sm collection text-primary"
                            href="{{ asset('storage/' . $op_purchas->operation_document) }}" target="_blank"
                            type="button"><i class="fa-solid fa-search"></i></a>
                    </td>
                    <td>{{ $op_purchas->client_name }}</td>
                    <td>{{ $op_purchas->address }}</td>
                    <td>{{ $op_purchas->created_at }}</td>
                    <td>{{ $op_purchas->cost }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-around align-items-center mt-4">
        <a type="button" id="" href="{{ route('operation_purchas') }}" class="btn btn-dark p-2">رجوع</a>
    </div>


    <script src="{{ asset('js/jq/jq.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"
        integrity="sha512-3dZ9wIrMMij8rOH7X3kLfXAzwtcHpuYpEgQg1OA4QAob1e81H8ntUQmQm3pBudqIoySO5j0tHN4ENzA6+n2r4w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>



    <script>
        window.print();
    </script>

    <body>

</html>
