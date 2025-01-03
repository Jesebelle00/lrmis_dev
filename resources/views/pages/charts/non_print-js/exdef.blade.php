<script type="text/javascript">
    // Passing exdefData_np from Blade to JavaScript
    var exdefData_np = @json($exdefData_np);

    // Prepare the data array for the chart
    var exdefData_np = exdefData_np.map(function (item) {
        return [
            item.subject_shortcode, // subject_title
            item.grade_level,      // grade_level
            item.qty,              // qty
            item.population,       // population
            item.exdef,            // exdef
            item.ratio             // ratio
        ];
    });

    var chartDom = document.getElementById('exdef_np');
    var exdefChart_np = echarts.init(chartDom);
    var option;

    var seriesData = exdefData_np.map(function (item) {
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
                var item = exdefData_np[params.dataIndex];
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
            data: exdefData_np.map(function (item) { return item[0] + " - " + item[1]; }),  // Combining subject and grade_level
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

    exdefChart_np.setOption(option);

    window.onresize = function () {
        exdefChart_np.resize();
    };

    // Resize the chart when carousel item is shown
    $('#carouselNonPrintControls').on('slide.bs.carousel', function () {
        setTimeout(function() {
            exdefChart_np.resize(); // Resize the chart when a new slide is active
        }, 100);
    });

    // Full-screen toggle functionality for exdef chart
    const fullscreenToggleExdef_np = document.getElementById('fullscreenToggleExdef_np');
    const exdefChart_npContainer_np = document.getElementById('exdefChart_npContainer_np');

    fullscreenToggleExdef_np.addEventListener('click', () => {
        if (!document.fullscreenElement) {
            // Enter full screen
            exdefChart_npContainer_np.requestFullscreen();
            fullscreenToggleExdef_np.textContent = 'Exit Full Screen';
            
            // Apply full-screen styles
            exdefChart_npContainer_np.style.backgroundColor = 'white';  // Set background color to white
            exdefChart_npContainer_np.style.display = 'flex';  // Use flexbox to center the content
            exdefChart_npContainer_np.style.justifyContent = 'center';  // Center horizontally
            exdefChart_npContainer_np.style.alignItems = 'center';  // Center vertically
            exdefChart_npContainer_np.style.height = '100vh';  // Full viewport height
            exdefChart_npContainer_np.style.padding = '20px';  // Add padding for margin effect

            exdefChart_np.resize(); // Resize chart to fit new container size
        } else {
            // Exit full screen
            document.exitFullscreen();
            fullscreenToggleExdef_np.textContent = 'Full Screen';
            
            // Reset styles
            exdefChart_npContainer_np.style.backgroundColor = '';  // Reset background color
            exdefChart_npContainer_np.style.display = '';  // Reset layout
            exdefChart_npContainer_np.style.justifyContent = '';  // Reset alignment
            exdefChart_npContainer_np.style.alignItems = '';  // Reset alignment
            exdefChart_npContainer_np.style.height = '';  // Reset height
            exdefChart_npContainer_np.style.padding = '';  // Reset padding

            exdefChart_np.resize(); // Resize chart back to original size
        }
    });

    // Listen for the ESC key to exit full-screen mode
    document.addEventListener('keydown', function (event) {
        if (event.key === "Escape" && document.fullscreenElement) {
            // Exit full screen
            document.exitFullscreen();
            fullscreenToggleExdef_np.textContent = 'Full Screen';
            
            // Reset styles
            exdefChart_npContainer_np.style.backgroundColor = '';  // Reset background color
            exdefChart_npContainer_np.style.display = '';  // Reset layout
            exdefChart_npContainer_np.style.justifyContent = '';  // Reset alignment
            exdefChart_npContainer_np.style.alignItems = '';  // Reset alignment
            exdefChart_npContainer_np.style.height = '';  // Reset height
            exdefChart_npContainer_np.style.padding = '';  // Reset padding

            exdefChart_np.resize(); // Resize chart back to original size
        }
    });

    // Adjust chart on fullscreen change
    document.addEventListener('fullscreenchange', () => {
        if (!document.fullscreenElement) {
            // When exiting fullscreen, reset button text to "Full Screen"
            fullscreenToggleExdef_np.textContent = 'Full Screen';

            // Reset styles
            exdefChart_npContainer_np.style.backgroundColor = '';  // Reset background color
            exdefChart_npContainer_np.style.display = '';  // Reset layout
            exdefChart_npContainer_np.style.justifyContent = '';  // Reset alignment
            exdefChart_npContainer_np.style.alignItems = '';  // Reset alignment
            exdefChart_npContainer_np.style.height = '';  // Reset height
            exdefChart_npContainer_np.style.padding = '';  // Reset padding

        }
        exdefChart_np.resize();
    });
</script>
