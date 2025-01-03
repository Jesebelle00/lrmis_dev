<script type="text/javascript">
    // Passing exdefData from Blade to JavaScript
    var exdefData = @json($exdefData);

    // Prepare the data array for the chart
    var exdefData = exdefData.map(function (item) {
        return [
            item.subject_shortcode, // subject_title
            item.grade_level,      // grade_level
            item.qty,              // qty
            item.population,       // population
            item.exdef,            // exdef
            item.ratio             // ratio
        ];
    });

    var chartDom = document.getElementById('exdef');
    var exdefChart = echarts.init(chartDom);
    var option;

    var seriesData = exdefData.map(function (item) {
        var positive = item[4] >= 0;  // Checking if exdef is positive
        var color = positive ? 'green' : 'red';
        return {
            name: item[0] + " - " + item[1],  // Combining subject and grade_level for the label
            value: item[4],  // exdef value
            itemStyle: {
                color: color
            }
        };
    });

    option = {
        grid: {
            left: '3%',
            right: '4%',
            bottom: '8%',
            containLabel: true
        },
        tooltip: {
            trigger: 'item',
            formatter: function (params) {
                var item = exdefData[params.dataIndex];
                return [
                    '<b>' + params.name + '</b><br><br>',
                    'ExDef: ' + item[4] + '<br>',
                    'LR: ' + item[2] + '<br>',
                    'Learners: ' + item[3] + '<br>',
                    'Ratio: ' + item[5]
                ].join('\n');
            },
            rich: {
                title: {
                    fontWeight: 'bold'
                }
            }
        },
        xAxis: {
            type: 'category',
            data: exdefData.map(function (item) { return item[0] + " - " + item[1]; }),  // Combining subject and grade_level
            axisLabel: {
                interval: 0,
                rotate: -90
            }
        },
        yAxis: {
            type: 'value'
        },
        series: [{
            data: seriesData,
            type: 'bar'
        }]
    };

    exdefChart.setOption(option);

    window.onresize = function () {
        exdefChart.resize();
    };

    // Resize the chart when carousel item is shown
    $('#carouselPrintControls').on('slide.bs.carousel', function () {
        setTimeout(function() {
            exdefChart.resize(); // Resize the chart when a new slide is active
        }, 100);
    });

    // Full-screen toggle functionality for exdef chart
    const fullscreenToggleExdef = document.getElementById('fullscreenToggleExdef');
    const exdefChartContainer = document.getElementById('exdefChartContainer');

    fullscreenToggleExdef.addEventListener('click', () => {
        if (!document.fullscreenElement) {
            // Enter full screen
            exdefChartContainer.requestFullscreen();
            fullscreenToggleExdef.textContent = 'Exit Full Screen';
            
            // Apply full-screen styles
            exdefChartContainer.style.backgroundColor = 'white';  // Set background color to white
            exdefChartContainer.style.display = 'flex';  // Use flexbox to center the content
            exdefChartContainer.style.justifyContent = 'center';  // Center horizontally
            exdefChartContainer.style.alignItems = 'center';  // Center vertically
            exdefChartContainer.style.height = '100vh';  // Full viewport height
            exdefChartContainer.style.padding = '20px';  // Add padding for margin effect

            exdefChart.resize(); // Resize chart to fit new container size
        } else {
            // Exit full screen
            document.exitFullscreen();
            fullscreenToggleExdef.textContent = 'Full Screen';
            
            // Reset styles
            exdefChartContainer.style.backgroundColor = '';  // Reset background color
            exdefChartContainer.style.display = '';  // Reset layout
            exdefChartContainer.style.justifyContent = '';  // Reset alignment
            exdefChartContainer.style.alignItems = '';  // Reset alignment
            exdefChartContainer.style.height = '';  // Reset height
            exdefChartContainer.style.padding = '';  // Reset padding

            exdefChart.resize(); // Resize chart back to original size
        }
    });

    // Listen for the ESC key to exit full-screen mode
    document.addEventListener('keydown', function (event) {
        if (event.key === "Escape" && document.fullscreenElement) {
            // Exit full screen
            document.exitFullscreen();
            fullscreenToggleExdef.textContent = 'Full Screen';
            
            // Reset styles
            exdefChartContainer.style.backgroundColor = '';  // Reset background color
            exdefChartContainer.style.display = '';  // Reset layout
            exdefChartContainer.style.justifyContent = '';  // Reset alignment
            exdefChartContainer.style.alignItems = '';  // Reset alignment
            exdefChartContainer.style.height = '';  // Reset height
            exdefChartContainer.style.padding = '';  // Reset padding

            exdefChart.resize(); // Resize chart back to original size
        }
    });

    // Adjust chart on fullscreen change
    document.addEventListener('fullscreenchange', () => {
        if (!document.fullscreenElement) {
            // When exiting fullscreen, reset button text to "Full Screen"
            fullscreenToggleExdef.textContent = 'Full Screen';

            // Reset styles
            exdefChartContainer.style.backgroundColor = '';  // Reset background color
            exdefChartContainer.style.display = '';  // Reset layout
            exdefChartContainer.style.justifyContent = '';  // Reset alignment
            exdefChartContainer.style.alignItems = '';  // Reset alignment
            exdefChartContainer.style.height = '';  // Reset height
            exdefChartContainer.style.padding = '';  // Reset padding

        }
        exdefChart.resize();
    });
</script>
