<aside
	class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl fixed-start ms-3 overflow-hidden  bg-gradient-white"
	id="sidenav-main">
	<div class="sidenav-header">
		<i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
			aria-hidden="true" id="iconSidenav"></i>
		<a class="navbar-brand m-0" target="_blank">
			<img src="{{ asset('ico.png') }}" class="navbar-brand-img h-100" alt="main_logo">
			<span class="ms-1 font-weight-bold text-dark">LRMIS v.3</span>
		</a>
	</div>

	<hr class="horizontal light mt-0 mb-2">
	<div class="collapse navbar-collapse w-auto" style="height:auto" id="sidenav-collapse-main">
		<ul class="navbar-nav ">
			<li class="nav-item">
				<a class="nav-link active text-light bg-gradient-warning " href="{{ url('../pages/dashboard') }}">
					<div class="text-center me-2 d-flex align-items-center justify-content-center text-dark">
						<i class="material-icons opacity-10">dashboard</i>
					</div>
					<span class="nav-link-text ms-1">Dashboard</span>
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link text-dark" href="{{ url('../pages/add-resources') }}">
					<div class="text-center me-2 d-flex align-items-center justify-content-center text-dark">
						<i class="material-icons opacity-10" style="color: #344767">addchart</i>
					</div>
					<span class="nav-link-text ms-1" style="color: #344767">Add New Resource</span>
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link text-dark" data-bs-toggle="collapse" href="#resourcesCollapse" role="button"
					aria-expanded="false" aria-controls="resourcesCollapse">
					<div class="text-center me-2 d-flex align-items-center justify-content-center text-dark">
						<i class="material-icons opacity-10" style="color: #344767">table_view</i>
					</div>
					<span class="nav-link-text ms-1" style="color: #344767">Resources</span>
				</a>
				<div class="collapse" id="resourcesCollapse">
					<ul class="submenu">
						<a href="{{ url('/pages/school-resources') }}" class="submenu-link">
							<li>School Resources</li>
						</a>
						<a href="{{ url('/pages/lr-hubs') }}" class="submenu-link">
							<li>LR Hub</li>
						</a>
					</ul>
				</div>
			</li>

			<!-- CSS Code for the submenu -->
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

				@media only screen and (max-width: 600px) {
					.scroll-bar {
						border-radius: 20px;
						width: 280px;
						height: 100%;
						overflow-x: scroll;
					}
				}
			</style>

			<li class="nav-item">
				<a class="nav-link text-dark" href="{{ url('../pages/borrowers-log') }}">
					<div class="text-center me-2 d-flex align-items-center justify-content-center text-dark">
						<i class="material-icons opacity-10" style="color: #344767">receipt_long</i>
					</div>
					<span class="nav-link-text ms-1" style="color: #344767">Borrowers Log</span>
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link text-dark" href="{{ url('../pages/reports') }}">
					<div class="text-center me-2 d-flex align-items-center justify-content-center text-dark">
						<i class="material-icons opacity-10" style="color: #344767">format_textdirection_r_to_l</i>
					</div>
					<span class="nav-link-text ms-1" style="color: #344767">Generate Report</span>
				</a>
			</li>

			<li class="nav-item mt-3">
				<h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-8 text-dark">Account lrmis</h6>
			</li>
			<li class="nav-item">
				<a class="nav-link text-dark" href="{{ url('../pages/user-profile') }}">
					<div class="text-center me-2 d-flex align-items-center justify-content-center text-dark">
						<i class="material-icons opacity-10" style="color: #344767">person</i>
					</div>
					<span class="nav-link-text ms-1" style="color: #344767">Users Profile</span>
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link text-dark" href="{{ url('../pages/station-profile') }}">
					<div class="text-center me-2 d-flex align-items-center justify-content-center text-dark">
						<i class="material-icons opacity-10" style="color: #344767">school</i>
					</div>
					<span class="nav-link-text ms-1" style="color: #344767">School Profile</span>
				</a>
			</li>
            {{-- @if ($profileService->Type === "SDO Librarian")
                I have one record!
            @elseif (count($records) > 1)
                I have multiple records!
            @else
                I don't have any records!
            @endif --}}

			<!-- Top User Heading ---------------------------------------------------------------------------------->
	</div>
	<div class="sidenav-footer position-absolute w-100 mb-2 pb-0 " style="bottom:0">
		<div style="text-align:center;">
		</div>
		<a class="btn bg-gradient-white w-100 mb-0 pb-0"
			href="https://lookerstudio.google.com/embed/reporting/2a622315-7649-4cea-a7cd-6a8a1f2859e6/page/JoMED"
			type="button">LR Data Analytics</a>

		</ul>
		<!-- <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;">
				<div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div> -->
	</div>
