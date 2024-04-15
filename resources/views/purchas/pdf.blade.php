<div class="table-data mt-3 pt-3 pe-1 h-auto">
    <table class="table table-striped text-center" id="example">
        <thead>
            <tr>
                <th scope="col">رقم</th>
                <th scope="col">كود</th>
                <!-- <th scope="col">صورة المنتج</th> -->
                <th scope="col">اسم</th>
                <th scope="col">الكمية</th>
                <th scope="col">السعر</th>
                <th scope="col">اسم المورد</th>
                <th scope="col">تليفون المورد</th>
                <th scope="col">عنوان المورد</th>
                <th scope="col">تاريخ الاضافة</th>
                <th scope="col">اخر تحديث </th>
    
                <!-- <th scope="col">حذف</th> -->
            </tr>
        </thead>
        <tbody id="data-body">
            @foreach ($items as $item)
            @foreach ($item->purchas as $purchas)
            <tr>
                <td>{{ $purchas->id }}</td>
                <td>{{ $purchas->pro_num }}</td>
                <td>{{ $purchas->pro_name }}</td>
                <td>{{ $purchas->number_of_product }}</td>
                <td>{{ $purchas->price }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->phone }}</td>
                <td>{{ $item->address }}</td>
                <td>{{ $item->created_at }}</td>
                <td>{{ $item->updated_at }}</td>
           
            
            </tr>

            @endforeach
            @endforeach
        </tbody>
    </table>
</div>