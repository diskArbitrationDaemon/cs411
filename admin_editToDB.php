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
	
	$query = "UPDATE assignment SET AssnName='$assnName', GroupWork='$groupWork', MaxMark='$maxMark', AvgMark='$avgMark', MedianMark='$medianMark', CourseID='$courseID', DueTime=FROM_UNIXTIME('$dueTime') WHERE AssnID='$assnID'";
	
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
		
	$query = "UPDATE automarking SET SampleSoln='$sampleSoln', Configs='$configs', AssnID='$assnID' WHERE AutomarkID='$automarkID'";
	
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
	$semesterName=$_GET["SemesterName"];
		
	$query = "SELECT * FROM `course` WHERE CourseName = '$courseName' AND SemesterName = '$semesterName '";
	$result = mysql_query($query) or die(mysql_error());
	if($row = mysql_fetch_array($result))    //if we did return a record
	{ 
		echo "This course already exists in the database!";
		return;
	}	
		
		
	$query = "UPDATE course SET CourseName='$courseName', SemesterName='$semesterName' WHERE CourseID='$courseID'";
	
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
	$oldGroup = $_GET['OldGroup'];
	$oldAssn = $_GET['OldAssn'];
	$groupName = $_GET['GroupName'];
	$assnID = $_GET['AssnID'];
	
	$query = "UPDATE `group` SET GroupName='$groupName', AssnID='$assnID' WHERE GroupName='$oldGroup' AND AssnID='$oldAssn'";
	
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
	
	$query = "UPDATE `instructor` SET FirstName='$firstName', LastName='$lastName', PhoneNumber='$phoneNumber', OfficeLocation='$officeLocation', Email='$email' WHERE InstructorID='$instructorID'";
	
	if (!mysql_query($query, $mysqlConnection))
	{
		die ('Error: ' . mysql_error());
	}
	
	mysql_close($mysqlConnection);	
	?>
	<script src="admin_functions.js"></script>
	<meta http-equiv="refresh" content="0;url=admin.html?displayTable=5">
	<?php
}

if ($table == "memberof")
{
	$oldGroup=$_GET["OldGroup"];
	$oldStudentID=$_GET["OldStudentID"];
	$oldAssn=$_GET["OldAssnID"];
	$groupName=$_GET["GroupName"];
	$studentID=$_GET["StudentID"];
	$assnID=$_GET["AssnID"];
		
	$query = "UPDATE `memberof` SET GroupName='$groupName', StudentID='$studentID', AssnID='$assnID' WHERE GroupName='$oldGroup' AND StudentID='$oldStudentID' AND AssnID='$oldAssn'";
	
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
	
	$query = "UPDATE `questions` SET questionName='$questionName', fullMark='$fullMark', AssnID='$assnID' WHERE QuestionID='$questionID'";
	
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
	
	$query = "UPDATE `student` SET Major='$major', FirstName='$firstName', LastName='$lastName' WHERE StudentID='$studentID'";
	
	if (!mysql_query($query, $mysqlConnection))
	{
		die ('Error: ' . mysql_error());
	}
	
	mysql_close($mysqlConnection);	
	?>
	<script src="admin_functions.js"></script>
	<meta http-equiv="refresh" content="0;url=admin.html?displayTable=8">
	<?php
}


if ($table == "takes")
{
	$oldStudentID=$_GET["OldStudentID"];
	$oldCourseID=$_GET["OldCourseID"];
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
	
	$query = "UPDATE `takes` SET StudentID='$studentID', CourseID='$courseID', FinalMark='$finalMark' WHERE StudentID='$oldStudentID' AND CourseID='$oldCourseID'";
	
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
	$oldInstructorID = $_GET['OldInstructorID'];
	$oldCourseID = $_GET['OldCourseID'];
	$instructorID = $_GET['InstructorID'];
	$courseID = $_GET['CourseID'];
	
	$query = "UPDATE `teaches` SET InstructorID='$instructorID', CourseID='$courseID' WHERE InstructorID='$oldInstructorID' AND CourseID='$oldCourseID'";
	
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
	$isAdmin=$_GET["AdminPerm"];
	$passwordChange=$_GET["PasswordChange"];
	
	$query = "SELECT * FROM `users` WHERE Username='$username'";
	$result = mysql_query($query);

	$row = mysql_fetch_array($result);
	$userType = $row['UserType'];
	
	if ($isAdmin == "no")
	{
		if ($userType%2 == 1)
			$userType=$userType-1;
	}
	else if ($isAdmin == "yes")
		$userType=($userType | 1);
		
	if ($passwordChange == "")	
		$encryptedPassword = md5($password);
	else
		$encryptedPassword = $password;
		
	$query = "UPDATE `users` SET Password='$encryptedPassword', UserType='$userType' WHERE UserName='$username'";
	
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