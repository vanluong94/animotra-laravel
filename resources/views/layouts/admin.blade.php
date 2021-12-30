<x-base-layout>

    @prepend('headerScripts')
        <!-- Custom fonts for this template-->
        <link href="/assets/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        
        <!-- Custom styles for this template-->
        <link href="/assets/admin/css/sb-admin-2.css" rel="stylesheet">
        <link href="/assets/admin/css/general.css" rel="stylesheet" type="text/css">

        <!-- Bootstrap core JavaScript-->
        <script src="/assets/admin/vendor/jquery/jquery.min.js"></script>
        <script src="/assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="/assets/admin/vendor/jquery-easing/jquery.easing.min.js"></script>
    @endprepend

    @push('footerScripts')
        <!-- Custom scripts for all pages-->
        <script src="/assets/admin/js/sb-admin-2.min.js"></script>
    @endpush

    {{ $slot }}

</x-base-layout>