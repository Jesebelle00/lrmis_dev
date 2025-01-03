@extends('layout.layout')

<head>
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    
    <!-- Fonts and Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
    
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    
    <!-- Material Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
</head>

@section('content')

<div class="container-fluid py-2">

    <!-- Nav Tabs with Custom Styling -->
    <div class="col-md-8 mb-0">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="tab-button active" id="chart-tab" data-bs-toggle="tab" data-bs-target="#chart" type="button" role="tab" aria-controls="chart" aria-selected="true">Print</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="tab-button" id="table-tab" data-bs-toggle="tab" data-bs-target="#table" type="button" role="tab" aria-controls="table" aria-selected="false" tabindex="-1">Non-Print</button>
            </li>
        </ul>
    </div>

    <div class="row g-1">
        
        <!-- Print Chart -->
        <div class="col-xl-9 col-sm-6 mb-1">
            <div class="card" style="height: 676px; display: flex; flex-direction: column; justify-content: space-between;">
                <div class="card-body">
                    <div class="tab-content" id="printChartTabsContent">
                        <div class="tab-pane fade show active" id="chart" role="tabpanel" aria-labelledby="chart-tab">
                            <div class="pe-2">
                                <div class="chart">
                                    @include('pages.charts.print')
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="table" role="tabpanel" aria-labelledby="table-tab">
                            <div class="pe-2">
                                @include('pages.charts.non_print')
                            </div>
                        </div>
                    </div>
                    <hr class="dark horizontal">
                </div>
            </div>
        </div>

        <!-- New Two Cards -->
        <div class="col-xl-3 col-sm-6">
            
            <!-- Total Learning Resources Card -->
            <div class="col-xl-12 col-sm-6 mb-1">
                <div class="card">
                    <div class="card-header p-2 ps-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-sm mb-0 text-capitalize">TOTAL LEARNING RESOURCES</p>
                                <h4 class="mb-0">{{ $printCount + $nonPrintCount }}</h4>
                            </div>
                            <div class="icon icon-md icon-shape bg-gradient-warning shadow-dark shadow text-center border-radius-lg">
                                <i class="material-symbols-rounded opacity-10">book</i>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('pages.charts.total_lr')
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-2 ps-3">
                        <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">S/Y: </span>2024 - 2025</p>
                    </div>
                </div>
            </div>

            <!-- Total Learners Card -->
            <div class="col-xl-12 col-sm-6 mb-1">
                <div class="card">
                    <div class="card-header p-2 ps-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-sm mb-0 text-capitalize">TOTAL LEARNERS</p>
                                <h4 class="mb-0">{{$totalPopulation}}</h4>
                            </div>
                            <div class="icon icon-md icon-shape bg-gradient-warning shadow-dark shadow text-center border-radius-lg">
                                <i class="material-symbols-rounded opacity-10">school</i>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('pages.charts.total_learners')
                    </div>
                    <hr class="dark horizontal my-0">
                </div>
            </div>
        </div>
    </div>

    <!-- School Profile and Transaction Section -->
    <div class="row g-1 mb-4">
        
        <!-- School Profile -->
        <div class="col-lg-8 col-md-6 mb-md-0 mb-1">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-lg-6 col-7">
                            <h4 class="mb-4">School Profile</h4>
                        </div>
                        <div class="col-lg-6 col-5 my-auto text-end">
                            @if ($profileService->Level === "1")
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add Region</button>
                            @elseif ($profileService->Level === "2")
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add SDO</button>
                            @elseif ($profileService->Level === "3")
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add District</button>
                            @elseif ($profileService->Level === "4")
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add School</button>
                            @else
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body px-2 pb-2">
                    <div class="table-responsive">
                        <table id="user-profile-table" class="table table-bordered table-sm table-hover nowrap" style="width: 100%; font-size: 0.875rem;">
                            <thead class="thead-light">
                                <tr>
                                    <th>School</th>
                                    <th>District</th>
                                    <th>Division</th>
                                    <th>Region</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    @include('pages.add_station-modal')
                </div>
            </div>
        </div>

        <!-- Transaction -->
        <div class="col-lg-4 col-md-6">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-lg-6 col-7">
                            <h4 class="mb-4">Transaction</h4>
                        </div>
                    </div>
                </div>

                <div class="card-body p-3">
                    <div class="timeline timeline-one-side">
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i class="material-symbols-rounded text-success text-gradient">notifications</i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">$2400, Design changes</h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">22 DEC 7:20 PM</p>
                            </div>
                        </div>
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i class="material-symbols-rounded text-danger text-gradient">code</i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">New order #1832412</h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">21 DEC 11 PM</p>
                            </div>
                        </div>
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i class="material-symbols-rounded text-info text-gradient">shopping_cart</i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">Server payments for April</h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">21 DEC 9:34 PM</p>
                            </div>
                        </div>
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i class="material-symbols-rounded text-warning text-gradient">credit_card</i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">New card added for order #4395133</h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">20 DEC 2:20 AM</p>
                            </div>
                        </div>
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i class="material-symbols-rounded text-primary text-gradient">key</i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">Unlock packages for development</h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">18 DEC 4:54 AM</p>
                            </div>
                        </div>
                        <div class="timeline-block">
                            <span class="timeline-step">
                                <i class="material-symbols-rounded text-dark text-gradient">payments</i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">New order #9583120</h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">17 DEC</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('pages.footer')

@endsection
