<?php
$mySqlHost = "localhost";
$mySqlUser = "admin";
$mySqlPass = "admin";
				
$mysqlConnection = mysql_connect($mySqlHost, $mySqlUser, $mySqlPass) or die("Can not connect to DB. " . mysql_error());
				
$uiucDB = "assignments_uiuc";
		
mysql_select_db($uiucDB) or die("Cannot connect to uiucDB.");

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
	
	$query = "UPDATE assignment SET AssnName='$assnName', GroupWork='$groupWork', MaxMark='$maxMark', AvgMark='$avgMark', MedianMark='$medianMark', CourseID='$courseID', DueTime=FROM_UNIXTIME('$dueTime') WHERE AssnID='$assnID'";
	
	if (!mysql_query($query, $mysqlConnection))
	{
		die ('Error: ' . mysql_error());
	}
	
	?>
	<font color="green"><b>1 record changed</b></font>
	<?php
	mysql_close($mysqlConnection);	
}



?>