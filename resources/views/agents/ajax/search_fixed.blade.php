@foreach ($agents_fixed as $Fixed_supplie)
    <!-- <div class="col-md-12 purchas_tabel"> -->
    <tr>
        <td> {{ $x++ }}</td>
        <td> {{ $Fixed_supplie->pro_name }}</td>
        <td> {{ $Fixed_supplie->number_of_product }} </td>
        <td> {{ $Fixed_supplie->sell_price }} </td>
        <td> {{ $Fixed_supplie->buy_price }} </td>


        <td>
            <button onclick="window.location='{{ route('edit_fixed_supplies', $Fixed_supplie->id) }}'">
                <i class="fa-solid fa-pen-to-square text-primary"></i>
            </button>
        </td>
        <td>
            <form method="POST" action="{{ route('delete_supply', ['id' => $Fixed_supplie->id]) }}">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('هل انت متاكد من حذف هذا التوريد')"
                    style="border:none; background-color:transparent;">
                    <i class="fa-solid fa-trash text-danger"></i>
                </button>
            </form>

        </td>
@endforeach
