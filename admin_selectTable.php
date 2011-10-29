<?php

$table=$_GET["table"];

$mySqlHost = "localhost";
$mySqlUser = "admin";
$mySqlPass = "admin";
				
$mysqlConnection = mysql_connect($mySqlHost, $mySqlUser, $mySqlPass) or die("Can not connect to DB. " . mysql_error());
				
$uiucDB = "assignments_uiuc";
		
mysql_select_db($uiucDB) or die("Cannot connect to uiucDB.");

$query = "SELECT * FROM " . $table;

$result = mysql_query($query);

?>

<!--  FILTER BUTTONS

<form method="POST">
<div class="sur_box"><span></span><spanr><input name="a" type="checkbox" class="styled" id="a" value="1" /></spanr></div>
<div class="sur_box"><span>2</span><spanr><input name="b" type="checkbox" class="styled" id="b" value="2" /></spanr></div>
<div class="sur_box"><span>3</span><spanr><input name="c" type="checkbox" class="styled" id="c" value="3" /></spanr></div>
<div class="sur_box"><span>4</span><spanr><input name="d" type="checkbox" class="styled" id="d" value="4" /></spanr></div>
<div class="sur_box"><span>5</span><spanr><input name="e" type="checkbox" class="styled" id="e" value="5" /></spanr></div>
<div class="sur_box"><span>6</span><spanr><input name="f" type="checkbox" class="styled" id="f" value="6" /></spanr></div>
<div class="sur_box"><span>7</span><spanr><input name="g" type="checkbox" class="styled" id="g" value="7" /></spanr></div>
<div id="poll_ajax">
<input name="search" type="button" onclick="ajaxPoll();" class="submit" value="SEND" id="search" />
</div>
</form>

-->
	
<?php

if ($table == "assignment")
{ 
	?>
	
	<button type="insertAssnButton" onclick="showInsert('assignment')">Insert New Assignment</button>
	<br />
	<br />	
	
	<?php

	echo "<table border='1'>
	<tr>
	<th>AssnID</th>
	<th>AssnName</th>
	<th>GroupWork</th>
	<th>MaxMark</th>
	<th>AvgMark</th>
	<th>MedianMark</th>
	<th>CourseID</th>
	<th>DueTime</th>
	</tr>";

	while ($row = mysql_fetch_array($result))
	{
	  echo "<tr>";
	  echo "<td>" . $row['AssnID'] . "</td>";
	  echo "<td>" . $row['AssnName'] . "</td>";
	  echo "<td>" . $row['GroupWork'] . "</td>";
	  echo "<td>" . $row['MaxMark'] . "</td>";
	  echo "<td>" . $row['AvgMark'] . "</td>";
	  echo "<td>" . $row['MedianMark'] . "</td>";
	  echo "<td>" . $row['CourseID'] . "</td>";
	  echo "<td>" . $row['DueTime'] . "</td>";
	  
	  ?>
	  <td>
		<button type="editButton" onclick="showEdit('assignment', <?php print($row['AssnID']); ?> )">Edit</button>
	  </td>	

	  <td>
		<button type="deleteButton" onclick="showDelete('assignment', <?php print($row['AssnID']); ?> )">Delete</button>
	  </td>
	  <?php
	  
	  
	  
	  echo "</tr>";
	}

	echo "</table>";
}

else if ($table == "course")
{
   echo "<table border='1'>
	<tr>
	<th>CourseID</th>
	<th>CourseName</th>
	<th>NumStudents</th>
	<th>SemesterName</th>
	</tr>";
	
	while ($row = mysql_fetch_array($result))
	{
	  echo "<tr>";
	  echo "<td>" . $row['CourseID'] . "</td>";
	  echo "<td>" . $row['CourseName'] . "</td>";
	  echo "<td>" . $row['NumStudents'] . "</td>";
	  echo "<td>" . $row['SemesterName'] . "</td>";	  
	  echo "</tr>";
	}

	echo "</table>";
}

mysql_close($mysqlConnection);

?>