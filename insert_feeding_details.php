<?php  

	$response = array(); 

	
	if (isset($_POST['minderid']) && isset ($_POST['childid'])) {  

		$minderid = $_POST['minderid'];  
		$childid = $_POST['childid'];  
	
		// include db connect class  
		include 'database_connect.php';  
		// connecting to db  
		$db = new db_connection();
		$db->connect();
		
		$result = mysqli_query($db->myconn, "INSERT INTO feeding(minderid, childid, date, time) VALUES('$minderid', '$childid', '$date_now', '$time_now',)");  
		
		// check if row inserted or not  
		if ($result) {  
			$response["success_msg"] = 1;  
			$response["message"] = "Feeding record successfully inserted";  
			echo json_encode($response);  
		} else {  
			// failed to insert row  
			$response["success_msg "] = 0;  
			$response["message"] = "ERROR: Record not inserted";  

			// echoing JSON response  
			echo json_encode($response);  
		}  
	} 

?>  