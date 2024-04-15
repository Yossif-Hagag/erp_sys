<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>عروض الأسعار || العربي جروب</title>
    <link rel="shortcut icon" href="./assets/elarby group logo.jpg" type="image/x-icon" />

    <!-- Importing fontawesome library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- Importing Bootstrap library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css"
        integrity="sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">


    <!-- Importing 'Cairo' Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('files/stocks.css') }}" />
</head>

<body>
    <table class="table table-striped text-center">
        <thead>
            <tr>
                <th scope="col">رقم</th>
                <th scope="col">إسم العميل</th>
                <th scope="col">عرض السعر</th>
                <th scope="col">العنوان</th>
                <th scope="col">التاريخ</th>
                <th scope="col">السعر</th>
                <th scope="col">تم التسعير</th>
            </tr>
        </thead>
        <tbody id="data-body">
            @foreach ($quotations as $q)
                <tr>
                    <td>{{ $x++ }}</td>
                    <td>{{ $q->client }}</td>
                    <td>
                        @if ($q->quotation_file != null)
                            <a class="btn btn-sm collection text-primary"
                                href="{{ asset('storage/' . $q->quotation_file) }}" target="_blank" type="button"><i
                                    class="fa-solid fa-search"></i></a>
                        @endif
                    </td>
                    <td>{{ $q->address }}</td>
                    <td>{{ $q->created_at }}</td>
                    <td>{{ $q->price }}</td>
                    <td>
                        @if ($q->price != null || $q->price != 0)
                            <button class="btn btn-sm">
                                <i class="fa-solid text-primary fa-check"></i>
                            </button>
                        @else
                            <button class="btn btn-sm" data-bs-toggle="modal"
                                data-bs-target="#pricing{{ $q->id }}">
                                <i class="fa-solid fa-hand-holding-dollar text-primary"></i>
                            </button>
                        @endif
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-around align-items-center mt-4">
        <a type="button" id="" href="{{ route('quotations') }}" class="btn btn-dark p-2">رجوع</a>
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
