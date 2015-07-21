<?php  

	$response = array(); 


	$minderid = $_POST['minderid'];  
	$childid = $_POST['childid']; 
	$description = $_POST['description'];	
	$date = $_POST['date'];
	$time = $_POST['time'];
	
	// include db connect class  
	include 'database_connect.php';  
	// connecting to db  
	$db = new db_connection();
	$db->connect();
	
	//ensure child ID exsists 
	$childExist = mysqli_query($db->myconn, "SELECT * FROM users WHERE unique_id='$childid'");  

	// check if there are any rows which have the unique Id specified 
	$num_rows = mysqli_num_rows($childExist);
	
	if ($num_rows > 0) {
		$result = mysqli_query($db->myconn, "INSERT INTO incidents(minderid, childid, description, date, time) VALUES('$minderid', '$childid', '$description', '$date', '$time')");  

		// check if row inserted or not  
		if ($result) {  
			$response["success_msg"] = 0;  
			$response["message"] = "Incident record successfully inserted";  
			echo json_encode($response);  
		} else {  
			// failed to insert row  
			$response["success_msg"] = 1;  
			$response["message"] = "ERROR: Record not inserted";  

			// echoing JSON response  
			echo json_encode($response);  
			}  
	} else {
		$response["success_msg"] = 1;  
		$response["message"] = "Child ID not found";  
		echo json_encode($response);  
	}
		

?>  