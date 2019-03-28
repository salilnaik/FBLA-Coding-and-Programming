<html>
<head><title>Sending...</title></head>
<body>
<?php 
session_start();
$info = array();
array_push($info, $_POST["name"], $_POST["code"], $_POST["grade"], $_POST["used?"]); #creates an array with the data recieved

$choice1 = $_SESSION['choice'];

$get = array();
$file = fopen("test.csv", "r") or die("ERROR"); #opens the csv ile for reading
while(($end = fgetcsv($file)) !== FALSE){
	array_push($get, $end); #stores the information in array $get
}
fclose($file);

$get[$choice1] = $info; #gets the information of only the student selected.

$val = array();
foreach ($get as $x):
array_push($val, $x[1]);
endforeach; #gets the redemption code from all the students

#data validation (below)

if($_POST['used?'] == "yes" or $_POST['used?'] == "no"){ #the used column can only be "yes" or "no"
	if(is_numeric($_POST['grade']) and is_numeric($_POST['code'])){ #the grade and code column can only be numbers

		if(count($val) != count(array_unique($val))){ #checks to make sure the redemption code isn't already used
			echo "<script> alert('That redemption code is already in use. Please use another one.'); window.location.href='edit.php';</script>";
			
		}else{

		$file = fopen("test.csv", "w") or die("ERRORORORORORORORO"); #if all those conditions are met, the csv file is opened and written into to save the changes
		echo "Sending Information...<br><br>";
		foreach ($get as $line){
			fputcsv($file, $line);
		}

		fclose($file);
		echo "Information sent successfully!";
		header("Location: index.php");
		exit(); 
	}
	}else{
		echo "<script> alert('Please enter a number for the grade and code.'); window.location.href='edit.php';</script>"; #if the grade and code aren't numbers
	}
}else{
	echo '<script> alert("Please enter either \"yes\" or \"no\" for the Used column."); window.location.href="edit.php";</script>'; #if the used column has anything other than "yes" or "no"
}
?>
</body>
</html>