@foreach ($agents_each as $each_supplie)
    <tr>
        <td> {{ $y++ }}</td>
        <td> {{ $each_supplie->pro_name }}</td>
        <td> {{ $each_supplie->number_of_product }} </td>
        <td> {{ $each_supplie->sell_price }} </td>
        <td> {{ $each_supplie->buy_price }} </td>


        <td>
            <button onclick="window.location='{{ route('edit_each_supplies', $each_supplie->id) }}'"">
                <i class="fa-solid fa-pen-to-square text-primary"></i>
            </button>
        </td>
        <td>
            <form method="POST" action="{{ route('delete_Eachsupply', ['id' => $each_supplie->id]) }}">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure you want to delete this supply?')"
                    style="border:none; background-color:transparent;">
                    <i class="fa-solid fa-trash text-danger"></i>
                </button>
            </form>
        </td>
    </tr>
@endforeach
