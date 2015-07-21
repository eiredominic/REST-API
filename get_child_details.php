<?php  

	$response = array(); 

	if (isset($_POST['parent_id'])) {  

		$parent_id = $_POST['parent_id'];  

		// include db connect class  
		include 'database_connect.php';  
		// connecting to db  
		$db = new db_connection();
		$db->connect();



		$result = mysqli_query($db->myconn, "SELECT * FROM users WHERE parent_id='$parent_id'");  
		$num_rows = mysqli_num_rows($result);
	if ($num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
				
			$row_array['child_id'] = $row['unique_id'];
			$row_array['success_msg'] = 0;
			array_push($response, $row_array);
	

		}
			echo json_encode($response);  

		} else {  
			// failed to insert row  
			$response["success_msg"] = 1;  
			$response["message"] = "Could not find child. Check unique ID.";  
			// echoing JSON response  
			echo json_encode($response);  
		
		}  
	}
		
		
?>  