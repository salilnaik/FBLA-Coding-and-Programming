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
</style>
<title>Report</title>
</head>
<body>
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
<button onclick="window.location.href='index.html'">Back</button>
</body>
</html>