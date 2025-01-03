<div id="totalLearnersChart" style="width: 100%; height: 200px;"></div>

<script type="text/javascript">
    // Dummy data for demonstration purposes (total learners)
    var totalLearnersData = [
        { grade_level: 'Grade 1', qty: 10 },
        { grade_level: 'Grade 2', qty: 15 },
        { grade_level: 'Grade 3', qty: 20 },
        { grade_level: 'Grade 4', qty: 25 },
        { grade_level: 'Grade 5', qty: 30 },
        { grade_level: 'Grade 6', qty: 35 }
    ];

    // Initialize the chart for total learners version
    var chartDomLearners = document.getElementById('totalLearnersChart');
    var totalLearnersChart = echarts.init(chartDomLearners);

    var gradeLevels = [...new Set(totalLearnersData.map(item => item.grade_level))];

    // Prepare series data for total learners version
    var seriesLearners = [{
        name: 'Learning Resources',
        type: 'bar',
        data: gradeLevels.map(grade => {
            var totalQty = totalLearnersData
                .filter(d => d.grade_level === grade)
                .reduce((sum, item) => sum + item.qty, 0);
            return totalQty;
        })
    }];

    // Chart options for total learners version
    var optionLearners = {
        legend: {            itemGap: 15, // Add spacing between legend items
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: { type: 'line' }
        },
        xAxis: {
            type: 'category',
            data: gradeLevels,
            axisLabel: { rotate: -45 }
        },
        yAxis: {
            type: 'value',
            name: 'Population'
        },
        series: seriesLearners,
        grid: {
            containLabel: true,
            left: '10%',
            right: '10%',
            top: '15%',
            bottom: '10%'
        }
    };

    // Set the chart options for total learners version
    totalLearnersChart.setOption(optionLearners);

    window.onresize = function () {
        totalLearnersChart.resize();
    };

    // Full-screen toggle functionality for total learners version
    const fullscreenToggleLearners = document.getElementById('fullscreenToggleLearners');
    const learnersChartContainer = document.getElementById('learnersChartContainer');

    fullscreenToggleLearners.addEventListener('click', () => {
        if (!document.fullscreenElement) {
            // Enter full screen
            learnersChartContainer.requestFullscreen();
            fullscreenToggleLearners.textContent = 'Exit Full Screen';

            // Apply full-screen styles
            learnersChartContainer.style.backgroundColor = 'white';
            learnersChartContainer.style.display = 'flex';
            learnersChartContainer.style.justifyContent = 'center';
            learnersChartContainer.style.alignItems = 'center';
            learnersChartContainer.style.height = '100vh';
            learnersChartContainer.style.padding = '20px';

            totalLearnersChart.resize(); // Resize chart to fit new container size
        } else {
            // Exit full screen
            document.exitFullscreen();
            fullscreenToggleLearners.textContent = 'Full Screen';

            // Reset styles
            learnersChartContainer.style.backgroundColor = '';
            learnersChartContainer.style.display = '';
            learnersChartContainer.style.justifyContent = '';
            learnersChartContainer.style.alignItems = '';
            learnersChartContainer.style.height = '';
            learnersChartContainer.style.padding = '';

            totalLearnersChart.resize(); // Resize chart back to original size
        }
    });

    // Adjust chart on fullscreen change for total learners version
    document.addEventListener('fullscreenchange', () => {
        if (!document.fullscreenElement) {
            fullscreenToggleLearners.textContent = 'Full Screen';

            // Reset styles
            learnersChartContainer.style.backgroundColor = '';
            learnersChartContainer.style.display = '';
            learnersChartContainer.style.justifyContent = '';
            learnersChartContainer.style.alignItems = '';
            learnersChartContainer.style.height = '';
            learnersChartContainer.style.padding = '';
        }
        totalLearnersChart.resize();
    });
</script>
