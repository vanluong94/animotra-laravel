@push('headerScripts')
    <link rel="stylesheet" href="/assets/admin/css/manga.css">
@endpush

@section('pageTitle', 'Admin | Edit Manga')

@section('pageHeading')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Manga</h1>
@endsection

<x-dashboard-layout>
    <x-admin.card-manga
        :id="$manga->id"
        :slug="$manga->slug"
        :title="$manga->title"
        :summary="$manga->summary"
        :thumbnail="$manga->getThumbnailURL()"
        :publishStatus="$manga->publish_status"
        :publishTime="$manga->getPublishedAtInputValue()"
        :releaseStatus="$manga->release_status"
        :categories="$manga->categories()->pluck('name')->toArray()"
        :tags="$manga->tags()->pluck('name')->toArray()"
        :authors="$manga->authors()->pluck('name')->toArray()"
        :year="$manga->year()->first() ? $manga->year()->first()->name : ''"
    ></x-admin.card-manga>
</x-dashboard-layout>