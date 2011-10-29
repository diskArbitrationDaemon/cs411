<?php
$mySqlHost = "localhost";
$mySqlUser = "admin";
$mySqlPass = "admin";
				
$mysqlConnection = mysql_connect($mySqlHost, $mySqlUser, $mySqlPass) or die("Can not connect to DB. " . mysql_error());
				
$uiucDB = "assignments_uiuc";
		
mysql_select_db($uiucDB) or die("Cannot connect to uiucDB.");

$table=$_GET["table"];
$rowID=$_GET["rowID"];

if ($table == "assignment")
{
	$query = "DELETE FROM assignment WHERE assnID = '$rowID'";
	
	if (!mysql_query($query, $mysqlConnection))
	{
		die ('Error: ' . mysql_error());
	}
	
	?>
	<font color="red"><b>1 record deleted</b></font>
	<?php
	mysql_close($mysqlConnection);
}



?>