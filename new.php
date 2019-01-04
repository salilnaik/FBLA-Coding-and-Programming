<html>
<head><title>New Student</title></head>
<body>
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
<input type="submit" name="submit">
<button onclick="window.location.href='index.html'">Back</button>
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
?>
</body>
</html>