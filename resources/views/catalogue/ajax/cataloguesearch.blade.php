@foreach ($catalogues as $catalogue)
    <tr>

        <td> {{ $x++ }}</td>
        <td> {{ $catalogue->name }}</td>
        <td> {{ $catalogue->code }}</td>

        <td>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-sm" data-bs-toggle="modal"
                data-bs-target="#suppliers{{ $catalogue->code }}">
                <i class="fa-solid fa-search text-primary"></i>
            </button>

            <!-- Modal -->
            <div class="modal fade" id="suppliers{{ $catalogue->code }}" tabindex="-1" aria-labelledby="suppliersLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h5>
                                @if ($catalogue->suppliers)
                                    {{ $catalogue->suppliers }}
                                @else
                                    لا يوجد بيانات . . .
                                @endif
                            </h5>
                        </div>
                    </div>
                </div>
            </div>          
        </td>

        <td>
            <a type="button" id="edt_catalogue" href="{{ route('edt_catalogue', $catalogue->id) }}"
                class="btn btn-sm collection text-primary"><i class="fa-solid fa-edit"></i></a>
        </td>

        <td>
            <a href="{{ route('barren_code', ['code-barren' => $catalogue->code]) }}"
                class="btn btn-sm collection text-primary" target="_blank">
                <i class="fa-solid fa-edit"></i>
            </a>
        </td>


    </tr>
    <!-- </div><br><br> -->
@endforeach
