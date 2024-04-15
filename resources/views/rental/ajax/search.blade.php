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
        <!-- <td>{{ $p->updated_at }}</td> -->
        {{-- <td>
        @if ($p->store_name === 'stock')
            المخزن
        @elseif ($p->store_name === 'purchas')
            المشتريات
        @endif
    </td> --}}
        <td>
            @if ($p->store_name === 'stock')
                <a type="button" class="btn btn-sm collection text-danger back-to-stock" id="back"
                    href="{{ route('back-to-stock', $p->id) }}"><i class="fa-solid fa-warehouse"></i></a>
                {{-- @elseif ($p->store_name === 'purchas')
            <a type="button"
                class="btn btn-sm collection text-primary back-to-purchas"
                href="{{ route('back-to-purchas', $p->id) }}"><i
                    class="fa-solid fa-cart-shopping"></i></a> --}}
            @endif
        </td>
        <td>
            <a type="button" id="edt_rental" href="{{ route('edt_rental', $p->id) }}"
                class="btn btn-sm collection text-primary"><i class="fa-solid fa-edit"></i></a>
        </td>
        <div class="modal fade" id="modal11{{ $p->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    {{-- <div class="bg-danger d-flex justify-content-center text-white">Pro ID ::
                {{ $p->id }}</div> --}}
                    <div class="modal-header">
                        <h5 class="modal-title">ارسال المنتج الى المخزن</h5>
                        <button type="button" class="m-0 btn-close fw-bold" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="send_to_rent">
                            <form class="row g-3" method="post" action="{{ route('send-to-stock', $p->id) }}">
                                @csrf
                                <div class="row g-3">
                                    <div class="col">
                                        <input type="number" name="number_of_product" class="form-control mt-3 mb-3"
                                            placeholder="عدد المنتج" aria-label="" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary"
                                        name="button_add_submit">تخزين</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">إغلاق</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </tr>
@endforeach
