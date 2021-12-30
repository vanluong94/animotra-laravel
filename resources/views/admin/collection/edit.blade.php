@section('pageTitle', 'Edit ' . $collection->getTypeLabelSingular()) 

@section('pageHeading')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800">Edit {{ $collection->getTypeLabelSingular() }}</h1>
        <a href="{{ route('admin.collection.all', $type) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-stream fa-sm text-white-50"></i> All {{ $collection->getTypeLabelPlural() }}
        </a>
    </div>
@endsection

<x-dashboard-layout>
    
    <x-admin.card-collection 
        type="category" 
        type-label="Category"
        :name="$collection->name"
        :slug="$collection->slug"
        :id="$collection->id"
    ></x-admin.card-collection>

</x-dashboard-layout>