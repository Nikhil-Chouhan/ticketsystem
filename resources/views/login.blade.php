<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="css/dashboard.css" rel="stylesheet" crossorigin="anonymous">
    <title>Ticket Admin Panel</title>
</head>

<body>
    <!-- <h1>Hello, world!</h1> -->

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <div class="navbar-brand col-md-3 col-lg-2 me-0 px-3"><img
                src="https://new.ksoftpl.com/newksoftplweb/wp-content/uploads/2023/03/kspl-logo.png" alt=" "></div>
        <!-- <a  href="#">Company name</a> -->
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </header>

    <div class="container-fluid">
        <div class="row"> 
            <section class="vh-100" >
                <div class="container-fluid h-custom mt-5">
                  <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-md-9 col-lg-6 col-xl-5">
                      <img src="https://foodiisoft.com/web/assets/img/back.jpg"
                        class="img-fluid rounded-3" alt="Sample image">
                    </div>
                    @if (session()->has('success'))
                    <div class="notification">
                    {!! session('success') !!}
                    </div>
                    @endif
                    <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1" style="box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px; border-radius:10px;">
                      <form action="{{ route('loginpost') }}" method="post" name="admin">                                     
                        @csrf
                        {{-- <!-- UserName input -->
                        <div class="form-outline mb-4 mt-5">
                          <input type="text" name="username" id="username" class="form-control form-control-lg"
                            placeholder="Enter User Name" required />
                        </div> --}}
              
                        <!-- Email input -->
                        <div class="form-outline mb-4 mt-5">
                          <input type="text" name="email" id="email" class="form-control form-control-lg"
                            placeholder="Enter Email" required />
                        </div>


                        <!-- Password input -->
                        <div class="form-outline mb-4">
                          <input type="password" id="password" name="password" class="form-control form-control-lg"
                            placeholder="Enter password" required />
                        </div>
              
                        <div class="text-center text-lg-start mb-5 mt-5">
                          <button type="submit" class="btn btn-primary btn-lg" 
                          style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>                           
                        </div> 

                      </form>
                    </div>
                  </div>
                </div>

              </section>

        </div>
    </div>

</body>

</html>