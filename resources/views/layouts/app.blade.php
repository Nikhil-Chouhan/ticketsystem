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
{{-- New SideBar --}}


<body>
    <header class="navbar sticky-top bg-light flex-md-nowrap p-0 shadow">
        <div class="navbar-brand col-md-3 col-lg-2 me-0 px-3">
          <img src="https://new.ksoftpl.com/newksoftplweb/wp-content/uploads/2023/03/kspl-logo.png" alt=" ">
        </div>
        {{-- <li>
          <div class="openmenu">
            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
          </div>
          <ul class="sub-menu">
            <span class="link_name">logout</span>
          </ul>
        </li> --}}
          <!-- <a  href="#">Company name</a> -->
        
    </header>

    <div class="sidebar">
      <div class="logo-details">
        <i class='bx bxs-pyramid'></i>
        <span class="logo_name">Admin Panel</span>
      </div>
    
      <ul class="nav-links">
        @can('manage_masters')
          <li>
            <div class="icon-link openmenu">
              <a href="#">
                <i class='bx bx-book'></i>
                <span class="link_name">Masters</span>
              </a>
              <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
              <li><a class="link_name" href="#">Masters</a></li>
              <li><a href="{{route('companymaster')}}">Company</a></li>
              <li><a href="{{route('branchmaster')}}">Branch</a></li>
              <li><a href="{{route('productmaster')}}">Product</a></li>
              <li><a href="{{route('servicemaster')}}">Service</a></li>
            </ul>
          </li>
        @endcan

        @can('manage_registers')
          <li>
            <div class="icon-link openmenu">
              <a href="#">
                <i class='bx bx-book-add'></i>
                <span class="link_name">Register</span>
              </a>
              <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
              <li><a class="link_name" href="#">Register</a></li>
              <li><a href="{{route('companyregister')}}">Company</a></li>
              <li><a href="{{route('branchregister')}}">Branch</a></li>
              <li><a href="{{url('productregister')}}">Product</a></li>
              <li><a href="{{url('serviceregister')}}">Service</a></li>
            </ul>
          </li>
        @endcan

        @canany(['support_bucket','pmbucket','management_bucket'])
        <li>
          <div class="icon-link openmenu">
            <a href="#">
              <i class='bx bx-book-content'></i>
              <span class="link_name">Tickets</span>
            </a>
            <i class='bx bxs-chevron-down arrow'></i>
          </div>
          <ul class="sub-menu">
            <li><a class="link_name">Tickets</a></li>
            @can('support_bucket')
              <li><a href="{{url('supportbucket')}}">Support Bucket</a></li>
            @endcan
            @can('pm_bucket')
              <li><a href="{{url('pmbucket')}}">PM Bucket</a></li>
            @endcan
            @can('management_bucket')
              <li><a href="{{url('managementbucket')}}">Management</a></li>
            @endcan
          </ul>
        </li>
        @endcanany
        @can('manage_activetickets')
          <li>
            <div class="icon-link openmenu">
              <a href="#">
                <i class='bx bx-book-bookmark'></i>
                <span class="link_name">ActiveTickets</span>
              </a>
              <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
              <li><a class="link_name" href="#">Active Tickets</a></li>
              <li><a href="{{url('livetickets')}}">Live Tickets</a></li>
              <li><a href="{{url('openticket')}}">Open Tickets</a></li>
              <li><a href="{{url('workinprogress')}}">Work in Progress</a></li>
              <li><a href="{{url('CloseTicket')}}">Closed Tickets</a></li>
            </ul>
          </li>
        @endcan

        @can('manage_users')
          <li>
            <div class="icon-link openmenu">
              <a>
                <i class='bx bx-user'></i>
                <span class="link_name">Users</span>
              </a>
              <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
              <li><a class="link_name">Users</a></li>
              <li><a href="{{route('users')}}">Users</a></li>
              <li><a href="{{route('regsiteruser')}}">Add User</a></li>
              <li><a href="{{url('registerrole')}}">Add Role</a></li>
              <li><a href="{{url('registerpermission')}}">Add Permission</a></li>
            </ul>
          </li>
        @endcan

        <li>
          <div class="icon-link openmenu">
            <a>
              <i class='bx bx-detail'></i>
              <span class="link_name">My Tickets</span>
            </a>
            <i class='bx bxs-chevron-down arrow'></i>
          </div>
          <ul class="sub-menu">
            <li><a class="link_name">My Tickets</a></li>
            <li><a href="{{route('myopentickets')}}">Open Tickets</a></li>
            <li><a href="{{route('myinprogresstickets')}}">Work In Progress</a></li>
            <li><a href="{{route('myQnAtickets')}}">In QnA</a></li>
          </ul>
        </li>

        <li>
          <div class="icon-link openmenu">
            <a>
              <i class='bx bx-detail'></i>
              <span class="link_name">My QnA</span>
            </a>
            <i class='bx bxs-chevron-down arrow'></i>
          </div>
          <ul class="sub-menu">
            <li><a class="link_name">My QnA</a></li>
            <li><a href="{{route('QnATickets')}}">QnA Tickets</a></li>
          </ul>
        </li>

        <li>
          <a href="{{url('get-userdetails')}}">
            <i class='bx bx-user-circle'></i>
            <span class="link_name">User Details</span>
          </a>
          <ul class="sub-menu blank">
            <li><a class="link_name" href="{{url('get-userdetails')}}">User Details</a></li>
          </ul>
        </li>
        <li>
          <a href="{{url('logout')}}">
            <i class='bx bx-log-out'></i>
            <span class="link_name">Log out</span>
          </a>
          <ul class="sub-menu blank">
            <li><a class="link_name" href="{{url('logout')}}">Log out</a></li>
          </ul>
        </li>
        
    </ul>
    </div>
    <section class="home-section">
      <div class="colse-sidebar home-content">
        <i class='bx bx-menu'></i>
      </div>
      <div>
        @yield('content')
    </div>
    </section>

    

<script>

    const arrows = document.querySelectorAll(".openmenu");

    arrows.forEach((arrow) => {
        arrow.addEventListener("click", (e) => {
            const arrowParent = e.target.closest(".openmenu").parentElement;
            arrowParent.classList.toggle("showMenu");
        });
    });

    const sidebar = document.querySelector(".sidebar");
    const sidebarBtn = document.querySelector(".colse-sidebar");

    sidebarBtn.addEventListener("click", () => {
        sidebar.classList.toggle("close");
    });

</script>

</body>
</html>