@push('headerScripts')
    <link href="/assets/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <script src="/assets/admin/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>
@endpush

@section('pageTitle', 'Admin | All Comments')

@section('pageHeading')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800">Comment</h1>
    </div>
@endsection


<x-dashboard-layout>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Comments</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Avatar</th>
                            <th>User</th>
                            <th>Content</th>
                            <th>Article</th>
                            <th>Created at</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Avatar</th>
                            <th>User</th>
                            <th>Content</th>
                            <th>Article</th>
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
                        ajax: '{{ route('admin.ajax.comment.list') }}',
                        columns: [
                            { data: 'avatar', name: 'avatar' },
                            { data: 'user', name: 'user' },
                            { data: 'content', name: 'content' },
                            { data: 'article', name: 'article' },
                            { data: 'created_at', name: 'created_at' },
                            { data: 'actions', name: 'actions' }
                        ],
                        order: [[ 4, 'desc' ]]
                    })
                })
            </script>
        </div>
    </div>
</x-dashboard-layout>