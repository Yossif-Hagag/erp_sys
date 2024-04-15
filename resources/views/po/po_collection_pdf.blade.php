<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>تحصيل ال PO || العربي جروب</title>
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
                <th scope="col">رقم</th>
                <th scope="col">مرفق ال PO</th>
                <th scope="col">العميل</th>
                <th scope="col">عرض السعر</th>
                <th scope="col">S/N</th>
                <th scope="col">القيمة</th>
                <th scope="col">تاريخ التحصيل</th>
                <th scope="col">تاريخ الإنشاء</th>
                <th scope="col">تحصيل</th>
                {{-- <th scope="col">تعديل</th> --}}
            </tr>
        </thead>
        <tbody id="data-body">
            @foreach ($pos as $po)
                <tr>
                    <td> {{ $x++ }}</td>
                    <td>
                        <a class="btn btn-sm collection text-primary"
                            href="{{ asset('storage/' . $po->po_file) }}" target="_blank"
                            type="button"><i class="fa-solid fa-search"></i></a>
                    </td>
                    <td>
                        @foreach ($agents as $agent)
                            @if ($agent->id == $po->from)
                                {{ $agent->name }}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        <a class="btn btn-sm collection text-primary"
                            href="{{ asset('storage/' . $po->sale_present_file) }}" target="_blank"
                            type="button"><i class="fa-solid fa-search"></i></a>
                    </td>
                    <td> {{ $po->snum }} </td>
                    <td class="small fw-bold"> {{ $po->po_value }} </td>
                    <td class="small"> {{ $po->collection_date }} </td>
                    <td class="small"> {{ $po->created_at }} </td>

                    @if ($po->status == 1)
                        <td><i class='fa-solid fa-check' style='color: #00803e;'></i></td>
                    @endif
                    {{-- <td>
                        <a type="button" id="edt_po" href="{{ route('edt_po', $po->id) }}"
                            class="lh-1 p-2 btn btn-sm btn-dark">تعديل</a>
                    </td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>


    
    <div class="d-flex justify-content-around align-items-center mt-4">
        <a type="button" id="" href="{{ route('po_collected') }}" class="btn btn-dark p-2">رجوع</a>
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
