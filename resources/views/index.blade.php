
<!--
=========================================================
* Material Dashboard 2 - v3.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="apple-touch-icon" sizes="76x76" href="ico.png">
  <link rel="icon" type="image/png" href="ico.png">
  <title>
    DepEd Naga LRMIS v.2
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css"
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
  <!-- <link rel="stylesheet" href="assets/css/login.css">
  <link rel="stylesheet" href="assets/css/lrmis_cssstyle.css"> -->

  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet">
<link id="lrmistyle" href="{{ asset('assets/css/material-dashboard.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/login.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/lrmis_cssstyle.css') }}" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <style>
  .bold-signup-button {
    font-weight: bolder;
  }
</style>

</head>

<style>
.custombg{
  margin: 0;
  padding: 0;
  /* background-image: url("assets/img/whitebg.jpg"); */
  background-size: cover;
  background-position: center;
}
@media only screen and (min-width: 768px) and (max-width: 1024px) {
  .customcard{
    margin-left: auto;
    margin-right: auto;
  }
}
@media only screen and (max-width: 400px) {
  .customcard{
    margin-left: auto;
    margin-right: auto;
  }
}

</style>
<body class="bg-gray-200">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <!-- Navbar -->
        <nav
        class="navbar navbar-expand-lg blur border-radius-xl top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
        <div class="container-fluid ps-2 pe-0">
          <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="lrmis/lrmis-dashboard.php">
            LRMIS
          </a>
          <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
          data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="navbar-toggler-icon mt-2">
            <span class="navbar-toggler-bar bar1"></span>
            <span class="navbar-toggler-bar bar2"></span>
            <span class="navbar-toggler-bar bar3"></span>
          </span>
        </button>
        <div class="collapse navbar-collapse" id="navigation">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center me-2 active" aria-current="page"


              href="https://lookerstudio.google.com/reporting/b907ba47-21db-462e-8f9c-34dfac9a91b3/page/JqokD">
              <i class="fa fa-chart-pie opacity-6 text-dark me-1"></i>
              LR Data Analytics
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-2 " href="{{ url('register') }}">
              <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
              Sign Up
            </a>
          </li>
        </ul>
        <ul class="navbar-nav d-lg-flex d-none">
          <li class="nav-item d-flex align-items-center">
            <a class="btn btn-outline-primary btn-sm mb-0 me-2" target="_blank"
            href="https://drive.google.com/file/d/10DZoDhOwiPsfmua49ml1pthDHDSe2hN5/view?usp=drive_link">LRMIS User Manual v.2</a>

          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
</div>
</div>
</div>




