<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<style>
table, th, td {
  border: 2px solid black;
  border-collapse: collapse;
}
th, td{
	padding: 5px;
}
button{
	border:none;
	background-color:grey;
	padding: 10px;
	color:#eeeeee;
	cursor:pointer;
}
#submit, select{
	border:none;
	background-color:#0caaff;
	padding: 10px;
	color:#eeeeee;
	cursor:pointer;
}
option{
	background-color:#35caf4;
}



.material-icons{
	color:black;
	font-size:20px;
	cursor:pointer;
}

.information{
	position: absolute;
	bottom: 72%;
	visibility: hidden;
	font-size: 12px;
	color: white;
	border-radius: 20%;
	padding: 5px;
	background-color: rgba(0,0,0,0.5);
}

.help:hover .information{
	visibility: visible;
	opacity:1;
}

#helpbox{
	background-color: #fefefe;
	position: fixed;
	bottom:0;
	right:0;
	width: 100%;
	height: 40%;
	-webkit-animation-name: slideIn;
	-webkit-animation-duration: 0.4s;
	animation-name: slideIn;
	animation-duration: 0.4s;
	font-size:18px;
}
#helpbox p{
	padding:5px;
}
#helpheader{
	background-color:#0caaff;
	padding: 2px 16px;
	color:white;
	font-size: 20px;
}

#blur{
	display: none;
	position: fixed;
	left:0;
	top:0;
	background-color: rgba(0,0,0,0.4);
	z-index: 0;
	width: 100%;
	height: 100%;
	-webkit-animation-name: fadeIn;
	-webkit-animation-duration: 0.4s;
	animation-name: fadeIn;
	animation-duration: 0.4s;
}

.next{
	float:right;
	color:black;
	font-size:28px;
	font-weight:bold;
	padding: 5px;
}

.next:hover{
	cursor:pointer;
	text-decoration: none;
}

@-webkit-keyframes slideIn {
  from {bottom: -300px; opacity: 0} 
  to {bottom: 0; opacity: 1}
}

@keyframes slideIn {
  from {bottom: -300px; opacity: 0}
  to {bottom: 0; opacity: 1}
}

@-webkit-keyframes fadeIn {
  from {opacity: 0} 
  to {opacity: 1}
}

@keyframes fadeIn {
  from {opacity: 0} 
  to {opacity: 1}
}

#head1{display:block;}
#head2{display:none;}
#head3{display:none;}
#p1{display:block;}
#p2{display:none;}
#p3{display:none;}
</style>
<title>Choose a Student</title>
</head>
<body>
<script>var x = 0</script>
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
<button onclick="window.location.href='index.html'">Back</button><br><br><br>
<?php endif; ?>


<div class="help" style="width:20px;height:2px;">
<i class="material-icons" onclick="show()">help</i>
<span class="information">Help</span>
</div>
<div id="blur">
<div id="helpbox">
<div id="helpheader">
<h2 id="head1">Select a Name</h2>
<h2 id="head2">Choose</h2>
<h2 id="head3">Back</h2>
<span class="next" id="next" onclick="next()">&#10148;</span>
</div>
<p id="p1">If you click on this drop-down list, you will see the names of all the students. You click on the name of the student whose information you want to edit.</p>
<p id="p2">After you have chosen a student, you click on this button to select them and proceed to the next page.</p>
<p id="p3">This button allows you to cancel the process of editing a student's information and will return you to the page you came from.</p>
</div>
</div>
<script>
	function show(){
		x = 0
		document.getElementById("p1").style.display = "block";
		document.getElementById("head1").style.display = "block";
		document.getElementById("p2").style.display = "none";
		document.getElementById("head2").style.display = "none";
		document.getElementById("p3").style.display = "none";
		document.getElementById("head3").style.display = "none";
		document.getElementById("next").style.display = "block";
		document.getElementById("blur").style.display = "block";
		window.onclick = function(event) {
			if (event.target == document.getElementById("blur")) {
				document.getElementById("blur").style.display = "none";
			}
		}
	}
	function next(){
		x++
		console.log(x);
		if(x == 1){
			document.getElementById("p1").style.display = "none";
			document.getElementById("head1").style.display = "none";
			document.getElementById("p2").style.display = "block";
			document.getElementById("head2").style.display = "block";
		}else if(x == 2){
			document.getElementById("p2").style.display = "none";
			document.getElementById("head2").style.display = "none";
			document.getElementById("p3").style.display = "block";
			document.getElementById("head3").style.display = "block";
			document.getElementById("next").style.display = "none";
			x = 0
		}
	}
</script>
</body>
</html>