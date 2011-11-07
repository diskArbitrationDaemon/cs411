<?php
include 'includes/mysqlAdminLoginAssignment.php';

$table=$_GET["table"];


if ($table == "assignment")
{
	$assnID=$_GET["assnID"];
	$assnName=$_GET["assnName"];
	$groupWork=$_GET["groupWork"];
	$maxMark=$_GET["maxMark"];
	$avgMark=$_GET["avgMark"];
	$medianMark=$_GET["medianMark"];
	$courseID=$_GET["courseID"];
	$month=$_GET["month"];
	$day=$_GET["day"];
	$year=$_GET["year"];
	$hour=$_GET["hour"];
	$minute=$_GET["minute"];
	$second=$_GET["second"];
	
	$dueTime = mktime($hour, $minute, $second, $month, $day, $year, -1);
	
	
	$query = "INSERT INTO assignment (AssnID, AssnName, GroupWork, MaxMark, AvgMark, MedianMark, CourseID, DueTime) VALUES ('$assnID', '$assnName', '$groupWork', '$maxMark', '$avgMark', '$medianMark', '$courseID', FROM_UNIXTIME('$dueTime'))";
	
	if (!mysql_query($query, $mysqlConnection))
	{
		die ('Error: ' . mysql_error());
	}
	
	mysql_close($mysqlConnection);
	?>
	<script src="admin_functions.js"></script>
	
	<meta http-equiv="refresh" content="0;url=admin.html?displayTable=1">
	<?php
}


if ($table == "automarking")
{
	$automarkID=$_GET["AutomarkID"];
	$sampleSoln=$_GET["SampleSoln"];
	$configs=$_GET["Configs"];
	$assnID=$_GET["AssnID"];
		
	$query = "INSERT INTO automarking (AutomarkID, SampleSoln, Configs, AssnID) VALUES ('$automarkID', '$sampleSoln', '$configs', '$assnID')";
	
	if (!mysql_query($query, $mysqlConnection))
	{
		die ('Error: ' . mysql_error());
	}
	
	mysql_close($mysqlConnection);
	?>
	<script src="admin_functions.js"></script>
	
	<meta http-equiv="refresh" content="0;url=admin.html?displayTable=2">
	<?php
	
}


if ($table == "course")
{
	$courseID=$_GET["CourseID"];
	$courseName=$_GET["CourseName"];
	$numStudents=$_GET["NumStudents"];
	$semesterName=$_GET["SemesterName"];		
		
	$query = "INSERT INTO course (CourseID, CourseName, NumStudents, SemesterName) VALUES ('$courseID', '$courseName', '$numStudents', '$semesterName')";
	
	if (!mysql_query($query, $mysqlConnection))
	{
		die ('Error: ' . mysql_error());
	}
	
	mysql_close($mysqlConnection);
	?>
	<script src="admin_functions.js"></script>
	
	<meta http-equiv="refresh" content="0;url=admin.html?displayTable=3">
	<?php
	
}


if ($table == "group")
{
	$groupName=$_GET["GroupName"];
	$assnID=$_GET["AssnID"];
		
		
	$query = "INSERT INTO `group` (GroupName, AssnID) VALUES ('$groupName', '$assnID')";
	
	if (!mysql_query($query, $mysqlConnection))
	{
		die ('Error: ' . mysql_error());
	}
	
	mysql_close($mysqlConnection);
	?>
	<script src="admin_functions.js"></script>
	
	<meta http-equiv="refresh" content="0;url=admin.html?displayTable=4">
	<?php
	
}


if ($table == "instructor")
{
	$instructorID=$_GET["InstructorID"];
	$firstName=$_GET["FirstName"];
	$lastName=$_GET["LastName"];
	$phoneNumber=$_GET["PhoneNumber"];
	$officeLocation=$_GET["OfficeLocation"];
	$email=$_GET["Email"];
	$user=$_GET["Username"];
			
	$query = "INSERT INTO `instructor` (InstructorID, FirstName, LastName, PhoneNumber, OfficeLocation, Email) VALUES ('$instructorID', '$firstName', '$lastName', '$phoneNumber', '$officeLocation', '$email')";
	
	if (!mysql_query($query, $mysqlConnection))
	{
		die ('Error: ' . mysql_error());
	}

	// Update userType in users table
	$users_uiucDB = "assignments_users_uiuc";	
	mysql_select_db($users_uiucDB) or die("Cannot connect to assignments_uiuc database.");
		
	$query = "SELECT * FROM `users` WHERE Username = '$user'";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result))
	{
		$usertype = $row['UserType'];	
	}
		
	$query = "UPDATE `users` SET UserType=('$usertype' | 2) WHERE Username='$user'";
	if (!mysql_query($query, $mysqlConnection))
	{
		die ('Error: ' . mysql_error());
	}
		
	$users_uiucDB = "assignments_uiuc";	
	mysql_select_db($users_uiucDB) or die("Cannot connect to assignments_uiuc database.");
	

	mysql_close($mysqlConnection);
	?>
	<script src="admin_functions.js"></script>
	
	<meta http-equiv="refresh" content="0;url=admin.html?displayTable=5">
	<?php
}



