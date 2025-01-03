<script src="https://cdn.jsdelivr.net/npm/echarts@5.1.2/dist/echarts.min.js"></script>

<div id="carouselPrintControls" class="carousel slide" data-bs-ride="false">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <!-- Grade Subject Population Chart -->
            <div class="container mt-4">
                <div class="row mt-3">
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Subject Level LR Availability</p>
                        <h5 class="mb-1">Available LRs Per Subject</h5>
                    </div>
                </div>
                <div id="gradeChartContainer" style="position: relative;">
                    <button id="fullscreenToggle" class="btn btn-primary btn-sm" style="position: absolute; top: 10px; right: 10px; z-index: 10;">
                        Full Screen
                    </button>
                    <div id="gradeChart" style="width: 100%; height: 500px;"></div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <!-- Learner to LR Ratio -->
            <div class="container mt-4">
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">LRs To Learner Ratio</p>
                            <h5 class="mb-1">Ratio of LRs Per Grade Level</h5>
                        </div>
                        <div id="primaryContainer" style="position: relative;">
                            <button id="fullscreenTogglePrimary" class="btn btn-primary btn-sm" style="position: absolute; top: 10px; right: 10px; z-index: 10;">
                                Full Screen
                            </button>
                            <div id="primary" style="width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <!-- Total Learning Resource -->
            <div class="container mt-4">
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Schools LR Inventory vs Learners Population</p>
                            <h5 class="mb-0">LRs Per School</h5>
                        </div>
                        <div id="mainChartContainer" style="position: relative;">
                            <button id="fullscreenToggle2" class="btn btn-primary btn-sm" style="position: absolute; top: 10px; right: 10px; z-index: 10;">
                                Full Screen
                            </button>
                            <div id="main" style="width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        <div class="carousel-item">
            <!-- Grade-Subject ExDef -->
            <div class="container mt-4">
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Grade-Subject ExDef</p>
                            <h5 class="mb-0">Excess| Deficiency</h5>
                            <div id="exdefChartContainer" style="position: relative;">
                                <button id="fullscreenToggleExdef" class="btn btn-primary btn-sm" style="position: absolute; top: 10px; right: 10px; z-index: 10;">
                                    Full Screen
                                </button>
                                <div id="exdef" style="width: 100%; height: 500px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <!-- Heat Map -->
            <div class="container mt-4">
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Heat Map</p>
                            <h5 class="mb-0">Equitable Distribution</h5>
                        </div>
                        <div id="ratiolrtableContainer" style="position: relative;">
                            <button id="fullscreenToggleHeatmap" class="btn btn-primary btn-sm" style="position: absolute; top: 10px; right: 10px; z-index: 10;">
                                Full Screen
                            </button>
                            <div id="ratiolrtable" style="width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselPrintControls" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only"></span>
    </a>
    <a class="carousel-control-next" href="#carouselPrintControls" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only"></span>
    </a>
</div>
<!-- print charts -->
@include('pages.charts.print-js.sub_avail')
@include('pages.charts.print-js.total_lr')
@include('pages.charts.print-js.sli_vs_pop')
@include('pages.charts.print-js.exdef')
@include('pages.charts.print-js.heatmap')
