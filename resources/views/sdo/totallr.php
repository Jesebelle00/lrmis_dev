<?php 
	
	require_once 'config.php';
	session_start();
	$total_population= 0;

	$query = "select count(fk_id) totallr from lrmis where school_code = ".$_SESSION["school_code"];
	

	$result = mysqli_query($link,$query);
	$row = mysqli_fetch_assoc($result);
	echo number_format($row['totallr']);
?> 
