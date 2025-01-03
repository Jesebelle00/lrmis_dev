<div id="carouselNonPrintControls" class="carousel slide" data-bs-ride="false">
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
                            <h5 class="mb-1">Ratio of LRs Per Grade Level</h5>
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
            <div class="container mt-4">
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Schools LR Inventory vs Learners Population</p>
                            <h5 class="mb-0">LRs Per School</h5>
                        </div>
                        <div id="mainChartContainerSliVsPop_np" style="position: relative;">
                            <!-- <button id="np_fullscreenToggleSliVsPop" class="btn btn-primary btn-sm" style="position: absolute; top: 10px; right: 10px; z-index: 10;">
                                Full Screen
                            </button> -->
                            <div id="mainSliVsPop_np" style="width: 100%; height: 500px;"></div>
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
            <div class="container mt-4">
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Heat Map</p>
                            <h5 class="mb-0">Equitable Distribution</h5>
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
