<?php 
	require_once 'config.php';
	
	session_start();

	$query = "select 'kindergarten' level, kinder_population as population from schools where school_code = ".$_SESSION["school_code"]."
union all select 'Grade 1' level, grade1_population as population from schools where school_code = ".$_SESSION["school_code"]."
union all select 'Grade 2' level, grade2_population as population from schools where school_code = ".$_SESSION['school_code']."
union all select 'Grade 3' level, grade3_population as population from schools where school_code = ".$_SESSION['school_code']."
union all select 'Grade 4' level, grade4_population as population from schools where school_code = ".$_SESSION['school_code']."
union all select 'Grade 5' level, grade5_population as population from schools where school_code = ".$_SESSION['school_code']."
union all select 'Grade 6' level, grade6_population as population from schools where school_code = ".$_SESSION['school_code']."
union all select 'Grade 7' level, grade7_population as population from schools where school_code = ".$_SESSION['school_code']."
union all select 'Grade 8' level, grade8_population as population from schools where school_code = ".$_SESSION['school_code']."
union all select 'Grade 9' level, grade9_population as population from schools where school_code = ".$_SESSION['school_code']."
union all select 'Grade 10' level, grade10_population as population from schools where school_code = ".$_SESSION['school_code']."
union all select 'Grade 11' level, grade11_population as population from schools where school_code = ".$_SESSION['school_code']."
union all select 'Grade 12' level, grade12_population as population from schools where school_code = ".$_SESSION['school_code'];
	
	$x=0;
	$level[]='';
	$population[]=0;

	$exec = mysqli_query($link,$query);
	while($row = mysqli_fetch_array($exec)){
		if($row['population']!=0){
	 		$total_population += $row['population'];
			$level[$x]="'".$row['level']."'";
			$population[$x] = $row['population'];
			$x+=1;
		}
	}
	$levels= implode(',',$level);
	$populations=implode(',',$population);
?> 
