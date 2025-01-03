<?php 
	require_once 'config.php'; 
	session_start();
	$total_lr= 0;

	 	$query = "select * from ( select 'English' 	subject, count(*) lr from lrmis where school_code = ".$_SESSION['school_code']." and subject_area LIKE '%English%' group by 1
	union all select 'Mathematics' 		subject, count(*) lr from lrmis where school_code = ".$_SESSION['school_code']." and subject_area LIKE '%Math%' group by 1
	union all select 'Science & Technology' subject, count(*) lr from lrmis where school_code = ".$_SESSION['school_code']." and subject_area LIKE '%Science%' group by 1
	union all select 'Filipino' 		subject, count(*) lr from lrmis where school_code = ".$_SESSION['school_code']." and subject_area LIKE '%Filipino%' group by 1
	union all select 'MAPEH' 		subject, count(*) lr from lrmis where school_code = ".$_SESSION['school_code']." and subject_area LIKE '%MAPEH%' group by 1
	union all select 'EPP/TLE/TVE' 		subject, count(*) lr from lrmis where school_code = ".$_SESSION['school_code']." and subject_area LIKE '%EPP/TLE/TVE%' group by 1
    	union all select 'EsP' 			subject, count(*) lr from lrmis where school_code = ".$_SESSION['school_code']." and subject_area LIKE '%EsP%' group by 1
	union all select 'Araling Panlipunan' 	subject, count(*) lr from lrmis where school_code = ".$_SESSION['school_code']." and subject_area LIKE '%AralPan%' group by 1
	union all select 'MTB-MLE' 		subject, count(*) lr from lrmis where school_code = ".$_SESSION['school_code']." and subject_area LIKE '%MTB-MLE%' group by 1) aa order by 2 desc"; 
	

	$x=0;
	$subject[]='';
	$lr[]=0;

	$exec = mysqli_query($link,$query);
	while($row = mysqli_fetch_array($exec)){
		if($row['lr']!=0){
	 		$total_lr += $row['lr'];
			$subject[$x]="'".$row['subject']."'";
			$lr[$x] = $row['lr'];
			$x+=1;
		}
	}
	$Subjects= implode(',',$subject);
	$lrs=implode(',',$lr);
?> 
