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

	// check if there are any rows which have the unique Id specified 

	$num_rows = mysqli_num_rows($result);
	if ($num_rows > 0) {
		// found user with unique ID
		$row = $result->fetch_assoc();
		
		// retrieve the password we have stored for that user in the database and the type of user they are 
		$dbpassword = $row['encrypted_password'];
		$type = $row['type'];

		// check to see if password we have stored matches up with the password entered. We use the verify() method for this (see bottom of file)
		$verifypw = verify($password, $dbpassword);
		
		
		// if password matches up then return the corresponding success_msg, a message with 'Login Successful' and the type of user we have stored for them
		if ($verifypw) {
			$response["success_msg"] = 0;  
			$response["message"] = "Login Successful";
			$response["type"] = "$type";
			
			// check to see if a child exists under this parent 
			$childExist = mysqli_query($db->myconn, "SELECT * FROM users WHERE parent_id='$unique_id'");  
			
			$child_rows = mysqli_num_rows($childExist);
			if ($child_rows > 0) {			
			// found child 
				$row = $childExist->fetch_assoc();
				$response["child_id"] = $row['unique_id'];

			}
			
			echo json_encode($response);
			
		} 	else {
			// if password doesn't match, we return this error so it can be handeled by the app
			$response["success_msg"] = 1;  
			$response["message"] = "Incorrect Password";
			echo json_encode($response);

		}

	}	 else {  
			// we couldn't find a user with that unique ID. Inform the application of this
			$response["success_msg"] = 1;  
			$response["message"] = "Could not find Unique ID";  
			echo json_encode($response);  

		}
}		


// this is a function to generate a hash of a password. It uses the CRYPT_BLOWFISH cipher. This ensures we are not storing a password as plain text in the 
// database and that we have strong encryption built into our application 
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
