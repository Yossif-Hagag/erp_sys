@foreach ($suppliers as $supplier)
@foreach ($supplier->scraps as $scrap)
    <!-- <div class="col-md-12 purchas_tabel"> -->
    <tr>
        <td> {{ $x++ }}</td>
        <td> {{ $scrap->pro_num }}</td>
        <td> {{ $scrap->pro_name }}</td>
        <td> {{ $scrap->quantity }} </td>
        <td> {{ $scrap->price }} </td>
        <td> {{ $supplier->name }} </td>
        <td> {{ $supplier->phone }} </td>
        <td> {{ $supplier->address }} </td>
        <td>{{ $scrap->created_at }}</td>
        @if ($scrap->pay == 0)
            <td>
                <button type="button" id=""
                    class="btn btn-sm btn-success py-0 px-1" data-bs-toggle="modal"
                    data-bs-target="#{{ $scrap->id }}colmodal">سداد</button>

                <div class="modal fade" id="{{ $scrap->id }}colmodal"
                    tabindex="-1" aria-labelledby="colmodalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div
                                class="modal-body d-flex justify-content-between lead">
                                <p>هل أنت متأكد من التحصيل</p>
                                <button type="button" class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-footer">
                                <form
                                    action="{{ route('collect_scrap', $scrap->id) }}"method="POST">
                                    @csrf
                                    <button type="submit" id="collect_scrap"
                                        class="lh-1 p-2 btn btn-sm btn-primary">نعم
                                        متأكد</button>
                                </form>
                                <button type="button"
                                    class="btn btn-danger lh-1 p-2 btn btn-sm"
                                    data-bs-dismiss="modal">إلغاء</button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        @elseif($scrap->pay == 1)
            <td><i class='fa-solid fa-check' style='color: #00803e;'></i></td>
        @endif
        {{-- <td>{{ $scrap->updated_at }}</td> --}}
        <td>
            <button type="button" class="btn btn-sm collection text-success btnsell"
                data-bs-toggle="modal"
                data-bs-target="#modalsell{{ $scrap->id }}"><i
                    class="fa-solid fa-dollar"></i></button>
        </td>
        <td>
            <a type="button" id="edt_scrap"
                href="{{ route('edt_scrap', [$supplier->id, $scrap->id]) }}"
                class="btn btn-sm collection text-primary"><i
                    class="fa-solid fa-edit"></i></a>
        </td>
        <!-- </tr> -->
        <!-- modalsell -->
        <div class="modal fade" id="modalsell{{ $scrap->id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="alerting_modal"></div>
                    {{-- <div class="bg-danger d-flex justify-content-center text-white">Pro ID ::
                {{ $scrap->id }}</div> --}}

                    <div class="modal-header">
                        <h5 class="modal-title">بيع المنتج</h5>
                        <button type="button" class="m-0 btn-close fw-bold"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="addsales">
                            <form class="row g-3" method="post"
                                action="{{ route('send_scrap_sales', [$supplier->id, $scrap->id]) }}">
                                @csrf
                                <div class="row g-3">
                                    <div class="col">
                                        <input type="number" name="number_of_product"
                                            class="form-control mt-3 mb-3 sellamount"
                                            placeholder="عدد المنتج" aria-label=""
                                            required>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col">
                                        <input type="number" name="sell_price"
                                            class="form-control mb-3"
                                            placeholder="سعر البيع" aria-label=""
                                            required>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col">
                                        <input type="text" name="buyer_name"
                                            class="form-control mb-3"
                                            placeholder="اسم المشتري" aria-label=""
                                            required>
                                    </div>

                                    <div class="col">
                                        <input type="number" name="seller_phone"
                                            class="form-control mb-3"
                                            placeholder="رقم المشتري" aria-label=""
                                            required>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col">
                                        <input type="text" name="buyer_address"
                                            class="form-control mb-3"
                                            placeholder="عنوان المشتري" aria-label=""
                                            required>
                                    </div>
                                </div>
                                <div
                                    class="modal-footer d-flex justify-content-between">
                                    <div class="form-check">
                                        <input type="checkbox" name="all"
                                            class="form-check-input checkboxsell"
                                            id="checkboxsell{{ $scrap->quantity }}"
                                            value="{{ $scrap->quantity }}"
                                            aria-label="">
                                        <label
                                            for="checkboxsell{{ $scrap->quantity }}"
                                            class="form-check-label">الكل</label>
                                    </div>

                                    <div>
                                        <button type="submit" class="btn btn-primary"
                                            name="button_add_submit">بيع</button>
                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">إغلاق</button>
                                    </div>
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