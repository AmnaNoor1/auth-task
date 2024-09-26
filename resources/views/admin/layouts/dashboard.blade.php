<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>@yield('title')</title>
      <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
       <link rel="stylesheet" href="{{asset('css/sidebar.css')}}">
       <link rel="stylesheet" href="{{asset('css/styles.css')}}">

       <!-- Toastr CSS -->
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
       <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
       <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />

     

   </head>
   <body class="sb-nav-fixed">
    @include('admin.partials.navbar')
    
    <div id="layoutSidenav">
       
            <div id="layoutSidenav_nav">
            @include('admin.partials.sidebar')
            </div>

            <div id="layoutSidenav_content">
                  <main>
                   <div class="container-fluid px-4">
                @yield('content')
                  
                  </div>
               </main>
            </div>

       
      </div>

       @yield('scripts');

       <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
       <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
      
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
       <!-- Toastr JS -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

      <script
      src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
      crossorigin="anonymous"
    ></script>
  
    <script src="{{asset('js/datatables-simple-demo.js')}}"></script>
    <script src="{{asset('js/scripts.js')}}"></script>
   </body>
</html>