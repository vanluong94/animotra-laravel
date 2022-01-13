@push('headerScripts')
    <link rel="stylesheet" href="/assets/admin/css/manga.css">

    <link href="/assets/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <script src="/assets/admin/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

@endpush

@section('pageTitle', "Admin | {$manga->title} - Chapters List")

@section('pageHeading')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800"><strong>{{ $manga->title }}</strong> - Chapters List</h1>
        <a href="{{ route('admin.manga.chapter.add', $manga->id) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Add New Chapter
        </a>
    </div>
@endsection

<x-dashboard-layout>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Chapters</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Chapter Name</th>
                            <th>Extend Name</th>
                            <th>Coins</th>
                            <th>Created at</th>
                            <th>Created by</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Chapter Name</th>
                            <th>Extend Name</th>
                            <th>Coins</th>
                            <th>Created at</th>
                            <th>Created by</th>
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
                        ajax: '{{ route('admin.ajax.chapter.list', $manga->id) }}',
                        columns: [
                            { data: 'id', name: 'id' },
                            { data: 'name', name: 'name' },
                            { data: 'extend_name', name: 'extend_name' },
                            { data: 'coin', name: 'coin' },
                            { data: 'created_at', name: 'created_at' },
                            { data: 'created_by', name: 'created_by' },
                            { data: 'actions', name: 'actions' }
                        ],
                        order: [[ 4, 'desc' ]]
                    });
                })
            </script>
        </div>
    </div>
    
</x-dashboard-layout>