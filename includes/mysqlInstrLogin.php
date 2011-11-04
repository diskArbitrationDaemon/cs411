<?php

        $mySqlHost = "localhost";
        $mySqlUser = "instructor";
        $mySqlPass = "hello123";

        $mysqlConnection = mysql_connect($mySqlHost, $mySqlUser, $mySqlPass) or die("Can not connect to DB. " . mysql_error());
        mysql_select_db("assignments_uiuc");

        $courseTable = "Course";
        $assignmentTable = "Assignment";
        $instructorTable = "Instructor";
?>
