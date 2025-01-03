<script type="text/javascript">
    // Initialize the chart for print version
    var chartDomPrint = document.getElementById('gradeChart');
    var subAvailPrintChart = echarts.init(chartDomPrint);

    // Fetch dynamic data passed from Laravel for print version
    var dataPrint = @json($subAvailData);

    var gradesPrint = [...new Set(dataPrint.map(item => item.grade_level))];
    var subjectsPrint = [...new Set(dataPrint.map(item => item.subject_shortcode))];

    // Prepare series data for print version
    var seriesPrint = subjectsPrint.map(subject => ({
        name: subject,
        type: 'bar',
        data: gradesPrint.map(grade => {
            var item = dataPrint.find(d => d.grade_level === grade && d.subject_shortcode === subject);
            return item ? item.qty : 0;
        })
    }));

    seriesPrint.push({
        name: 'Population',
        type: 'line',
        areaStyle: { opacity: 0.35 },
        smooth: true,
        data: gradesPrint.map(grade => {
            var items = dataPrint.filter(d => d.grade_level === grade);
            return items.length > 0 ? items[0].population : 0;
        })
    });

    // Chart options for print version
    var optionPrint = {
        legend: {},
        tooltip: {
            trigger: 'axis',
            axisPointer: { type: 'line' }
        },
        xAxis: {
            type: 'category',
            data: gradesPrint,
            axisLabel: { rotate: -45 }
        },
        yAxis: [
            { type: 'value', name: 'Learning Resources' },
            { type: 'value', name: 'Population', show: false }
        ],
        series: seriesPrint,
        grid: {
            containLabel: true,
            left: '10%',
            right: '10%',
            top: '15%',
            bottom: '10%'
        }
    };

    // Set the chart options for print version
    subAvailPrintChart.setOption(optionPrint);

    window.onresize = function () {
        subAvailPrintChart.resize();
    };

    // Resize the chart when carousel item is shown
    $('#carouselPrintControls').on('slide.bs.carousel', function () {
        setTimeout(function () {
            subAvailPrintChart.resize();
        }, 100);
    });
    // Resize the chart when the print tab is shown
    $('#chart').on('shown.bs.tab', function () {
        setTimeout(function () {
        subAvailPrintChart.resize(); // Resize the chart
        }, 100); // Small delay to allow for layout changes
    });

    // Full-screen toggle functionality for print version
    const fullscreenTogglePrint = document.getElementById('fullscreenToggle');
    const gradeChartContainerPrint = document.getElementById('gradeChartContainer');

    fullscreenTogglePrint.addEventListener('click', () => {
        if (!document.fullscreenElement) {
            // Enter full screen
            gradeChartContainerPrint.requestFullscreen();
            fullscreenTogglePrint.textContent = 'Exit Full Screen';

            // Apply full-screen styles
            gradeChartContainerPrint.style.backgroundColor = 'white';
            gradeChartContainerPrint.style.display = 'flex';
            gradeChartContainerPrint.style.justifyContent = 'center';
            gradeChartContainerPrint.style.alignItems = 'center';
            gradeChartContainerPrint.style.height = '100vh';
            gradeChartContainerPrint.style.padding = '20px';

            subAvailPrintChart.resize(); // Resize chart to fit new container size
        } else {
            // Exit full screen
            document.exitFullscreen();
            fullscreenTogglePrint.textContent = 'Full Screen';

            // Reset styles
            gradeChartContainerPrint.style.backgroundColor = '';
            gradeChartContainerPrint.style.display = '';
            gradeChartContainerPrint.style.justifyContent = '';
            gradeChartContainerPrint.style.alignItems = '';
            gradeChartContainerPrint.style.height = '';
            gradeChartContainerPrint.style.padding = '';

            subAvailPrintChart.resize(); // Resize chart back to original size
        }
    });

    // Listen for the ESC key to exit full-screen mode for print version
    document.addEventListener('keydown', function (event) {
        if (event.key === "Escape" && document.fullscreenElement) {
            // Exit full screen
            document.exitFullscreen();
            fullscreenTogglePrint.textContent = 'Full Screen';

            // Reset styles
            gradeChartContainerPrint.style.backgroundColor = '';
            gradeChartContainerPrint.style.display = '';
            gradeChartContainerPrint.style.justifyContent = '';
            gradeChartContainerPrint.style.alignItems = '';
            gradeChartContainerPrint.style.height = '';
            gradeChartContainerPrint.style.padding = '';

            subAvailPrintChart.resize(); // Resize chart back to original size
        }
    });

    // Adjust chart on fullscreen change for print version
    document.addEventListener('fullscreenchange', () => {
        if (!document.fullscreenElement) {
            fullscreenTogglePrint.textContent = 'Full Screen';

            // Reset styles
            gradeChartContainerPrint.style.backgroundColor = '';
            gradeChartContainerPrint.style.display = '';
            gradeChartContainerPrint.style.justifyContent = '';
            gradeChartContainerPrint.style.alignItems = '';
            gradeChartContainerPrint.style.height = '';
            gradeChartContainerPrint.style.padding = '';
        }
        subAvailPrintChart.resize();
    });
</script>
