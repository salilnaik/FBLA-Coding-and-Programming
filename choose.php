<html>
<head>
<style>
table, th, td {
  border: 2px solid black;
  border-collapse: collapse;
}
th, td{
	padding: 5px;
}
#submit, select {
	cursor: pointer;
}
</style>
<title>Choose a Student</title>
</head>
<body>
<?php

$info = array();
$myfile = fopen("test.csv", "r") or die("ERROR"); #opens data and reads it
while(($end = fgetcsv($myfile)) !== FALSE){
	array_push($info, $end); #writes data to an array
}
fclose($myfile);

?>

<p>Which student's information do you want to edit?</p>
<form action="edit.php" method="post">
<?php if (count($info) > 0): ?>
<select id="select" name="names"> <!--  creates a dropdown list  -->
<option value="x">Select a Name</option>
<option value="x">------------</option>
<?php 
$x = -1;
foreach ($info as $option): $x++ ?>
<option id="option" value='<?php echo $x ?>'><?php echo $option[0]; ?></option> <!--  adds the names of all the students to the dropdown  -->
<?php endforeach; ?>
</select>
<input type="submit" id="submit" value="Choose">
</form>
<button onclick="window.location.href='index.html'">Back</button>
<?php endif; ?>
</body>
</html>