@push('headerScripts')
    <link rel="stylesheet" href="/assets/admin/css/manga.css">
@endpush

@section('pageTitle', 'Add New Manga')

@section('pageHeading')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Add New Manga</h1>
@endsection

<x-dashboard-layout>
    <x-admin.card-manga
        :title="old('title')"
        :summary="old('summary')"
        :publishStatus="old('publish_status')"
        :publishTime="old('published_at')"
        :releaseStatus="old('release_status')"
        :categories="old('categories')"
        :tags="old('tags')"
        :authors="old('authors')"
    ></x-admin.card-manga>
</x-dashboard-layout>