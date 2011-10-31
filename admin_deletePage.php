<?php
include 'includes/mysqlAdminLoginAssignment.php';

		
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
	
	mysql_close($mysqlConnection);
	
	?>
	<script src="admin_functions.js"></script>
	<meta http-equiv="refresh" content="0;url=admin.html?displayTable=1">
	<?php
}



?>