@push('headerScripts')
    <link href="/assets/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <script src="/assets/admin/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>
@endpush

@section('pageTitle', 'Admin | All Transactions')

@section('pageHeading')
    <h1 class="h3 text-gray-800">Transactions</h1>
@endsection


<x-dashboard-layout>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Transactions</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>User ID</th>
                            <th>User Name</th>
                            <th>User Email</th>
                            <th>Price</th>
                            <th>Amount</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Order ID</th>
                            <th>User ID</th>
                            <th>User Name</th>
                            <th>User Email</th>
                            <th>Price</th>
                            <th>Amount</th>
                            <th>Created At</th>
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
                        ajax: '{{ route('admin.ajax.transaction.list') }}',
                        columns: [
                            { data: 'order_id', name: 'order_id' },
                            { data: 'user_id', name: 'user_id' },
                            { data: 'user_name', name: 'user_name' },
                            { data: 'user_email', name: 'user_email' },
                            { data: 'price', name: 'publish_status' },
                            { data: 'amount', name: 'published_at' },
                            { data: 'created_at', name: 'created_at' },
                        ],
                        order: [[ 6, 'desc' ]]
                    })
                })
            </script>
        </div>
    </div>
</x-dashboard-layout>