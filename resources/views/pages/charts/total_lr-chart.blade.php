<script>
    // Fetch dynamic data passed from Laravel
    const totalLrData = @json($totalLrData);

    // Group data by grade levels and calculate totals if duplicates exist
    const groupedData = {};
    totalLrData.forEach(item => {
        if (!groupedData[item.grade_level]) {
            groupedData[item.grade_level] = {
                total_lr: parseInt(item.total_lr),
                population: parseInt(item.population),
            };
        } else {
            groupedData[item.grade_level].total_lr += parseInt(item.total_lr);
            groupedData[item.grade_level].population += parseInt(item.population);
        }
    });

    // Prepare data for the chart
    const chartData = Object.keys(groupedData).map(grade => [
        grade,
        groupedData[grade].population,
        groupedData[grade].total_lr,
    ]);

    // Sort the chart data by grade levels
    chartData.sort((a, b) => {
        function extractGradeNumber(str) {
            const gradeMatch = str.match(/\d+/);
            return gradeMatch ? parseInt(gradeMatch[0]) : str.includes('Kindergarten') ? -1 : 0;
        }
        return extractGradeNumber(a[0]) - extractGradeNumber(b[0]);
    });

    // Extract total learning resources and population
    const totalLR = chartData.map(item => item[2]);
    const minPopulationData = {
        name: 'Population',
        type: 'line',
        smooth: true,
        data: chartData.map(item => item[1]),
        lineStyle: { width: 2 },
        showSymbol: false,
        areaStyle: { opacity: 0.7 },
    };

    const totalBarData = {
        name: 'Total LR',
        type: 'bar',
        stack: 'total',
        emphasis: { focus: 'series' },
        data: totalLR,
        label: {
            show: true,
            position: 'top',
            formatter: function (params) {
                const population = minPopulationData.data[params.dataIndex];
                if (population === 0) return 'N/A'; // Avoid division by zero
                const ratio = (totalLR[params.dataIndex] / population).toFixed(1);
                return ratio + ':1';
            },
        },
    };

    // Chart options
    const graphOptions = {
        tooltip: { trigger: 'axis', axisPointer: { type: 'shadow' } },
        legend: { data: ['Total LR', 'Min Population'] },
        xAxis: {
            type: 'category',
            data: chartData.map(item => item[0]),
            axisLabel: { interval: 0, rotate: -45, margin: 8 },
        },
        yAxis: { type: 'value' },
        series: [totalBarData, minPopulationData],
    };

    // Initialize and set the chart options
    const primaryDom = document.getElementById('primary');
    const myGraph = echarts.init(primaryDom);
    myGraph.setOption(graphOptions);

    // Resize the chart on window resize
    window.onresize = function () {
        myGraph.resize();
    };

    // Resize the chart when carousel item is shown
    $('#carouselExampleControls').on('slide.bs.carousel', function () {
        setTimeout(function () {
            myGraph.resize(); // Resize the chart when a new slide is active
        }, 100);
    });

    // Full-screen toggle functionality for #primary chart
    const fullscreenTogglePrimary = document.getElementById('fullscreenTogglePrimary');
    const primaryContainer = document.getElementById('primaryContainer');

    fullscreenTogglePrimary.addEventListener('click', () => {
        if (!document.fullscreenElement) {
            // Enter full screen
            primaryContainer.requestFullscreen();
            fullscreenTogglePrimary.textContent = 'Exit Full Screen';
            
            // Apply full-screen styles
            primaryContainer.style.backgroundColor = 'white';  // Set background color to white
            primaryContainer.style.display = 'flex';  // Use flexbox to center the content
            primaryContainer.style.justifyContent = 'center';  // Center horizontally
            primaryContainer.style.alignItems = 'center';  // Center vertically
            primaryContainer.style.height = '100vh';  // Full viewport height
            primaryContainer.style.padding = '20px';  // Add padding for margin effect

            myGraph.resize(); // Resize chart to fit new container size
        } else {
            // Exit full screen
            document.exitFullscreen();
            fullscreenTogglePrimary.textContent = 'Full Screen';
            
            // Reset styles
            primaryContainer.style.backgroundColor = '';  // Reset background color
            primaryContainer.style.display = '';  // Reset layout
            primaryContainer.style.justifyContent = '';  // Reset alignment
            primaryContainer.style.alignItems = '';  // Reset alignment
            primaryContainer.style.height = '';  // Reset height
            primaryContainer.style.padding = '';  // Reset padding

            myGraph.resize(); // Resize chart back to original size
        }
    });

    // Listen for the ESC key to exit full-screen mode
    document.addEventListener('keydown', function (event) {
        if (event.key === "Escape" && document.fullscreenElement) {
            // Exit full screen
            document.exitFullscreen();
            fullscreenTogglePrimary.textContent = 'Full Screen';
            
            // Reset styles
            primaryContainer.style.backgroundColor = '';  // Reset background color
            primaryContainer.style.display = '';  // Reset layout
            primaryContainer.style.justifyContent = '';  // Reset alignment
            primaryContainer.style.alignItems = '';  // Reset alignment
            primaryContainer.style.height = '';  // Reset height
            primaryContainer.style.padding = '';  // Reset padding

            myGraph.resize(); // Resize chart back to original size
        }
    });

    // Adjust chart on fullscreen change
    document.addEventListener('fullscreenchange', () => {
        if (!document.fullscreenElement) {
            // When exiting fullscreen, reset button text to "Full Screen"
            fullscreenTogglePrimary.textContent = 'Full Screen';

            // Reset styles
            primaryContainer.style.backgroundColor = '';  // Reset background color
            primaryContainer.style.display = '';  // Reset layout
            primaryContainer.style.justifyContent = '';  // Reset alignment
            primaryContainer.style.alignItems = '';  // Reset alignment
            primaryContainer.style.height = '';  // Reset height
            primaryContainer.style.padding = '';  // Reset padding
        }
        myGraph.resize();
    });
</script>
