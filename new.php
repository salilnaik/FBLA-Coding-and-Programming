<html>
<head><title>New Student</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<style>
button{
	border:none;
	background-color:gray;
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
#head2, #head3, #head4, #head5, #head7{display:none;}
#p1{display:block;}
#p2, #p3, #p4, #p5 #p7{display:none;}
</style>
</head>
<body>
<script>var x = 0</script>
<form method="post" action="new.php">
<table>
<thead>
<th>Name</th><th>Code</th><th>Grade</th><th>Used?</th>
</thead>
<tbody>
<td><input type="text" name="name" required autofocus></td> <!--  creates the text boxes for each column  --> 
<td><input type="text" name="code" required></td>
<td><input type="text" name="grade" required></td>
<td><input type="text" name="used?" required></td>
</tr>
</tbody>
</table><br>
<input type="submit" id="submit" name="submit">
<button id="back" onclick="window.location.href='index.html'">Back</button>
</form>

<?php


function send($form){
	$get = array();
	$file = fopen("test.csv", "r") or die("ERROR"); #opens the csv file for reading
	while(($end = fgetcsv($file)) !== FALSE){
		array_push($get, $end); #saves the data in the array $get
	}
	fclose($file);
	array_push($get, $form); #puts the new student into the array
	$val = array();
	foreach($get as $col):
	array_push($val, $col[1]); #creates array $val with the redemption codes of all the students
	endforeach;
	
	#data validation (below)
	
	if($_POST['used?'] == 'yes' or $_POST['used?'] == 'no'){ #the used column can only have  "yes" or "no"
		if(count($val) == count(array_unique($val))){ #checks if all the redemption codes are unique
			if(is_numeric($_POST['code']) and is_numeric($_POST['grade'])){ #checks if the code and grade column are numbers
				$file = fopen("test.csv", "w") or die("ERROR"); #if all the conditions are met, opens the csv file for writing
				echo "Sending Information...<br><br>";
				foreach ($get as $line){
					fputcsv($file, $line); #writes the data to the csv file
				}

				fclose($file);
				echo "Information sent successfully!";
				header("Location: index.html");
				exit(); 
				
			}else{
				echo "<script>alert('Please enter a number for the code and grade.');</script>"; #code and grade aren't numbers
			}
		}else{
			echo "<script>alert('That redemption code is already in use. Please use another one.');</script>"; #redemption code is not unique
		}
	}else{
		echo '<script>alert("Please enter either \"yes\" or \"no\" for Used column");</script>'; #used column isn't "yes" or "no"
	}
}
if(isset($_POST['submit'])){
	$form = array($_POST['name'], $_POST['code'], $_POST['grade'], $_POST['used?']); #creates an array with the form data
	send($form); #calls the above function
} 
?><br>



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
<h2 id="head7">Back</h2>
<span class="next" id="next" onclick="next()">&#10148;</span>
</div>
<p id="p1">The text box underneath the label "Name" lets you edit the student's name.</p>
<p id="p2">The text box underneath the label "Code" lets you edit the student's redemption code. It must be a number.</p>
<p id="p3">The text box underneath the label "Grade" lets you edit the student's grade. It must be a number.</p>
<p id="p4">The text box underneath the label "Used?" lets you edit whether the student has used their redemption code or not. It must be either "yes" or "no"</p>
<p id="p5">The submit button should be clicked when the information is finalized and you are ready to send them to the database.</p>
<p id="p7">The back button should be clicked if you don't want to create a new student and will return you to the home page.</p>
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
			document.getElementById("p7").style.display = "block";
			document.getElementById("head7").style.display = "block";
			document.getElementById("next").style.display = "none";
		}
	}
</script>
</body>
</html>