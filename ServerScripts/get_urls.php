<?php

	$servername = "localhost";
	$username = "root";
	$password = "popdoxasd";
	$dbname = "wordpress";

	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);		
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		selectData($conn);
		// $command = escapeshellcmd('./get_state_urls.py');
		// $output = shell_exec($command);
		// echo $output;

	}
	catch (PDOException $e)
	{
		echo "Connection failed: " . $e->getMessage();
		return;
	}

	$conn = null;

	function selectData($conn)
	{
		$selection = "SELECT post_name,ID,post_parent from wp_posts where post_type = 'forum'";

		$selectStmt = $conn->prepare($selection);
		$selectStmt->execute();
		$result = $selectStmt->fetchAll();

		$length = count($result);

		$state_array = array();

		for($i = 0; $i < $length; $i++) {

			if($result[$i][2] == 30) {

			$state = $result[$i][0];

			$url = "http://10.171.204.135/?forum=forum/" . $state;

			echo 	"<br />
					<a href = " . $url . ">"
					. $state .
					"</a>";


			$state_array[$state] = "http://10.171.204.135/?forum=forum/" . $state;
			}
		}

		print_r($state_array);
	}

?>
