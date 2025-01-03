<!doctype html>
<div>
<canvas id="statuschart"></canvas>
    </div>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js" 
integrity="sha512-JPcRR8yFa8mmCsfrw4TNte1ZvF1e3+1SdGMslZvmrzDYxS69J7J49vkFL8u6u8PlPJK+H3voElBtUCzaXj+6ig==" 
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php require_once 'chartjsdonutdatastatus.php'; ?>
<script>

    const data2 = {labels: [<?php echo $statuses; ?>],datasets: [{data: [<?php echo $lrs2; ?>]}]};
    const config2 = {type: 'doughnut',data: data2,options:  {datalabels: {}}, plugins: [ChartDataLabels]};
    const statuschart= new Chart(document.getElementById('statuschart').getContext('2d'),config2);

</script>
</body>
</html>