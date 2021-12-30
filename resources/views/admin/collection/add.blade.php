@section('pageTitle', 'Add New ' . App\Models\MangaCollection::getTypeLabel( $type )) 

@section('pageHeading')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Add New {{ App\Models\MangaCollection::getTypeLabel( $type ) }}</h1>
@endsection

<x-dashboard-layout>
    <x-admin.card-collection 
        type="category" 
        type-label="Category"
        :name="old('name')"
    ></x-admin.card-collection>
</x-dashboard-layout>