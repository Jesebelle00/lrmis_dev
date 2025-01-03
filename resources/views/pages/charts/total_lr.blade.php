<div id="total-ads" style="width: 100%; height: 200px;"></div>

<script>
    // Pass PHP variables to JavaScript
    var printCount = @json($printCount);
    var nonPrintCount = @json($nonPrintCount);

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
                name: 'Total Material:',
                type: 'pie',
                radius: ['40%', '70%'],
                avoidLabelOverlap: true,
                label: { show: false, position: 'center' },
                labelLine: { show: false },
                data: [
                    { value: printCount, name: 'Print' },
                    { value: nonPrintCount, name: 'Non-Print' },
                ]
            }
        ]
    };
    adsChart.setOption(adsOption);
</script>
