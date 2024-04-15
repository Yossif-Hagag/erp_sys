@foreach ($OperationgStocks as $OperationgStock)
    <tr>
        <td>{{ $OperationgStock->operation_type }}</td>
        <td>
            <a class="btn btn-sm collection text-primary"
                href="{{ asset('storage/' . $OperationgStock->operation_document) }}" target="_blank" type="button"><i
                    class="fa-solid fa-search"></i></a>
        </td>
        <td>{{ $OperationgStock->client_name }}</td>
        <td>{{ $OperationgStock->address }}</td>
        <td>{{ $OperationgStock->created_at }}</td>
        <td>{{ $OperationgStock->cost }}</td>
        <td>
            <a type="button" id="edt_operatingStock" href="{{ route('edit_operatingStock', $OperationgStock->id) }}"
                class="lh-1 p-2 btn btn-sm btn-dark">تعديل</a>
        </td>
    </tr>
@endforeach
