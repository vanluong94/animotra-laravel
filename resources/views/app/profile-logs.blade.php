@section('pageTitle', 'Profile | Token Logs' )

@push('headerScripts')
    <link href="/assets/vendor/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="/assets/admin/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>
@endpush

<x-profile :user="$user">
    <section>
        <h1 class="h4 text-uppercase fw-bold mb-4">Token Logs</h1>
    
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Token</th>
                    <th>Entry</th>
                    <th>Created at</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Type</th>
                    <th>Token</th>
                    <th>Entry</th>
                    <th>Created at</th>
                </tr>
            </tfoot>
            <tbody>
                
            </tbody>
        </table>

        <script>
            jQuery(function($){
                $('#dataTable').DataTable({
                    processing: true,
                    serverSide: true,
                    
                    ajax: '{{ route('profile.logs.ajax') }}',
                    columns: [
                        { data: 'type', name: 'type' },
                        { data: 'token', name: 'token' },
                        { data: 'entry', name: 'entry' },
                        { data: 'created_at', name: 'created_at' },
                    ],
                    order: [[ 3, 'desc' ]]
                })
                .on('draw', function(){
                    $('[data-toggle="tooltip"]').tooltip();
                })
            })
        </script>
    </section>
</x-profile>