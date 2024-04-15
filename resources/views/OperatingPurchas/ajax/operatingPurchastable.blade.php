@foreach ($OperationgPurchas as $op_purchas)
    <tr>
        {{-- <td>{{ $op_purchas->operation_type }}</td> --}}
        <td>
            <a class="btn btn-sm collection text-primary" href="{{ asset('storage/' . $op_purchas->operation_document) }}"
                target="_blank" type="button"><i class="fa-solid fa-search"></i></a>
        </td>
        <td>{{ $op_purchas->client_name }}</td>
        <td>{{ $op_purchas->address }}</td>
        <td>{{ $op_purchas->created_at }}</td>
        <td>{{ $op_purchas->cost }}</td>
        <td>
            <a type="button" id="edt_operation_purchas" href="{{ route('edt_operation_purchas', $op_purchas->id) }}"
                class="lh-1 p-2 btn btn-sm btn-dark"><i class="fa-solid fa-edit"></i></a>
        </td>
    </tr>
@endforeach
