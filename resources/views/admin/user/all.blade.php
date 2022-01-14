@push('headerScripts')
    <link href="/assets/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <script src="/assets/admin/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>
@endpush

@section('pageTitle', 'Admin | All Users')

@section('pageHeading')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800">User</h1>
        <a href="{{ route('admin.manga.add') }}" class="d-inline-block btn btn-sm btn-primary shadow-sm mb-1">
            <i class="fas fa-plus fa-sm text-white-50"></i> Add New User
        </a>
    </div>
@endsection


<x-dashboard-layout>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Users</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Avatar</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Created at</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Avatar</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
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
                        
                        ajax: '{{ route('admin.ajax.user.list') }}',
                        columns: [
                            { data: 'avatar', name: 'avatar', width: '100px' },
                            { data: 'name', name: 'name' },
                            { data: 'email', name: 'email' },
                            { data: 'role', name: 'role', width: '50px' },
                            { data: 'created_at', name: 'created_at' },
                            { data: 'actions', name: 'actions', width: '50px' }
                        ],
                        order: [[ 4, 'desc' ]]
                    })
                })
            </script>
        </div>
    </div>
</x-dashboard-layout>