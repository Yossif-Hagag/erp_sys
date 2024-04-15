@foreach ($OperationgScrape as $op_scrap)
    <tr>
        <td>{{ $op_scrap->operation_type }}</td>
        <td>
            <a class="btn btn-sm collection text-primary" href="{{ asset('storage/' . $op_scrap->operation_document) }}"
                target="_blank" type="button"><i class="fa-solid fa-search"></i></a>
        </td>
        <td>{{ $op_scrap->client_name }}</td>
        <td>{{ $op_scrap->address }}</td>
        <td>{{ $op_scrap->created_at }}</td>
        <td>{{ $op_scrap->cost }}</td>
        <td>
            <a type="button" id="edt_operation_purchas" href="{{ route('edt_operation_scrap', $op_scrap->id) }}"
                class="lh-1 p-2 btn btn-sm btn-dark"><i class="fa-solid fa-edit"></i></a>
        </td>
    </tr>
@endforeach
