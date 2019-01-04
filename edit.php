<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<style>
#submit{
	cursor: pointer;
}
button{
	border:none;
	background-color:gray;
	padding: 10px;
	color:#eeeeee;
	cursor:pointer;
}
#reset{
	border:none;
	background-color:red;
	padding: 10px;
	color:#eeeeee;
	cursor:pointer;
}
#submit{
	border:none;
	background-color:#0caaff;
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
	bottom: 76%;
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
#head2, #head3, #head4, #head5, #head6, #head7{display:none;}
#p1{display:block;}
#p2, #p3, #p4, #p5, #p6, #p7{display:none;}
</style>
<title>Edit</title>
</head>
<body>
<script>var x = 0</script>
<?php
session_start();
$info = array();
$file = fopen("test.csv", "r") or die("ERROR"); #opens the csv file for reading
while(($end = fgetcsv($file)) !== FALSE){
	array_push($info, $end); #extracts the information into array $info
}

fclose($file);
?>


<?php if(isset($_POST['names']) and $_POST['names'] != "x"){  #anything except "Choose a Name" and "------"
		$_SESSION['choice'] = $_POST["names"];
		$choice = $_SESSION['choice'];
		$column = array("name", "code", "grade", "used?");
}elseif(isset($_POST['names'])){ #"choose a name" or "-------"
	header("Location: choose.php");
	exit();	
}else{ #isn't set, which means the user is returning from another page
	$choice = $_SESSION['choice'];
	$column = array("name", "code", "grade", "used?");
} ?>
<form action="send.php" method="post">
<table>
  <thead>
	<th>Name</th><th>Code</th><th>Grade</th><th>Used?</th>
  </thead>
  <tbody>
    <tr>
	<?php $count = 0; ?>
	<?php foreach($info[$choice] as $col): ?>
      <td><input type="text" name="<?php echo $column[$count]; ?>" value= "<?php echo  $col; ?>" required></td> <!--  creates a table with text boxes as the values of each of the columns  -->
	<?php $count++; ?>
	<?php endforeach; ?>
	</tr>
  </tbody>
</table><br>
<input id="submit" id="submit" type="submit">
<input id="reset" id="reset" type="reset">
<button onclick="window.location.href='index.html'">Cancel</button>
</form><br>



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
<h2 id="head5">Submit</h2>
<h2 id="head6">Reset</h2>
<h2 id="head7">Cancel</h2>
<span class="next" id="next" onclick="next()">&#10148;</span>
</div>
<p id="p1">The text box underneath the label "Name" should have text in it showing the current name of the student. You can edit the name with the text box.</p>
<p id="p2">The text box underneath the label "Code" should have a number in it showing the current redemption code for the student. You can edit the code with the text box.</p>
<p id="p3">The text box underneath the label "Grade" should have a number in it showing the current grade fo the student. This too is editable with the text box.</p>
<p id="p4">The text box underneath the label "Used?" should have either "yes" or "no" in it showing whether the student has used their redemption code or not.</p>
<p id="p5">The submit button should be clicked when the changes are finalized and you are ready to send them to the database.</p>
<p id="p6">The reset button should be clicked when you want the values of the text boxes to return to their original state.</p>
<p id="p7">The cancel button should be clicked if you don't want to edit the student's information and will return you to the home page.</p>
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
		document.getElementById("p6").style.display = "none";
		document.getElementById("head6").style.display = "none";
		document.getElementById("p7").style.display = "none";
		document.getElementById("head7").style.display = "none";
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
		}else if(x == 5){
			document.getElementById("p5").style.display = "none";
			document.getElementById("head5").style.display = "none";
			document.getElementById("p6").style.display = "block";
			document.getElementById("head6").style.display = "block";
		}else if(x == 6){
			document.getElementById("p6").style.display = "none";
			document.getElementById("head6").style.display = "none";
			document.getElementById("p7").style.display = "block";
			document.getElementById("head7").style.display = "block";
			document.getElementById("next").style.display = "none";
		}
	}
</script>
</body>
</html>