<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>التأجير || العربي جروب</title>
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
    <link rel="stylesheet" href="{{ asset('files/renting.css') }}" />
</head>

<body>
    <table class="table table-striped text-center">
        <thead>
            <tr>
                <th scope="col">رقم</th>
                <th scope="col">كود</th>
                <th scope="col">اسم</th>
                <th scope="col">عدد المنتج</th>
                <th scope="col">سعر التوريد</th>
                <th scope="col">المستأجر</th>
                <th scope="col">تليفون المستأجر</th>
                <th scope="col">عنوان المستأجر</th>
                <th scope="col" class="small">فترة الإيجار باليوم</th>
                <th scope="col">سعر الإيجار</th>
                <th scope="col">تاريخ الإيجار</th>
            </tr>
        </thead>
        <tbody id="data-body">
            @foreach ($allData as $p)
                <tr>
                    <td>{{ $x++ }}</td>
                    <td>{{ $p->pro_num }}</td>
                    <td>{{ $p->pro_name }}</td>
                    <td>{{ $p->number_of_product }}</td>
                    <td>
                        @if ($p->store_name === 'stock')
                            {{ $p->pro_sup_price }}
                        @elseif ($p->store_name === 'purchas')
                            {{ $p->purchas_sup_price }}
                        @endif
                    </td>
                    <td>{{ $p->Tenant_name }}</td>
                    <td>{{ $p->Tenant_phone }}</td>
                    <td>{{ $p->Tenant_address }}</td>
                    <td>{{ $p->rent_period }}</td>
                    <td>{{ $p->rent_price }}</td>
                    <td>{{ $p->created_at }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-around align-items-center mt-4">
        <a type="button" id="" href="{{ route('rental') }}" class="btn btn-dark p-2">رجوع</a>
    </div>


    <!-- Importing Scripts -->
    <script src="{{ asset('js/jq/jq.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"
        integrity="sha512-3dZ9wIrMMij8rOH7X3kLfXAzwtcHpuYpEgQg1OA4QAob1e81H8ntUQmQm3pBudqIoySO5j0tHN4ENzA6+n2r4w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        window.print();
    </script>

</body>

</html>
