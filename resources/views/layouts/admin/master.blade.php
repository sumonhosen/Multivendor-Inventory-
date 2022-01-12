<!doctype html>
<html>
<head>
    @include('includes.admin.head')
     
        <!-- Datatable Dependency start -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.css" />
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js"></script>
    
        <!-- Datatable Dependency end -->
</head>
<body id="admin_panel" class="skin-blue sidebar-mini wysihtml5-supported">
  <div class="wrapper">
    @include('includes.admin.header')
    @include('includes.admin.sidebar')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content-header">
        @yield('content-header')
      </section>
      <section class="content">
        @yield('content')
      </section>
    </div><!-- /.content-wrapper -->
    <input type="hidden" name="hf_base_url" id="hf_base_url" value="{{ url('/') }}">
    <input type="hidden" name="lang_code" id="lang_code" value="{{ $default_lang_code }}">
    <input type="hidden" name="site_name" id="site_name" value="admin">
    <div class="ajax-request-response-msg" style="display: none; background-color: #333;padding:20px 0px;position:fixed;width:100%;color:#DDD;bottom: 0px;z-index: 999;text-align: center;left: 0px; font-size:16px;"></div>
  </div><!-- ./wrapper -->
  <script>
    $(document).ready(function() {
    $('#table_id').DataTable({

        dom: 'Bfrtip',
        responsive: true,
        pageLength: 25,
        // lengthMenu: [0, 5, 10, 20, 50, 100, 200, 500],

        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]

    });
});
  </script>
</body>
</html>