if ($table == "memberof")
{
	$groupName=$_GET["GroupName"];
	$studentID=$_GET["StudentID"];
	$assnID=$_GET["AssnID"];
	
	
	
	$query = "INSERT INTO memberof (GroupName, StudentID, AssnID) VALUES ('$groupName', '$studentID', '$assnID')";
	
	if (!mysql_query($query, $mysqlConnection))
	{
		die ('Error: ' . mysql_error());
	}
	
	mysql_close($mysqlConnection);
	?>
	<script src="admin_functions.js"></script>
	
	<meta http-equiv="refresh" content="0;url=admin.html?displayTable=6">
	<?php
}


if ($table == "questions")
{
	$questionID=$_GET["QuestionID"];
	$questionName=$_GET["QuestionName"];
	$fullMark=$_GET["FullMark"];
	$assnID=$_GET["AssnID"];
	
	$query = "INSERT INTO questions (QuestionID, QuestionName, FullMark, AssnID) VALUES ('$questionID', '$questionName', '$fullMark', '$assnID')";
	
	if (!mysql_query($query, $mysqlConnection))
	{
		die ('Error: ' . mysql_error());
	}
	
	mysql_close($mysqlConnection);
	?>
	<script src="admin_functions.js"></script>
	
	<meta http-equiv="refresh" content="0;url=admin.html?displayTable=7">
	<?php
}


if ($table == "student")
{
	$studentID=$_GET["StudentID"];
	$major=$_GET["Major"];
	$lastName=$_GET["LastName"];
	$firstName=$_GET["FirstName"];
	$user=$_GET["Username"];
	
	$query = "INSERT INTO student (StudentID, Major, LastName, FirstName) VALUES ('$studentID', '$major', '$lastName', '$firstName')";
	
	if (!mysql_query($query, $mysqlConnection))
	{
		die ('Error: ' . mysql_error());
	}
	
	// Update userType in users table
	$users_uiucDB = "assignments_users_uiuc";	
	mysql_select_db($users_uiucDB) or die("Cannot connect to assignments_uiuc database.");
		
	$query = "SELECT * FROM `users` WHERE Username = '$user'";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result))
	{
		$usertype = $row['UserType'];	
	}
		
	$query = "UPDATE `users` SET UserType=('$usertype' | 4) WHERE Username='$user'";
	if (!mysql_query($query, $mysqlConnection))
	{
		die ('Error: ' . mysql_error());
	}
		
	$users_uiucDB = "assignments_uiuc";	
	mysql_select_db($users_uiucDB) or die("Cannot connect to assignments_uiuc database.");
	
	mysql_close($mysqlConnection);
	?>
	<script src="admin_functions.js"></script>
	
	<meta http-equiv="refresh" content="0;url=admin.html?displayTable=8">
	<?php
}


if ($table == "takes")
{
	$studentID=$_GET["StudentID"];
	$courseID=$_GET["CourseID"];
	$finalMark=$_GET["FinalMark"];
				
	if ($finalMark == "Aplus")
		$finalMark = "A+";
	else if ($finalMark == "Bplus")
		$finalMark = "B+";
	else if ($finalMark == "Cplus")
		$finalMark = "C+";
	else if ($finalMark == "Dplus")
		$finalMark = "D+";
		
		
	$query = "INSERT INTO `takes` (StudentID, CourseID, FinalMark) VALUES ('$studentID', '$courseID', '$finalMark')";
	
	if (!mysql_query($query, $mysqlConnection))
	{
		die ('Error: ' . mysql_error());
	}
	
	mysql_close($mysqlConnection);
	?>
	<script src="admin_functions.js"></script>
	
	<meta http-equiv="refresh" content="0;url=admin.html?displayTable=10">
	<?php
	
}


if ($table == "teaches")
{
	$instructorID=$_GET["InstructorID"];
	$courseID=$_GET["CourseID"];
		
		
	$query = "INSERT INTO `teaches` (InstructorID, CourseID) VALUES ('$instructorID', '$courseID')";
	
	if (!mysql_query($query, $mysqlConnection))
	{
		die ('Error: ' . mysql_error());
	}
	
	mysql_close($mysqlConnection);
	?>
	<script src="admin_functions.js"></script>
	
	<meta http-equiv="refresh" content="0;url=admin.html?displayTable=11">
	<?php
	
}


if ($table == "users")
{
	// Change database
	$users_uiucDB = "assignments_users_uiuc";	
	mysql_select_db($users_uiucDB) or die("Cannot connect to assignments_uiuc database.");
	
	$username=$_GET["Username"];
	$password=$_GET["Password"];
	$adminPerm=$_GET["AdminPerm"];
	
	if ($adminPerm == "no")
		$adminPerm=0;
	else if ($adminPerm == "yes")
		$adminPerm=1;
		
	$encryptedPassword = md5($password);	
	
	$query = "INSERT INTO `users` (Username, Password, UserType) VALUES ('$username', '$encryptedPassword', '$adminPerm')";
	
	if (!mysql_query($query, $mysqlConnection))
	{
		die ('Error: ' . mysql_error());
	}
	
	mysql_close($mysqlConnection);
	?>
	<script src="admin_functions.js"></script>
	
	<meta http-equiv="refresh" content="0;url=admin.html?displayTable=12"> 
	<?php
}

?>