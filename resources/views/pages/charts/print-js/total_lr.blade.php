<script type="text/javascript">
    // Fetch dynamic data passed from Laravel for print chart
    const totalLrData = @json($totalLrData);

    // Group data by grade levels and calculate totals if duplicates exist for print
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

    // Prepare data for print chart
    const printChartData = Object.keys(groupedData).map(grade => [
        grade,
        groupedData[grade].population,
        groupedData[grade].total_lr,
    ]);

    // Sort the chart data for print by grade levels
    printChartData.sort((a, b) => {
        function extractGradeNumber(str) {
            const gradeMatch = str.match(/\d+/);
            return gradeMatch ? parseInt(gradeMatch[0]) : str.includes('Kindergarten') ? -1 : 0;
        }
        return extractGradeNumber(a[0]) - extractGradeNumber(b[0]);
    });

    // Extract total learning resources and population for print
    const totalLR_print = printChartData.map(item => item[2]);
    const minPopulationData_print = {
        name: 'Population',
        type: 'line',
        smooth: true,
        data: printChartData.map(item => item[1]),
        lineStyle: { width: 2 },
        showSymbol: false,
        areaStyle: { opacity: 0.7 },
    };

    const totalBarData_print = {
        name: 'Total LR',
        type: 'bar',
        stack: 'total',
        emphasis: { focus: 'series' },
        data: totalLR_print,
        label: {
            show: true,
            position: 'top',
            formatter: function (params) {
                const population = minPopulationData_print.data[params.dataIndex];
                if (population === 0) return 'N/A'; // Avoid division by zero
                const ratio = (totalLR_print[params.dataIndex] / population).toFixed(1);
                return ratio + ':1';
            },
        },
    };

    // Print chart options
    const printGraphOptions = {
        tooltip: { trigger: 'axis', axisPointer: { type: 'shadow' } },
        legend: { data: ['Total LR', 'Min Population'] },
        xAxis: {
            type: 'category',
            data: printChartData.map(item => item[0]),
            axisLabel: { interval: 0, rotate: -45, margin: 8 },
        },
        yAxis: { type: 'value' },
        series: [totalBarData_print, minPopulationData_print],
    };

    // Initialize and set the print chart options
    const primaryDomPrint = document.getElementById('primary');
    const myGraphPrint = echarts.init(primaryDomPrint);
    myGraphPrint.setOption(printGraphOptions);

    // Resize the print chart on window resize
    window.onresize = function () {
        myGraphPrint.resize();
    };

    // Resize the print chart when carousel item is shown
    $('#carouselPrintControls').on('slide.bs.carousel', function () {
        setTimeout(function () {
            myGraphPrint.resize(); // Resize the chart when a new slide is active
        }, 100);
    });

    // Full-screen toggle functionality for print chart
    const fullscreenTogglePrimaryPrint = document.getElementById('fullscreenTogglePrimary');
    const primaryContainerPrint = document.getElementById('primaryContainer');

    fullscreenTogglePrimaryPrint.addEventListener('click', () => {
        if (!document.fullscreenElement) {
            // Enter full screen
            primaryContainerPrint.requestFullscreen();
            fullscreenTogglePrimaryPrint.textContent = 'Exit Full Screen';
            
            // Apply full-screen styles
            primaryContainerPrint.style.backgroundColor = 'white';  // Set background color to white
            primaryContainerPrint.style.display = 'flex';  // Use flexbox to center the content
            primaryContainerPrint.style.justifyContent = 'center';  // Center horizontally
            primaryContainerPrint.style.alignItems = 'center';  // Center vertically
            primaryContainerPrint.style.height = '100vh';  // Full viewport height
            primaryContainerPrint.style.padding = '20px';  // Add padding for margin effect

            myGraphPrint.resize(); // Resize chart to fit new container size
        } else {
            // Exit full screen
            document.exitFullscreen();
            fullscreenTogglePrimaryPrint.textContent = 'Full Screen';
            
            // Reset styles
            primaryContainerPrint.style.backgroundColor = '';  // Reset background color
            primaryContainerPrint.style.display = '';  // Reset layout
            primaryContainerPrint.style.justifyContent = '';  // Reset alignment
            primaryContainerPrint.style.alignItems = '';  // Reset alignment
            primaryContainerPrint.style.height = '';  // Reset height
            primaryContainerPrint.style.padding = '';  // Reset padding

            myGraphPrint.resize(); // Resize chart back to original size
        }
    });

    // Listen for the ESC key to exit full-screen mode for print
    document.addEventListener('keydown', function (event) {
        if (event.key === "Escape" && document.fullscreenElement) {
            // Exit full screen
            document.exitFullscreen();
            fullscreenTogglePrimaryPrint.textContent = 'Full Screen';
            
            // Reset styles
            primaryContainerPrint.style.backgroundColor = '';  // Reset background color
            primaryContainerPrint.style.display = '';  // Reset layout
            primaryContainerPrint.style.justifyContent = '';  // Reset alignment
            primaryContainerPrint.style.alignItems = '';  // Reset alignment
            primaryContainerPrint.style.height = '';  // Reset height
            primaryContainerPrint.style.padding = '';  // Reset padding

            myGraphPrint.resize(); // Resize chart back to original size
        }
    });

    // Adjust print chart on fullscreen change
    document.addEventListener('fullscreenchange', () => {
        if (!document.fullscreenElement) {
            // When exiting fullscreen, reset button text to "Full Screen"
            fullscreenTogglePrimaryPrint.textContent = 'Full Screen';

            // Reset styles
            primaryContainerPrint.style.backgroundColor = '';  // Reset background color
            primaryContainerPrint.style.display = '';  // Reset layout
            primaryContainerPrint.style.justifyContent = '';  // Reset alignment
            primaryContainerPrint.style.alignItems = '';  // Reset alignment
            primaryContainerPrint.style.height = '';  // Reset height
            primaryContainerPrint.style.padding = '';  // Reset padding
        }
        myGraphPrint.resize();
    });
</script>
