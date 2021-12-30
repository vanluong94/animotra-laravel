@php
    $labelPlural = App\Models\MangaCollection::getTypeLabel( $type, true );
    $labelSingular = App\Models\MangaCollection::getTypeLabel( $type );
@endphp

@push('headerScripts')
    <link href="/assets/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <script src="/assets/admin/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>
@endpush

@section('pageTitle', 'All ' . $labelPlural)

@section('pageHeading')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800">{{ App\Models\MangaCollection::getTypeLabel( $type ) }}</h1>
        <a href="{{ route('admin.collection.add', $type) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Add New {{ $labelSingular }}
        </a>
    </div>
@endsection


<x-dashboard-layout>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All {{ $labelPlural }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Total Mangas</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Total Mangas</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>

            <script>
                jQuery(function($){
                    $('#dataTable').DataTable({
                        processing: true,
                        serverSide: true,
                        // pageLength: 2,
                        ajax: '{{ route('admin.ajax.collection.list', $type) }}',
                        columns: [
                            { data: 'name', name: 'name' },
                            { data: 'slug', name: 'slug' },
                            { data: 'manga_count', name: 'manga_count' },
                            { data: 'created_at', name: 'created_at' },
                            { data: 'updated_at', name: 'updated_at' },
                            { data: 'actions', name: 'actions' }
                        ]
                    });
                })
            </script>
        </div>
    </div>
</x-dashboard-layout>