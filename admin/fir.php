<!DOCTYPE html>
<?php
	require_once 'logincheck.php';
?>
<html lang = "eng">
	<head>
		<title>Crime Prediction System</title>
		<meta charset = "utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel = "shortcut icon" href = "" />
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
		<div style = "display:none;" id = "add_itr" class = "panel panel-success">	
			<div class = "panel-heading">
				<label>ADD NEW FIR</label>
				<button id = "hide_itr" style = "float:right; margin-top:-4px;" class = "btn btn-sm btn-danger"><span class = "glyphicon glyphicon-remove"></span> CLOSE</button>
			</div>
			<div class = "panel-body">
				<form id = "form_dental" method = "POST" enctype = "multipart/form-data">
					<div style = "float:left;" class = "form-inline">
						<label for = "itr_no">FIR No:</label>
						<input class = "form-control" size = "3" min = "0" type = "number" name = "fir_no">
					</div>
					<!--div style = "float:right;" class = "form-inline">
						<label for = "family_no">Family no:</label>
						<input class = "form-control" placeholder = "(Optional)" size = "5" type = "text" name = "family_no">
					</div-->
					<br />
					<br />
					<br />
					<div class = "form-inline">
						<label for = "firstname">Firstname:</label>
						<input class = "form-control" name = "firstname" type = "text" required = "required">
						&nbsp;&nbsp;&nbsp;
						<label for = "middlename">Middle Name:</label>
						<input class = "form-control" name = "middlename" placeholder = "(Optional)" type = "text">
						&nbsp;&nbsp;&nbsp;
						<label for = "lastname">Lastname:</label>
						<input class = "form-control" name = "lastname" type = "text" required = "required">
					</div>
					<br />
					<div class = "form-group">
						<label for = "birthdate" style = "float:left;">Birthdate:</label>
						<br style = "clear:both;" />
						<select name = "month" style = "width:15%; float:left;" class = "form-control" required = "required">
							<option value = "">Select a month</option>
							<option value = "01">January</option>
							<option value = "02">February</option>
							<option value = "03">March</option>
							<option value = "04">April</option>
							<option value = "05">May</option>
							<option value = "06">June</option>
							<option value = "07">July</option>
							<option value = "08">August</option>
							<option value = "09">September</option>
							<option value = "10">October</option>
							<option value = "11">November</option>
							<option value = "12">December</option>
						</select>
						<select name = "day" class = "form-control" style = "width:13%; float:left;" required = "required">
							<option value = "">Select a day</option>
							<option value = "01">01</option>
							<option value = "02">02</option>
							<option value = "03">03</option>
							<option value = "04">04</option>
							<option value = "05">05</option>
							<option value = "06">06</option>
							<option value = "07">07</option>
							<option value = "08">08</option>
							<option value = "09">09</option>	
							<?php
								$a = 10;
								while($a <= 31){
									echo "<option value = '".$a."'>".$a++."</option>";
								}
							?>
						</select>
						<select name = "year" class = "form-control" style = "width:13%; float:left;" required = "required">
							<option value = "">Select a year</option>
							<?php
								$a = date(Y);
								while(1965 <= $a){
									echo "<option value = '".$a."'>".$a--."</option>";
								}
							?>
						</select>
						<br style = "clear:both;"/>
						<br />
						<label for = "address">Address:</label>
						<input class = "form-control" name = "address" type = "text" required = "required">
						<br />
						<label for = "age">Age:</label>
						<input class = "form-control" style = "width:20%;" min = "0" max = "999" name = "age" type = "number">
						<br />
						
						<br />
						<label for = "gender">Gender:</label>
						<select style = "width:22%;" class = "form-control" name = "gender" required = "required">
							<option value = "">--Please select an option--</option>
							<option value = "Male">Male</option>
							<option value = "Female">Female</option>
						</select>
						<br />
						<label for = "civil_status">Type of Crime:</label>
						<select style = "width:22%;" class = "form-control" name = "crime_type" required = "required">
							<option value = "">--Please select an option--</option>
							<option value = "Chain Snatching">Chain Snatching</option>
							<option value = "Eve Teasing">Eve Teasing</option>
							<option value = "Road Raze">Road Raze</option>
							<option value = "Pick Pocketing">Pick Pocketing</option>
							<option value = "Murder">Murder</option>
							<option value = "Vehicle Theft">Vehicle Theft</option>
						</select>
							<br />
						<label for = "civil_status">Location of Crime:</label>
						<select style = "width:22%;" class = "form-control" name = "crime_area" required = "required">
							<option value = "">--Please select an option--</option>
							<option value = "Alkapuri">Alkapuri</option>
							<option value = "Akota">Akota</option>
							<option value = "Mandvi">Mandvi</option>
							<option value = "Chhani">Chhani</option>
							<option value = "Makarpura">Makarpura</option>
							<option value = "Waghodiya">Waghodiya</option>
						</select>
						<br/>
						<label for = "birthdate" style = "float:left;">Date of Crime Commited:</label>
						<br style = "clear:both;" />
						<select name = "month1" style = "width:15%; float:left;" class = "form-control" required = "required">
							<option value = "">Select a month</option>
							<option value = "01">January</option>
							<option value = "02">February</option>
							<option value = "03">March</option>
							<option value = "04">April</option>
							<option value = "05">May</option>
							<option value = "06">June</option>
							<option value = "07">July</option>
							<option value = "08">August</option>
							<option value = "09">September</option>
							<option value = "10">October</option>
							<option value = "11">November</option>
							<option value = "12">December</option>
						</select>
						<select name = "day1" class = "form-control" style = "width:13%; float:left;" required = "required">
							<option value = "">Select a day</option>
							<option value = "01">01</option>
							<option value = "02">02</option>
							<option value = "03">03</option>
							<option value = "04">04</option>
							<option value = "05">05</option>
							<option value = "06">06</option>
							<option value = "07">07</option>
							<option value = "08">08</option>
							<option value = "09">09</option>	
							<?php
								$a = 10;
								while($a <= 31){
									echo "<option value = '".$a."'>".$a++."</option>";
								}
							?>
						</select>
						<select name = "year1" class = "form-control" style = "width:13%; float:left;" required = "required">
							<option value = "">Select a year </option>
							<?php
								$a = date(Y);
								while(2010 <= $a){
									echo "<option value = '".$a."'>".$a--."</option>";
								}
							?>
						</select>
						<br style = "clear:both;"/>
						<br />
						<label for = "crime_period">Crime Period:</label>
						<select style = "width:22%;" class = "form-control" name = "crime_period" required = "required">
							<option value = "">--Please select an option--</option>
							<option value = "Morning">Morning</option>
							<option value = "Afternoon">Afternoon</option>
							<option value = "Evening">Evening</option>
							<option value = "Night">Night</option>
							<option value = "Mid Night">Mid Night</option>
						</select>
						<br />
						<label for = "phil_health_no">Time of Crime Commited:</label>
						<input name = "crime_time" placeholder = "(As per your memory)" class = "form-control" type = "text">
						
					</div>
					<br />
					<div class = "form-inline">
					<label for = "phil_health_no">No. of Individuals:</label>
					<br/>
						<label for = "bp">No of Man:</label>
						<input class = "form-control" name = "no_of_man" type = "number"  required = "required">
						&nbsp;&nbsp;&nbsp;
						<label for = "temp">No.of Woman:</label>
						<input class = "form-control" name = "no_of_woman" type = "number"  required = "required"><label></label>
						&nbsp;&nbsp;&nbsp;
						<br/>
						<br />
						<label for = "rr">Total Individuals involve in Crime:</label>
						<input class = "form-control" name = "total" type = "number"  required = "required">
						&nbsp;&nbsp;&nbsp;
						
						
					</div>
					<br />
					<div class = "form-inline">
						<button class = "btn btn-primary" name = "save_fir"><span class = "glyphicon glyphicon-save"></span> SAVE</button>
					</div>
				</form>
			</div>	
		</div>	
		<?php require 'add_fir.php' ?>
		<div class = "panel panel-primary">
			<div class = "panel-heading">
				<label>FIR LIST</Label>
			</div>
			<div class = "panel-body">
				<button id = "show_itr" class = "btn btn-info"><span class = "glyphicon glyphicon-plus"></span> ADD FIR</button>
				<br />
				<br />
				<table id = "table" class = "display" width = "100%" cellspacing = "0">
					<thead>
						<tr>
							<th>FIR No</th>
							<th>Name</th>
							<th>Location of Crime</th>
							<th>Type of Crime</th>
							<th>Period of Crime</th>
							<th>Time of Crime</th>
							<th>No of Individuals</th>
							<th><center>Action</center></th>
						</tr>
					</thead>
					<tbody>
					<?php
						$conn = new mysqli("localhost", "root", "", "cps") or die(mysqli_error());
						$query = $conn->query("SELECT * FROM `fir` ORDER BY `fir_no` DESC") or die(mysqli_error());
						while($fetch = $query->fetch_array()){
						/*$id = $fetch['fir_no'];
						$q = $conn->query("SELECT COUNT(*) as total FROM `complaints` where `itr_no` = '$id' && `status` = 'Pending'") or die(mysqli_error());
						$f = $q->fetch_array();*/
					?>
						<tr>
							<td><?php echo $fetch['fir_no']?></td>
							<td><?php echo $fetch['firstname']." ".$fetch['lastname']?></td>
							<td><?php echo $fetch['crime_area']?></td>
							<td><?php echo $fetch['crime_type']?></td>
							<td><?php echo $fetch['crime_period']?></td>
							<td><?php echo $fetch['crime_time']?></td>
							<td><?php echo $fetch['total']?></td>
							<td><center>
							<a href = "edit_fir.php?id=<?php echo $fetch['fir_no']?>&lastname=<?php echo $fetch['lastname']?>" class = "btn btn-sm btn-warning"><span class = "glyphicon glyphicon-pencil"></span> View</a></center></td>
						</tr>
					<?php
						}
						$conn->close();
					?>
					</tbody>
					</table>
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