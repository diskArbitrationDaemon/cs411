<?php

include 'includes/mysqlAdminLoginAssignment.php';

$table=$_GET["table"];




/*
 ************************************************************
 *                  'assignments_users_uiuc' tables
 ************************************************************
 */

if ($table == "users")
{
	// Change database
	$users_uiucDB = "assignments_users_uiuc";	
	mysql_select_db($users_uiucDB) or die("Cannot connect to assignments_uiuc database.");

	$query = "SELECT * FROM `" . $table ."`";
	$result = mysql_query($query) or die(mysql_error());
	
   ?>
	
	<button type="insertAutomarkingButton" onclick="showInsert('users')">Insert New User</button>
	<br />
	<br />
	
	<?php

	echo "<table border='1'>
	<tr>
	<th>Username</th>
	<th>Password</th>
	<th>UserType</th>
	</tr>";

	while ($row = mysql_fetch_array($result))
	{
	  echo "<tr>";
	  echo "<td>" . $row['Username'] . "</td>";
	  echo "<td>" . $row['Password'] . "</td>";
	  echo "<td>" . $row['UserType'] . "</td>";
	  
	  ?>
	  <td>
		<button type="editButton" onclick="showEdit('users', '<?php print($row['Username']); ?>', '0', '0' )">Edit</button>
	  </td>	

	  <td>
		<button type="deleteButton" onclick="showDelete('users', '<?php print($row['Username']); ?>', '0', '0' )">Delete</button>
	  </td>
	  <?php
	  
	  
	  
	  echo "</tr>";
	}

	echo "</table>";
	
}


/*
 ************************************************************
 *                  'assignments_uiuc' tables
 ************************************************************
 */

$query = "SELECT * FROM `" . $table ."`";
$result = mysql_query($query) or die(mysql_error());

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
		<button type="editButton" onclick="showEdit('assignment', '<?php print($row['AssnID']); ?>', '0', '0' )">Edit</button>
	  </td>	

	  <td>
		<button type="deleteButton" onclick="showDelete('assignment', '<?php print($row['AssnID']); ?>', '0', '0' )">Delete</button>
	  </td>
	  <?php
	  
	  
	  
	  echo "</tr>";
	}

	echo "</table>";
}


else if ($table == "automarking")
{

   ?>
	
	<button type="insertAutomarkingButton" onclick="showInsert('automarking')">Insert New Automark</button>
	<br />
	<br />	
	
	<?php

	echo "<table border='1'>
	<tr>
	<th>AutomarkID</th>
	<th>SampleSoln</th>
	<th>Configs</th>
	<th>AssnID</th>
	</tr>";

	while ($row = mysql_fetch_array($result))
	{
	  echo "<tr>";
	  echo "<td>" . $row['AutomarkID'] . "</td>";
	  echo "<td>" . $row['SampleSoln'] . "</td>";
	  echo "<td>" . $row['Configs'] . "</td>";
	  echo "<td>" . $row['AssnID'] . "</td>";
	  
	  ?>
	  <td>
		<button type="editButton" onclick="showEdit('automarking', '<?php print($row['AutomarkID']); ?>', '0', '0' )">Edit</button>
	  </td>	

	  <td>
		<button type="deleteButton" onclick="showDelete('automarking', '<?php print($row['AutomarkID']); ?>', '0', '0' )">Delete</button>
	  </td>
	  <?php
	  
	  
	  
	  echo "</tr>";
	}

	echo "</table>";
}



else if ($table == "course")
{

   ?>
	
	<button type="insertCourseButton" onclick="showInsert('course')">Insert New Course</button>
	<br />
	<br />	
	
	<?php

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
	  
	  ?>
	  <td>
		<button type="editButton" onclick="showEdit('course', '<?php print($row['CourseID']); ?>', '0', '0' )">Edit</button>
	  </td>	

	  <td>
		<button type="deleteButton" onclick="showDelete('course', '<?php print($row['CourseID']); ?>', '0', '0' )">Delete</button>
	  </td>
	  <?php
	  
	  
	  
	  echo "</tr>";
	}

	echo "</table>";
}



