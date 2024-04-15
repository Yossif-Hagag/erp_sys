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
            <td>{{ $product->created_at }}</td>
            {{-- <td>{{ $product->updated_at }}</td> --}}
            <td>
                <button type="button" class="btn btn-sm collection text-success" data-bs-toggle="modal"
                    data-bs-target="#modalsell{{ $product->id }}"><i class="fa-solid fa-dollar"></i></button>
            </td>
            <td> <button type="button" class="btn btn-sm collection text-danger" data-bs-toggle="modal"
                    data-bs-target="#modal{{ $product->id }}"><i class="fa-solid fa-truck-ramp-box"></i></button>
            </td>
            <td>
                <a type="button" id="edt_product" href="{{ route('edt_product', [$supplier->id, $product->id]) }}"
                    class="btn btn-sm collection text-primary"><i class="fa-solid fa-edit"></i></a>
            </td>
            <!-- </tr> -->
            <!-- modal -->
            <div class="modal fade" id="modal{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        {{-- <div class="bg-danger d-flex justify-content-center text-white">Pro ID ::
                                                {{ $product->id }}</div> --}}

                        <div class="modal-header">
                            <h5 class="modal-title">ارسال المنتج للتأجير</h5>
                            <button type="button" class="m-0 btn-close fw-bold" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="">
                                <form class="row g-3" method="post"
                                    action="{{ route('send_stock_rental', [$product->id, $supplier->id]) }}">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col">
                                            <input type="number" name="number_of_product"
                                                class="form-control mt-3 mb-3" placeholder="عدد المنتج" aria-label=""
                                                required>
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col">
                                            <input type="number" name="rent_price" class="form-control mb-3"
                                                placeholder="سعر التأجير" aria-label="" required>
                                        </div>
                                        <div class="col">
                                            <input type="number" name="rent_period" class="form-control mb-3"
                                                placeholder="فتره التأجير باليوم" aria-label="" required>
                                        </div>
                                    </div>

                                    <div class="row g-3">
                                        <div class="col">
                                            <input type="text" name="Tenant_name" class="form-control mb-3"
                                                placeholder="اسم المستأجر" aria-label="" required>
                                        </div>

                                        <div class="col">
                                            <input type="number" name="Tenant_phone" class="form-control mb-3"
                                                placeholder="رقم المستأجر" aria-label="" pattern="^\d{11}$" required>
                                        </div>
                                    </div>

                                    <div class="row g-3">
                                        <div class="col">
                                            <input type="text" name="Tenant_address" class="form-control mb-3"
                                                placeholder="عنوان المستأجر" aria-label="" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary"
                                            name="button_add_submit">إرسال</button>
                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">إغلاق</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal -->
            <!-- modalsell -->
            <div class="modal fade" id="modalsell{{ $product->id }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="alerting_modal"></div>
                        {{-- <div class="bg-danger d-flex justify-content-center text-white">Pro ID ::
                                                {{ $product->id }}</div> --}}

                        <div class="modal-header">
                            <h5 class="modal-title">بيع المنتج</h5>
                            <button type="button" class="m-0 btn-close fw-bold" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="addsales">
                                <form class="row g-3" method="post"
                                    action="{{ route('send_stock_sales', [$supplier->id, $product->id]) }}">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col">
                                            <input type="number" name="number_of_product"
                                                class="form-control mt-3 mb-3" placeholder="عدد المنتج"
                                                aria-label="" required>
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col">
                                            <input type="number" name="sell_price" class="form-control mb-3"
                                                placeholder="سعر البيع" aria-label="" required>
                                        </div>
                                    </div>

                                    <div class="row g-3">
                                        <div class="col">
                                            <input type="text" name="buyer_name" class="form-control mb-3"
                                                placeholder="اسم المشتري" aria-label="" required>
                                        </div>

                                        <div class="col">
                                            <input type="number" name="seller_phone" class="form-control mb-3"
                                                placeholder="رقم المشتري" aria-label="" required>
                                        </div>
                                    </div>

                                    <div class="row g-3">
                                        <div class="col">
                                            <input type="text" name="buyer_address" class="form-control mb-3"
                                                placeholder="عنوان المشتري" aria-label="" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary"
                                            name="button_add_submit">بيع</button>
                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">إغلاق</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modalsell -->
        </tr>
        <!-- </div><br><br> -->
    @endforeach
@endforeach
