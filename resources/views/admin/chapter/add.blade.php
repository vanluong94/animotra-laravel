@push('headerScripts')
    <link rel="stylesheet" href="/assets/admin/css/manga.css">
@endpush

@section('pageTitle', "Admin | {$manga->title} - Add New Chapter")

@section('pageHeading')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><strong>{{ $manga->title }}</strong> - Add New Chapter</h1>
@endsection

<x-dashboard-layout>
    <x-admin.card-chapter
        :manga="$manga"
        :name="old('name')"
        :extendName="old('extend_name')"
        :coin="old('coin')"
        :release="old('release')"
    ></x-admin.card-chapter>
</x-dashboard-layout>