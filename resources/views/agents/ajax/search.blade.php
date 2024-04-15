@foreach ($allagents as $allagent)
    <tr>
        <td> {{ $x++ }}</td>
        <td> {{ $allagent->name }}</td>
        <td> {{ $allagent->address }} </td>
        <td>
            <a id="agnet" href="{{ route('agent', $allagent->id) }}" class="btn btn-primary"
                data-bs-target="#staticBackdrop">
                <i class="fa-solid fa-search"></i>
            </a>
        </td>
    </tr>
@endforeach
