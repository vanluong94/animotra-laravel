@section('headerMeta')
    <link rel="stylesheet" href="/assets/admin/css/manga.css">
@endsection

@section('pageTitle', 'Edit Manga Chapters List')

<x-dashboard-layout>

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Manga Chapters List</h1>

    <x-admin.card-chapter-list></x-admin.card-chapter-list>
    
</x-dashboard-layout>