<script type="text/javascript">
    // Fetch dynamic data passed from Laravel for non-print chart
    const totalLrData_np = @json($totalLrData_np);

    // Group data by grade levels and calculate totals if duplicates exist for non-print
    const groupedData_np = {};
    totalLrData_np.forEach(item => {
        if (!groupedData_np[item.grade_level]) {
            groupedData_np[item.grade_level] = {
                total_lr: parseInt(item.total_lr),
                population: parseInt(item.population),
            };
        } else {
            groupedData_np[item.grade_level].total_lr += parseInt(item.total_lr);
            groupedData_np[item.grade_level].population += parseInt(item.population);
        }
    });

    // Prepare data for non-print chart
    const npChartData = Object.keys(groupedData_np).map(grade => [
        grade,
        groupedData_np[grade].population,
        groupedData_np[grade].total_lr,
    ]);

    // Sort the chart data for non-print by grade levels
    npChartData.sort((a, b) => {
        function extractGradeNumber(str) {
            const gradeMatch = str.match(/\d+/);
            return gradeMatch ? parseInt(gradeMatch[0]) : str.includes('Kindergarten') ? -1 : 0;
        }
        return extractGradeNumber(a[0]) - extractGradeNumber(b[0]);
    });

    // Extract total learning resources and population for non-print
    const totalLR_np = npChartData.map(item => item[2]);
    const minPopulationData_np = {
        name: 'Population',
        type: 'line',
        smooth: true,
        data: npChartData.map(item => item[1]),
        lineStyle: { width: 2 },
        showSymbol: false,
        areaStyle: { opacity: 0.7 },
    };

    const totalBarData_np = {
        name: 'Total LR',
        type: 'bar',
        stack: 'total',
        emphasis: { focus: 'series' },
        data: totalLR_np,
        label: {
            show: true,
            position: 'top',
            formatter: function (params) {
                const population = minPopulationData_np.data[params.dataIndex];
                if (population === 0) return 'N/A'; // Avoid division by zero
                const ratio = (totalLR_np[params.dataIndex] / population).toFixed(1);
                return ratio + ':1';
            },
        },
    };

    // Non-print chart options
    const npGraphOptions = {
        tooltip: { trigger: 'axis', axisPointer: { type: 'shadow' } },
        legend: { data: ['Total LR', 'Min Population'] },
        xAxis: {
            type: 'category',
            data: npChartData.map(item => item[0]),
            axisLabel: { interval: 0, rotate: -45, margin: 8 },
        },
        yAxis: { type: 'value' },
        series: [totalBarData_np, minPopulationData_np],
    };

    // Initialize and set the non-print chart options
    const npPrimaryDom = document.getElementById('np_primary');
    const npTotalLrGraph = echarts.init(npPrimaryDom);
    npTotalLrGraph.setOption(npGraphOptions);

    // Resize the non-print chart on window resize
    window.onresize = function () {
        npTotalLrGraph.resize();
    };

    // Resize the non-print chart when carousel item is shown
    $('#carouselNonPrintControls').on('slide.bs.carousel', function () {
        setTimeout(function () {
            npTotalLrGraph.resize(); // Resize the chart when a new slide is active
        }, 100);
    });

    // Full-screen toggle functionality for non-print chart
    const npFullscreenTogglePrimary = document.getElementById('np_fullscreenTogglePrimary');
    const npPrimaryContainer = document.getElementById('np_primaryContainer');

    npFullscreenTogglePrimary.addEventListener('click', () => {
        if (!document.fullscreenElement) {
            // Enter full screen
            npPrimaryContainer.requestFullscreen();
            npFullscreenTogglePrimary.textContent = 'Exit Full Screen';
            
            // Apply full-screen styles
            npPrimaryContainer.style.backgroundColor = 'white';  // Set background color to white
            npPrimaryContainer.style.display = 'flex';  // Use flexbox to center the content
            npPrimaryContainer.style.justifyContent = 'center';  // Center horizontally
            npPrimaryContainer.style.alignItems = 'center';  // Center vertically
            npPrimaryContainer.style.height = '100vh';  // Full viewport height
            npPrimaryContainer.style.padding = '20px';  // Add padding for margin effect

            npTotalLrGraph.resize(); // Resize chart to fit new container size
        } else {
            // Exit full screen
            document.exitFullscreen();
            npFullscreenTogglePrimary.textContent = 'Full Screen';
            
            // Reset styles
            npPrimaryContainer.style.backgroundColor = '';  // Reset background color
            npPrimaryContainer.style.display = '';  // Reset layout
            npPrimaryContainer.style.justifyContent = '';  // Reset alignment
            npPrimaryContainer.style.alignItems = '';  // Reset alignment
            npPrimaryContainer.style.height = '';  // Reset height
            npPrimaryContainer.style.padding = '';  // Reset padding

            npTotalLrGraph.resize(); // Resize chart back to original size
        }
    });

    // Listen for the ESC key to exit full-screen mode
    document.addEventListener('keydown', function (event) {
        if (event.key === "Escape" && document.fullscreenElement) {
            // Exit full screen
            document.exitFullscreen();
            npFullscreenTogglePrimary.textContent = 'Full Screen';
            
            // Reset styles
            npPrimaryContainer.style.backgroundColor = '';  // Reset background color
            npPrimaryContainer.style.display = '';  // Reset layout
            npPrimaryContainer.style.justifyContent = '';  // Reset alignment
            npPrimaryContainer.style.alignItems = '';  // Reset alignment
            npPrimaryContainer.style.height = '';  // Reset height
            npPrimaryContainer.style.padding = '';  // Reset padding

            npTotalLrGraph.resize(); // Resize chart back to original size
        }
    });

    // Adjust non-print chart on fullscreen change
    document.addEventListener('fullscreenchange', () => {
        if (!document.fullscreenElement) {
            // When exiting fullscreen, reset button text to "Full Screen"
            npFullscreenTogglePrimary.textContent = 'Full Screen';

            // Reset styles
            npPrimaryContainer.style.backgroundColor = '';  // Reset background color
            npPrimaryContainer.style.display = '';  // Reset layout
            npPrimaryContainer.style.justifyContent = '';  // Reset alignment
            npPrimaryContainer.style.alignItems = '';  // Reset alignment
            npPrimaryContainer.style.height = '';  // Reset height
            npPrimaryContainer.style.padding = '';  // Reset padding
        }
        npTotalLrGraph.resize();
    });
</script>
