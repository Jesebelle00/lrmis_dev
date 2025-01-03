<!-- total charts -->
<div id="total-ads" style="width: 100%; height: 200px;"></div>

<script>
    var totalAdsDom = document.getElementById('total-ads');
    var adsChart = echarts.init(totalAdsDom);
    var adsOption = {
        tooltip: { trigger: 'item' },
        legend: {
            left: 'center',
            itemGap: 15, // Add spacing between legend items
        },
        series: [
            {
                name: 'Access From',
                type: 'pie',
                radius: ['40%', '70%'],
                avoidLabelOverlap: true,
                label: { show: false, position: 'center' },
                labelLine: { show: false },
                data: [
                    { value: 1048, name: 'Print' },
                    { value: 735, name: 'Non-Print' },
                ]
            }
        ]
    };
    adsChart.setOption(adsOption);
</script>
