<div id="carouselPrintControls" class="carousel slide" data-bs-ride="false">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <!-- Grade Subject Population Chart -->
            <div class="container mt-4">
                <div class="row">
                    <div class="text-end pt-1">
                        <p class="text-sm mt-2 text-capitalize">Subject Level LR Availability</p>
                    </div>
                </div>
                <div id="gradeChartContainer" style="position: relative;">
                    <!-- <button id="fullscreenToggle" class="btn btn-primary btn-sm" style="position: absolute; top: 10px; right: 10px; z-index: 10;">
                        Full Screen
                    </button> -->
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
                            <h4 class="mb-0"><?php //require_once 'overalllearnertolrratio_sdo.php'; ?></h4>
                        </div>
                        <div id="primaryContainer" style="position: relative;">
                            <!-- <button id="fullscreenTogglePrimary" class="btn btn-primary btn-sm" style="position: absolute; top: 10px; right: 10px; z-index: 10;">
                                Full Screen
                            </button> -->
                            <div id="primary" style="width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="carousel-item">
            <!-- Total Learning Resource -->
            <div class="container">
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Schools LR Inventory vs Learners Population</p>
                            <h4 class="mb-0">
                                <?php //require_once 'totallr_sdo.php'; ?>LRs | 
                                <?php //require_once 'totalpopulation_sdo.php'; ?> Learners
                            </h4>
                        </div>
                        <div id="mainChartContainer" style="position: relative;">
                            <!-- <button id="fullscreenToggle2" class="btn btn-primary btn-sm" style="position: absolute; top: 10px; right: 10px; z-index: 10;">
                                Full Screen
                            </button> -->
                            <div id="main" style="width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                </div>
            </div>
        </div>  

        <div class="carousel-item">
            <!-- Grade-Subject ExDef -->
            <div class="container">
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Grade-Subject ExDef</p>
                            <div id="exdefChartContainer" style="position: relative;">
                                <!-- <button id="fullscreenToggleExdef" class="btn btn-primary btn-sm" style="position: absolute; top: 10px; right: 10px; z-index: 10;">
                                    Full Screen
                                </button> -->
                                <div id="exdef" style="width: 100%; height: 500px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="carousel-item">
            <!-- Heat Map -->
            <div class="container">
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Heat Map</p>
                        </div>
                        <div id="ratiolrtableContainer" style="position: relative;">
                            <!-- <button id="fullscreenToggleHeatmap" class="btn btn-primary btn-sm" style="position: absolute; top: 10px; right: 10px; z-index: 10;">
                                Full Screen
                            </button> -->
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
