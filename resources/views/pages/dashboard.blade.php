@extends('layout.layout')

<!-- echart script -->
<script src="https://cdn.jsdelivr.net/npm/echarts@5.1.2/dist/echarts.min.js"></script>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
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
      <div class="col-xl-8 col-sm-6 mb-1">
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
      <div class="col-xl-4 col-sm-6">
          <div class="col-xl-12 col-sm-6 mb-1">
              <div class="card">
                  <div class="card-header p-2 ps-3">
                      <div class="d-flex justify-content-between">
                          <div>
                              <p class="text-sm mb-0 text-capitalize">TOTAL LEARNING RESOURCES</p>
                              <h4 class="mb-0">3,462</h4>
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
          <div class="col-xl-12 col-sm-6 mb-1">
              <div class="card">
                  <div class="card-header p-2 ps-3">
                      <div class="d-flex justify-content-between">
                          <div>
                              <p class="text-sm mb-0 text-capitalize">TOTAL LEARNERS</p>
                              <h4 class="mb-0">103,430</h4>
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
    <div class="row g-1 mb-4">
        
<!-- Profiles -->
<div class="col-lg-8 col-md-6 mb-md-0 mb-4">
    <div class="card">
        <div class="card-header pb-0">
            <div class="row">
                <div class="col-lg-6 col-7">
                    <h4>School Profile</h4>
                </div>
                <div class="col-lg-6 col-5 my-auto text-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add School</button>
                </div>
            </div>
        </div>
        <div class="card-body px-0 pb-2">
            <div class="table-responsive">
                <table id="user-profile-table" class="table table-bordered table-sm nowrap" style="width: 100%; font-size: 12px;">
                    <thead>
                        <tr>
                            <th style="width: 25%;">School</th>
                            <th style="width: 20%;">District</th>
                            <th style="width: 20%;">Division</th>
                            <th style="width: 20%;">Region</th>
                            <th style="width: 15%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#user-profile-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('station-profile.data') }}",
            scrollX: true,
            columns: [
                { data: 'school_name' },
                { data: 'district_name' },
                { data: 'division_name' },
                { data: 'region_name' },
                {
                    data: 'actions',
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                }
            ],
            responsive: false,
            language: {
                emptyTable: "No data available in the table"
            }
        });
    });

    function editStation(stationId) {
        alert("Edit button clicked for Station ID: " + stationId);
    }

    function deleteStation(stationId) {
        if (confirm("Are you sure you want to delete this station?")) {
            alert("Delete button clicked for Station ID: " + stationId);
        }
    }
</script>

<style>
    .table-sm th, .table-sm td {
        padding: 0.3rem;
    }
    .table th, .table td {
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
    }
</style>


        <!-- Transaction -->
        <div class="col-lg-4 col-md-6">
            <div class="card h-100">
            <div class="card-header pb-0">
                <h6>Orders overview</h6>
                <p class="text-sm">
                <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
                <span class="font-weight-bold">24%</span> this month
                </p>
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
    @include ('pages.footer')

    <!-- Datables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/datatable.custom.css') }}">
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>

@endsection
