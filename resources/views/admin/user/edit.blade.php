@push('headerScripts')

@endpush

@section('pageTitle', 'Admin | Edit User')

@section('pageHeading')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit User</h1>
@endsection

<x-dashboard-layout>
    <x-admin.card-user
        :id="$user->id"
        :username="$user->username"
        :name="$user->name"
        :email="$user->email"
        :role="$user->role"
        :avatar="$user->getAvatar()"
    ></x-admin.card-user>
</x-dashboard-layout>