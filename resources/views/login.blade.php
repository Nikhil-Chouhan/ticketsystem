<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="{{URL::asset ('css/bootstrap.min.css')}}" rel="stylesheet" crossorigin="anonymous"> 
    <title>Ticket Admin Panel</title>
</head>
<style>
  *,
*:before,
*:after {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}
body {
  background-color: #ffffff;
}
.background {
  width: 430px;
  height: 480px;
  position: absolute;
  transform: translate(-50%, -50%);
  left: 50%;
  top: 50%;
}
.background .shape {
  height: 200px;
  width: 200px;
  position: absolute;
  border-radius: 50%;
}
.shape:first-child {
  background: linear-gradient(#1845ad, #23a2f6);
  left: -80px;
  top: -80px;
}
.shape:last-child {
  background: linear-gradient(to right, #ff512f, #f09819);
  right: -30px;
  bottom: -80px;
}
form {
  height: 520px;
  width: 400px;
  background-color: rgba(255, 255, 255, 0.13);
  position: absolute;
  transform: translate(-50%, -50%);
  top: 50%;
  left: 50%;
  border-radius: 10px;
  backdrop-filter: blur(10px);
  border: 2px solid rgba(255, 255, 255, 0.1);
  box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
  padding: 50px 35px;
}
form * {
  font-family: "Poppins", sans-serif;
  color: #000;
  letter-spacing: 0.5px;
  outline: none;
  border: none;
}
form h3 {
  font-size: 32px;
  font-weight: 500;
  line-height: 42px;
  text-align: center;
}

label {
  display: block;
  margin-top: 30px;
  font-size: 16px;
  font-weight: 500;
}
input {
  display: block;
  height: 50px;
  width: 100%;
  background-color:rgb(0 0 0 / 10%);
  border-radius: 3px;
  border-color: #000;
  padding: 0 10px;
  margin-top: 8px;
  font-size: 14px;
  font-weight: 300;
}
::placeholder {
  color: #000;
}
button {
  margin-top: 50px;
  width: 100%;
  background-color: rgb(0 0 0 / 10%);
  color: #000;
  padding: 15px 0;
  font-size: 18px;
  font-weight: 500;
  border-radius: 5px;
  cursor: pointer;
}
.social {
  margin-top: 30px;
  display: flex;
}
.social div {
  background: red;
  width: 150px;
  border-radius: 3px;
  padding: 5px 10px 10px 5px;
  background-color: rgb(0 0 0 / 10%);
  color: #000;
  text-align: center;
}
.social div:hover {
  background-color: rgba(255, 255, 255, 0.47);
}
.social .fb {
  margin-left: 25px;
}
.social i {
  margin-right: 4px;
}
</style>
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
<body>
  @if (session()->has('success'))
    <div class="toast-bodygit">
    {!! session('success') !!}
    </div>
  @endif
    {{-- <div class="container-fluid">
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
                        <div class="form-outline mb-4 mt-5">
                          <input type="text" name="email" id="email" class="form-control form-control-lg"
                            placeholder="Enter Email" required />
                        </div>

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
    </div> --}}

    <div class="background">
      <div class="shape"></div>
      <div class="shape"></div>
    </div>
    <form action="{{ route('loginpost') }}" method="post" name="admin">
      @csrf
      <h3>Login</h3>
    
      <label for="username">Email</label>
      <input type="text" name="email" placeholder="Email" id="username" required>
    
      <label for="password">Password</label>
      <input type="password" name="password" placeholder="Password" id="password" required>
    
      <button type="submit">Log In</button>
    </form>

</body>

</html>