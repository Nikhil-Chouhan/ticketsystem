<!doctype html>
<html lang="en"
dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Ticketing Tool Help Desk</title>
  <!-- Ajax Crf Token Setup -->
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">

  <!-- Datatable -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
  <!-- Custom Stylesheet -->
  <link rel="stylesheet" href="  {{ asset('vendor/chartist/css/chartist.min.css') }}">
  <link href="{{ asset('vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}"rel="stylesheet">
  <link href="{{ asset('vendor/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
  <link href="{{asset('css/style.css')}}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
  
  <script src="{{URL::asset ('js/kit.fontawesome.com_me.js')}}" ></script> 
  {{-- <!--Old Links-->
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.11.1/dist/css/uikit.min.css">

    <script src="https://cdn.jsdelivr.net/npm/uikit@3.11.1/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.11.1/dist/js/uikit-icons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"></script>

    <link href="{{URL::asset ('css/app.css')}}" rel="stylesheet" crossorigin="anonymous">
  <!--Old Links--> --}}
</head>

{{-- <head>
    
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->

    <link href="{{URL::asset ('css/font-awesome.css')}}" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icon-kit/dist/css/iconkit.min.css') }}">
    
    <link href="{{URL::asset ('css/sidebar.css')}}" rel="stylesheet" crossorigin="anonymous">
    
    <link href="{{URL::asset ('css/bootstrap.min.css')}}" rel="stylesheet" crossorigin="anonymous"> 
    

    <title>Ticket Admin Panel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

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
    <script src="{{URL::asset ('js/bootstrap.bundle.min.js')}}" ></script> 

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.11.1/dist/css/uikit.min.css">

    <script src="https://cdn.jsdelivr.net/npm/uikit@3.11.1/dist/js/uikit.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.11.1/dist/js/uikit-icons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"></script>
  <link href="{{URL::asset ('css/app.css')}}" rel="stylesheet" crossorigin="anonymous">

{{-- <body>
    <header class="navbar sticky-top bg-light flex-md-nowrap p-0 shadow">
        <div class="navbar-brand col-md-3 col-lg-2 me-0 px-3">
          <img src="https://new.ksoftpl.com/newksoftplweb/wp-content/uploads/2023/03/kspl-logo.png" alt=" ">
        </div>
        <div class="mx-5">
          <a href="{{url('generateticket')}}"><button type="button" class="btn btn-outline-success">Generate Ticket</button></a>
        </div>

    </header>

    <div class="sidebar">
      <div class="logo-details">
        <i class='bx bxs-pyramid'></i>
        <span class="logo_name">Admin Panel</span>
      </div>
    
      <ul class="nav-links">
        <li>
          <a href="{{url('dashboard')}}">
            <i class='bx bx-list-check'></i>
            <span class="link_name">Dashboard</span>
          </a>
          <ul class="sub-menu blank">
            <li><a class="link_name" href="{{url('dashboard')}}">Dashboard</a></li>
          </ul>
        </li>
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
              <li><a href="{{route('departmentmaster')}}">Department</a></li>
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
              <li><a href="{{url('inQnA')}}">In QnA</a></li>
              <li><a href="{{url('failedQnA')}}">Failed QnA</a></li>
              <li><a href="{{url('approveQnA')}}">Approve QnA</a></li>
              <li><a href="{{url('CloseTicket')}}">Closed Tickets</a></li>
            </ul>
          </li>
        @endcan

        @can('manage_mytickets')
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
              <li><a href="{{route('mydepartmenttickets')}}">My Department Tickets</a></li>
              <li><a href="{{route('myopentickets')}}">Open Tickets</a></li>
              <li><a href="{{route('myinprogresstickets')}}">Work In Progress</a></li>
              <li><a href="{{route('myQnAtickets')}}">In QnA</a></li>
              <li><a href="{{route('myFailedQnAtickets')}}">Failed QnA</a></li>
            </ul>
          </li>
        @endcan

       @can('manage_testing')
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
              <li><a href="{{route('QnAPassTickets')}}">QnA Pass</a></li>
              <li><a href="{{route('QnAfailTickets')}}">QnA Fail</a></li>
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
              <li><a href="{{route('registeruser')}}">Add User</a></li>
              <li><a href="{{url('registerrole')}}">Add Role</a></li>
              <li><a href="{{url('registerpermission')}}">Add Permission</a></li>
            </ul>
          </li>
        @endcan

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

    document.addEventListener('new_ticket_created', function () {
            toastr.success('New ticket raised');
    });

    document.dispatchEvent(new Event('new_ticket_created'));
    
</script>
</body> --}}

<body>

<!--Preloader start-->
    
  <div id="preloader">
    <div class="sk-three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
    </div>
  </div>

<!--Preloader end-->

  <!--Main wrapper start-->
  <div id="main-wrapper">

    <!--Nav header start-->
    <div class="nav-header">
      <a href="index.html" class="brand-logo">
          <img class="logo-abbr" src="https://new.ksoftpl.com/newksoftplweb/wp-content/uploads/2023/03/kspl-logo.png" alt="">
          {{-- <img class="logo-compact" src="./images/logo-text.png" alt="">
          <img class="brand-title" src="./images/logo-text.png" alt=""> --}}
      </a>

      <div class="nav-control">
        <div class="hamburger">
          <span class="line"></span><span class="line"></span><span class="line"></span>
        </div>
      </div>
    </div>
    <!--Nav header end-->

    <!--Header start-->
    <div class="header">
      <div class="header-content">
        <nav class="navbar navbar-expand">
          <div class="collapse navbar-collapse justify-content-between">
            <div class="header-left">
                <div class="dashboard_bar">
                Ticketing Tool Help Desk
                </div>
            </div>
            
            <a href={{route('generateticket')}}><button type="submit" class="btn btn-success btn-lg">Generate Ticket</button></a>
            
            
            <ul class="navbar-nav header-right">
              <li class="nav-item dropdown header-profile">
                <a class="nav-link" href="javascript:void(0)" role="button" data-toggle="dropdown">
                    <img src="images/profile/17.jpg" width="20" alt=""/>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a href="./app-profile.html" class="dropdown-item ai-icon">
                      <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                      <span class="ml-2">Profile </span>
                  </a>
                  <a href="./email-inbox.html" class="dropdown-item ai-icon">
                      <svg id="icon-inbox" xmlns="http://www.w3.org/2000/svg" class="text-success" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                      <span class="ml-2">Inbox </span>
                  </a>
                  <a href="./page-login.html" class="dropdown-item ai-icon">
                      <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                      <span class="ml-2">Logout </span>
                  </a>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </div>
    <!--Header end-->

    <!--Sidebar start-->
    <div class="deznav">
      <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
          <li><a href="{{url('dashboard')}}" aria-expanded="false">
            <i class="flaticon-381-networking"></i>
            <span class="nav-text">Dashboard</span>
            </a>
          </li>

          <li><a class="has-arrow ai-icon" aria-expanded="false">
            <i class="flaticon-381-television"></i>
            <span class="nav-text">Masters</span>
            </a>
            <ul aria-expanded="false">
              <li><a  href="{{route('companymaster')}}">Company</a></li>
              <li><a href="{{route('branchmaster')}}">Branch</a></li>
              <li><a href="{{route('productmaster')}}">Product</a></li>
              <li><a href="{{route('servicemaster')}}">Service</a></li>
              <li><a href="{{route('departmentmaster')}}">Department</a></li>
            </ul>
          </li>

          {{-- <li><a class="has-arrow ai-icon" aria-expanded="false">
            <i class="flaticon-381-controls-3"></i>
            <span class="nav-text">Register</span>
            </a>
            <ul aria-expanded="false">
                <li><a href="{{route('companyregister')}}">Company</a></li>
                <li><a href="{{route('branchregister')}}">Branch</a></li>
                <li><a href="{{url('productregister')}}">Product</a></li>
                <li><a href="{{url('serviceregister')}}">Service</a></li>
            </ul>
          </li> --}}

          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="flaticon-381-internet"></i>
              <span class="nav-text">Tickets</span>
            </a>
              <ul aria-expanded="false">
                  <li><a href="{{url('supportbucket')}}">Support Bucket</a></li>
                  <li><a href="{{url('pmbucket')}}">PM Bucket</a></li>
                  <li><a href="{{url('managementbucket')}}">Management</a></li>
              </ul>
          </li>

            <li>
              <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                <i class="flaticon-381-heart"></i>
                <span class="nav-text">ActiveTickets</span>
              </a>
              <ul aria-expanded="false">
                  <li><a href="{{url('livetickets')}}">Live Tickets</a></li>
                  <li><a href="{{url('inQnA')}}">In QnA</a></li>
                  <li><a href="{{url('failedQnA')}}">Failed QnA</a></li>
                  <li><a href="{{url('approveQnA')}}">Approve QnA</a></li>
                  <li><a href="{{url('CloseTicket')}}">Closed Tickets</a></li>
              </ul>
            </li>
          
            <li>
              <a class="has-arrow ai-icon" aria-expanded="false">
                <i class="flaticon-381-notepad"></i>
                <span class="nav-text">My Tickets</span>
              </a>
              <ul aria-expanded="false">
                  <li><a href="{{route('mydepartmenttickets')}}">My Department Tickets</a></li>
                  <li><a href="{{route('myopentickets')}}">Open Tickets</a></li>
                  <li><a href="{{route('myinprogresstickets')}}">Work In Progress</a></li>
                  <li><a href="{{route('myQnAtickets')}}">In QnA</a></li>
                  <li><a href="{{route('myFailedQnAtickets')}}">Failed QnA</a></li>
              </ul>
            </li>

            <li>
              <a class="has-arrow ai-icon" aria-expanded="false">
                <i class="flaticon-381-network"></i>
                <span class="nav-text">My QnA</span>
              </a>
                <ul aria-expanded="false">
                  <li><a href="{{route('QnATickets')}}">QnA Tickets</a></li>
                  <li><a href="{{route('QnAPassTickets')}}">QnA Pass</a></li>
                  <li><a href="{{route('QnAfailTickets')}}">QnA Fail</a></li>
                </ul>
            </li>
            
            <li>
              <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                <i class="flaticon-381-layer-1"></i>
                <span class="nav-text">Users</span>
              </a>
              <ul aria-expanded="false">
                  <li><a href="{{route('users')}}">Users</a></li>
                  <li><a href="{{route('registeruser')}}">Add User</a></li>
                  <li><a href="{{url('registerrole')}}">Add Role</a></li>
                  <li><a href="{{url('registerpermission')}}">Add Permission</a></li>
              </ul>
            </li>

            <li><a href="{{url('logout')}}" aria-expanded="false">
              <i class="flaticon-381-networking"></i>
              <span class="nav-text">Log out</span>
              </a>
            </li>
        </ul>

        <div class="copyright">
          <p><strong>Kanishka Ticketing Dashboard</strong> © 2023 All Rights Reserved</p>
          <p>Made with <span class="heart"></span> by Kanishka Software Pvt Ltd</p>
        </div>

      </div>
    </div>

    <!--Sidebar end-->

    <!-- Content body start-->
    <div class="content-body">
      <div>
         @yield('content')
        
      </div>
    </div>

  </div>
<!--Main wrapper end-->

<script src="{{URL::asset ('vendor/global/global.min.js')}}" ></script> 
<script src="{{URL::asset ('js/custom.min.js')}}" ></script> 
<script src="{{URL::asset ('js/deznav-init.js')}}" ></script> 
<script src="{{URL::asset ('vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}" ></script> 
<script src="{{URL::asset ('vendor/chart.js/Chart.bundle.min.js')}}" ></script> 
<script src="{{URL::asset ('vendor/owl-carousel/owl.carousel.js')}}" ></script> 
<script src="{{URL::asset ('js/dashboard/event-detail.js')}}" ></script> 

<!-- Dashboard 1 -->
<script src="{{URL::asset ('js/dashboard/dashboard-1.js')}}" ></script> 

<!-- Datatable -->
<script src="{{URL::asset ('vendor/datatables/js/jquery.dataTables.min.js')}}" ></script> 
<script src="{{URL::asset ('js/plugins-init/datatables.init.js')}}" ></script> 

<!-- Chart piety plugin files -->
<script src="{{URL::asset ('vendor/peity/jquery.peity.min.js')}}" ></script> 

<!-- Apex Chart -->
<script src="{{URL::asset ('vendor/apexchart/apexchart.js')}}" ></script> 

</body>

</html>