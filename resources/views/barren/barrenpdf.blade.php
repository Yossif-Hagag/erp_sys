<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>الجرد || العربي جروب</title>
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
    <link rel="stylesheet" href="{{ asset('files/barren.css') }}" />



</head>

<body>
    <!-- Start Body Home -->
    <div class="home overflow-hidden">

        <div class="row m-0">
            <!-- Start Content -->
            <div class="d-flex justify-content-center align-items-center col-md-12 mt-4 mb-4">
                <button type="button" id="" class="btn btn-outline-dark p-2 mx-3" onclick="window.print();">بعد مراجعة البيانات يرجى الضغط للطباعة</button>
                <a type="button" id="" href="{{ route('barren') }}" class="btn btn-sm btn-dark p-2">رجوع</a>
            </div>
            <div class="content col-12 d-flex p-0 overflow-y-scroll h-100 flex-column">
                <!-- Start Data -->
                <br>
                <div class="row">
                    <div class="col-md-6" id="sellBarChart">
                        {!! $sellChart->container() !!}
                    </div>
                    <div class="col-md-6">
                        {!! $sellPieChart->container() !!}
                    </div>
                </div>

                <br><br>
                <!-- start sell section -->
                <div class="d-flex justify-content-around align-items-center fs-4 fa font-monospace mb-2 pb-2">
                    <div class="text-bg-dark p-2 pb-3 rounded-bottom-4">البيع</div>
                </div>
                <div class="table-data pe-1 h-auto">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th scope="col">مسلسل</th>
                                <th scope="col">كود</th>
                                <th scope="col">اسم</th>
                                <th scope="col">الكمية</th>
                                {{-- <th scope="col">صورة المنتج</th> --}}
                                <th scope="col">سعر التوريد</th>
                                <th scope="col">سعر البيع</th>
                                <th scope="col">اسم المشتري</th>
                                <th scope="col">تليفون المشتري</th>
                                <th scope="col">عنوان المشتري</th>
                                <th scope="col">تاريخ الاضافة</th>
                                <!-- <th scope="col">اخر تحديث </th> -->
                                {{-- <th scope="col">تعديل</th> --}}
                                {{-- <th scope="col">حذف</th> --}}
                                <th scope="col">ربح العملية</th>
                            </tr>
                            <!-- <div class="d-flex justify-content-around align-items-center">
                                <div class="">لا يوجد عمليات بيع لهذا المنتج . . .</div>
                            </div> -->
                        </thead>
                        <tbody id="data-body">
                            @foreach ($sales as $s)
                                <!-- <div class="col-md-12 purchas_tabel"> -->
                                <tr>
                                    <td>{{ $x++ }}</td>
                                    <td> {{ $s->pro_num }}</td>
                                    <td> {{ $s->pro_name }} </td>
                                    <td> {{ $s->number_of_product }} </td>
                                    <td> {{ $s->supply_price }} </td>
                                    <td> {{ $s->sell_price }} </td>
                                    <td> {{ $s->seller }} </td>
                                    <td> {{ $s->seller_phone }} </td>
                                    <td> {{ $s->seller_address }} </td>
                                    <td>{{ $s->created_at }}</td>
                                    <!-- <td>{{ $s->updated_at }}</td> -->
                                    @if ($s->sell_price > $s->supply_price)
                                        <td class="text-bg-success">
                                            {{ $s->number_of_product * ($s->sell_price - $s->supply_price) }}</td>
                                    @elseif($s->sell_price < $s->supply_price)
                                        <td class="text-bg-danger">
                                            {{ $s->number_of_product * ($s->sell_price - $s->supply_price) }}</td>
                                    @endif
                                </tr>
                                <!-- </div><br><br> -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex align-items-center fw-bold" style="margin-right:1em;">
                    <div class="text-bg-success p-1 rounded fs-6"><span class="font-monospace">الربح الكلي :
                        </span>{{ $sum_sell_profit }}
                    </div>
                </div>
                <!-- end sell section -->


                <br><br>
                <div class="row">
                    <div class="col-md-6">
                        {!! $rentChart->container() !!}
                    </div>
                    <div class="col-md-6">
                        {!! $rentPieChart->container() !!}
                    </div>
                </div>


                <br><br>



                <!-- start rental section -->
                <div class="d-flex justify-content-around align-items-center fs-4 fa font-monospace mb-2 pb-2">
                    <div class="text-bg-dark p-2 pb-3 rounded-bottom-4">الإيجار</div>
                </div>
                <div class="table-data pe-1 h-auto">
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
                                <th scope="col">فترة الإيجار باليوم</th>
                                <th scope="col">سعر الإيجار</th>
                                <th scope="col">تاريخ الإيجار</th>
                                <!-- <th scope="col">اخر تحديث</th> -->
                                {{-- <th scope="col">المصدر</th> --}}
                                <th scope="col">ربح العملية</th>
                            </tr>
                        </thead>
                        <tbody id="data-body">
                            @foreach ($rentals as $p)
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
                                    {{-- <td>
                                        @if ($p->store_name === 'stock')
                                            المخزن
                                        @elseif ($p->store_name === 'purchas')
                                            المشتريات
                                        @endif
                                    </td> --}}
                                    <td class="text-bg-success align-middle">
                                        {{ $p->number_of_product * $p->rent_price }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex align-items-center fw-bold" style="margin-right:1em;">
                    <div class="text-bg-success p-1 rounded fs-6"><span class="font-monospace">الربح الكلي :
                        </span>{{ $sum_rent_price }}
                    </div>
                </div>
                <!-- end rental section -->


                <br><br>



                <!-- start product section -->
                <div class="d-flex justify-content-around align-items-center fs-4 fa font-monospace mb-2 pb-2">
                    <div class="text-bg-dark p-2 pb-3 rounded-bottom-4">المخزن</div>
                </div>
                <div class="table-data pe-1 h-auto">
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
                                    @if ($product->pro_num == $code)
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
                                    @endif
                                    <!-- </div><br><br> -->
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- end product section -->



                {{-- <br><br><br> --}}


{{-- 
                <!-- start purchas section -->
                <div class="d-flex justify-content-around align-items-center fs-4 fa font-monospace mb-2 pb-2">
                    <div class="text-bg-dark p-2 pb-3 rounded-bottom-4">المشتريات</div>
                </div>
                <div class="table-data pe-1 h-auto">
                    <table class="table table-striped text-center" id="" style="width: 100%">
                        <thead>
                            <tr>
                                <th scope="col">رقم</th>
                                <th scope="col">كود</th>
                                <!-- <th scope="col">صورة المنتج</th> -->
                                <th scope="col">اسم</th>
                                <th scope="col">عدد المنتج</th>
                                <th scope="col">السعر</th>
                                <th scope="col">اسم المورد</th>
                                <th scope="col">تليفون المورد</th>
                                <th scope="col">عنوان المورد</th>
                                <!-- <th scope="col">تاريخ الاضافة</th> -->
                                <th scope="col">اخر تحديث </th>
                            </tr>
                        </thead>
                        <tbody id="data-body">
                            @foreach ($items as $item)
                                @foreach ($item->purchas as $purchas)
                                    @if ($purchas->pro_num == $code)
                                        <tr>
                                            <td>{{ $x++ }}</td>
                                            <td>{{ $purchas->pro_num }}</td>
                                            <td>{{ $purchas->pro_name }}</td>
                                            <td>{{ $purchas->number_of_product }}</td>
                                            <td>{{ $purchas->price }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>{{ $item->address }}</td>
                                            <!-- <td>{{ $purchas->created_at }}</td> -->
                                            <td>{{ $purchas->updated_at }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- end purchas section -->
 --}}


                <br><br><br>



                <!-- start scrap section -->
                <div class="d-flex justify-content-around align-items-center fs-4 fa font-monospace mb-2 pb-2">
                    <div class="text-bg-dark p-2 pb-3 rounded-bottom-4">سكراب</div>
                </div>
                <div class="table-data pe-1 h-auto">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>

                                <th scope="col">رقم</th>
                                <th scope="col">كود</th>
                                <th scope="col">اسم</th>
                                <th scope="col">الكمية</th>
                                <th scope="col">سعر التوريد</th>
                                <th scope="col">اسم المورد</th>
                                <th scope="col">تليفون المورد</th>
                                <th scope="col">عنوان المورد</th>
                                <!-- <th scope="col">تاريخ الاضافة</th> -->
                                <th scope="col">اخر تحديث </th>
                            </tr>
                        </thead>
                        <tbody id="data-body">
                            @foreach ($suppliers_scraps as $supplier)
                                @foreach ($supplier->scraps as $scrap)
                                    <!-- <div class="col-md-12 purchas_tabel"> -->
                                    @if ($scrap->pro_num == $code)
                                        <tr>
                                            <td> {{ $x++ }}</td>
                                            <td> {{ $scrap->pro_num }}</td>
                                            <td> {{ $scrap->pro_name }}</td>
                                            <td> {{ $scrap->quantity }} </td>
                                            <td> {{ $scrap->price }} </td>
                                            <td> {{ $supplier->name }} </td>
                                            <td> {{ $supplier->phone }} </td>
                                            <td> {{ $supplier->address }} </td>
                                            <!-- <td>{{ $scrap->created_at }}</td> -->
                                            <td>{{ $scrap->updated_at }}</td>
                                        </tr>
                                        <!-- </div><br><br> -->
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- end scrap section -->

                <br><br><br>


                <!-- End Data -->
                
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

    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

    {!! $sellChart->script() !!}
    {!! $sellPieChart->script() !!}
    {!! $rentChart->script() !!}
    {!! $rentPieChart->script() !!}



</body>

</html>
