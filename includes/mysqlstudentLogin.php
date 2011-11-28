<?php
    	session_start();
		if (isset ($_SESSION['username'])){

	        $mySqlHost = "localhost";
	        $mySqlUser = "student";
	        $mySqlPass = "hello123";
	
	        $mysqlConnection = mysql_connect($mySqlHost, $mySqlUser, $mySqlPass) or die("Can not connect to DB. " . mysql_error());
	        mysql_select_db("assignments_uiuc");
	
	        $courseTable = "course";
	        $assignmentTable = "assignment";
	        $instructorTable = "instructor";
        
		}
?>