else if ($table == "group")
{

   ?>
	
	<button type="insertGroupButton" onclick="showInsert('group')">Insert New Group</button>
	<br />
	<br />	
	
	<?php

	echo "<table border='1'>
	<tr>
	<th>GroupName</th>
	<th>AssnID</th>
	</tr>";

	while ($row = mysql_fetch_array($result))
	{
	  echo "<tr>";
	  echo "<td>" . $row['GroupName'] . "</td>";
	  echo "<td>" . $row['AssnID'] . "</td>";
	  
	  ?>
	  <td>
		<button type="editButton" onclick="showEdit('group', '<?php print($row['GroupName'])?>', '<?php print($row['AssnID'])?>', '0' )">Edit</button>
	  </td>	

	  <td>
		<button type="deleteButton" onclick="showDelete('group', '<?php print($row['GroupName'])?>', '<?php print($row['AssnID'])?>', '0' )">Delete</button>
	  </td>
	  <?php
	  
	  
	  
	  echo "</tr>";
	}

	echo "</table>";
}


if ($table == "instructor")
{ 
	?>
	
	<button type="insertInstructorButton" onclick="showInsert('instructor')">Insert New Instructor</button>
	<br />
	<br />
	
	<?php

	echo "<table border='1'>
	<tr>
	<th>InstructorID</th>
	<th>FirstName</th>
	<th>LastName</th>
	<th>PhoneNumber</th>
	<th>OfficeLocation</th>
	<th>Email</th>
	</tr>";

	while ($row = mysql_fetch_array($result))
	{
	  echo "<tr>";
	  echo "<td>" . $row['InstructorID'] . "</td>";
	  echo "<td>" . $row['FirstName'] . "</td>";
	  echo "<td>" . $row['LastName'] . "</td>";
	  echo "<td>" . $row['PhoneNumber'] . "</td>";
	  echo "<td>" . $row['OfficeLocation'] . "</td>";
	  echo "<td>" . $row['Email'] . "</td>";
	  
	  ?>
	  <td>
		<button type="editButton" onclick="showEdit('instructor', '<?php print($row['InstructorID']); ?>', '0', '0' )">Edit</button>
	  </td>	

	  <td>
		<button type="deleteButton" onclick="showDelete('instructor', '<?php print($row['InstructorID']); ?>', '0', '0' )">Delete</button>
	  </td>
	  <?php
	  
	  
	  
	  echo "</tr>";
	}

	echo "</table>";
}



if ($table == "memberof")
{ 
	?>
	
	<button type="insertInstructorButton" onclick="showInsert('memberof')">Insert New Group Member</button>
	<br />
	<br />	
	
	<?php

	echo "<table border='1'>
	<tr>
	<th>GroupName</th>
	<th>StudentID</th>
	<th>AssnID</th>
	</tr>";

	while ($row = mysql_fetch_array($result))
	{
	  echo "<tr>";
	  echo "<td>" . $row['GroupName'] . "</td>";
	  echo "<td>" . $row['StudentID'] . "</td>";
	  echo "<td>" . $row['AssnID'] . "</td>";
	  
	  ?>
	  <td>
		<button type="editButton" onclick="showEdit('memberof', '<?php print($row['GroupName']); ?>', '<?php print($row['StudentID']); ?>', '<?php print($row['AssnID']); ?>' )">Edit</button>
	  </td>	

	  <td>
		<button type="deleteButton" onclick="showDelete('memberof', '<?php print($row['GroupName']); ?>', '<?php print($row['StudentID']); ?>', '<?php print($row['AssnID']); ?>' )">Delete</button>
	  </td>
	  <?php
	  
	  
	  
	  echo "</tr>";
	}

	echo "</table>";
}


else if ($table == "questions")
{

   ?>
	
	<button type="insertAutomarkingButton" onclick="showInsert('questions')">Insert New Question</button>
	<br />
	<br />	
	
	<?php

	echo "<table border='1'>
	<tr>
	<th>QuestionID</th>
	<th>QuestionName</th>
	<th>FullMark</th>
	<th>AssnID</th>
	</tr>";

	while ($row = mysql_fetch_array($result))
	{
	  echo "<tr>";
	  echo "<td>" . $row['QuestionID'] . "</td>";
	  echo "<td>" . $row['QuestionName'] . "</td>";
	  echo "<td>" . $row['FullMark'] . "</td>";
	  echo "<td>" . $row['AssnID'] . "</td>";
	  
	  ?>
	  <td>
		<button type="editButton" onclick="showEdit('questions', '<?php print($row['QuestionID']); ?>', '0', '0' )">Edit</button>
	  </td>	

	  <td>
		<button type="deleteButton" onclick="showDelete('questions', '<?php print($row['QuestionID']); ?>', '0', '0' )">Delete</button>
	  </td>
	  <?php
	  
	  
	  
	  echo "</tr>";
	}

	echo "</table>";
}



