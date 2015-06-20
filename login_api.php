<?php  

	$response = array(); 

	if (isset($_POST['unique_id']) && isset ($_POST['password'])) {  

		$unique_id = $_POST['unique_id'];  
		$password = $_POST['password'];  

		// include db connect class  
		include 'database_connect.php';  
		// connecting to db  
		$db = new db_connection();
		$db->connect();



		$result = mysqli_query($db->myconn, "SELECT * FROM users WHERE unique_id='$unique_id'");  
		
		while ($row = $result->fetch_assoc()) {
			$dbpassword = $row['encrypted_password'];
			$type = $row['type'];
		}

		
			// check if row inserted or not  
			if ($result) {
		
				if ($dbpassword == $password) {	
					$response["success_msg"] = 1;  
					$response["message"] = "Login Successful";
					$response["type"] = "$type";

					echo json_encode($response);  
				} else {
					$response["message"] = "Incorrect Password";
					}
				
			} else {  
				// failed to insert row  
				$response["success_msg "] = 0;  
				$response["message"] = "Login unsuccessful. Check unique ID.";  
				// echoing JSON response  
				echo json_encode($response);  
			
			}  
	}
		
		

?>  