<!-- MAIN CONTENT -->
<main class="main-content mt-0 ">
  <!-- <img src="assets/img/depedNaga.png" alt="bg" class="login_img"> -->
  <div class="page-header align-items-start min-vh-100">
    <span class="mask opacity-1"></span>
    <div class="container my-auto">
      <div class="row d-flex justify-content-between my-4">
        <div class="col-md-5 col-lg-15 col-15 mx-1 my-auto pt-5">

          <iframe
          src="https://lookerstudio.google.com/embed/reporting/31d4f526-4a6b-422a-bf3b-8ae627df0ca5/page/GynVD"
          width="850"
          height="640"
          frameborder="0">
        </iframe>

      </div>
      <div class=" col-md-8 col-lg-4 col-12 my-auto">
        <div class="card z-index-0 fadeIn3 fadeInBottom mx-0 mt-5 px-2">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="shadow-dark border-radius-lg pt-3 pb-3"
            style="background: #0071bd; ">
            <h4 class="text-white text-center  mb-0">DepEd LRMIS</h4>
            <div class="row ">
            </div>
          </div>
        </div>
        <div class="card-body py-0 px-3 mx-2 my-2" >
          <h4 style="text-align:center" class="mt-2">Login</h4>
          <img src="assets/img/lrmis_qr.png" alt="QR Login" width="100" height="100"  style="display: block; margin: 0 auto;">
          <p class="mt-0" style="color:#000000; text-align: center; font-size: 14px" >Welcome to DepEd LRMIS!</p>
          <div id="wb_form">
            <div class="mt-2 mb-2" id="loginMessage"></div>

            {{-- @if ($errors->any())
                <div class="alert alert-warning" style="text-align: center;">
                    {{ $errors->first('message') }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success" style="text-align: center;">
                    {{ session('success') }}
                </div>
            @endif --}}
{{--
            @section('content') --}}
            <div class="container">
                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="login_content mx-2">
                        <!-- Username -->
                        <div class="login_box">
                            <i class="ri-user-3-line login_icon"></i>
                            <div class="login_box-input">
                                <input class="login_input" type="text" id="username" name="username" placeholder=" " required>
                                <label for="username" class="login_label">Username</label>
                            </div>
                        </div>
                        <!-- Password -->
                        <div class="login_box">
                            <i class="ri-lock-2-fill login_icon"></i>
                            <div class="login_box-input">
                                <input type="password" name="password" class="login_input" id="password" placeholder=" " required>
                                <label for="password" class="login_label">Password</label>
                                <i class="ri-eye-off-line login_eye" id="loginEye"></i>
                            </div>
                        </div>
                        <!-- Submit -->
                        <button type="submit" class="btn btn-primary shadow-dark mx-5 mt-2 my-0 loginbtn">Login</button>
                        <div class="py-0 mb-3 text-center">
                            <span style="color:#000000;font-size:13px;"> Don't have an account yet?
                                <a href="{{ url('pages/register') }}" class="signuplink">Sign Up Here.</a>
                            </span>
                        </div>
                    </div>
                </form>

            </div>

            {{-- @endsection --}}
            <script>
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    }
                });
            </script>

            <script>
                $(document).ready(function () {
                    $('#loginForm').on('submit', function (e) {
                        e.preventDefault();

                        const formData = $(this).serialize();

                        $.ajax({
                            url: $(this).attr('action'),
                            type: 'POST',
                            data: formData,
                            success: function (response) {
                                if (response.success) {
                                    $('#loginMessage').html('<div class="alert alert-success" style="text-align:center; color: #fff; padding: 5px 10px" role="alert">' + response.message + '</div>');
                                    setTimeout(function() {
                                        window.location.href = response.redirect_url;
                                    }, 1000);
                                } else {
                                    $('#loginMessage').html('<div class="alert alert-warning" style="text-align:center; color: #fff; padding: 5px 10px" role="alert">' + response.message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                                }
                            },
                            error: function() {
                                $('#loginMessage').html('<div class="alert alert-warning" style="text-align:center; color: #fff; padding: 5px 10px" role="alert">' + response.message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                            }
                        });
                    });
                });
            </script>

          </div>
      </div>
    </div>
  </div>
</div>
</div>
</main>


<style>
.alertLogin {
  text-align:center;
  /* font-size: clamp(0.875rem, 0.75rem + 0.3333vw, 1rem); */
  font-size: 13px;
  color: #fff;
  background-color: rgba(255, 0, 0, 0.7);
  padding: 5px 10px 5px;
  border-radius: 14px;

}
.alertCloseB{
  color: #fff;
  /* font-size: clamp(0.875rem, 0.75rem + 0.3333vw, 1rem); */
  font-size: 12px;
}
.alertCloseB:hover{
  color: #000;
  /* background-color: rgba(255, 0, 0, 0.3); */
  font-size: 15px;
  /* font-size: clamp(0.875rem, 0.75rem + 0.3333vw, 1rem); */
}



</style>

<script src="assets/js/viewpass.js"> </script>

<script>
function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

<!--   Core JS Files   -->
<script src="{{asset('assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>

<script>
var win = navigator.platform.indexOf('Win') > -1;
if (win && document.querySelector('#sidenav-scrollbar')) {
  var options = {
    damping: '0.5'
  }
  Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
}
</script>

<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example lrmis etc -->
<script src="{{asset('assets/js/material-dashboard.min.js?v=3.0.4')}}"></script>


<!-- //toaster -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</body>
</html>
