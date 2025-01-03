<script type="text/javascript">
    // Get heatmap data from the backend
    var heatmapDataRaw = @json($heatmapData);

    // Create arrays for grade levels and subject shortcodes
    var gradeLevels = [...new Set(heatmapDataRaw.map(item => item.grade_level))];
    var subjectShortcodes = [...new Set(heatmapDataRaw.map(item => item.subject_shorcode))];

    // Map raw data to heatmap format: [gradeIndex, subjectIndex, qty]
    var heatMapData = heatmapDataRaw.map(item => {
        return [
            gradeLevels.indexOf(item.grade_level),  // Find grade level index
            subjectShortcodes.indexOf(item.subject_shorcode),  // Find subject index
            item.qty  // Quantity
        ];
    });

    var option = {
        tooltip: {
            formatter: function (params) {
                var data = params.data;
                return '<b>Grade:</b> ' + gradeLevels[data[0]] +
                    '<br><b>Subject:</b> ' + subjectShortcodes[data[1]] +
                    '<br><b>Learning Resources:</b> ' + data[2];
            }
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis: {
            type: 'category',
            data: gradeLevels,
            axisLabel: {
                interval: 0,
                rotate: -45,
                margin: 8
            }
        },
        yAxis: {
            type: 'category',
            data: subjectShortcodes
        },
        visualMap: {
            min: 0,
            max: 2000, // Adjust this based on your data
            calculable: true,
            orient: 'horizontal',
            left: 'center',
            top: '0%',
            inRange: {
                color: ['white', 'green']
            }
        },
        series: [{
            name: 'Learning Resources',
            type: 'heatmap',
            data: heatMapData,
            label: {
                show: true,
                formatter: function (params) {
                    return params.value[2];
                }
            },
            emphasis: {
                itemStyle: {
                    shadowBlur: 10,
                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            }
        }]
    };

    var heatMapChart = echarts.init(document.getElementById('ratiolrtable'));
    heatMapChart.setOption(option);

    window.onresize = function () {
        heatMapChart.resize();
    };

    // Resize the chart when carousel item is shown
    $('#carouselExampleControls').on('slide.bs.carousel', function () {
        setTimeout(function() {
            heatMapChart.resize(); // Resize the chart when a new slide is active
        }, 100);
    });

    // Full-screen toggle functionality for heatmap chart
    const fullscreenToggleHeatmap = document.getElementById('fullscreenToggleHeatmap');
    const ratiolrtableContainer = document.getElementById('ratiolrtableContainer');

    fullscreenToggleHeatmap.addEventListener('click', () => {
        if (!document.fullscreenElement) {
            // Enter full screen
            ratiolrtableContainer.requestFullscreen();
            fullscreenToggleHeatmap.textContent = 'Exit Full Screen';
            
            // Apply full-screen styles
            ratiolrtableContainer.style.backgroundColor = 'white';  // Set background color to white
            ratiolrtableContainer.style.display = 'flex';  // Use flexbox to center the content
            ratiolrtableContainer.style.justifyContent = 'center';  // Center horizontally
            ratiolrtableContainer.style.alignItems = 'center';  // Center vertically
            ratiolrtableContainer.style.height = '100vh';  // Full viewport height
            ratiolrtableContainer.style.padding = '20px';  // Add padding for margin effect

            heatMapChart.resize(); // Resize chart to fit new container size
        } else {
            // Exit full screen
            document.exitFullscreen();
            fullscreenToggleHeatmap.textContent = 'Full Screen';
            
            // Reset styles
            ratiolrtableContainer.style.backgroundColor = '';  // Reset background color
            ratiolrtableContainer.style.display = '';  // Reset layout
            ratiolrtableContainer.style.justifyContent = '';  // Reset alignment
            ratiolrtableContainer.style.alignItems = '';  // Reset alignment
            ratiolrtableContainer.style.height = '';  // Reset height
            ratiolrtableContainer.style.padding = '';  // Reset padding

            heatMapChart.resize(); // Resize chart back to original size
        }
    });

    // Listen for the ESC key to exit full-screen mode
    document.addEventListener('keydown', function (event) {
        if (event.key === "Escape" && document.fullscreenElement) {
            // Exit full screen
            document.exitFullscreen();
            fullscreenToggleHeatmap.textContent = 'Full Screen';
            
            // Reset styles
            ratiolrtableContainer.style.backgroundColor = '';  // Reset background color
            ratiolrtableContainer.style.display = '';  // Reset layout
            ratiolrtableContainer.style.justifyContent = '';  // Reset alignment
            ratiolrtableContainer.style.alignItems = '';  // Reset alignment
            ratiolrtableContainer.style.height = '';  // Reset height
            ratiolrtableContainer.style.padding = '';  // Reset padding

            heatMapChart.resize(); // Resize chart back to original size
        }
    });

    // Adjust chart on fullscreen change
    document.addEventListener('fullscreenchange', () => {
        if (!document.fullscreenElement) {
            // When exiting fullscreen, reset button text to "Full Screen"
            fullscreenToggleHeatmap.textContent = 'Full Screen';

            // Reset styles
            ratiolrtableContainer.style.backgroundColor = '';  // Reset background color
            ratiolrtableContainer.style.display = '';  // Reset layout
            ratiolrtableContainer.style.justifyContent = '';  // Reset alignment
            ratiolrtableContainer.style.alignItems = '';  // Reset alignment
            ratiolrtableContainer.style.height = '';  // Reset height
            ratiolrtableContainer.style.padding = '';  // Reset padding

        }
        heatMapChart.resize();
    });
</script>
