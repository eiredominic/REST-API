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
	

	// check if row inserted or not  
	if ($result) {
		while ($row = $result->fetch_assoc()) {
			$dbpassword = $row['encrypted_password'];
			$type = $row['type'];
		}
		
		$cryptpw = generateHash($password);
		$verifypw = verify($password, $cryptpw);
		
		
		if ($verifypw) {	
			$response["success_msg"] = 1;  
			$response["message"] = "Login Successful";
			$response["type"] = "$type";
			echo json_encode($response);
			
		} 	else {
			$response["message"] = "Incorrect Password";
			
			}

	}	 else {  
			// failed to find user row  
			$response["success_msg "] = 0;  
			$response["message"] = "Could not find Unique ID";  
			// echoing JSON response  
			echo json_encode($response);  

		}  
}

function generateHash($password) {
    if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
        $salt = '$2y$15$' . substr(md5(uniqid(rand(), true)), 0, 22);
        return crypt($password, $salt);
		
    }
}

function verify($password, $hashedPassword) {
       return crypt($password, $hashedPassword) == $hashedPassword;
}


?>  
