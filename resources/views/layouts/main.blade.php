<!DOCTYPE html>
<html lang="FR-fr">

@yield('head')

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->

    @yield('navbar')

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @yield('sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      @yield('header')
      <!-- /.content-header -->

      <!-- Main content -->
      @yield('body')
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    @yield('aside')
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    @yield('footer')
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

 @yield('script')

</body>

</html>