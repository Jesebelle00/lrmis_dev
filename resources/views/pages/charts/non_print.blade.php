<div id="carouselNonPrintControls" class="carousel slide" data-bs-ride="false">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <!-- Grade Subject Population Chart -->
            <div class="container mt-4">
                <div class="row">
                    <div class="text-end pt-1">
                        <p class="text-sm mt-2 text-capitalize">Subject Level LR Availability</p>
                    </div>
                </div>
                <div id="np_gradeChartContainer" style="position: relative;">
                    <!-- <button id="np_fullscreenToggle" class="btn btn-primary btn-sm" style="position: absolute; top: 10px; right: 10px; z-index: 10;">
                        Full Screen
                    </button> -->
                    <div id="np_gradeChart" style="width: 100%; height: 500px;"></div>
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
                        <div id="np_primaryContainer" style="position: relative;">
                            <!-- <button id="np_fullscreenTogglePrimary" class="btn btn-primary btn-sm" style="position: absolute; top: 10px; right: 10px; z-index: 10;">
                                Full Screen
                            </button> -->
                            <div id="np_primary" style="width: 100%; height: 500px;"></div>
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
                        <div id="mainChartContainerSliVsPop_np" style="position: relative;">
                            <!-- <button id="np_fullscreenToggleSliVsPop" class="btn btn-primary btn-sm" style="position: absolute; top: 10px; right: 10px; z-index: 10;">
                                Full Screen
                            </button> -->
                            <div id="mainSliVsPop_np" style="width: 100%; height: 500px;"></div>
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
                            <div id="exdefChart_npContainer_np" style="position: relative;">
                                <!-- <button id="fullscreenToggleExdef_np" class="btn btn-primary btn-sm" style="position: absolute; top: 10px; right: 10px; z-index: 10;">
                                    Full Screen
                                </button> -->
                                <div id="exdef_np" style="width: 100%; height: 500px;"></div>
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
                        <div id="ratiolrtableContainer_np" style="position: relative;">
                            <!-- <button id="fullscreenToggleHeatmap_np" class="btn btn-primary btn-sm" style="position: absolute; top: 10px; right: 10px; z-index: 10;">
                                Full Screen
                            </button> -->
                            <div id="ratiolrtable_np" style="width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a class="carousel-control-prev" href="#carouselNonPrintControls" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only"></span>
    </a>
    <a class="carousel-control-next" href="#carouselNonPrintControls" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only"></span>
    </a>
</div>

<!-- non-print charts -->
@include('pages.charts.non_print-js.sub_avail')
@include('pages.charts.non_print-js.total_lr')
@include('pages.charts.non_print-js.sli_vs_pop')
@include('pages.charts.non_print-js.exdef')
@include('pages.charts.non_print-js.heat_map')
