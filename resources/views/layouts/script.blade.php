{{-- @section('script')
 <!-- jQuery -->
 <script src="{{ asset ('/frontend')}}/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset ('/frontend')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset ('/frontend')}}/dist/js/adminlte.min.js"></script>
@endsection --}}

@section('script')
<script>
  // Script pour activer/désactiver la sidebar
  document.getElementById('toggleSidebarBtn').addEventListener('click', function() {
    document.querySelector('.sidebar').classList.toggle('active');
  });
</script>
 <!-- jQuery -->
 <script src="{{ asset ('/frontend')}}/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset ('/frontend')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script>
    toastr.success("{{ session('success') }}");
  </script>
<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  
  <!-- AdminLTE App -->
  {{-- <script src="{{ asset ('/frontend')}}/dist/js/adminlte.min.js"></script> --}}
@endsection