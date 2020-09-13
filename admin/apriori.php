<!DOCTYPE html>
<?php
	require_once 'logincheck.php';
	$date = date("Y", strtotime("+ 8 HOURS"));
	$conn = new mysqli("localhost", "root", "", "cps") or die(mysqli_error());
	
?>
<html lang = "eng">
	<head>
		<title>Crime Prediction System | Dashboard</title>
		<meta charset = "utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel = "shortcut icon" href = "" />
		<link rel = "stylesheet" type = "text/css" href = "../css/bootstrap.css" />
		<link rel = "stylesheet" type = "text/css" href = "../css/jquery.dataTables.css" />
		<link rel = "stylesheet" type = "text/css" href = "../css/customize.css" />
		<?php require 'script.php'?>
		<script src = "../js/jquery.canvasjs.min.js"></script>
		
	</head>
<body>
	<div class = "navbar navbar-default navbar-fixed-top">
		<img src = "" style = "float:left;" height = "55px" /><label class = "navbar-brand">Crime Prediction System</label>
		<?php 
			$q = $conn->query("SELECT * FROM `admin` WHERE `admin_id` = $_SESSION[admin_id]") or die(mysqli_error());
			$f = $q->fetch_array();
		?>
			<ul class = "nav navbar-right">	
				<li class = "dropdown">
					<a class = "user dropdown-toggle" data-toggle = "dropdown" href = "#">
						<span class = "glyphicon glyphicon-user"></span>
						<?php 
							echo $f['firstname']." ".$f['lastname'];
						?>
						<b class = "caret"></b>
					</a>
				<ul class = "dropdown-menu">
					<li>
						<a class = "me" href = "logout.php"><i class = "glyphicon glyphicon-log-out"></i> Logout</a>
					</li>
				</ul>
				</li>
			</ul>
	</div>
	<div id = "sidebar">
			<ul id = "menu" class = "nav menu">
				<li><a href = "home.php"><i class = "glyphicon glyphicon-home"></i> Dashboard</a></li>
				
				<li><li><a href = "fir.php"><i class = "glyphicon glyphicon-user"></i> FIR</a></li></li>
				<li><a href = ""><i class = "glyphicon glyphicon-folder-close"></i> Analysis</a>
					<ul>
						<li><a href = "apriori.php">Apriori Algorithm</a></li>
						<li><a href = "decisiontree.php">Decision Tree</a></li>
						<li><a href = "naivedata.php">Naive Bayes</a></li>
						
						
					</ul>
				</li>
			</ul>
	</div>
	<div id = "content">
		<br />
		<br />
		<br />
		<div class = "well">
			Apriori Algorithm
		</div>
		<?php 
		include 'class.apriori.php'; 
$Apriori = new Apriori();
//echo "Success"."<br/>";


 
$Apriori->setMaxScan(20);       //Scan 2, 3, ...
$Apriori->setMinSup(2);         //Minimum support 1, 2, 3, ...
$Apriori->setMinConf(25);       //Minimum confidence - Percent 1, 2, ..., 100
$Apriori->setDelimiter(',');    //Delimiter 
 
/*$conn = new mysqli("localhost", "root", "", "hcpms") or die(mysqli_error());
$q = $conn->query("SELECT * FROM fir") or die(mysqli_error());
//Use Array:
$myfile = fopen("logs.txt", "w+") or die("Unable to open file!");


//$dataset   = array();
while($row = mysqli_fetch_array($q)){
	//echo $row['crime_type'];
 	$var = $row['crime_type'].",".$row['crime_area'].",".$row['crime_period'];
 	//echo $var;
 	fwrite($myfile, $var."\n");

 	
}
fclose($myfile);
$myfile = fopen("logs.txt","r+");*/
//print_r($dataset);


/*
$var = "Chain Snatching".","."Mandvi".","."2.30 PM".","."2";
$var1 = "Chain Snatching".","."2".","."2.30 PM";
$var2 = "Mandvi".","."2";
$dataset[] = array();
$dataset[] = $var;
$dataset[] = $var1;
$dataset[] = $var2;
$Apriori->process($dataset);
echo '<h1>Frequent Itemsets</h1>';
$Apriori->printFreqItemsets();
 
echo '<h3>Frequent Itemsets Array</h3>';
print_r($Apriori->getFreqItemsets()); 
 
//Association Rules
echo '<h1>Association Rules</h1>';
$Apriori->printAssociationRules();
 
echo '<h3>Association Rules Array</h3>';
print_r($Apriori->getAssociationRules()); */
/*$dataset[] = array('A', 'B', 'C', 'D'); 
$dataset[] = array('A', 'D', 'C');  
$dataset[] = array('B', 'C'); 
$dataset[] = array('A', 'E', 'C'); 
$Apriori->process($dataset);
*/
$Apriori->process('logs.txt');

//$Apriori->process('dataset.txt');
 
//Frequent Itemsets
echo '<h1>Frequent Itemsets</h1>';
$Apriori->printFreqItemsets();
 
/*echo '<h3>Frequent Itemsets Array</h3>';
print_r($Apriori->getFreqItemsets()); */
 
//Association Rules
echo '<h1>Association Rules</h1>';
$Apriori->printAssociationRules();
 
/*echo '<h3>Association Rules Array</h3>';
print_r($Apriori->getAssociationRules()); */
 
//fclose($myfile);
error_reporting(E_ERROR | E_PARSE);
?>
	</div>
	<div id = "footer">
		<label class = "footer-title">&copy; Crime Prediction System 2018</label>
	</div>
		
</body>
</html>