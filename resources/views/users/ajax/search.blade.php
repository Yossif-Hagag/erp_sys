@foreach ($users as $user)
<tr>
    <td> {{ $x++ }}</td>
    <td> {{ $user->name }}</td>
    <td> {{ $user->email }}</td>
    <td> {{ $user->phone }}</td>
    <td> {{ $user->job_type }}</td>
    <td> {{ $user->salary }}</td>
    <td> {{ $user->holidays }}</td>
    <td> {{ $user->holi_rest }}</td>
    <td> {{ $user->over_time }}</td>
    <td> 
        <a class="btn btn-sm collection text-primary" href="{{ asset('storage/'.$user->emp_file) }}" 
            target="_blank" type="button"><i class="fa-solid fa-search"></i></a>
    </td>
    {{-- <td> {{ $user->updated_at }}</td> --}}

    <td>
        <a type="button" id="edt_user" href="{{route('edt_user',$user->id)}}"
            class="btn btn-sm collection text-primary"><i class="fa-solid fa-edit"></i></a>
    </td>
</tr>
@endforeach