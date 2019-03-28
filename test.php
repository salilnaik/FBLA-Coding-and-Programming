
<?php
    if (!empty($_POST['params'])) {
        $params = $_POST['params'];

        $jsonObject = json_encode($params);
		$send = json_encode("{ name:salil }");
        file_put_contents('test.json', $jsonObject);
		echo 'done';
    }
	
	
?>
