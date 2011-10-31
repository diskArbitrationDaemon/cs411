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
	$courseName=$_GET["courseName"];
	$month=$_GET["month"];
	$day=$_GET["day"];
	$year=$_GET["year"];
	$hour=$_GET["hour"];
	$minute=$_GET["minute"];
	$second=$_GET["second"];
	
	$dueTime = mktime($hour, $minute, $second, $month, $day, $year, -1);
	
	//Get courseID for assignment's course
	$query = "SELECT CourseID FROM course WHERE CourseName = '$courseName'";
	$result = mysql_query($query);
	$course_row = mysql_fetch_array($result);
	$courseID = $course_row['CourseID'];
	
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



?>