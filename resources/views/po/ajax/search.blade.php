@foreach ($pos as $po)
    <tr>
        <td> {{ $x++ }}</td>
        <td>
            <a class="btn btn-sm collection text-primary" href="{{ asset('storage/' . $po->po_file) }}" target="_blank"
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
            <a class="btn btn-sm collection text-primary" href="{{ asset('storage/' . $po->sale_present_file) }}"
                target="_blank" type="button"><i class="fa-solid fa-search"></i></a>
        </td>
        <td> {{ $po->snum }} </td>
        <td class="small fw-bold"> {{ $po->po_value }} </td>
        <td class="small"> {{ $po->collection_date }} </td>
        <td class="small"> {{ $po->created_at }} </td>
        @if (today()->diffInDays($po->collection_date) == 3 || today()->diffInDays($po->collection_date) == 2)
            <td class="text-bg-warning" style="width:0;">
                {{ today()->diffInDays($po->collection_date) }} يوم </td>
        @elseif(today()->diffInDays($po->collection_date) == 1)
            <td class="text-bg-danger" style="width:0;">
                {{ today()->diffInDays($po->collection_date) }} يوم </td>
        @elseif(today()->diffInDays($po->collection_date) < 1)
            <td class="text-bg-danger" style="width:0;"> 0 يوم </td>
            {{-- background-color:rgb(177 30 30);color:#fff; --}}
        @else
            <td style="width:0;"> {{ today()->diffInDays($po->collection_date) }} يوم
            </td>
        @endif

        @if ($po->status == 0)
            <td>
                <button type="button" id="" class="btn btn-sm collection text-success" data-bs-toggle="modal"
                    data-bs-target="#{{ $po->id }}colmodal"><i class="fa-solid fa-dollar"></i></button>

                <div class="modal fade" id="{{ $po->id }}colmodal" tabindex="-1" aria-labelledby="colmodalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body d-flex justify-content-between lead">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                                <p>هل أنت متأكد من تحصيل ال PO الخاص بالكود {{ $po->snum }}</p>
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('collect_po', $po->id) }}"method="POST">
                                    @csrf
                                    <button type="submit" id="collect_po" class="lh-1 p-2 btn btn-sm btn-primary">نعم
                                        متأكد</button>
                                </form>
                                <button type="button" class="btn btn-danger lh-1 p-2 btn btn-sm"
                                    data-bs-dismiss="modal">إلغاء</button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        @endif
        <td>
            <a type="button" id="edt_po" href="{{ route('edt_po', $po->id) }}"
                class="btn btn-sm collection text-primary"><i class="fa-solid fa-edit"></i></a>
        </td>
    </tr>
@endforeach
