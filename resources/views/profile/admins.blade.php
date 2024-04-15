<x-app-layout>
    @section('navlinks')
        <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')" style="margin-right:2em;">
            {{ __('الحساب التعريفي') }}
        </x-nav-link>
        <x-nav-link :href="route('add_admin')" :active="request()->routeIs('add_admin')" style="">
            {{ __('إضافة مسئول') }}
        </x-nav-link>
        <x-nav-link :href="route('admins')" :active="request()->routeIs('admins')" style="">
            {{ __('عرض المسئولين') }}
        </x-nav-link>
    @endsection

    <div class="container">
        @if (Session::has('done'))
            <div class="alert alert-dismissible alert-success align-items-center h3em d-flex fade justify-content-between m-2 show"
                role="alert">
                <div>{{ Session::get('done') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">x</button>
                <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
                    <symbol id="check-circle-fill" viewBox="0 0 16 16">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </symbol>
                    <symbol id="info-fill" viewBox="0 0 16 16">
                        <path
                            d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                    </symbol>
                    <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
                        <path
                            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </symbol>
                </svg>

                <svg class="bi flex-shrink-0 me-2 w-7 h-7" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
            </div>
        @endif

        <div class="row">
            <div class="row p-1 mb-2 shadow bg-white mt-3">
                <div class="col-md-3 d-flex justify-content-around align-items-center fw-bold pt-2 pb-2">الإسم</div>
                <div class="col-md-3 d-flex justify-content-around align-items-center fw-bold pt-2 pb-2">الهاتف</div>
                <div class="col-md-4 d-flex justify-content-around align-items-center fw-bold pt-2 pb-2">البريد
                    الإلكتروني</div>
                <div class="col-md-1 d-flex justify-content-around align-items-center fw-bold pt-2 pb-2">تعديل</div>
                <div class="col-md-1 d-flex justify-content-around align-items-center fw-bold pt-2 pb-2">حذف</div>
            </div>

            @foreach ($admins as $admin)
                <div class="row mb-1 p-2 shadow bg-white">
                    <div class="col-md-3 d-flex justify-content-around align-items-center pt-2 pb-2">{{ $admin->name }}
                    </div>
                    <div class="col-md-3 d-flex justify-content-around align-items-center pt-2 pb-2">{{ $admin->phone }}
                    </div>
                    <div class="col-md-4 d-flex justify-content-around align-items-center pt-2 pb-2">{{ $admin->email }}
                    </div>
                    <div class="col-md-1 d-flex justify-content-around align-items-center pt-2 pb-2">
                        <a class="btn btn-sm btn-primary bg-primary" href="{{ route('edt_admin', $admin->id) }}" type="button">تعديل</a>
                    </div>
                    <div class="col-md-1 d-flex justify-content-around align-items-center pt-2 pb-2">
                        <form method="post" action="{{ route('del_admin', $admin->id) }}">
                            @csrf
                            <button class="btn btn-sm btn-danger bg-danger" onclick="return confirm('هل انت متأكد من الحذف؟')" type="submit">حذف</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
        <div class = "paginate px-4 py-2" style="direction: ltr;">{{ $admins->links() }}</div>
    </div>

</x-app-layout>
