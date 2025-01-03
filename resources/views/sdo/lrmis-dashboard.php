
<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="ico.png">
  <link rel="icon" href="ico.png">
  <title>
    DepEd Naga LRMIS v.2
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="lrmistyle" href="../assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />


  <style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 90%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

</head>

<!--------- Side Nav ------------------------------------------------------------------------------------>
<body class="g-sidenav-show  bg-gray-200">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-white" id="sidenav-main">
 
   <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" target="_blank">
        <img src="ico.png" alt="main_logo">
        <span class="ms-1 font-weight-bold text-dark">LRMIS v.2</span>
      </a>
    </div>
  
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">

      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active text-dark  bg-gradient-warning" href="../lrmis/sdo/lrmis-dashboard.php">
            <div class="text-center me-2 d-flex align-items-center justify-content-center text-dark">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
				<span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../lrmis/sdo/lrmis-addnew.php">
            <div class="text-center me-2 d-flex align-items-center justify-content-center text-dark">
              <i class="material-icons opacity-10">addchart</i>
            </div>
				<span class="nav-link-text ms-1">Add New Resource</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../lrmis/sdo/lrmis-tables.php">
            <div class="text-center me-2 d-flex align-items-center justify-content-center text-dark">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Resources</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../lrmis/sdo/lrmis-borrowers.php">
            <div class="text-center me-2 d-flex align-items-center justify-content-center text-dark">
              <i class="material-icons opacity-10">receipt_long</i>
            </div>
            <span class="nav-link-text ms-1">Borrowers Log</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-dark" href="../lrmis/sdo/lrmis-generate.php">
            <div class="text-center me-2 d-flex align-items-center justify-content-center text-dark">
              <i class="material-icons opacity-10">format_textdirection_r_to_l</i>
            </div>
            <span class="nav-link-text ms-1">Generate Report</span>
          </a>
        </li>
        
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-8 text-dark">Account lrmis</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../lrmis/sdo/lrmis-profile.php">
            <div class="text-center me-2 d-flex align-items-center justify-content-center text-dark">
              <i class="material-icons opacity-10">person</i>
            </div>
            <span class="nav-link-text ms-1">Users Profile</span>
          </a>
        </li>

 	<!-- Top User Heading ---------------------------------------------------------------------------------->
        <div class="sidenav-footer position-absolute w-100 bottom-0 ">
	     <div style="text-align:center;">
  		<img src="sdo.png" alt="Schools Division of Naga" style="width:30%; height:auto;  object-fit: cover; object-position: bottom;">
	     </div>
             <a class="btn bg-gradient-white mt-4 w-100" href="https://www.depednaga.ph" type="button">LR Data Analytics</a>
        </div>

    </ul>
      <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
          <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
      </div>
      <div class="ps__rail-y" style="top: 0px; right: 0px;">
           <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
      </div>
</div>
</aside>


  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
 			<li class="font-weight-bolder mb-0" aria-current="page">
				<?php echo $_SESSION['school_name']; ?>
			</li>
          </ol>		  
          <h6 class="text-sm text-dark active" >Welcome! <?php echo ' '.$_SESSION['first_name'].' '.$_SESSION['last_name'].' '.$_SESSION['type'];?></h6>
		  <p>
        </nav>


	<!-- COntent Header --------------------------------------------------------------------------------------->
		<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
			<div class="ms-md-auto pe-md-3 d-flex align-items-center"> 
			</div>
        </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a href="../lrmis/sdo/logout.php" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Sign Out</span>
              </a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>		
           </ul>
        </div> 
       </div>   
    </nav>
     	
    <!-- End Navbar ------------------------------------------------------------------------------
		 
	
    MAIN CONtent -------------------------------------------------------------------------------------> 
 <div class="container-fluid py-2">
   <div class="row">

      <!-- POpulation -->
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4" style="width:400px; height:auto;">
          <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="text-end pt-1">
                  <p class="text-sm mb-0 text-capitalize">Population</p>
                  <h4 class="mb-0"><?php require_once 'sdo/totalpopulation.php'; ?> Learners</h4>
                </div>

		<div id="SchoolPop"><?php require_once 'sdo/chartjsdonutchart.php'; ?></div>
	        </div>

            	<hr class="dark horizontal my-0">
            	<div class="card-footer p-3">
               	    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">School Year: </span>2021-2022</p>
            	</div>

	    </div>
         </div>

        <!-- Total Learning REsource -->
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4" style="width:650px; height:auto;">
          <div class="card">
             <div class="card-header p-3 pt-2">
               <div class="text-end pt-1">
                  <p class="text-sm mb-0 text-capitalize">Total Available LRs</p>
                  <h4 class="mb-0"><?php require_once 'sdo/totallr.php'; ?></h4>
                </div>
 
		<div id="SubjectLR"><?php require_once 'sdo/chartjsbarchart.php'; ?></div>		        
     		</div>              

              <hr class="dark horizontal my-0">
              <div class="card-footer p-3">
             	  <p class="mb-0"><span class="text-success text-sm font-weight-bolder">Last Update: </span><?php require_once 'sdo/lrmislastupdate.php'; ?></p>
              </div>

          </div>
        </div>
 </div>
 <!-- Next Row -->
 <div class="row" style="margin-top:10px;">

        <!-- Status of REsources -->
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4" style="width:400px; height:auto;">
          <div class="card">
            <div class="card-header p-3 pt-2">

              <div class="text-end pt-1">
                 <p class="text-sm mb-0 text-capitalize">Status of Resources</p> 
              	 <!-- <h4 class="mb-0">103,430</h4> -->
              </div>
		
	      <div id="LRStatus"><?php require_once 'sdo/chartjsdonutchartstatus.php'; ?></div>
	      </div>

	      <hr class="dark horizontal my-0">
  	      <div class="card-footer p-3">
             	  <p class="mb-0"><span class="text-success text-sm font-weight-bolder">Highest: </span>Usable</p>
              </div>    

           </div>
         </div>

        <!-- Learner to LR Ratio -->
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4" style="width:500px; height:auto;">
          <div class="card">
            <div class="card-header p-3 pt-2">

              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">LRs To Learner Ratio</p>
                <h4 class="mb-0"><?php require_once 'sdo/overalllearnertolrratio.php'; ?></h4>
              </div>	
			
		<div><?php require_once 'ratiotable.php'; ?></div>
	        </div>
	<!--
	      <div class="card-footer p-3">
             	  <p class="mb-0"><span class="text-success text-sm font-weight-bolder">Over-all: </span>1:1</p>
              </div>    
	-->
            </div>   
          </div>

 </div>
</main>
</body>

      <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>

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
  <script src="../assets/js/material-dashboard.min.js?v=3.0.4"></script>
</body>

</html>