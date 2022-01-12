@push('headerScripts')
    <link rel="stylesheet" href="/assets/admin/css/manga.css">
@endpush

@section('pageTitle', "Admin | {$chapter->manga->title} - Edit {$chapter->name}")

@section('pageHeading')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800"><strong>{{ $chapter->manga->title }}</strong> - Edit <strong>{{ $chapter->name }}</strong></h1>
        <div>
            <a href="{{ route('admin.manga.chapter.all', $chapter->manga->id) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-stream fa-sm text-white-50"></i> Chapters List
            </a>
            <a href="{{ route('admin.manga.chapter.add', $chapter->manga->id) }}" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Add new Chapter
            </a>
        </div>
    </div>
@endsection

<x-dashboard-layout>
    <x-admin.card-chapter
        :id="$chapter->id"
        :manga="$chapter->manga"
        :name="$chapter->name"
        :extendName="$chapter->extend_name"
        :coin="$chapter->coin"
        :release="$chapter->getReleasedAtInputValue()"
        :images="$chapter->getImages()"
    ></x-admin.card-chapter>
</x-dashboard-layout>