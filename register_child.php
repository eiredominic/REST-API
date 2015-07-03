<?php>

$response = array(); 

if (isset($_POST['unique_id']) && isset ($_POST['type']) && isset ($_POST['name']) && isset($_POST['email']) && isset($_POST['password']))   {  

	$unique_id = $_POST['unique_id'];  
	$type = $_POST['type'];  
	$name = $_POST['name'];  
	$email = $_POST['email'];  
	$password = $_POST['password']; 
	
	// hash password 
	$cryptpw= generateHash($password);
	
	// include db connect class  
	include 'database_connect.php';  
	// connecting to db  
	$db = new db_connection();
	$db->connect();

	if (isset($_POST['parent_id'])) {
		$parent_id= $_POST['child_id']; 
		$result = mysqli_query($db->myconn, "INSERT INTO users (unique_id, type, name, email, encrypted_password,created_at, linked_id) VALUES ('$unique_id', '$type', '$name', '$email', '$cryptpw', NOW(), '$parent_id'));  
	} 	else {	
		$result = mysqli_query($db->myconn, "INSERT INTO users(unique_id, type, name, email, encrypted_password, created_at) VALUES('$unique_id', '$type', '$name', '$email', '$cryptpw', NOW())");  
		}

	// check if row inserted or not  
	if ($result) {  
		$response["success_msg"] = 777;  
		$response["message"] = "Registration Successful";  
		echo json_encode($response);  
	} 	else {  
		// failed to insert row  
		$response["success_msg "] = 999;  
		$response["message"] = "Registration not successful. An error occurred.";  

		// echoing JSON response  
		echo json_encode($response);  
		}  
} 	else {
		echo "Could not complete query - missing parameter";
	}
	
function generateHash($password) {
	if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
	$salt = '$2y$15$' . substr(md5(uniqid(rand(), true)), 0, 22);
	return crypt($password, $salt);	
	}
}

?>  