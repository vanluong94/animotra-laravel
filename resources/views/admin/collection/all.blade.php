@section('pageTitle') 
All {{ App\Models\MangaCollection::getTypeLabel( $type, true ) }}
@endsection

@section('pageHeading')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">All {{ App\Models\MangaCollection::getTypeLabel( $type, true ) }}</h1>
@endsection

<x-dashboard-layout>
    {{-- something here --}}
</x-dashboard-layout>