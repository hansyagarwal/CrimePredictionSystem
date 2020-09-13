<!DOCTYPE html>
<?php
	require_once 'logincheck.php';
	$date = date("Y", strtotime("+ 8 HOURS"));
	$conn = new mysqli("localhost", "root", "", "cps") or die(mysqli_error());
	?>
<html>
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
		<?php 
		 require_once('NaiveBayesClassifier.php');
     require 'db_connect.php';
/*
    $classifier = new NaiveBayesClassifier();
    $spam = Category::$SPAM;
    $ham = Category::$HAM;

    $classifier -> train('Have a pleasurable stay! Get up to 30% off + Flat 20% Cashback on Oyo Room' . 
            ' bookings done via Paytm', $spam);
    $classifier -> train('Lets Talk Fashion! Get flat 40% Cashback on Backpacks, Watches, Perfumes,' .
            ' Sunglasses & more', $spam);

    $classifier -> train('Opportunity with Product firm for Fullstack | Backend | Frontend- Bangalore', $ham);
    $classifier -> train('Javascript Developer, Fullstack Developer in Bangalore- Urgent Requirement', $ham);

    $category = $classifier -> classify('Scan Paytm QR Code to Pay & Win 100% Cashback');
    echo $category."<br/>";
    
    $category = $classifier -> classify('Re: Applying for Fullstack Developer');
    echo $category."<br/>";

    */
    $classifier = new NaiveBayesClassifier();
    $murder = Category::$Murder;
    $pp = Category::$PP;
    $vt = Category::$VT;
    $rr = Category::$RR;
    $cc = Category::$CC;
    $et = Category::$ET;

  /* $sql = mysqli_query($conn, "SELECT * FROM fir");
            //$q = mysqli_fetch_assoc($sql);
        while($q = mysqli_fetch_assoc($sql)){
           // echo $q['crime_type'];
            if($q['gender']=='Male')
            {
                $g = 'man';
            }
            else
            {
                $g = 'woman';
            }
            if($q['crime_type']=='Murder'){
                $classifier -> train($q['crime_period']." ".$q['crime_area']." ".$g, $murder);
            }
            else if($q['crime_type']=='Pick Pocketing'){
                $classifier -> train($q['crime_period']." ".$q['crime_area']." ".$g, $pp);
            }
            else if($q['crime_type']=='Vehicle Theft'){
                $classifier -> train($q['crime_period']." ".$q['crime_area']." ".$g, $vt);
            }
            else if($q['crime_type']=='Road Raze'){
                $classifier -> train($q['crime_period']." ".$q['crime_area']." ".$g, $rr);
            }
            else if($q['crime_type']=='Chain Snatching'){
                $classifier -> train($q['crime_period']." ".$q['crime_area']." ".$g, $cc);
            }
            else if($q['crime_type']=='Eve Teasing'){
                $classifier -> train($q['crime_period']." ".$q['crime_area']." ".$g, $et);
            }
             
            }
        */

   /* $classifier -> train('Night Mandvi Man', $murder);
    $classifier -> train('Mid Night Fatehpura Man', $murder);

    $classifier -> train('Afternoon Alkapuri Woman', $pp);
    $classifier -> train('Afternoon Mandvi Woman', $pp);*/
    $data = $_POST['crimedetail'];
    echo "The Data entered is:".$data."</br>";

    $category = $classifier -> classify($data);
    echo "<br/>".$category."<br/>";
    
  /*  $category = $classifier -> classify('Woman normally go shopping in chhani in afternoon');
    echo $category."<br/>";*/
?>
	</div>
	<div id = "footer">
		<label class = "footer-title">&copy; Crime Prediction System 2018</label>
	</div>
		
</body>
</html>