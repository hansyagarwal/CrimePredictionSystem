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
            Decision Tree Algorithm
        </div>
        <?php 
        
include 'DecisionNode.php';
include 'RootNode.php';
include 'TerminalNode.php';


$subjects = array();
$conn = new mysqli("localhost", "root", "", "cps") or die(mysqli_error());
$q = $conn->query("SELECT * FROM fir") or die(mysqli_error());
$count = 0;
while($row = mysqli_fetch_array($q)){
    //echo $row['crime_type'];
  //  $var = $row['gender'].",".$row['crime_type'].",".$row['crime_period']."<br/>";
    //echo $var;
   // echo $var;
   
$subjects[] =  array('gender' => $row['gender'],'crime_type' => $row['crime_type'], 'crime_period' => $row['crime_period']);
$count++;
    
}
//print_r($subjects);
/*$subjects = array(
    0 => array('gender' => 'Male','crime_type' => 'Murder', 'crime_period' => 'Night'),
    1 => array('gender' => 'Male','crime_type' => 'Not Murder', 'crime_period' => 'Not Night'),
    2 => array('gender' => 'Male','crime_type' => 'Murder', 'crime_period' => 'Night'),
    3 => array('gender' => 'Male','crime_type' => 'Not Murder','crime_period' => 'Not Night'),
    
   
);*/

echo "<h2>"."Find all males who committed murder at night"."</h2>"."<br/>";
echo "Total FIR Records found:".$count."<br/>";
// Find all
// - males
// - under 50
// - can cook
// - does not play football

// Create from bottom up

// We want all subjects who don't play football

$crimeperiod = array(
    'Night' => new TerminalNode(),
    'Not Night' => new TerminalNode(), // This is our last node
);

// Create the decider for football
$cpdecider = new DecisionNode(function ($subject) {
    // This is our decider function, $subject is the current object
    // in the queue of the current node.
    // Return the key of our $footballDecision-Array
    return ($subject['crime_period'] == 'Night' ? 'Night' : 'Not Night');
}, $crimeperiod);

// Great, next we need the cook-decisions.
/*$cookDecisions = array(
    'can cook' => $footballDecider, // redirect all subjects who can cook to the $footballDecider
    'can not cook' => new TerminalNode(),
);*/

$murderDecisions = array(
    'Murder' => $cpdecider, // redirect all subjects who can cook to the $footballDecider
    'Not Murder' => new TerminalNode(),
);


// Now the cookDecider
$murderDecider = new DecisionNode(function ($subject) {
    return ($subject['crime_type'] == 'Murder' ? 'Murder' : 'Not Murder');
}, $murderDecisions);

// The same as previous for the next 2 decisions

/*$ageDecisions = array(
    '< 50' => $cookDecider,
    '>= 50' => new TerminalNode(),
);
$ageDecider = new DecisionNode(function ($subject) {
    return ($subject['age'] >= 50 ? '>= 50' : '< 50');
}, $ageDecisions);*/

$genderDecisions = array(
    'Male' => $murderDecider,
    'Female' => new TerminalNode(),
);

$genderDecider = new DecisionNode(function ($subject) {
    return $subject['gender'];
}, $genderDecisions);

// And now we need to create a RootNode
$rootNode = new RootNode($subjects);

// Add the first (last created) node to our RootNode:
$rootNode->addSubNode($genderDecider);

// And classify
$rootNode->classify();

// In $footballDecisions['does not play'] are our subjects there we looked for:
print_r($crimeperiod['Night']);

?>
    </div>
    <div id = "footer">
        <label class = "footer-title">&copy; Crime Prediction System 2018</label>
    </div>
        
</body>
</html>





