<script type="text/javascript">
    var chart_np = echarts.init(document.getElementById('mainSliVsPop_np'));

    // Data passed from the controller
    var data = @json($sliVsPopData_np);

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

    chart_np.setOption(option);

    window.onresize = function () {
        chart_np.resize();
    };

    // Resize the chart when carousel item is shown
    $('#carouselNonPrintControls').on('slide.bs.carousel', function () {
        setTimeout(function() {
            chart_np.resize(); // Resize the chart when a new slide is active
        }, 100);
    });

    // Full-screen toggle functionality for the second chart
    const np_fullscreenToggleSliVsPop = document.getElementById('np_fullscreenToggleSliVsPop');
    const mainChartContainerSliVsPop_np = document.getElementById('mainChartContainerSliVsPop_np');

    np_fullscreenToggleSliVsPop.addEventListener('click', () => {
    console.log("Fullscreen toggle clicked");
    if (!document.fullscreenElement) {
        console.log("Entering fullscreen");
        mainChartContainerSliVsPop_np.requestFullscreen();
        np_fullscreenToggleSliVsPop.textContent = 'Exit Full Screen';

        // Apply full-screen styles
        mainChartContainerSliVsPop_np.style.backgroundColor = 'white';  
        mainChartContainerSliVsPop_np.style.display = 'flex';  
        mainChartContainerSliVsPop_np.style.justifyContent = 'center';  
        mainChartContainerSliVsPop_np.style.alignItems = 'center';  
        mainChartContainerSliVsPop_np.style.height = '100vh';  
        mainChartContainerSliVsPop_np.style.padding = '20px';  

        chart_np.resize();
    } else {
        console.log("Exiting fullscreen");
        document.exitFullscreen();
        np_fullscreenToggleSliVsPop.textContent = 'Full Screen';

        // Reset styles
        mainChartContainerSliVsPop_np.style.backgroundColor = '';  
        mainChartContainerSliVsPop_np.style.display = '';  
        mainChartContainerSliVsPop_np.style.justifyContent = '';  
        mainChartContainerSliVsPop_np.style.alignItems = '';  
        mainChartContainerSliVsPop_np.style.height = '';  
        mainChartContainerSliVsPop_np.style.padding = '';  

        chart_np.resize();
    }
});

    // Listen for the ESC key to exit full-screen mode
    document.addEventListener('keydown', function (event) {
        if (event.key === "Escape" && document.fullscreenElement) {
            // Exit full screen
            document.exitFullscreen();
            np_fullscreenToggleSliVsPop.textContent = 'Full Screen';

            // Reset styles
            mainChartContainerSliVsPop_np.style.backgroundColor = '';  // Reset background color
            mainChartContainerSliVsPop_np.style.display = '';  // Reset layout
            mainChartContainerSliVsPop_np.style.justifyContent = '';  // Reset alignment
            mainChartContainerSliVsPop_np.style.alignItems = '';  // Reset alignment
            mainChartContainerSliVsPop_np.style.height = '';  // Reset height
            mainChartContainerSliVsPop_np.style.padding = '';  // Reset padding

            chart_np.resize(); // Resize chart back to original size
        }
    });

    // Adjust chart on fullscreen change
    document.addEventListener('fullscreenchange', () => {
        if (!document.fullscreenElement) {
            // When exiting fullscreen, reset button text to "Full Screen"
            np_fullscreenToggleSliVsPop.textContent = 'Full Screen';

            // Reset styles
            mainChartContainerSliVsPop_np.style.backgroundColor = '';  // Reset background color
            mainChartContainerSliVsPop_np.style.display = '';  // Reset layout
            mainChartContainerSliVsPop_np.style.justifyContent = '';  // Reset alignment
            mainChartContainerSliVsPop_np.style.alignItems = '';  // Reset alignment
            mainChartContainerSliVsPop_np.style.height = '';  // Reset height
            mainChartContainerSliVsPop_np.style.padding = '';  // Reset padding

        }
        chart_np.resize();
    });
</script>
