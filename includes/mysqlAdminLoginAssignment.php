<?php
		include('includes/common.php');
    	session_start();
		if (isset ($_SESSION['username'])){
			
			$mySqlHost = "localhost";
	        $mySqlUser = "login_auth";
	        $mySqlPass = "hello123";
	
	        $mysqlConnection = mysql_connect($mySqlHost, $mySqlUser, $mySqlPass) or die("Can not connect to DB. " . mysql_error());
	        mysql_select_db("assignments_users_uiuc");
	        if (mysql_errno()) die ("ERROR: ".mysql_error());
	        
	        $query = "SELECT UserType FROM users WHERE username ='$_SESSION[username]'";
			$result = mysql_query($query);
			if (mysql_errno()) die ("ERROR: ".mysql_error());
	        $row = mysql_fetch_array($result);
			$userType = $row['UserType'];
			
			if ($userType != ADMINISTRATOR){
				die ("Not admin. Permission denied. Please notify the database administrator
				of this error.");
			}
			
			$mySqlHost = "localhost";
			$mySqlUser = "admin";
			$mySqlPass = "admin";
							
			$mysqlConnection = mysql_connect($mySqlHost, $mySqlUser, $mySqlPass) or die("Can not connect to DB. " . mysql_error());
							
			$uiucDB = "assignments_uiuc";
					
			mysql_select_db($uiucDB) or die("Cannot connect to assignments_uiuc database.");
		}
?>