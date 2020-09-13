<!DOCTYPE html>
<?php
	require_once 'logincheck.php';
	$date = date("Y", strtotime("+ 8 HOURS"));
	$conn = new mysqli("localhost", "root", "", "cps") or die(mysqli_error());
	$sql = mysqli_query($conn, "SELECT count(fir_no) as total FROM fir");
	$count = mysqli_fetch_assoc($sql);
	$total = $count['total'];
	$sql1 = mysqli_query($conn, "SELECT count(fir_no) as mtotal FROM fir WHERE crime_type = 'Murder'");
	$count1 = mysqli_fetch_assoc($sql1);
	$mtotal = $count1['mtotal'];
	$sql2 = mysqli_query($conn, "SELECT count(fir_no) as ptotal FROM fir WHERE crime_type = 'Pick Pocketing'");
	$count2 = mysqli_fetch_assoc($sql2);
	$ptotal = $count2['ptotal'];
	$sql3 = mysqli_query($conn, "SELECT count(fir_no) as rtotal FROM fir WHERE crime_type = 'Road Raze'");
	$count3 = mysqli_fetch_assoc($sql3);
	$rtotal = $count3['rtotal'];
	$sql4 = mysqli_query($conn, "SELECT count(fir_no) as etotal FROM fir WHERE crime_type = 'Eve Teasing'");
	$count4 = mysqli_fetch_assoc($sql4);
	$etotal = $count4['etotal'];
	$sql5 = mysqli_query($conn, "SELECT count(fir_no) as vtotal FROM fir WHERE crime_type = 'Vehicle Theft'");
	$count5 = mysqli_fetch_assoc($sql5);
	$vtotal = $count5['vtotal'];
	$sql6 = mysqli_query($conn, "SELECT count(fir_no) as ctotal FROM fir WHERE crime_type = 'Chain Snatching'");
	$count6 = mysqli_fetch_assoc($sql6);
	$ctotal = $count6['ctotal'];
	
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
		
		<script src = "../js/jquery.canvasjs.min.js"></script>
		
	</head>
<body>
	<?php include("script.php"); ?>

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
			<h4>Dashboard</h4>
		</div>
		<h3>Total FIR Registered : <?php echo $total;?></h3>
		<h3 style="color:red">Type of Crime:</h3>
		<h3>Murder : <?php echo $mtotal;?></h3>
		<h3>Pick Pocketing : <?php echo $ptotal;?></h3>
		<h3>Chain Snatching : <?php echo $ctotal;?></h3>
		<h3>Vehicle Theft : <?php echo $vtotal;?></h3>
		<h3>Eve Teasing : <?php echo $etotal;?></h3>
		<h3>Road Raze : <?php echo $rtotal;?></h3>
	</div>
	<div id = "footer">
		<label class = "footer-title">&copy; Crime Prediction System 2018</label>
	</div>
		
</body>
</html>