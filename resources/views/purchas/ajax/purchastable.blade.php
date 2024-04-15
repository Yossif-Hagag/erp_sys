@foreach ($purchas as $p)
    <tr>
        <td>{{ $x++ }}</td>
        <td>
            <a class="btn btn-sm collection text-primary" href="{{ asset('storage/' . $p->supply_file) }}" target="_blank"
                type="button"><i class="fa-solid fa-search"></i></a>
        </td>
        <td>{{ $p->num_of_products }}</td>
        <td>{{ $p->total_price }}</td>
        <td>
            <a type="button" id="edt_product" data-bs-toggle="modal" data-bs-target="#edt_product{{ $p->id }}"
                class="btn btn-sm collection text-primary lh-1 p-2"><i class="fa-solid fa-edit"></i></a>

            <!-- Modal -->
            <div class="modal fade" id="edt_product{{ $p->id }}" data-bs-backdrop="static"
                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">
                                تعديل
                            </h5>
                            <button type="button" class="btn-close m-0" style="margin-right: 18.65rem"
                                data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-end">
                            <form method="post" action="{{ route('update_purchas', $p->id) }}"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label" for="item-img">ملف
                                        التوريدة</label>
                                    <input type="file" class="form-control" id="item-img" name="supply_file"
                                        value="{{ old('supply_file', $p->supply_file) }}" />
                                </div>
                                <div class="mb-4 d-block">
                                    <label for="" class="form-label">عرض مرفق ال ملف التوريدة المحفوظ <span
                                            class="text-danger">*</span></label>
                                    @if (isset($p->supply_file))
                                        <a href="{{ asset('storage/' . $p->supply_file) }}" target="_blank"
                                            class="form-control text-bg-dark text-decoration-none">{{ substr($p->supply_file, 3) }}</a>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="product-name" class="form-label">عدد
                                        المنتجات</label>
                                    <input type="number" class="form-control" id="product-name" name="num_of_products"
                                        value="{{ old('num_of_products', $p->num_of_products) }}" />
                                </div>
                                <div class="mb-3">
                                    <label for="supply-price" class="form-label">إجمالي
                                        السعر</label>
                                    <input type="number" class="form-control" id="supply-price" name="total_price"
                                        value="{{ old('total_price', $p->total_price) }}" />
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    تعديل
                                </button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                إنهاء
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Popup Form-->


        </td>
    </tr>
@endforeach
