<html>
	<div >
        	<canvas id="subjectsbarchartchart"></canvas>
	</div>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js" 
integrity="sha512-JPcRR8yFa8mmCsfrw4TNte1ZvF1e3+1SdGMslZvmrzDYxS69J7J49vkFL8u6u8PlPJK+H3voElBtUCzaXj+6ig==" 
crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php require_once 'chartjsbarchartdata.php'; ?>
<script>

    const data1 = {labels: [<?php echo $Subjects; ?>],datasets: [{label: 'Available LR Per Subject Area', data: [<?php echo $lrs; ?>]}]};
    const config1 = {type: 'bar',data: data1, options: { datalabels: { }}, plugins: [ChartDataLabels]};
    const subjectsbarchartchart = new Chart(document.getElementById('subjectsbarchartchart').getContext('2d'),config1);

</script>
</body>
</html>