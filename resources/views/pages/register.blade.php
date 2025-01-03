<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
?>



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


</head>
<style>
.form-label{
  font-weight: 500;
}
</style>
<body class="bg-gray-200">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <!-- Navbar -->
        <nav
        class="navbar navbar-expand-lg blur border-radius-xl top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0">
        <di class="container-fluid ps-2 pe-0">
          <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="{{ url('dashboard') }}">
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
              href="{{ url('dashboard') }}">
              <i class="fa fa-chart-pie opacity-6 text-dark me-1"></i>
              LR Main Dashboard
            </a>
          </li>
      <li class="nav-item">
        <a class="nav-link me-2" href="{{ url('index') }}">
          <i class="fas fa-key opacity-6 text-dark me-1"></i>
          Sign In
        </a>
      </li>
    </ul>
    <ul class="navbar-nav d-lg-flex d-none">
      <li class="nav-item d-flex align-items-center">
        <a class="btn btn-outline-primary btn-sm mb-0 me-2" target="_blank"
        href="https://www.depednaga.ph">www.depednaga.ph</a>
      </li>
    </ul>
  </div>
</di>
</nav>
<!-- End Navbar -->
</div>
</div>
</div>

<!-- MAIN CONTENT -->
<main class="main-content  mt-0">
  <div class="page-header align-items-start min-vh-100" style="background-image: url('?unnamed.jpg');">
    <span class="mask opacity-6"></span>

    <div class="container mt-5 my-3">
      <div class="row mt-5 my-3">
        <div class="col-sm-12 col-md-10 col-lg-10 mx-auto">
          <div class="card z-index-0 fadeIn3 fadeInBottom mt-5 mx-2    ">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="shadow-dark border-radius-lg pt-3 pb-3" style="background: #0071bd; ">
                <h4 class="text-white text-center  mb-0">DepEd Naga LRMIS</h4>
                <div class="row ">

                </div>
              </div>
            </div>

        <style media="screen">
					.error-text{
						font-size: small;
						float: right;
						vertical-align: middle;
						padding-top: 5px;
            color: #dc3545;

					}
          #reg_form{
            margin-left: 20px;
            margin-right: 20px;
          }
          @media only screen and (max-width: 600px) {
            #reg_form{
              margin-left: 0;
              margin-right: 0;
            }
          }
					</style>

            <h4 style="text-align: center" class="mt-4 mb-2 my-2">Sign Up</h4>
             <p class="" style="text-align: center; color:black; text-align: center; padding-left: 30px; padding-right: 30px; font-size: clamp(0.875rem, 0.75rem + 0.3333vw, 1rem);">To create an account, please provide the neccessary information  in the form then  click the submit button.</p>
                <div class="row ms-2 ">

                    @include('section.register-form')

              </div>
            </div>
          </div>
      </div>
    </div>
   <style>
        .titleB {
          font-size: 20px;
          text-align: center;
        }
        .confirmBtn{
          font-size: 15px !important;
          margin: 20px !important;
          border-radius: 100px !important;
          padding: 7px 30px !important;
          background-color: #0071bd !important;
        }
        .iconSize{
          margin-top: 50px;
          font-size: 15px;
          /* margin: auto; */

        }
        .closeButtonClass{
          color: #000;
          font-size: 40px;
        }
        .closeButtonClass:hover{
          color: #E25657;
        }
        .cancelBtn{
          font-size: 15px !important;
          margin: 20px !important;
          border-radius: 100px !important;
          padding: 7px 30px !important;
          background-color: #E25657 !important;
        }
    </style>

    <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/material-dashboard.min.js?v=3.0.4')}}"></script>



</body>

</html>
