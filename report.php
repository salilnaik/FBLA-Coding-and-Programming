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
	background-color:gray;
	padding: 10px;
	color:#eeeeee;
	cursor:pointer;
}




.material-icons{
	color:black;
	font-size:20px;
	cursor:pointer;
}

.information{
	position: absolute;
	bottom: 30%;
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
#head2, #head3, #head4, #head5{display:none;}
#p1{display:block;}
#p2, #p3, #p4, #p5{display:none;}
</style>
<title>Report</title>
</head>
<body>
<script>var x = 0</script>
<?php
$info = array();
$myfile = fopen("test.csv", "r") or die("ERROR"); #opens the csv file for reading
while(($end = fgetcsv($myfile)) !== FALSE){
	array_push($info, $end); #reads the csv file and saves as array $info
}
fclose($myfile); 
?>


<?php if (count($info) > 0): ?>
<table>
  <thead>
    <tr>
      <th>Name</th><th>Code</th><th>Grade</th><th>Used?</th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($info as $row): array_map('htmlentities', $row); ?>
    <tr>
      <td><?php echo implode('</td><td>', $row); ?></td> <!--  writes the data into the table  -->
    </tr>
<?php endforeach; ?>
  </tbody>
</table>
<?php endif; ?><br><br>
<button onclick="window.location.href='index.php'">Back</button><br><br><br>


<div class="help" style="width:20px;height:2px;">
<i class="material-icons" onclick="show()">help</i>
<span class="information">Help</span>
</div>
<div id="blur">
<div id="helpbox">
<div id="helpheader">
<h2 id="head1">Name</h2>
<h2 id="head2">Code</h2>
<h2 id="head3">Grade</h2>
<h2 id="head4">Used?</h2>
<h2 id="head5">Back</h2>
<span class="next" id="next" onclick="next()">&#10148;</span>
</div>
<p id="p1">The "Name" column shows the name of the student.</p>
<p id="p2">The "Code" column shows the redemption code for the student.</p>
<p id="p3">The "Grade" column shows the student's grade in the class.</p>
<p id="p4">The "Used?" column shows if the student used the redemption code yet.</p>
<p id="p5">The back button returns you to the home screen.</p>
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
		document.getElementById("p4").style.display = "none";
		document.getElementById("head4").style.display = "none";
		document.getElementById("p5").style.display = "none";
		document.getElementById("head5").style.display = "none";
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
		}else if(x == 3){
			document.getElementById("p3").style.display = "none";
			document.getElementById("head3").style.display = "none";
			document.getElementById("p4").style.display = "block";
			document.getElementById("head4").style.display = "block";
		}else if(x == 4){
			document.getElementById("p4").style.display = "none";
			document.getElementById("head4").style.display = "none";
			document.getElementById("p5").style.display = "block";
			document.getElementById("head5").style.display = "block";
			document.getElementById("next").style.display = "none";
		}
		}
	
</script>
</body>
</html>