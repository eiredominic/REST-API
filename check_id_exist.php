<?php  

	$response = array(); 

	if (isset($_POST['unique_id'])) {  

		$childid = $_POST['unique_id'];  
	
		// include db connect class  
		include 'database_connect.php';  
		// connecting to db  
		$db = new db_connection();
		$db->connect();
		
		$parent_result = mysqli_query($db->myconn, "SELECT * FROM users WHERE parentid='$unique_id'");  
		$minder_result = mysqli_query($db->myconn, "SELECT * FROM users WHERE minderid='$unique_id'");  
		
		$num_rows_parent = mysqli_num_rows($parent_result);
		$num_rows_minder = mysqli_num_rows($minder_result);
		
		if ($num_rows_parent > 0 || $num_rows_minder > 0) {
			$response["success_msg "] = 1;  
			$response["message"] = "ID already in use";  
			echo json_encode($response);  

		} else {  

			$response["success_msg "] = 0;  
			$response["message"] = "ID not in use";  
			// echoing JSON response  
			echo json_encode($response);  
		}  
	} 

?>  