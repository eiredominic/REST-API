<?php  
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);




	$response = array(); 

	if (isset($_POST['parent_id'])  {  

		$unique_id = $_POST['parent_id'];  

		// include db connect class  
		include 'database_connect.php';  
		// connecting to db  
		$db = new db_connection();
		$db->connect();
		
		$result = mysqli_query($db->myconn, "SELECT * FROM parent WHERE id=$pid"
		
		// check if row inserted or not  
		if ($result) {  
			$response["success_msg"] = 1;  
			$response["message"] = "Registration Successful";  
			echo json_encode($response);  
		} else {  
			// failed to insert row  
			$response["success_msg "] = 0;  
			$response["message"] = "Registration not successful. An error occurred.";  
			// echoing JSON response  
			echo json_encode($response);  
		}  
	} 
	else {
		echo "Could not complete query - missing parameter";
	}
	
?>  