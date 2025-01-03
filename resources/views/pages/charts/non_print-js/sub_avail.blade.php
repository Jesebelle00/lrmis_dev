<script type="text/javascript">
    // Initialize the chart
    var chartDomNonPrint = document.getElementById('np_gradeChart');
    var subAvailNonPrintChart = echarts.init(chartDomNonPrint);

    // Fetch dynamic data passed from Laravel
    var dataNonPrint = @json($subAvailData_np);

    // Helper function to create unique values
    function getUniqueValues(array, key) {
        return [...new Set(array.map(item => item[key]))];
    }

    // Get unique grades and subjects
    var gradesNonPrint = getUniqueValues(dataNonPrint, 'grade_level');
    var subjectsNonPrint = getUniqueValues(dataNonPrint, 'subject_shortcode');

    // Prepare series data
    var seriesNonPrint = subjectsNonPrint.map(subject => ({
        name: subject,
        type: 'bar',
        data: gradesNonPrint.map(grade => {
            // Ensure missing data is handled
            var item = dataNonPrint.find(d => d.grade_level === grade && d.subject_shortcode === subject);
            return item ? item.qty : 0;
        })
    }));

    // Add Population line series
    seriesNonPrint.push({
        name: 'Population',
        type: 'line',
        areaStyle: { opacity: 0.35 },
        smooth: true,
        data: gradesNonPrint.map(grade => {
            // Fetch the first available population for each grade
            var items = dataNonPrint.filter(d => d.grade_level === grade);
            return items.length > 0 ? items[0].population : 0;
        })
    });

    // Chart options
    var optionNonPrint = {
        legend: {},
        tooltip: {
            trigger: 'axis',
            axisPointer: { type: 'line' }
        },
        xAxis: {
            type: 'category',
            data: gradesNonPrint,
            axisLabel: { rotate: -45 }
        },
        yAxis: [
            { type: 'value', name: 'Learning Resources' },
            { type: 'value', name: 'Population', show: false }
        ],
        series: seriesNonPrint,
        grid: {
            containLabel: true,
            left: '10%',
            right: '10%',
            top: '15%',
            bottom: '10%'
        }
    };

    // Set the chart options
    subAvailNonPrintChart.setOption(optionNonPrint);

    // Handle resizing on window resize
    window.onresize = function () {
        subAvailNonPrintChart.resize();
    };

    // Handle resizing when carousel item is shown
    $('#carouselNonPrintControls').on('slide.bs.carousel', function () {
        setTimeout(function () {
            subAvailNonPrintChart.resize();
        }, 100);
    });

    // Resize the chart when the non-print tab is shown
    $('#table-tab').on('shown.bs.tab', function () {
        setTimeout(function () {
            subAvailNonPrintChart.resize(); // Resize the chart
        }, 100); // Small delay to allow for layout changes
    });

    // Full-screen toggle functionality
    const fullscreenToggleNonPrint = document.getElementById('np_fullscreenToggle');
    const gradeChartContainerNonPrint = document.getElementById('np_gradeChartContainer');

    fullscreenToggleNonPrint.addEventListener('click', () => {
        if (!document.fullscreenElement) {
            // Enter full screen
            gradeChartContainerNonPrint.requestFullscreen();
            fullscreenToggleNonPrint.textContent = 'Exit Full Screen';

            // Apply full-screen styles
            gradeChartContainerNonPrint.style.backgroundColor = 'white';
            gradeChartContainerNonPrint.style.display = 'flex';
            gradeChartContainerNonPrint.style.justifyContent = 'center';
            gradeChartContainerNonPrint.style.alignItems = 'center';
            gradeChartContainerNonPrint.style.height = '100vh';
            gradeChartContainerNonPrint.style.padding = '20px';

            subAvailNonPrintChart.resize(); // Resize chart to fit new container size
        } else {
            // Exit full screen
            document.exitFullscreen();
            fullscreenToggleNonPrint.textContent = 'Full Screen';

            // Reset styles
            gradeChartContainerNonPrint.style.backgroundColor = '';
            gradeChartContainerNonPrint.style.display = '';
            gradeChartContainerNonPrint.style.justifyContent = '';
            gradeChartContainerNonPrint.style.alignItems = '';
            gradeChartContainerNonPrint.style.height = '';
            gradeChartContainerNonPrint.style.padding = '';

            subAvailNonPrintChart.resize(); // Resize chart back to original size
        }
    });

    // Listen for the ESC key to exit full-screen mode
    document.addEventListener('keydown', function (event) {
        if (event.key === "Escape" && document.fullscreenElement) {
            // Exit full screen
            document.exitFullscreen();
            fullscreenToggleNonPrint.textContent = 'Full Screen';

            // Reset styles
            gradeChartContainerNonPrint.style.backgroundColor = '';
            gradeChartContainerNonPrint.style.display = '';
            gradeChartContainerNonPrint.style.justifyContent = '';
            gradeChartContainerNonPrint.style.alignItems = '';
            gradeChartContainerNonPrint.style.height = '';
            gradeChartContainerNonPrint.style.padding = '';

            subAvailNonPrintChart.resize(); // Resize chart back to original size
        }
    });

    // Adjust chart on fullscreen change
    document.addEventListener('fullscreenchange', () => {
        if (!document.fullscreenElement) {
            fullscreenToggleNonPrint.textContent = 'Full Screen';

            // Reset styles
            gradeChartContainerNonPrint.style.backgroundColor = '';
            gradeChartContainerNonPrint.style.display = '';
            gradeChartContainerNonPrint.style.justifyContent = '';
            gradeChartContainerNonPrint.style.alignItems = '';
            gradeChartContainerNonPrint.style.height = '';
            gradeChartContainerNonPrint.style.padding = '';
        }
        subAvailNonPrintChart.resize();
    });
</script>
