<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>@yield('title')</title>
      <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
       <link rel="stylesheet" href="{{asset('css/sidebar.css')}}">
   </head>
   <body class="bg-light">
    @include('admin.partials.navbar')
    
       <div class="container-fluid">
         <div class="row flex-nowrap">
            @include('admin.partials.sidebar')

             <div class="col py-3">
                @yield('content')
            </div>

         </div>
       </div>

       @yield('scripts');

       
      
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
   </body>
</html>