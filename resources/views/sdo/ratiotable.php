<!DOCTYPE HTML>
<html>

<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
 
<style>
table {
  width: 100%;
  border-collapse: collapse;
}

td,
th {
  padding: 15px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

tr:hover {
  background-color: #f5f5f5;
}

@media screen and (max-width: 600px) {
  td,
  th {
    display: block;
    width: 100%;
    text-align: left;
  }

  td:before,
  th:before {
    content: attr(data-label);
    display: block;
    font-weight: bold;
  }
}
</style>
</head> 

<body>
<div class=ratiolrtable>
<font size="2" face="Arial Narrow"><center>
<table class="table table-striped" > 
<thead>
      <tr > 
          <td> <font face="Arial"><B>Grade Level</B></font> </td> 
          <td> <font face="Arial"><B>LRs</font></B></td> 
	  <td> <font face="Arial"><B>Learners</B></font> </td> 
          <td> <font face="Arial"><B>Ratio</B></font> </td> 
      </tr>
</thead>

 <?php 
	
	require_once 'config.php';
	session_start();
 
	// Check if the user is logged in, if not then redirect him to login page
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		    header("index: index.php");
	    exit;
	}
	$total_population=0;
	$total_lr=0;
	$overall_ratio=0;


$query = "select 'Kindergarten' level, count(*) lr, Kinder_population population, count(*)/Kinder_population ratio from lrmis l inner join schools s on l.school_code = s.school_code where s.school_code = ".$_SESSION['school_code']."
 and l.level LIKE '%Kindergarten%' group by 1
union all select 'Grade 1' 	level, count(*) lr, grade1_population population, count(*)/grade1_population ratio from lrmis l inner join schools s on l.school_code = s.school_code where s.school_code =  ".$_SESSION['school_code']."
 and l.level LIKE '%Grade 1,%' group by 1 
union all select 'Grade 2' 	level, count(*) lr, grade2_population population, count(*)/grade2_population ratio  from lrmis l inner join schools s on l.school_code = s.school_code where s.school_code =  ".$_SESSION['school_code']."
 and l.level LIKE '%Grade 2%' group by 1 
union all select 'Grade 3' 	level, count(*) lr, grade3_population population, count(*)/grade3_population ratio  from lrmis l inner join schools s on l.school_code = s.school_code where s.school_code =  ".$_SESSION['school_code']."
 and l.level LIKE '%Grade 3%' group by 1 
union all select 'Grade 4' 	level, count(*) lr, grade4_population population, count(*)/grade4_population ratio  from lrmis l inner join schools s on l.school_code = s.school_code where s.school_code =  ".$_SESSION['school_code']."
 and l.level LIKE '%Grade 4%' group by 1 
union all select 'Grade 5' 	level, count(*) lr, grade5_population population, count(*)/grade5_population ratio  from lrmis l inner join schools s on l.school_code = s.school_code where s.school_code =  ".$_SESSION['school_code']."
 and l.level LIKE '%Grade 5%' group by 1 
union all select 'Grade 6' 	level, count(*) lr, grade6_population population, count(*)/grade6_population ratio  from lrmis l inner join schools s on l.school_code = s.school_code where s.school_code =  ".$_SESSION['school_code']."
 and l.level LIKE '%Grade 6%' group by 1 
union all select 'Grade 7' 	level, count(*) lr, grade7_population population, count(*)/grade7_population ratio  from lrmis l inner join schools s on l.school_code = s.school_code where s.school_code =  ".$_SESSION['school_code']."
 and l.level LIKE '%Grade 7%' group by 1 
union all select 'Grade 8' 	level, count(*) lr, grade8_population population, count(*)/grade8_population ratio  from lrmis l inner join schools s on l.school_code = s.school_code where s.school_code =  ".$_SESSION['school_code']."
 and l.level LIKE '%Grade 8%' group by 1 
union all select 'Grade 9' 	level, count(*) lr, grade9_population population, count(*)/grade9_population ratio  from lrmis l inner join schools s on l.school_code = s.school_code where s.school_code =  ".$_SESSION['school_code']."
 and l.level LIKE '%Grade 9%' group by 1 
union all select 'Grade 10' 	level, count(*) lr, grade10_population population, count(*)/grade10_population ratio  from lrmis l inner join schools s on l.school_code = s.school_code where s.school_code =  ".$_SESSION['school_code']."
 and l.level LIKE '%Grade 10%' group by 1 
union all select 'Grade 11' 	level, count(*) lr, grade11_population population, count(*)/grade11_population ratio  from lrmis l inner join schools s on l.school_code = s.school_code where s.school_code =  ".$_SESSION['school_code']."
 and l.level LIKE '%Grade 11%' group by 1 
union all select 'Grade 12' 	level, count(*) lr, grade12_population population, count(*)/grade12_population ratio  from lrmis l inner join schools s on l.school_code = s.school_code where s.school_code =  ".$_SESSION['school_code']."
 and l.level LIKE '%Grade 12%' group by 1";
	
	$exec = mysqli_query($link,$query);
	while($row = mysqli_fetch_array($exec)){

		echo "<tr><td>".ucfirst($row['level'])."</td><td>".number_format($row['lr'])."</td><td>".number_format($row['population'])."</td><td>".number_format($row['ratio']).":1</td></tr>";
		$total_population += $row['population'];
		$total_lr += $row['lr'];
	}
		
?> 
 <!-- <tr><td><B>TOTAL</td><td><B><?php echo number_format($total_lr); ?></td><td><B><?php //echo number_format($total_population); ?></td><td><B><?php echo number_format($total_lr/$total_population).":1"; ?></b></td></tr> --> 

</div>
</body>
</html>