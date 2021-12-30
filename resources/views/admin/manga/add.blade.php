@section('headerMeta')
    <link rel="stylesheet" href="/assets/admin/css/manga.css">
@endsection

@section('pageTitle', 'Add New Manga')

@section('pageHeading')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Add New Manga</h1>
@endsection

<x-dashboard-layout>
    <x-admin.card-manga></x-admin.card-manga>
</x-dashboard-layout>