</aside>

<main class="main-content" style="overflow-x:hidden">
	<!-- Navbar -->
	<nav class="navbar navbar-main navbar-expand-lg px-0 shadow-none border-radius-xl" id="navbarBlur"
		data-scroll="true">
		<div class="container-fluid py-1 px-3">
			<nav aria-label="breadcrumb">
				<h3 class="font-weight-bolder mb-0" style="font-size: clamp(0.8125rem, 0.767rem + 0.2273vw, 0.9375rem);">
					{{ $profileService->StationName }}</h3>
				<h6 class="text-sm text-dark active welcometext">Welcome! {{ $profileService->Firstname }}
					{{ $profileService->Lastname }} {{ $profileService->Type }}</h6>
                    <div class="text-center">

                        @php $shortcode = session('shortcode'); @endphp

                        <!-- <p><strong>Description:</strong>
                            @switch($shortcode)
                                @case('CO-BLR')
                                    {{$shortcode}}
                                    @break
                                @case('RLREPS')
                                    {{$shortcode}}
                                    @break
                                @case('RL')
                                    {{$shortcode}}
                                    @break
                                @case('LREPS')
                                    {{$shortcode}}
                                    @break
                                @case('PDO')
                                    {{$shortcode}}
                                    @break
                                @case('SDOL')
                                   {{$shortcode}}
                                    @break
                                @case('ITO')
                                    {{$shortcode}}
                                    @break
                                @case('PSDS')
                                    {{$shortcode}}
                                    @break
                                @case('DL')
                                    {{$shortcode}}
                                    @break
                                @case('DPC')
                                    {{$shortcode}}
                                    @break
                                @case('DICT')
                                    {{$shortcode}}
                                    @break
                                @case('SP')
                                    {{$shortcode}}
                                    @break
                                @case('SL')
                                    {{$shortcode}}
                                    @break
                                @case('SPC')
                                    {{$shortcode}}
                                    @break
                                @case('SICT')
                                    {{$shortcode}}
                                    @break
                                @case('SDOPC')
                                    {{$shortcode}}
                                    @break
                                @case('AO')
                                    {{$shortcode}}
                                    @break
                                @case('SDOSO')
                                    {{$shortcode}}
                                    @break
                                @case('TCH')
                                    {{$shortcode}}
                                    @break
                                @default
                                    Shortcode not recognized
                            @endswitch
                        </p> -->
                    </div>
			</nav>

			<!-- CONTENT Header --------------------------------------------------------------------------------------->

			<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
				<div class="ms-md-auto pe-md-3 d-flex align-items-center">
				</div>
			</div>

			<!-- Profile pic dropdown  -->
			<script>
				function toggleMenu() {
					let subMenu = document.getElementById("subMenu");
					subMenu.classList.toggle("open-menu");
				}
			</script>

			<!-- Profile Picture -->
			<img src="{{ asset('profile_picture/default-icon.jpg') }}" alt="profile" class="user-pic"
				onclick="toggleMenu()">

			<div class="sub-menu-cont" id="subMenu">
				<div class="sub">
					<div class="userdetails">
						<img src="{{ asset('profile_picture/default-icon.jpg') }}" class="user-pic_2" alt="">

						<a href="{{ url('../pages/profile') }}" class="userdetails" style="text-decoration: none; color: black">
							<h4>My Profile</h4>
						</a>
					</div>
					<hr>

					<a href="#" class="submenu_link"
						onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
						<i class="fa fa-sign-out icn"></i> Sign Out
					</a>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						@csrf
					</form>

				</div>
			</div>

			<ul class="navbar-nav justify-content-end">
				<li class="nav-item d-xl-none ps-2 d-flex align-items-center">
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
	</nav>
