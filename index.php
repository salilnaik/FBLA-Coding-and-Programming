<html>
<head>
<title>Home</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<style>
h1 {
	color: #ff3f3f;
}

.material-icons{
	color:black;
	font-size:20px;
	cursor:pointer;
}

.information{
	position: absolute;
	bottom: 77%;
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
p{
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
button{
	border:none;
	background-color:#0caaff;
	padding: 10px;
	color:#eeeeee;
	cursor:pointer;
}
</style>
</head>
<body>
<script>var x = 0</script>
<h1><strong>My Class</strong></h1>
<button id="edit" onclick="window.location.href='choose.php'">Edit Students</button>
<button id="new" onclick="window.location.href='new.php'">New Student</button>
<button id="report" onclick="window.location.href='report.php'">Generate Report</button><br><br><br>
<div class="help" style="width:20px;height:2px;">
<i class="material-icons" onclick="show()">help</i>
<span class="information">Help</span>
</div>
<div id="blur">
<div id="helpbox">
<div id="helpheader">
<h2 id="head1">Edit Students</h2>
<h2 id="head2">New Student</h2>
<h2 id="head3">Generate Report</h2>
<span class="next" id="next" onclick="next()">&#10148;</span>
</div>
<p id="p1">This button takes you to a page with a drop-down list. You then choose the name of the student you want to edit. Once submitted, the next page will show you text boxes containing the student's current information where you can edit it.</p>
<p id="p2">This button takes you to a page with text boxes to create a new student and enter their information into the database.</p>
<p id="p3">This button will take you to a page with a table displaying all the information in the database. You can then proceed to print out the table for a paper copy of the records.</p>
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