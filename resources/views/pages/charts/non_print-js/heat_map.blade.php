<script type="text/javascript">
    // Get heatmap data from the backend
    var heatmapDataRaw_np = @json($heatmapData_np);

    // Create arrays for grade levels and subject shortcodes
    var gradeLevels = [...new Set(heatmapDataRaw_np.map(item => item.grade_level))];
    var subjectShortcodes = [...new Set(heatmapDataRaw_np.map(item => item.subject_shortcode))];

    // Map raw data to heatmap format: [gradeIndex, subjectIndex, qty]
    var heatMapData = heatmapDataRaw_np.map(item => {
        return [
            gradeLevels.indexOf(item.grade_level),  // Find grade level index
            subjectShortcodes.indexOf(item.subject_shortcode),  // Find subject index
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

    var heatMapChart_np = echarts.init(document.getElementById('ratiolrtable_np'));
    heatMapChart_np.setOption(option);

    window.onresize = function () {
        heatMapChart_np.resize();
    };

    // Resize the chart when carousel item is shown
    $('#carouselNonPrintControls').on('slide.bs.carousel', function () {
        setTimeout(function() {
            heatMapChart_np.resize(); // Resize the chart when a new slide is active
        }, 100);
    });

    // Full-screen toggle functionality for heatmap chart
    const fullscreenToggleHeatmap_np = document.getElementById('fullscreenToggleHeatmap_np');
    const ratiolrtableContainer_np = document.getElementById('ratiolrtableContainer_np');

    fullscreenToggleHeatmap_np.addEventListener('click', () => {
        if (!document.fullscreenElement) {
            // Enter full screen
            ratiolrtableContainer_np.requestFullscreen();
            fullscreenToggleHeatmap_np.textContent = 'Exit Full Screen';
            
            // Apply full-screen styles
            ratiolrtableContainer_np.style.backgroundColor = 'white';  // Set background color to white
            ratiolrtableContainer_np.style.display = 'flex';  // Use flexbox to center the content
            ratiolrtableContainer_np.style.justifyContent = 'center';  // Center horizontally
            ratiolrtableContainer_np.style.alignItems = 'center';  // Center vertically
            ratiolrtableContainer_np.style.height = '100vh';  // Full viewport height
            ratiolrtableContainer_np.style.padding = '20px';  // Add padding for margin effect

            heatMapChart_np.resize(); // Resize chart to fit new container size
        } else {
            // Exit full screen
            document.exitFullscreen();
            fullscreenToggleHeatmap_np.textContent = 'Full Screen';
            
            // Reset styles
            ratiolrtableContainer_np.style.backgroundColor = '';  // Reset background color
            ratiolrtableContainer_np.style.display = '';  // Reset layout
            ratiolrtableContainer_np.style.justifyContent = '';  // Reset alignment
            ratiolrtableContainer_np.style.alignItems = '';  // Reset alignment
            ratiolrtableContainer_np.style.height = '';  // Reset height
            ratiolrtableContainer_np.style.padding = '';  // Reset padding

            heatMapChart_np.resize(); // Resize chart back to original size
        }
    });

    // Listen for the ESC key to exit full-screen mode
    document.addEventListener('keydown', function (event) {
        if (event.key === "Escape" && document.fullscreenElement) {
            // Exit full screen
            document.exitFullscreen();
            fullscreenToggleHeatmap_np.textContent = 'Full Screen';
            
            // Reset styles
            ratiolrtableContainer_np.style.backgroundColor = '';  // Reset background color
            ratiolrtableContainer_np.style.display = '';  // Reset layout
            ratiolrtableContainer_np.style.justifyContent = '';  // Reset alignment
            ratiolrtableContainer_np.style.alignItems = '';  // Reset alignment
            ratiolrtableContainer_np.style.height = '';  // Reset height
            ratiolrtableContainer_np.style.padding = '';  // Reset padding

            heatMapChart_np.resize(); // Resize chart back to original size
        }
    });

    // Adjust chart on fullscreen change
    document.addEventListener('fullscreenchange', () => {
        if (!document.fullscreenElement) {
            // When exiting fullscreen, reset button text to "Full Screen"
            fullscreenToggleHeatmap_np.textContent = 'Full Screen';

            // Reset styles
            ratiolrtableContainer_np.style.backgroundColor = '';  // Reset background color
            ratiolrtableContainer_np.style.display = '';  // Reset layout
            ratiolrtableContainer_np.style.justifyContent = '';  // Reset alignment
            ratiolrtableContainer_np.style.alignItems = '';  // Reset alignment
            ratiolrtableContainer_np.style.height = '';  // Reset height
            ratiolrtableContainer_np.style.padding = '';  // Reset padding

        }
        heatMapChart_np.resize();
    });
</script>
