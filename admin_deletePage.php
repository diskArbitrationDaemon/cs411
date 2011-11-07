<?php
include 'includes/mysqlAdminLoginAssignment.php';

		
mysql_select_db($uiucDB) or die("Cannot connect to uiucDB.");

$table=$_GET["table"];


if ($table == "assignment")
{
	$rowID=$_GET["rowID"];
	$query = "DELETE FROM assignment WHERE assnID = '$rowID'";
	
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
	$rowID=$_GET["rowID"];
	$query = "DELETE FROM automarking WHERE AutomarkID = '$rowID'";
	
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
	$rowID=$_GET["rowID"];
	$query = "DELETE FROM course WHERE CourseID = '$rowID'";
	
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
	$rowID=$_GET["rowID"];
	$rowIDtwo=$_GET["rowIDtwo"];
	
	$query = "DELETE FROM `group` WHERE GroupName = '$rowID' AND AssnID = '$rowIDtwo'";
	
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
	$rowID=$_GET["rowID"];
	
	$query = "DELETE FROM `instructor` WHERE InstructorID = '$rowID'";
	
	if (!mysql_query($query, $mysqlConnection))
	{
		die ('Error: ' . mysql_error());
	}
	
	// Update userType in users table
	$users_uiucDB = "assignments_users_uiuc";	
	mysql_select_db($users_uiucDB) or die("Cannot connect to assignments_uiuc database.");
		
	$query = "SELECT * FROM `users` WHERE Username = '$rowID'";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result))
	{
		$usertype = $row['UserType'];	
	}
		
	$query = "UPDATE `users` SET UserType=('$usertype' ^ 2) WHERE Username='$rowID'";
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
	$rowID=$_GET["rowID"];
	$rowIDtwo=$_GET["rowIDtwo"];
	$rowIDthree=$_GET["rowIDthree"];
	
	$query = "DELETE FROM `memberof` WHERE GroupName = '$rowID' AND StudentID = '$rowIDtwo' AND AssnID='$rowIDthree'";
	
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
	$rowID=$_GET["rowID"];
	
	$query = "DELETE FROM `questions` WHERE QuestionID = '$rowID'";
	
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
	$rowID=$_GET["rowID"];
	
	$query = "DELETE FROM `student` WHERE StudentID = '$rowID'";
	
	if (!mysql_query($query, $mysqlConnection))
	{
		die ('Error: ' . mysql_error());
	}
	
	// Update userType in users table
	$users_uiucDB = "assignments_users_uiuc";	
	mysql_select_db($users_uiucDB) or die("Cannot connect to assignments_uiuc database.");
		
	$query = "SELECT * FROM `users` WHERE Username = '$rowID'";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result))
	{
		$usertype = $row['UserType'];	
	}
		
	$query = "UPDATE `users` SET UserType=('$usertype' ^ 4) WHERE Username='$rowID'";
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
	$rowID=$_GET["rowID"];
	$rowIDtwo=$_GET["rowIDtwo"];
	
	$query = "DELETE FROM `takes` WHERE StudentID = '$rowID' AND CourseID = '$rowIDtwo'";
	
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
	$rowID=$_GET["rowID"];
	$rowIDtwo=$_GET["rowIDtwo"];
	
	$query = "DELETE FROM `teaches` WHERE InstructorID = '$rowID' AND CourseID = '$rowIDtwo'";
	
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
	
	$rowID=$_GET["rowID"];
	
	$query = "DELETE FROM `users` WHERE Username = '$rowID'";
	
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