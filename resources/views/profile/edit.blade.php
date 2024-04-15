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
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="sm:p-8 sm:rounded-lg row d-flex justify-content-between">

                <div class="max-w-xl bg-white shadow p-4 col-md-6">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <div class="max-w-xl bg-white shadow p-4 col-md-6">
                    @include('profile.partials.update-password-form')
                </div>

            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
