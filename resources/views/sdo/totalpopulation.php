<?php 

	session_start();

	require_once 'config.php'; 

	$query = "select kinder_population+grade1_population+grade2_population+grade3_population+grade4_population+grade5_population+grade6_population+grade7_population
	+grade8_population+grade9_population+grade10_population+grade11_population+grade12_population
	totalpopulation from schools where school_code = ".$_SESSION["school_code"];

	$result = mysqli_query($link,$query);
	$row = mysqli_fetch_assoc($result);

	echo number_format($row['totalpopulation']);
	
?> 
