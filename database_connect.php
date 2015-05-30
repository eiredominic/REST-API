
<?php  

/** 
* A class file to connect to database 
*/  
class db_connection {  
	var $user = "university";   
	var $password = "sunt1774";
	var $database = "activity_monitor";
	var $host = "mkbdesigncouk.ipagemysql.com";
	var $myconn;
	
    function connect() {
        $con = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        if (!$con) {
            die('Could not connect to database!');
        } 
		else {
			// Connected! 
            $this->myconn = $con;
        return $this->myconn;
		}
	}

    function close() {
        mysqli_close($myconn);
        echo 'Connection closed!';
    }

	
}

?>