else if ($table == "student")
{

   ?>
	
	<button type="insertAutomarkingButton" onclick="showInsert('student')">Insert New Student</button>
	<br />
	<br />	
	
	<?php

	echo "<table border='1'>
	<tr>
	<th>StudentID</th>
	<th>Major</th>
	<th>LastName</th>
	<th>FirstName</th>
	</tr>";

	while ($row = mysql_fetch_array($result))
	{
	  echo "<tr>";
	  echo "<td>" . $row['StudentID'] . "</td>";
	  echo "<td>" . $row['Major'] . "</td>";
	  echo "<td>" . $row['LastName'] . "</td>";
	  echo "<td>" . $row['FirstName'] . "</td>";
	  
	  ?>
	  <td>
		<button type="editButton" onclick="showEdit('student', '<?php print($row['StudentID']); ?>', '0', '0' )">Edit</button>
	  </td>	

	  <td>
		<button type="deleteButton" onclick="showDelete('student', '<?php print($row['StudentID']); ?>', '0', '0' )">Delete</button>
	  </td>
	  <?php
	  
	  
	  
	  echo "</tr>";
	}

	echo "</table>";
}


else if ($table == "submission")
{

   ?>
	
	<br />
	<br />	
	
	<?php

	echo "<table border='1'>
	<tr>
	<th>AssnID</th>
	<th>Student</th>
	<th>Files</th>
	<th>AssnFinalMark</th>
	<th>Timestamp</th>
	</tr>";

	while ($row = mysql_fetch_array($result))
	{
	  echo "<tr>";
	  echo "<td>" . $row['AssnID'] . "</td>";
	  echo "<td>" . $row['StudentID'] . "</td>";
	  echo "<td>" . $row['Files'] . "</td>";
	  echo "<td>" . $row['AssnFinalMark'] . "</td>";
	  echo "<td>" . $row['Timestamp'] . "</td>";
	  echo "</tr>";
	}

	echo "</table>";
}


else if ($table == "takes")
{

   ?>
	
	<button type="insertAutomarkingButton" onclick="showInsert('takes')">Insert New Takes Relation</button>
	<br />
	<br />
	
	<?php

	echo "<table border='1'>
	<tr>
	<th>StudentID</th>
	<th>CourseID</th>
	<th>FinalMark</th>
	</tr>";

	while ($row = mysql_fetch_array($result))
	{
	  echo "<tr>";
	  echo "<td>" . $row['StudentID'] . "</td>";
	  echo "<td>" . $row['CourseID'] . "</td>";
	  echo "<td>" . $row['FinalMark'] . "</td>";
	  
	  ?>
	  <td>
		<button type="editButton" onclick="showEdit('takes', '<?php print($row['StudentID']); ?>', '<?php print($row['CourseID']); ?>', '0' )">Edit</button>
	  </td>	

	  <td>
		<button type="deleteButton" onclick="showDelete('takes', '<?php print($row['StudentID']); ?>', '<?php print($row['CourseID']); ?>', '0' )">Delete</button>
	  </td>
	  <?php
	  
	  
	  
	  echo "</tr>";
	}

	echo "</table>";
}


else if ($table == "teaches")
{

   ?>
	
	<button type="insertAutomarkingButton" onclick="showInsert('teaches')">Insert New Teaches Relation</button>
	<br />
	<br />
	
	<?php

	echo "<table border='1'>
	<tr>
	<th>InstructorID</th>
	<th>CourseID</th>
	</tr>";

	while ($row = mysql_fetch_array($result))
	{
	  echo "<tr>";
	  echo "<td>" . $row['InstructorID'] . "</td>";
	  echo "<td>" . $row['CourseID'] . "</td>";
	  
	  ?>
	  <td>
		<button type="editButton" onclick="showEdit('teaches', '<?php print($row['InstructorID']); ?>', '<?php print($row['CourseID']); ?>', '0' )">Edit</button>
	  </td>	

	  <td>
		<button type="deleteButton" onclick="showDelete('teaches', '<?php print($row['InstructorID']); ?>', '<?php print($row['CourseID']); ?>', '0' )">Delete</button>
	  </td>
	  <?php
	  
	  
	  
	  echo "</tr>";
	}

	echo "</table>";
}


mysql_close($mysqlConnection);

?>