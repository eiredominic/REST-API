<?php  

	$response = array(); 
		
	
	if (isset($_POST['childid'])) {  

		$childid = $_POST['childid'];  
	
		// include db connect class  
		include 'database_connect.php';  
		// connecting to db  
		$db = new db_connection();
		$db->connect();
		
		$result = mysqli_query($db->myconn, "SELECT * FROM feeding WHERE childid='$childid'");  
		
		$num_rows = mysqli_num_rows($result);
		if ($num_rows > 0) {
			$row_array["success_msg"] = 0;  
			$row_array["message "] = "Records Found";  

			while ($row = $result->fetch_assoc()) {
				$row_array['ref'] = $row['ref'];
				$row_array['minderid'] = $row['minderid'];
				$row_array['childid'] = $row['childid'];
				$row_array['amount'] = $row['amount'];
				$row_array['date'] = $row['date'];
				$row_array['time'] = $row['time'];

				array_push($response, $row_array);

			}

			echo json_encode($response);  

		} else {  

			$row_array["success_msg"] = 1;  
			$row_array["message"] = "ERROR: Record not found";  
			array_push($response, $row_array);
			// echoing JSON response  
			echo json_encode($response);  
		}  
	} 

?>  