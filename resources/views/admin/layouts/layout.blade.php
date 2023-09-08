<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>{{ Auth::guard('admin')->user()->type  }} Panel</title>
      <!-- plugins:css -->
      <!-- font awesome -->
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="{{ url('admin/vendors/feather/feather.css') }}">
      <link rel="stylesheet" href="{{ url('admin/vendors/ti-icons/css/themify-icons.css') }}">
      <link rel="stylesheet" href="{{ url('admin/vendors/css/vendor.bundle.base.css') }}">
      <!-- endinject -->
      <!-- Plugin css for this page -->
        <link rel="stylesheet" href="{{ url('admin/vendors/mdi/css/materialdesignicons.min.css') }}">
         <link rel="stylesheet" href="{{ url('admin/vendors/mdi/css/materialdesignicons.min.css.map') }}">
      <link rel="stylesheet" href="{{ url('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
      <link rel="stylesheet" href="{{ url('admin/vendors/ti-icons/css/themify-icons.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ url('admin/js/select.dataTables.min.css') }}">
      <!-- End plugin css for this page -->
      <!-- inject:css -->
      <link rel="stylesheet" href="{{ url('admin/css/vertical-layout-light/style.css') }}">
      <!-- endinject -->
      <link rel="shortcut icon" href="{{ url('admin/images/favicon.png') }}"/>
      <!-- data table -->
      <link rel="stylesheet" href="{{ url('admin/css/bootstrap.css') }}">
      <link rel="stylesheet" href="{{ url('admin/css/dataTables.bootstrap4.min.css') }}">

   </head>
   <body>
      <div class="container-scroller">
         <!-- partial:partials/_navbar.html -->
         @include('admin.layouts.header')
         <!-- partial -->
         <div class="container-fluid page-body-wrapper">
            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            @include('admin.layouts.sidebar')
            <!-- partial -->
            <div class="main-panel">
              @yield('content')
               <!-- content-wrapper ends -->
               <!-- partial:partials/_footer.html -->
               @include('admin.layouts.footer')
               <!-- partial -->
            </div>
            <!-- main-panel ends -->
         </div>
         <!-- page-body-wrapper ends -->
      </div>
      <!-- container-scroller -->
      <!-- plugins:js -->
      <script src="{{ url('admin/vendors/js/vendor.bundle.base.js') }}"></script>
      <!-- endinject -->
      <!-- Plugin js for this page -->
      <script src="{{ url('admin/vendors/chart.js/Chart.min.js') }}"></script>
      <script src="{{ url('admin/vendors/datatables.net/jquery.dataTables.js') }}"></script>
      <script src="{{ url('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
      <script src="{{ url('admin/js/dataTables.select.min.js') }}"></script>
      <!-- End plugin js for this page -->
      <!-- inject:js -->
      <script src="{{ url('admin/js/off-canvas.js') }}"></script>
      <script src="{{ url('admin/js/hoverable-collapse.js') }}"></script>
      <script src="{{ url('admin/js/template.js') }}"></script>
      <script src="{{ url('admin/js/settings.js') }}"></script>
      <script src="{{ url('admin/js/todolist.js') }}"></script>
      <!-- endinject -->
      <!-- Custom js for this page-->
      <!-- sweet alert -->
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script src="{{ url('admin/js/dashboard.js') }}"></script>
      <script src="{{ url('admin/js/Chart.roundedBarCharts.js') }}"></script>
      <!-- End custom js for this page-->
      <!-- custom script file -->
      <script src="{{ url('admin/js/custom.js')}}"></script>
      <!-- datatable -->
      <script>
         $(document).ready( function () {
            $('#Sections').DataTable();
         } );

          $(document).ready( function () {
            $('#categories').DataTable();
         } );

         $(document).ready( function () {
            $('#brands').DataTable();
         } );
         $(document).ready( function () {
            $('#products').DataTable();
         } );
      </script>
   </body>
</html>
