<?php  

	$response = array(); 

	if (isset($_POST['unique_id'])) {  

		$unique_id = $_POST['unique_id'];  

		// include db connect class  
		include 'database_connect.php';  
		// connecting to db  
		$db = new db_connection();
		$db->connect();



		$result = mysqli_query($db->myconn, "SELECT * FROM users WHERE unique_id='$unique_id'");  
		$num_rows = mysqli_num_rows($result);
		
		while ($row = $result->fetch_assoc()) {
			$dbpassword = $row['encrypted_password'];
			$response["name"] = $row['name'];
			$response["type"] = $row['type'];
		}

		
		// check if row inserted or not  
		if ($num_rows > 0) {
			$response["success_msg"] = 1;  
			$response["message"] = "Found Child";
			echo json_encode($response);  

		} else {  
			// failed to insert row  
			$response["success_msg "] = 0;  
			$response["message"] = "Could not find child. Check unique ID.";  
			// echoing JSON response  
			echo json_encode($response);  
		
		}  
	}
		
		
?>  