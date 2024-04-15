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
    <table class="table table-striped text-center">
        <thead>
            <tr>
                <th scope="col">مسلسل</th>
                <th scope="col">إسم المنتج</th>
                <th scope="col">الكود</th>
                <th scope="col">الموردين</th>
            </tr>
        </thead>
        <tbody id="data-body">

            @foreach ($catalogues as $catalogue)
            <tr>

                <td> {{ $x++ }}</td>
                <td> {{ $catalogue->name }}</td>
                <td> {{ $catalogue->code }}</td>

                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-sm" data-bs-toggle="modal"
                        data-bs-target="#suppliers{{ $catalogue->code }}">
                        <i class="fa-solid fa-search text-primary"></i>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="suppliers{{ $catalogue->code }}" tabindex="-1"
                        aria-labelledby="suppliersLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h5>
                                        @if ($catalogue->suppliers)
                                            {{ $catalogue->suppliers }}
                                        @else
                                            لا يوجد بيانات . . .
                                        @endif
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>

            </tr>
            @endforeach

        </tbody>
    </table>

    <div class="d-flex justify-content-around align-items-center mt-4">
        <a type="button" id="" href="{{route('catalogue')}}" class="btn btn-dark p-2">رجوع</a>
    </div>


    <!-- Importing Scripts -->
    <script src="{{ asset('js/jq/jq.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"
        integrity="sha512-3dZ9wIrMMij8rOH7X3kLfXAzwtcHpuYpEgQg1OA4QAob1e81H8ntUQmQm3pBudqIoySO5j0tHN4ENzA6+n2r4w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>window.print();</script>

</body>

</html>