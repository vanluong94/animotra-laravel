@section('pageTitle', 'Edit ' . $collection->getTypeLabelSingular()) 

@section('pageHeading')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit {{ $collection->getTypeLabelSingular() }}</h1>
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