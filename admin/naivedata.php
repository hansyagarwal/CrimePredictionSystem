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
			Naive Bayes Classification
		</div>
		<form action = "naivebayes.php" enctype = "multipart/form-data" method = "POST" >
				
				<div class = "form-group">
					<label for = "username">Enter details of Crime here:</label>
					<input class = "form-control" type = "text" name = "crimedetail" required = "required"/>
				</div>
				<br />
				
				<br />
				<div class = "form-group">
					<button class  = "btn btn-success form-control" type = "submit" name = "submit" ><span class = "glyphicon glyphicon-log-in"></span> Submit</button>
				</div>
			</form>
		

	</div>
	<div id = "footer">
		<label class = "footer-title">&copy; Crime Prediction System 2018</label>
	</div>
		
</body>
</html>