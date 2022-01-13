@push('headerScripts')

@endpush

@section('pageTitle', 'Admin | Add New User')

@section('pageHeading')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Add New User</h1>
@endsection

<x-dashboard-layout>
    <x-admin.card-user
        :username="old('username')"
        :name="old('name')"
        :email="old('email')"
        :role="old('role')"
    ></x-admin.card-user>
</x-dashboard-layout>