<?php
 require_once('NaiveBayesClassifier.php');
   //  require 'db_connect.php';

 $classifier = new NaiveBayesClassifier();
    $murder = Category::$Murder;
    $pp = Category::$PP;
    $vt = Category::$VT;
    $rr = Category::$RR;
    $cc = Category::$CC;
    $et = Category::$ET;

	if(ISSET($_POST['save_fir'])){
		$fir_no = $_POST['fir_no'];
		$firstname = $_POST['firstname'];
		$middlename = $_POST['middlename'];
		$lastname = $_POST['lastname'];
		$birthdate = $_POST['month']."/".$_POST['day']."/".$_POST['year'];
		$age = $_POST['age'];
		
		$address = $_POST['address'];
        $crime_type = $_POST['crime_type'];
        $crime_area = $_POST['crime_area'];
         $crime_period = $_POST['crime_period'];
		$gender = $_POST['gender'];
        $crimedate = $_POST['month1']."/".$_POST['day1']."/".$_POST['year1'];
        $crime_time = $_POST['crime_time'];
        $man = $_POST['no_of_man'];
        $woman = $_POST['no_of_woman'];
        $total = $_POST['total'];
		
		$conn = new mysqli("localhost", "root", "", "cps") or die(mysqli_error());
		$q1 = $conn->query("SELECT * FROM `fir` WHERE `fir_no` = '$fir_no'") or die(mysqli_error());
		$c1 = $q1->num_rows;
		if($c1 > 0){
				echo "<script>alert('FIR No. must not be the same!')</script>";
		}else{
			$conn->query("INSERT INTO `fir` VALUES('$fir_no', '$firstname', '$middlename', '$lastname', '$birthdate', '$age', '$address','$gender', '$crime_type', '$crime_area', '$crimedate','$crime_period', '$crime_time', '$man', '$woman', '$total')") or die(mysqli_error());


			if($gender =='Male')
            {
                $g = 'man';
            }
            else
            {
                $g = 'woman';
            }
            if($crime_type =='Murder'){
                $classifier -> train($crime_period." ".$crime_area." ".$g, $murder);
            }
            else if($crime_type == 'Pick Pocketing'){
                $classifier -> train($crime_period." ".$crime_area." ".$g, $pp);
            }
            else if($crime_type == 'Vehicle Theft'){
                $classifier -> train($crime_period." ".$crime_area." ".$g, $vt);
            }
            else if($crime_type == 'Road Raze'){
                $classifier -> train($crime_period." ".$crime_area." ".$g, $rr);
            }
            else if($crime_type == 'Chain Snatching'){
                $classifier -> train($crime_period." ".$crime_area." ".$g, $cc);
            }
            else if($crime_type == 'Eve Teasing'){
                $classifier -> train($crime_period." ".$crime_area." ".$g, $et);
            }

			header("location: fir.php");
		}
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
		
	}
	