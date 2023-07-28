<!doctype html>
<html lang="en"
dir="ltr">

<head>
    
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->

    <link href="{{URL::asset ('css/font-awesome.css')}}" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icon-kit/dist/css/iconkit.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('plugins/ionicons/dist/css/ionicons.min.css') }}"> --}}
    
    <link href="{{URL::asset ('css/sidebar.css')}}" rel="stylesheet" crossorigin="anonymous">
    {{-- <link href="{{URL::asset ('css/dashboard.css')}}" rel="stylesheet" crossorigin="anonymous"> --}}
    <link href="{{URL::asset ('css/bootstrap.min.css')}}" rel="stylesheet" crossorigin="anonymous"> 
    <link href="{{URL::asset ('css/app.css')}}" rel="stylesheet" crossorigin="anonymous">
    

    <title>Ticket Admin Panel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" ></script>

    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>

    {{-- for mulit-select --}}
    {{-- <link rel="stylesheet" href="https://www.codehim.com/demo/bootstrap-multiselect-dropdown/dist/css/bootstrap-multiselect.css" > --}}
    {{-- <script type="text/javascript" src="https://www.codehim.com/demo/bootstrap-multiselect-dropdown/dist/js/bootstrap-multiselect.js"></script> --}}

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" > --}}

    <script src="{{URL::asset ('js/bootstrap.bundle.min.js')}}" ></script> 

</head>

<body>

<header class="navbar sticky-top bg-light flex-md-nowrap p-0 shadow">
  <div class="navbar-brand col-md-3 col-lg-2 me-0 px-3">
    <img src="https://new.ksoftpl.com/newksoftplweb/wp-content/uploads/2023/03/kspl-logo.png" alt=" ">
  </div>
    <!-- <a  href="#">Company name</a> -->
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
        data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</header>

<div>
        @yield('content')
 </div>

</body>
</html>