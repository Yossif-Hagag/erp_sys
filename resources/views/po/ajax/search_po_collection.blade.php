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

        @if ($po->status == 1)
            <td><i class='fa-solid fa-check' style='color: #00803e;'></i></td>
        @endif
    </tr>
@endforeach
