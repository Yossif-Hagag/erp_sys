<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>شئون الموظفين || العربي جروب</title>
    <link rel="shortcut icon" href="./assets/elarby group logo.jpg" type="image/x-icon" />

    <!-- Importing fontawesome library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- Importing Bootstrap library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css"
        integrity="sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">


    <!-- Importing 'Cairo' Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('files/purchases.css') }}" />
</head>

<body>
    <table class="table table-striped text-center" id="" style="width: 100%">
        <thead>
            <tr>
                <th scope="col">رقم</th>
                <th scope="col">الإسم</th>
                <th scope="col">البريد الإلكتروني</th>
                <th scope="col">التليفون</th>
                <th scope="col">الوظيفة</th>
                <th scope="col">المرتب</th>
                <th scope="col">الأجازات</th>
                <th scope="col">باقي الأجازات</th>
                <th scope="col">وقت إضافي</th>
                <th scope="col">مرفقات</th>
            </tr>
        </thead>
        <tbody id="data-body">
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
                </tr>
            @endforeach
        </tbody>
    </table>


    
    <div class="d-flex justify-content-around align-items-center mt-4">
        <a type="button" id="" href="{{ route('users') }}" class="btn btn-dark p-2">رجوع</a>
    </div>

    <!-- Importing Scripts -->
    <script src="{{ asset('js/jq/jq.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"
        integrity="sha512-3dZ9wIrMMij8rOH7X3kLfXAzwtcHpuYpEgQg1OA4QAob1e81H8ntUQmQm3pBudqIoySO5j0tHN4ENzA6+n2r4w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        window.print();
    </script>
</body>

</html>
