<html>
<div>
<canvas id="pieChart"></canvas>
</div>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js" 
integrity="sha512-JPcRR8yFa8mmCsfrw4TNte1ZvF1e3+1SdGMslZvmrzDYxS69J7J49vkFL8u6u8PlPJK+H3voElBtUCzaXj+6ig==" 
crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php require_once 'chartjsdonutdata.php'; ?>
<script>

    const data0 = {labels: [<?php echo $levels; ?>],datasets: [{data: [<?php echo $populations; ?>]}]  };
    const config0 = {type: 'doughnut',data: data0, options:  {datalabels: { }}, plugins: [ChartDataLabels]};
    const pieChart = new Chart(document.getElementById('pieChart').getContext('2d'),config0);

</script>
</body>
</html>