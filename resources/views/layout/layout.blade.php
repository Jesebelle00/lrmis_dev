<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="apple-touch-icon" sizes="76x76" href="ico.png">
		<link rel="icon" href="ico.png">
		<title>
			DepEd Naga LRMIS v.3
		</title>
		<!--     Fonts and icons     -->
		<link rel="stylesheet" type="text/css"
			href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
		<!-- Nucleo Icons -->
		<link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
		<link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
		<!-- Font Awesome Icons -->
		<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

		<!-- Material Icons -->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
		<!-- CSS Files -->
		<link id="lrmistyle" href="{{ asset('assets/css/material-dashboard.css?v=3.0.4') }}" rel="stylesheet" />
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
			integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<link rel="stylesheet" href="{{ asset('assets/css/lrmis_cssstyle.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.min.css">

		<link rel="stylesheet" href="{{ asset('assets/css/scrollTop.css') }}">
		<!-- <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
			crossorigin="anonymous"></script> -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

		<!-- Bootstrap 5 JS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
			integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
		</script>
		<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
		<link rel="stylesheet" href="{{ asset('assets/css/profilepage.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/css/datatable.custom.css') }}">
	</head>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			const navLinks = document.querySelectorAll("#sidenav-main .nav-link, #sidenav-main .submenu-link");

			function setActiveClass() {
				navLinks.forEach(link => {
					link.classList.remove("active", "bg-gradient-warning", "text-white", "text-danger");
					const navLinkText = link.querySelector(".nav-link-text");
					if (navLinkText) {
						navLinkText.style.color = "#344767";
					}
					if (link.href && link.href !== "#" && link.href === window.location.href) {
						link.classList.add("active", "bg-gradient-warning");
						if (link.classList.contains("submenu-link")) {
							link.classList.add("text-danger");
						}
						if (navLinkText) {
							navLinkText.style.color = "white";
						}
					}
				});
			}

			setActiveClass();
		});
	</script>

	<!--------- Side Nav ------------------------------------------------------------------------------------>

	<body class="g-sidenav-show  bg-gray-200">

		@include('layout.nav')
		@yield('content')
		<style>
			@media only screen and (max-width: 600px) {
				.scroll-bar {
					border-radius: 20px;
					width: 280px;
					height: 100%;
					overflow-x: scroll;
				}
			}
		</style>

		</main>

		<!--   Core JS Files   -->
		<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
		<!-- <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script> -->
		<script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>

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
		<script src="{{ asset('assets/js/material-dashboard.min.js?v=3.0.4') }}"></script>

		<div id="progress">
			<span id="progress-value"><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
					clip-rule="evenodd">
					<path d="M11 2.206l-6.235 7.528-.765-.645 7.521-9 7.479 9-.764.646-6.236-7.53v21.884h-1v-21.883z" />
				</svg></span>
		</div>
		<script src="{{ asset('assets/js/scrollTop.js') }}"></script>

		<style>
			a {
				cursor: pointer;
			}

			.arrow {
				width: 18px;
				height: auto;
				position: absolute;
				color: #808080;
				left: 12rem;
				transition: 0.5s ease;
			}

			.arrow.down {
				transform: rotate(180deg);
			}

			.navbar-vertical .navbar-nav .nav-link[data-bs-toggle="collapse"]:after {
				color: #344767;
			}

			.navbar-vertical .navbar-nav .nav-link[data-bs-toggle="collapse"][aria-expanded="true"]:after {
				color: #344767;
			}

			.submenu {
				list-style: none;
				width: 87%;
				padding-top: 0.5rem;
				padding-bottom: 0.55rem;
				padding-left: 0;
				margin-left: 1rem;
				margin-bottom: 1.5px;
				background-color: #fff;
				border-radius: 5px;
				color: #808080;
			}

			.submenu a {
				cursor: pointer;
				width: max-content;
				color: #344767;
				font-size: 14px;
				text-decoration: none;
			}

			.submenu a li {
				padding: 5px 15px;
			}

			.submenu a li:hover {
				background-color: #c4cfe3;
				border-radius: 5px;
				margin-left: 5px;
				transition: 1s ease;
			}
			/* Increase space between the arrows */
			.carousel-control-prev, .carousel-control-next {
				margin-left: 15px; /* Adjust the space as needed */
				margin-right: 15px; /* Adjust the space as needed */
			}

			/* Optional: Make the arrow icons white for better visibility */
			.carousel-control-prev-icon,
			.carousel-control-next-icon {
				filter: invert(0); /* This will make the arrows white */
				transition: filter 0.3s ease, opacity 0.3s ease; /* Smooth transition for color and opacity */
			}

			/* Change the arrow color to black when hovered */
			.carousel-control-prev:hover .carousel-control-prev-icon,
			.carousel-control-next:hover .carousel-control-next-icon {
				filter: invert(1); /* Turns the arrow color to black */
			}

			/* Make the arrow turn black */
			.carousel-control-prev.icon-black .carousel-control-prev-icon,
			.carousel-control-next.icon-black .carousel-control-next-icon {
				filter: invert(1); /* Turns the arrow color to black */
			}

			/* Make the arrow disappear */
			.carousel-control-prev.icon-hidden,
			.carousel-control-next.icon-hidden {
				opacity: 0; /* Makes the arrow transparent */
			}
			.carousel-control-prev {
				left: -50px;  /* Adjust the left positioning */
			}

			.carousel-control-next {
				right: -50px;  /* Adjust the right positioning */
			}
		</style>
	</body>

</html>
