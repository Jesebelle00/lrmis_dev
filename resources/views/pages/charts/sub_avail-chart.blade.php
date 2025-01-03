<script>
    // Initialize the chart
    var chartDom = document.getElementById('gradeChart');
    var subAvailChart = echarts.init(chartDom);

    // Fetch dynamic data passed from Laravel
    var data = @json($subAvailData);

    var grades = [...new Set(data.map(item => item.grade_level))];
    var subjects = [...new Set(data.map(item => item.subject_shorcode))];

    // Prepare series data
    var series = subjects.map(subject => ({
        name: subject,
        type: 'bar',
        data: grades.map(grade => {
            var item = data.find(d => d.grade_level === grade && d.subject_shorcode === subject);
            return item ? item.qty : 0;
        })
    }));

    series.push({
        name: 'Population',
        type: 'line',
        areaStyle: { opacity: 0.35 },
        smooth: true,
        data: grades.map(grade => {
            var items = data.filter(d => d.grade_level === grade);
            return items.length > 0 ? items[0].population : 0;
        })
    });

    // Chart options
    var option = {
        legend: {},
        tooltip: {
            trigger: 'axis',
            axisPointer: { type: 'line' }
        },
        xAxis: {
            type: 'category',
            data: grades,
            axisLabel: { rotate: -45 }
        },
        yAxis: [
            { type: 'value', name: 'Learning Resources' },
            { type: 'value', name: 'Population', show: false }
        ],
        series: series,
        grid: {
            containLabel: true,
            left: '10%',
            right: '10%',
            top: '15%',
            bottom: '10%'
        }
    };

    // Set the chart options
    subAvailChart.setOption(option);

    window.onresize = function () {
        subAvailChart.resize();
    };

    // Resize the chart when carousel item is shown
    $('#carouselExampleControls').on('slide.bs.carousel', function () {
        setTimeout(function () {
            subAvailChart.resize();
        }, 100);
    });

    // Full-screen toggle functionality
    const fullscreenToggle = document.getElementById('fullscreenToggle');
    const gradeChartContainer = document.getElementById('gradeChartContainer');

    fullscreenToggle.addEventListener('click', () => {
        if (!document.fullscreenElement) {
            // Enter full screen
            gradeChartContainer.requestFullscreen();
            fullscreenToggle.textContent = 'Exit Full Screen';
            
            // Apply full-screen styles
            gradeChartContainer.style.backgroundColor = 'white';  // Set background color to white
            gradeChartContainer.style.display = 'flex';  // Use flexbox to center the content
            gradeChartContainer.style.justifyContent = 'center';  // Center horizontally
            gradeChartContainer.style.alignItems = 'center';  // Center vertically
            gradeChartContainer.style.height = '100vh';  // Full viewport height
            gradeChartContainer.style.padding = '20px';  // Add padding for margin effect

            subAvailChart.resize(); // Resize chart to fit new container size
        } else {
            // Exit full screen
            document.exitFullscreen();
            fullscreenToggle.textContent = 'Full Screen';
            
            // Reset styles
            gradeChartContainer.style.backgroundColor = '';  // Reset background color
            gradeChartContainer.style.display = '';  // Reset layout
            gradeChartContainer.style.justifyContent = '';  // Reset alignment
            gradeChartContainer.style.alignItems = '';  // Reset alignment
            gradeChartContainer.style.height = '';  // Reset height
            gradeChartContainer.style.padding = '';  // Reset padding

            subAvailChart.resize(); // Resize chart back to original size
        }
    });

    // Listen for the ESC key to exit full-screen mode
    document.addEventListener('keydown', function (event) {
        if (event.key === "Escape" && document.fullscreenElement) {
            // Exit full screen
            document.exitFullscreen();
            fullscreenToggle.textContent = 'Full Screen';
            
            // Reset styles
            gradeChartContainer.style.backgroundColor = '';  // Reset background color
            gradeChartContainer.style.display = '';  // Reset layout
            gradeChartContainer.style.justifyContent = '';  // Reset alignment
            gradeChartContainer.style.alignItems = '';  // Reset alignment
            gradeChartContainer.style.height = '';  // Reset height
            gradeChartContainer.style.padding = '';  // Reset padding

            subAvailChart.resize(); // Resize chart back to original size
        }
    });

    // Adjust chart on fullscreen change
    document.addEventListener('fullscreenchange', () => {
        if (!document.fullscreenElement) {
            // When exiting fullscreen, reset button text to "Full Screen"
            fullscreenToggle.textContent = 'Full Screen';

            // Reset styles
            gradeChartContainer.style.backgroundColor = '';  // Reset background color
            gradeChartContainer.style.display = '';  // Reset layout
            gradeChartContainer.style.justifyContent = '';  // Reset alignment
            gradeChartContainer.style.alignItems = '';  // Reset alignment
            gradeChartContainer.style.height = '';  // Reset height
            gradeChartContainer.style.padding = '';  // Reset padding
        }
        subAvailChart.resize();
    });
</script>
