<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'My Blog')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('public/backend/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('public/backend/plugins/datatables/dataTables.bootstrap4.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/backend/dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">

    <div class="wrapper">
        <!-- Navbar -->
        @include('layouts.backend.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('layouts.backend.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            

            <!-- Main content -->
            @yield('content')
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.0.0-beta.2
            </div>
            <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>

    <!-- jQuery -->
    <script src="{{ asset('public/backend/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('public/backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('public/backend/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('public/backend/plugins/datatables/dataTables.bootstrap4.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('public/backend/plugins/fastclick/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('public/backend/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('public/backend/dist/js/demo.js') }}"></script>
    
    <!-- Ionicons Fonts -->
    {{-- <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script> --}}

    <!-- page script -->
<script>
  $(function () {
          $("#example1").DataTable({
            "lengthMenu": [3, 25, 50, "All"],
            "order": [[1, "asc"]],
            // "pagingType": "simple",
            "language": {
              "paginate": {
                "previous": "<",
                "next": ">",
              }
            }
          });
          $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "lengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]],
          });
        });
</script>

@yield('script')
    

</body>
</html>