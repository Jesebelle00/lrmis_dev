<?php 

	require_once 'config.php';
	// Initialize the session
	session_start();
 
	$query = "select count(fk_id)/(kinder_population+grade1_population+grade2_population+grade3_population+grade4_population+grade5_population+grade6_population+grade7_population
+grade8_population+grade9_population+grade10_population+grade11_population+grade12_population) learner_to_lr from schools s
inner join lrmis l
on s.school_code = l.school_code
where s.school_code = ".$_SESSION["school_code"];
	

	$result = mysqli_query($link,$query);
	$row = mysqli_fetch_assoc($result);
	echo floor($row['learner_to_lr']).":1";
?> 
