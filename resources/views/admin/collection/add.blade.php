@section('pageTitle', 'Admin | Add New ' . App\Models\MangaCollection::getTypeLabel( $type )) 

@section('pageHeading')
    <!-- Page Heading -->

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800">Add New {{ App\Models\MangaCollection::getTypeLabel( $type ) }}</h1>
        <a href="{{ route('admin.collection.all', $type) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-stream fa-sm text-white-50"></i> All {{ App\Models\MangaCollection::getTypeLabel( $type, true ) }}
        </a>
    </div>
@endsection

<x-dashboard-layout>
    <x-admin.card-collection 
        :type="$type" 
        :name="old('name')"
    ></x-admin.card-collection>
</x-dashboard-layout>