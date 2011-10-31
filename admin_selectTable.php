<?php

include 'includes/mysqlAdminLoginAssignment.php';

$table=$_GET["table"];

$query = "SELECT * FROM " . $table;

$result = mysql_query($query);



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