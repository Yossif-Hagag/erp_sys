@foreach ($quotations as $q)
    <tr>
        <td>{{ $x++ }}</td>
        <td>{{ $q->client }}</td>
        <td>
            @if ($q->quotation_file != null)
                <a class="btn btn-sm collection text-primary" href="{{ asset('storage/' . $q->quotation_file) }}"
                    target="_blank" type="button"><i class="fa-solid fa-search"></i></a>
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
                <button class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#pricing{{ $q->id }}">
                    <i class="fa-solid fa-hand-holding-dollar text-primary"></i>
                </button>

                <div class="modal fade" id="pricing{{ $q->id }}" tabindex="-1" aria-labelledby="colmodalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header d-flex justify-content-between lead">
                                <p>تسعـير العرض</p>
                                <button type="button" class="btn-close m-0" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('pricing', $q->id) }}"method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        {{-- <label for="price" class="form-label">السعر</label> --}}
                                        <input type="number" class="form-control" id="price" name="price_add"
                                            placeholder="السعر" required />
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" id="pricing"
                                        class="lh-1 p-2 btn btn-sm btn-primary">حفظ</button>
                                    <button type="button" class="btn btn-danger lh-1 p-2 btn btn-sm"
                                        data-bs-dismiss="modal">إلغاء</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </td>
        <td>
            <button class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#agree{{ $q->id }}">
                <i class="fa-solid text-primary fa-truck-fast"></i>
            </button>
            @if ($q->price != null || $q->price != 0)
                <div class="modal fade" id="agree{{ $q->id }}" tabindex="-1" aria-labelledby="colmodalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body d-flex justify-content-between lead">
                                <p>هل أنت متأكد من الموافقة</p>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('agree', $q->id) }}"method="POST">
                                    @csrf
                                    <button type="submit" id="collect_scrap"
                                        class="lh-1 p-2 btn btn-sm btn-primary">نعم
                                        متأكد</button>
                                </form>
                                <button type="button" class="btn btn-danger lh-1 p-2 btn btn-sm"
                                    data-bs-dismiss="modal">إلغاء</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </td>
        <td>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-sm" data-bs-toggle="modal"
                data-bs-target="#editFirstOffer{{ $q->id }}">
                <i class="fa-solid text-primary fa-edit"></i>
            </button>

            <!-- Modal -->
            <div class="modal fade" id="editFirstOffer{{ $q->id }}" tabindex="-1"
                aria-labelledby="editFirstOfferLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editFirstOfferLabel">
                                تعديل عرض السعر
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" style="margin-right: 18rem"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="text-end" action="{{ route('update_quotation', $q->id) }}"
                                enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="client" class="form-label">اسم
                                        العميل</label>
                                    <input type="text" class="form-control" id="client" name="client" required
                                        value="{{ old('client', $q->client) }}" />
                                </div>
                                <div class="mb-3">
                                    <label for="clientAddress" class="form-label">العنوان</label>
                                    <input type="text" class="form-control" id="clientAddress" name="address"
                                        required value="{{ old('address', $q->address) }}" />
                                </div>
                                <div class="mb-3">
                                    <label for="priceOffer" class="form-label">عرض
                                        السعر</label>
                                    <input type="file" class="form-control" id="priceOffer" name="quotation_file"
                                        value="{{ old('quotation_file', $q->quotation_file) }}" />
                                </div>
                                <div class="mb-4 d-block">
                                    <label for="" class="form-label">عرض السعر
                                        المحفوظ<span class="text-danger">*</span></label>
                                    @if (isset($q->quotation_file))
                                        <a href="{{ asset('storage/' . $q->quotation_file) }}" target="_blank"
                                            class="form-control text-bg-secondary text-decoration-none">{{ substr($q->quotation_file, 11) }}</a>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">السعر</label>
                                    <input type="number" class="form-control" id="price" name="price"
                                        value="{{ old('price', $q->price) }}" />
                                </div>
                                <button type="submit" class="btn btn-dark w-100 mt-3">
                                    تعديل
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </td>
    </tr>
@endforeach
