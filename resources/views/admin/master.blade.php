<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.urbanui.com/salt/jquery/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Dec 2017 12:31:57 GMT -->
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin</title>
   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- plugins:css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/2.0.46/css/materialdesignicons.min.css" integrity="sha512-HmBTsbqKSDy0wIk8SGSCj68xUg8b22mGtXx8cXF64qcmnQnJepz6Aq37X43gF/WhbvqPcx68GoiaWu8wE8/y4g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="{{asset('backend/node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/node_modules/jquery-toast-plugin/dist/jquery.toast.min.css')}}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rickshaw/1.6.1/rickshaw.min.css" integrity="sha512-m4Frl894bPM7JXtnIDx18P3rg4e3Uxmdsn/LiQEqvbqIaQj+/XBi555R7cu9pVvkxzMPp+hRKcp/unNJHmWZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('backend/css/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" type="image/x-icon" href="{{asset('favicon.png')}}" />
  @stack('custom-css')
</head>
<body class="sidebar-dark">

  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('admin.includes.navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <div class="row row-offcanvas row-offcanvas-right">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.includes.leftsidebar')
        <!-- partial -->
        @yield('content')
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="float-right">
                <a href="#"> Admin</a> &copy; 2023
            </span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- row-offcanvas ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>  <script src="{{asset('backend/node_modules/bootstrap/dist/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('backend/node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="{{asset('backend/node_modules/jquery-toast-plugin/dist/jquery.toast.min.js')}}"></script>
  <script src="{{asset('backend/node_modules/flot/jquery.flot.js')}}"></script>
  <script src="{{asset('backend/node_modules/flot/jquery.flot.resize.js')}}"></script>
  <script src="{{asset('backend/node_modules/flot/jquery.flot.categories.js')}}"></script>
  <script src="{{asset('backend/node_modules/flot/jquery.flot.pie.js')}}"></script>
  <script src="{{asset('backend/node_modules/rickshaw/vendor/d3.v3.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/rickshaw/1.6.1/rickshaw.min.js" integrity="sha512-nNZplF+hNMTJgUMnTzXLg/DlfN3Y5sUxRe3fOKSNLB0NLt0gGRmW2T5oYVjX5d1VClg4LoiXhPkhjmXGcvEHFA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="{{asset('backend/node_modules/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{asset('backend/js/off-canvas.js')}}"></script>
  <script src="{{asset('backend/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('backend/js/misc.js')}}"></script>
  <script src="{{asset('backend/js/settings.js')}}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{asset('backend/js/dashboard_1.js')}}"></script>
  <!-- End custom js for this page-->
  <script>
    @if(Session::has('messege'))
      var type="{{Session::get('alert-type','info')}}"
      switch(type){
          case 'info':
          $.toast({
        heading: 'Info',
        text: '{{ Session::get('messege') }}',
        position: ('top-right'),
        showHideTransition: 'slide',
        icon: 'info',
        loaderBg: '#d9534f'
      });
              warning
               break;
          case 'success':
          $.toast({
        heading: 'Success',
        text: '{{ Session::get('messege') }}',
        position: ('top-right'),
        showHideTransition: 'slide',
        icon: 'success',
        loaderBg: '#d9534f'
      });
              break;
          case 'warning':
          $.toast({
        heading: 'Warning',
        text: '{{ Session::get('messege') }}',
        position: ('top-right'),
        showHideTransition: 'slide',
        icon: 'warning',
        loaderBg: '#d9534f'
      });
              break;
          case 'error':
          $.toast({
        heading: 'Danger',
        text: '{{ Session::get('messege') }}',
        showHideTransition: 'slide',
        position: ('top-right'),
        icon: 'error',
        loaderBg: '#5bc0de'
      })
              // toastr.error("{{ Session::get('messege') }}");
              break;
      }
    @endif
  </script>
<!-- Mirrlored from www.urbanui.com/salt/jquery/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Dec 2017 12:32:50 GMT -->
@stack('custom-scripts')
</body>

</html>
