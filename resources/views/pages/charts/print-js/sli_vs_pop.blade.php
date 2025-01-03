<script type="text/javascript">
    var chart = echarts.init(document.getElementById('main'));

    // Data passed from the controller
    var data = @json($sliVsPopData);

    // Extracting values for the chart
    var schools = data.map(item => item.shortname);
    var lrData = data.map(item => item.lr);
    var populationData = data.map(item => item.population);

    // Chart configuration
    var option = {
        dataZoom: {
            type: 'slider',
            xAxisIndex: 0,
            start: 0,
            end: 100,
            fillerColor: "#D2E5F6",
            borderColor: "#748aa1",
            textStyle: { color: "black", fontFamily: "Roboto', sans-serif" },
            dataBackground: { areaStyle: { color: "rgba(92, 97, 103)" } },
            handleStyle: { color: "#fff", shadowColor: "rgba(0, 0, 0, 0.1)", shadowBlur: "6px" }
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: { type: 'shadow' },
            formatter: function (params) {
                return params.map(item => {
                    return `${item.marker} ${item.seriesName}: ${item.value}`;
                }).join('<br/>');
            }
        },
        legend: {
            data: ['LR', 'Population'],
            align: 'right',
            padding: [0, 20]
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '10%',
            containLabel: true
        },
        xAxis: {
            type: 'category',
            data: schools,
            axisLabel: {
                interval: 0,
                rotate: 90,
                margin: 8
            }
        },
        yAxis: {
            type: 'value'
        },
        series: [
            {
                name: 'LR',
                type: 'bar',
                stack: 'total',
                data: lrData,
                itemStyle: { color: '#748aa1', opacity: 0.8 }
            },
            {
                name: 'Population',
                type: 'bar',
                stack: 'total',
                data: populationData,
                itemStyle: { color: '#adcbe3', opacity: 0.8 }
            }
        ]
    };

    chart.setOption(option);

    window.onresize = function () {
        chart.resize();
    };

    // Resize the chart when carousel item is shown
    $('#carouselPrintControls').on('slide.bs.carousel', function () {
        setTimeout(function() {
            chart.resize(); // Resize the chart when a new slide is active
        }, 100);
    });

    // Full-screen toggle functionality for the second chart
    const fullscreenToggle2 = document.getElementById('fullscreenToggle2');
    const mainChartContainer = document.getElementById('mainChartContainer');

    fullscreenToggle2.addEventListener('click', () => {
        if (!document.fullscreenElement) {
            // Enter full screen
            mainChartContainer.requestFullscreen();
            fullscreenToggle2.textContent = 'Exit Full Screen';

            // Apply full-screen styles
            mainChartContainer.style.backgroundColor = 'white';  // Set background color to white
            mainChartContainer.style.display = 'flex';  // Use flexbox to center the content
            mainChartContainer.style.justifyContent = 'center';  // Center horizontally
            mainChartContainer.style.alignItems = 'center';  // Center vertically
            mainChartContainer.style.height = '100vh';  // Full viewport height
            mainChartContainer.style.padding = '20px';  // Add padding for margin effect

            chart.resize(); // Resize chart to fit new container size
        } else {
            // Exit full screen
            document.exitFullscreen();
            fullscreenToggle2.textContent = 'Full Screen';

            // Reset styles
            mainChartContainer.style.backgroundColor = '';  // Reset background color
            mainChartContainer.style.display = '';  // Reset layout
            mainChartContainer.style.justifyContent = '';  // Reset alignment
            mainChartContainer.style.alignItems = '';  // Reset alignment
            mainChartContainer.style.height = '';  // Reset height
            mainChartContainer.style.padding = '';  // Reset padding

            chart.resize(); // Resize chart back to original size
        }
    });

    // Listen for the ESC key to exit full-screen mode
    document.addEventListener('keydown', function (event) {
        if (event.key === "Escape" && document.fullscreenElement) {
            // Exit full screen
            document.exitFullscreen();
            fullscreenToggle2.textContent = 'Full Screen';

            // Reset styles
            mainChartContainer.style.backgroundColor = '';  // Reset background color
            mainChartContainer.style.display = '';  // Reset layout
            mainChartContainer.style.justifyContent = '';  // Reset alignment
            mainChartContainer.style.alignItems = '';  // Reset alignment
            mainChartContainer.style.height = '';  // Reset height
            mainChartContainer.style.padding = '';  // Reset padding

            chart.resize(); // Resize chart back to original size
        }
    });

    // Adjust chart on fullscreen change
    document.addEventListener('fullscreenchange', () => {
        if (!document.fullscreenElement) {
            // When exiting fullscreen, reset button text to "Full Screen"
            fullscreenToggle2.textContent = 'Full Screen';

            // Reset styles
            mainChartContainer.style.backgroundColor = '';  // Reset background color
            mainChartContainer.style.display = '';  // Reset layout
            mainChartContainer.style.justifyContent = '';  // Reset alignment
            mainChartContainer.style.alignItems = '';  // Reset alignment
            mainChartContainer.style.height = '';  // Reset height
            mainChartContainer.style.padding = '';  // Reset padding

        }
        chart.resize();
    });
</script>
