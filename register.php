<?php  
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);




	$response = array(); 

	if (isset($_POST['unique_id']) && isset ($_POST['type']) && isset ($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {  

		$unique_id = $_POST['unique_id'];  
		$type = $_POST['type'];  
		$name = $_POST['name'];  
		$email = $_POST['email'];  
		$password = $_POST['password'];  

		// include db connect class  
		include 'database_connect.php';  
		// connecting to db  
		$db = new db_connection();
		$db->connect();
		
		$result = mysqli_query($db->myconn, "INSERT INTO users(unique_id, type, name, email, encrypted_password, created_at) VALUES('$unique_id', '$type', '$name', '$email', '$password', NOW())");  
		
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