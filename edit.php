<html>
<head>
<style>
#submit{
	cursor: pointer;
}
</style>
<title>Edit</title>
</head>
<body>
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
<input id="submit" type="submit">
<input id="reset" type="reset">
<button onclick="window.location.href='index.html'">Cancel</button>
</form>
</body>
</html>