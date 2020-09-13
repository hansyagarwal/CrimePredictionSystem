<!DOCTYPE html>
<?php
	require_once 'logincheck.php';
?>
<html lang = "eng">
	<head>
		<title>Crime Prediction System</title>
		<meta charset = "utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel = "shortcut icon" href = "../images/logo.png" />
		<link rel = "stylesheet" type = "text/css" href = "../css/bootstrap.css" />
		<link rel = "stylesheet" type = "text/css" href = "../css/jquery.dataTables.css" />
		<link rel = "stylesheet" type = "text/css" href = "../css/customize.css" />
	</head>
<body>
	<div class = "navbar navbar-default navbar-fixed-top">
		<img src = "" style = "float:left;" height = "55px" /><label class = "navbar-brand">Crime Prediction System </label>
			<?php
				$conn = new mysqli("localhost", "root", "", "cps") or die(mysqli_error());
				$q = $conn->query("SELECT * FROM `admin` WHERE `admin_id` = '$_SESSION[admin_id]'") or die(mysqli_error());
				$f = $q->fetch_array();
			?>
			<ul class = "nav navbar-right">	
				<li class = "dropdown">
					<a class = "user dropdown-toggle" data-toggle = "dropdown" href = "#">
						<span class = "glyphicon glyphicon-user"></span>
						<?php
							echo $f['firstname']." ".$f['lastname'];
							$conn->close();
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
		<div class = "panel panel-success">	
			<div class = "panel-heading">
				<label>FIR INFORMATION / EDIT</label>
				<a style = "float:right; margin-top:-4px;" href = "fir.php" class = "btn btn-info"><span class = "glyphicon glyphicon-hand-right"></span> BACK</a>
			</div>
			<div class = "panel-body">
			<?php
				$conn = new mysqli("localhost", "root", "", "cps") or die(mysqli_error());
				$q = $conn->query("SELECT * FROM `fir` WHERE `fir_no` = '$_GET[id]' && `lastname` = '$_GET[lastname]'") or die(mysqli_error());
				$f = $q->fetch_array();
			?>
				<form method = "POST" enctype = "multipart/form-data">
					<div style = "float:left;" class = "form-inline">
						<label for = "fir_no">FIR No:</label>
						<input class = "form-control" value = "<?php echo $f['fir_no'] ?>" disabled = "disabled" size = "3" type = "number" name = "fir_no">
					</div>

					<br />
					<br />
					<br />
					<div class = "form-inline">
						<label for = "firstname">Firstname:</label>
						<input class = "form-control" name = "firstname" value = "<?php echo $f['firstname']?>" type = "text" required = "required">
						&nbsp;&nbsp;&nbsp;
						<label for = "middlename">Middle Name:</label>
						<input class = "form-control" name = "middlename" value = "<?php echo $f['middlename']?>" type = "text" required = "required">
						&nbsp;&nbsp;&nbsp;
						<label for = "lastname">Lastname:</label>
						<input class = "form-control" name = "lastname" value = "<?php echo $f['lastname']?>" type = "text" required = "required">
					</div>
					<br />
					<div class = "form-group">
						<label for = "birthdate" style = "float:left;">Birthdate:</label>
                        <input class = "form-control" name = "birthdate" value = "<?php echo $f['birthdate']?>" type = "text" required = "required">

						<br style = "clear:both;"/>
						<br />

						<label for = "address">Address:</label>
						<input class = "form-control" name = "address" type = "text" value = "<?php echo $f['address']?>" required = "required">
						<br />
						<label for = "age">Age:</label>
						<input class = "form-control" style = "width:20%;" value = "<?php echo $f['age']?>" name = "age" type = "number">
						<br />

						<label for = "gender">Gender:</label>
						<select style = "width:22%;" class = "form-control"  name = "gender" required = "required">
							<option value = "">--Please select an option--</option>
							<option value = "Male" <?php if($f['gender']=='Male') echo 'selected'; ?>>Male</option>
							<option value = "Female" <?php if($f['gender']=='Female') echo 'selected'; ?>>Female</option>
						</select>
					</div>
					<br />
                    <label for = "civil_status">Type of Crime:</label>
                    <select style = "width:22%;" class = "form-control" name = "crime_type" required = "required">
                        <option value = "">--Please select an option--</option>
                        <option value = "Chain Snatching" <?php if($f['crime_type']=='Chain Snatching') echo 'selected'; ?>>Chain Snatching</option>
                        <option value = "Eve Teasing" <?php if($f['crime_type']=='Eve Teasing') echo 'selected'; ?>>Eve Teasing</option>
                        <option value = "Road Raze" <?php if($f['crime_type']=='Road Raze') echo 'selected'; ?>>Road Raze</option>
                        <option value = "Pick Pocketing" <?php if($f['crime_type']=='Pick Pocketing') echo 'selected'; ?>>Pick Pocketing</option>
                        <option value = "Murder" <?php if($f['crime_type']=='Murder') echo 'selected'; ?>>Murder</option>
                        <option value = "Vehicle Theft" <?php if($f['crime_type']=='Vehicle Theft') echo 'selected'; ?>>Vehicle Theft</option>
                    </select>
                    <br />
                    <label for = "civil_status">Location of Crime:</label>
                    <select style = "width:22%;" class = "form-control" name = "crime_area" required = "required">
                        <option value = "">--Please select an option--</option>
                        <option value = "Alkapuri" <?php if($f['crime_area']=='Alkapuri') echo 'selected'; ?>>Alkapuri</option>
                        <option value = "Akota" <?php if($f['crime_area']=='Akota') echo 'selected'; ?>>Akota</option>
                        <option value = "Mandvi" <?php if($f['crime_area']=='Mandvi') echo 'selected'; ?>>Mandvi</option>
                        <option value = "Chhani" <?php if($f['crime_area']=='Chhani') echo 'selected'; ?>>Chhani</option>
                        <option value = "Makarpura" <?php if($f['crime_area']=='Makarpura') echo 'selected'; ?>>Makarpura</option>
                        <option value = "Waghodiya" <?php if($f['crime_area']=='Waghodiya') echo 'selected'; ?>>Waghdoiya</option>
                    </select>
                    <br/>
                    <label for = "birthdate" style = "float:left;">Date of Crime Commited:</label>
                    <br style = "clear:both;" />
                    <input class = "form-control" name = "birthdate" value = "<?php echo $f['crime_date']?>" type = "text" required = "required">

                    <br/>
                    <label for = "Period of crime" style = "float:left;">Period of Crime Commited:</label>
                    <br style = "clear:both;" />
                    <input class = "form-control" name = "birthdate" value = "<?php echo $f['crime_period']?>" type = "text" required = "required">


                    <br style = "clear:both;"/>
                    <br />
                    <label for = "time_of_crime">Time of Crime Commited:</label>
                    <input name = "crime_time" placeholder = "(As per your memory)" class = "form-control" type = "text" value="<?php echo $f['crime_time']?>">

            </div>
            <br />
            <div class = "form-inline">
                <label for = "No_of_ind">No. of Individuals:</label>
                <br/>
                <label for = "bp">No of Man:</label>
                <input class = "form-control" name = "no_of_man" type = "number"  required = "required" value="<?php echo $f['man']?>">
                &nbsp;&nbsp;&nbsp;
                <label for = "temp">No.of Woman:</label>
                <input class = "form-control" name = "no_of_woman" type = "number"  required = "required" value="<?php echo $f['woman']?>"><label></label>
                &nbsp;&nbsp;&nbsp;

                <br />
                <label for = "rr">Total Individuals involve in Crime:</label>
                <input class = "form-control" name = "total" type = "number"  required = "required" value="<?php echo $f['total']?>">
                &nbsp;&nbsp;&nbsp;


            </div>
           <br/>
				</form>
			</div>	
		</div>	
	</div>
	<div id = "footer">
		<label class = "footer-title">&copy; Crime Prediction System 2018</label>
	</div>
<?php include("script.php"); ?>
<script type = "text/javascript">
    $(document).ready(function() {
        function disableBack() { window.history.forward() }

        window.onload = disableBack();
        window.onpageshow = function(evt) { if (evt.persisted) disableBack() }
    });
</script>	
</body>
</html>