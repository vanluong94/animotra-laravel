@push('headerScripts')
    <link href="/assets/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <script src="/assets/admin/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>
@endpush

@section('pageTitle', 'Admin | All Mangas')

@section('pageHeading')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800">Manga</h1>
        <a href="{{ route('admin.manga.add') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Add New Manga
        </a>
    </div>
@endsection


<x-dashboard-layout>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Mangas</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Thumbnail</th>
                            <th>Title</th>
                            <th>Publish Status</th>
                            <th>Published at</th>
                            <th>Created at</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Thumbnail</th>
                            <th>Title</th>
                            <th>Publish Status</th>
                            <th>Published at</th>
                            <th>Created at</th>
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
                        ajax: '{{ route('admin.ajax.manga.list') }}',
                        columns: [
                            { data: 'thumbnail', name: 'thumbnail' },
                            { data: 'title', name: 'title' },
                            { data: 'publish_status', name: 'publish_status' },
                            { data: 'published_at', name: 'published_at' },
                            { data: 'created_at', name: 'created_at' },
                            { data: 'actions', name: 'actions' }
                        ]
                    });
                })
            </script>
        </div>
    </div>
</x-dashboard-layout>