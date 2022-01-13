@push('headerScripts')
    <link rel="stylesheet" href="/assets/admin/css/manga.css">
@endpush

@section('pageTitle', "Admin | {$manga->title} - Add New Chapter")

@section('pageHeading')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800"><strong>{{ $manga->title }}</strong> - Add New Chapter</h1>
        <div>
            <a href="{{ route('admin.manga.chapter.all', $manga->id) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-stream fa-sm text-white-50"></i> Chapters List
            </a>
        </div>
    </div>
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