<?php
include 'includes/mysqlAdminLoginAssignment.php';


$table=$_GET["table"];

if ($table == "assignment")
{
	?>
	<h3><u>INSERT NEW ROW INTO 'assignment' TABLE</h3></u>
	<?php
	// Get largest assnID
	$query = "SELECT MAX(assnID) FROM assignment";
    $result = mysql_query($query);
	
	while($row = mysql_fetch_array($result))
    {
       $newID = $row['MAX(assnID)'] + 1;  // newID = MAX(assnID) + 1
       echo "<br />";
    }
	
	?>
	
	<form name="insertAssnForm" id="insertAssnFormId" action="" method="GET">
		<table border="2">
		<tr>
			<td align="center"><label for="assnIDLabel"><b>Assignment ID:</b></label></td>
			<td align="center"><label for="assnID"><?php print($newID); ?></label></td>  
			<td align="center"><label for="assnIDType">int(30)</label></td>
		</tr>
		<tr>
			<td align="center"><label for="assNameLabel"><b>* Assignment Name:</b></label></td>
			<td align="center"><input type="text" name="assnName" id="assnNameId" size="30" maxlength="30" /></td>
			<td align="center"><label for="assnNameType">varchar(30)</label></td>
		</tr>
		<tr>
			<td align="center"><label for="groupWorkLabel"><b>Number of Group Members Allowed:</b></label></td>
			<td align="center">
			<select name="groupWork">
			<?php
			$group = 0;
			while ($group <= 9)
			{
				?> <option value="<?php print($group); ?>"><?php print($group); ?></option><?php
				$group++;
			}
			?>
			</select>
			</td>
			<td align="center"><label for="groupWorkType">tinyint(1)</label></td>
		</tr>
		
		
		<tr>
			<td align="center"><label for="maxMarkLabel"><b>Max Mark:</b></label></td>
			<td align="center"><input type="text" name="maxMark" size="3" maxlength="3" /></td>
			<td align="center"><label for="maxMarkType">int(3)</label></td>
		</tr>
		<tr>
			<td align="center"><label for="avgMarkLabel"><b>Average Mark:<b></label></td>
			<td align="center"><input type="text" name="avgMark" size="30" maxlength="30"/></td>
			<td align="center"><label for="avgMarkType">double</label></td>
		</tr>
		<tr>
			<td align="center"><label for="medianMarkLabel"><b>Median Mark:</b></label></td>
			<td align="center"><input type="text" name="medianMark" size="30" maxlength="30"/></td>
			<td align="center"><label for="medianMarkType">double</label></td>
		</tr>
		<td align="center"><label for="courseNameLabel"><b>Distributing Course ID:</b></label></td>
		<td align="center">	
			<select name="courseID">
			<?php
			$query = "SELECT courseID FROM course";
			$result = mysql_query($query);
	
			while($row = mysql_fetch_array($result))
			{
			   ?> <option value="<?php print($row['courseID']); ?>"><?php print($row['courseID']); ?></option><?php
			}
			?>
			</select>
		</td>
		</tr>
		<td align="center"><label for="dateLabel"><b>Date Due:</b></label></td>
		<td align="center"><label for="monthNameLabel"><b>Month:</b></label>
			<select name="monthName">
			<?php
			$month = 1;
			while ($month <= 12)
			{
				?> <option value="<?php print($month); ?>"><?php print($month); ?></option><?php
				$month++;
			}
			?>
			</select>
			
			<label for="dayNameLabel"><b>Day:</b></label>
			<select name="dayName">
			<?php
			$day = 1;
			while ($day <= 31)
			{
				?> <option value="<?php print($day); ?>"><?php print($day); ?></option><?php
				$day++;
			}
			?>
			</select>
			
			<label for="yearLabel"><b>Year:</b></label>
			<select name="year">
			<?php
			$year = 2011;
			while ($year <= 2037)
			{
				?> <option value="<?php print($year); ?>"><?php print($year); ?></option><?php
				$year++;
			}
			?>
			
			</select>
		</td>
		</tr>
		<td align="center"><label for="timeLabel"><b>Time Due:</b></label></td>
		<td><label for="hourLabel"><b>Hour:</b></label>
		<select name="hour">
		<?php
		$hour = 0;
		while ($hour <= 23)
		{
			?> <option value="<?php print($hour); ?>"><?php print($hour); ?></option><?php
			$hour++;
		}
		?>
		</select>
		
		<label for="minuteLabel"><b>Minute:</b></label>
		<select name="minute">
		<?php
		$minute = 0;
		while ($minute <= 59)
		{
			?> <option value="<?php print($minute); ?>"><?php print($minute); ?></option><?php
			$minute++;
		}
		?>
		</select>
	
		<label for="secondLabel"><b>Second:</b></label>
		<select name="second">
		<?php
		$second = 0;
		while ($second <= 59)
		{
			?> <option value="<?php print($second); ?>"><?php print($second); ?></option><?php
			$second++;
		}
		?>
		</select>	
		
		</td>
		</tr>
		</table>
		
		<br />
		<script src="admin_functions.js"></script>
		<input type="button" name="submitAssnButton" value="Insert New Assignment" onclick="submitAssignment(this.form, '<?php print($newID) ?>', 'insert');" />

	</form>
	
	
	
	<?php
	
}



if ($table == "automarking")
{
	?>
	<h3><u>INSERT NEW ROW INTO 'automarking' TABLE</h3></u>
	<?php
	// Get largest assnID
	$query = "SELECT MAX(AutomarkID) FROM automarking";
    $result = mysql_query($query);
	
	while($row = mysql_fetch_array($result))
    {
       $newID = $row['MAX(AutomarkID)'] + 1;  // newID = MAX(AutomarkID) + 1
       echo "<br />";
    }
	
	?>
	
	<form name="insertAssnForm" id="insertAssnFormId" action="" method="GET">
		<table border="2">
		<tr>
			<td align="center"><label for="automarkIDLabel"><b>Automark ID:</b></label></td>
			<td align="center"><label for="automarkID"><?php print($newID); ?></label></td>  
			<td align="center"><label for="automarkIDType">int(11)</label></td>
		</tr>
		<tr>
			<td align="center"><label for="sampleSolnLabel"><b>* Sample Solution Directory:</b></label></td>
			<td align="center"><input type="text" name="sampleSoln" id="sampleSolnId" size="50" maxlength="200" /></td>
			<td align="center"><label for="sampleSolnType">varchar(200)</label></td>
		</tr>
		<tr>
			<td align="center"><label for="configsLabel"><b>* Configs:</b></label></td>			
			<td align="center"><textarea name="configs" cols="40" rows="10"></textarea></td>
			<td align="center"><label for="configsType">text</label></td>
		</tr>
		<td align="center"><label for="assnIDLabel"><b>Assignment ID:</b></label></td>
		<td align="center">	
			<select name="assnID">
			<?php
			$query = "SELECT AssnID FROM assignment";
			$result = mysql_query($query);
	
			while($row = mysql_fetch_array($result))
			{
			   ?> <option value="<?php print($row['AssnID']); ?>"><?php print($row['AssnID']); ?></option><?php
			}
			?>
			</select>
		</td>
		<td align="center"><label for="assnIDType">int(30)</label></td>

		</tr>
		
		</table>
		
		<br />
		<script src="admin_functions.js"></script>
		<input type="button" name="submitAutomarkButton" value="Insert New Automark" onclick="submitAutomark(this.form, '<?php print($newID) ?>', 'insert');" />

	</form>
	
	
	
	<?php
	
}


if ($table == "course")
{
	?>
	<h3><u>INSERT NEW ROW INTO 'course' TABLE</h3></u>
	<?php
	// Get largest assnID
	$query = "SELECT MAX(CourseID) FROM course";
    $result = mysql_query($query);
	
	while($row = mysql_fetch_array($result))
    {
       $newID = $row['MAX(CourseID)'] + 1;  // newID = MAX(AutomarkID) + 1
       echo "<br />";
    }
	
	?>
	
	<form name="insertCourseForm" id="insertCouseFormId" action="" method="GET">
		<table border="2">
		<tr>
			<td align="center"><label for="courseIDLabel"><b>Course ID:</b></label></td>
			<td align="center"><label for="courseID"><?php print($newID); ?></label></td>  
			<td align="center"><label for="courseIDType">int(4)</label></td>
		</tr>
		<tr>
			<td align="center"><label for="courseNameLabel"><b>* Course Name:</b></label></td>
			<td align="center"><input type="text" name="courseName" id="courseNameId" size="10" maxlength="10" /></td>
			<td align="center"><label for="courseNameType">varchar(10)</label></td>
		</tr>
		<tr>
			<td align="center"><label for="numStudentsLabel"><b>* Number of Students:</b></label></td>
			<td align="center"><input type="text" name="numStudents" id="numSutdentsId" size="4" maxlength="4" /></td>
			<td align="center"><label for="courseNameType">int(4)</label></td>
		</tr>
		<tr>
		<td align="center"><label for="semesterNameLabel"><b>Semester Name:</b></label></td>
		<td>
		<label for="seasonLabel"><b>Season:</b></label>
			<select name="season">
			<option value="Fall">Fall</option>
			<option value="Spring">Spring</option>
			<option value="Summer">Summer</option>
			</select>
			
			<label for="yearLabel"><b>Year:</b></label>
			<select name="year">
			<?php
			$year = 2011;
			while ($year <= 2037)
			{
				?> <option value="<?php print($year); ?>"><?php print($year); ?></option><?php
				$year++;
			}
			?>
			</select>
		</td>

		</tr>
		
		</table>
		
		<br />
		<script src="admin_functions.js"></script>
		<input type="button" name="submitCourseButton" value="Insert New Course" onclick="submitCourse(this.form, '<?php print($newID) ?>', 'insert');" />

	</form>
	
	
	
	<?php
	
}


if ($table == "group")
{
	?>
	<h3><u>INSERT NEW ROW INTO 'group' TABLE</h3></u>
	
	
	<form name="insertGroupForm" id="insertGroupFormId" action="" method="GET">
		<table border="2">
		<tr>
			<td align="center"><label for="courseNameLabel"><b>* Group Name:</b></label></td>
			<td align="center"><input type="text" name="groupName" id="courseNameId" size="50" maxlength="100" /></td>
			<td align="center"><label for="courseNameType">varchar(100)</label></td>
		</tr>
		<tr>
		<td align="center"><label for="assnIDLabel"><b>Assignment ID:</b></label></td>
		<td align="center">	
			<select name="assnID">
			<?php
			$query = "SELECT AssnID FROM assignment";
			$result = mysql_query($query);
	
			while($row = mysql_fetch_array($result))
			{
			   ?> <option value="<?php print($row['AssnID']); ?>"><?php print($row['AssnID']); ?></option><?php
			}
			?>
			</select>
		</td>
		<td align="center"><label for="assnIDType">int(30)</label></td>

		</tr>
		
		</table>
		
		<br />
		<script src="admin_functions.js"></script>
		<input type="button" name="submitGroupButton" value="Insert New Group" onclick="submitGroup(this.form, '0', '0', 'insert');" />

	</form>
	
	
	
	<?php	
}




if ($table == "instructor")
{
	?>
	<h3><u>INSERT NEW ROW INTO 'instructor' TABLE</h3></u>
	
	
	<form name="insertInstuctorForm" id="insertAssnFormId" action="" method="GET">
		<table border="2">
		<tr>
			<td align="center"><label for="assNameLabel"><b>* Instructor ID:</b></label></td>
			<td align="center"><input type="text" name="instructorID" id="assnNameId" size="20" maxlength="20" /></td>
			<td align="center"><label for="assnNameType">varchar(20)</label></td>
		</tr>	
		<tr>
			<td align="center"><label for="maxMarkLabel"><b>* First Name:</b></label></td>
			<td align="center"><input type="text" name="firstName" size="50" maxlength="100" /></td>
			<td align="center"><label for="maxMarkType">varchar(100)</label></td>
		</tr>
		<tr>
			<td align="center"><label for="avgMarkLabel"><b>* Last Name:<b></label></td>
			<td align="center"><input type="text" name="lastName" size="50" maxlength="100"/></td>
			<td align="center"><label for="avgMarkType">varchar(100)</label></td>
		</tr>
		<tr>
			<td align="center"><label for="medianMarkLabel"><b>* Phone Number:</b></label></td>
			<td align="center">(<input type="text" name="phone1" size="3" maxlength="3"/>) <input type="text" name="phone2" size="3" maxlength="3"/> - <input type="text" name="phone3" size="4" maxlength="4"/></td>
			
		</tr>
		<tr>
			<td align="center"><label for="avgMarkLabel"><b>* Office Location:<b></label></td>
			<td align="center"><input type="text" name="officeLocation" size="50" maxlength="100"/></td>
			<td align="center"><label for="avgMarkType">varchar(100)</label></td>
		</tr>
		<tr>
			<td align="center"><label for="avgMarkLabel"><b>* Email:<b></label></td>
			<td align="center"><input type="text" name="email" size="50" maxlength="100"/></td>
			<td align="center"><label for="avgMarkType">varchar(100)</label></td>
		</tr>
		
		</table>
		
		<br />
		<script src="admin_functions.js"></script>
		<input type="button" name="submitInstructorButton" value="Insert New Instructor" onclick="submitInstructor(this.form, '0', 'insert');" />

	</form>
	
	
	
	<?php
	
}



if ($table == "memberof")
{
	?>
	<h3><u>INSERT NEW ROW INTO 'memberof' TABLE</h3></u>
	
	
	<form name="insertInstuctorForm" id="insertAssnFormId" action="" method="GET">
		<table border="2">
		<tr>
		<td align="center"><label for="assnIDLabel"><b>Group Name:</b></label></td>
		<td align="center">	
			<select name="groupName">
			<?php
			$query = "SELECT GroupName FROM `group`";
			$result = mysql_query($query);
	
			while($row = mysql_fetch_array($result))
			{
			   ?> <option value="<?php print($row['GroupName']); ?>"><?php print($row['GroupName']); ?></option><?php
			}
			?>
			</select>
		</td>
		<td align="center"><label for="assnIDType">varchar(20)</label></td>

		</tr>
		<tr>
		<td align="center"><label for="assnIDLabel"><b>Student ID:</b></label></td>
		<td align="center">	
			<select name="studentID">
			<?php
			$query = "SELECT StudentID FROM `student`";
			$result = mysql_query($query);
	
			while($row = mysql_fetch_array($result))
			{
			   ?> <option value="<?php print($row['StudentID']); ?>"><?php print($row['StudentID']); ?></option><?php
			}
			?>
			</select>
		</td>
		<td align="center"><label for="assnIDType">varchar(20)</label></td>

		</tr>
		
		</tr>
		<tr>
		<td align="center"><label for="assnIDLabel"><b>Assignment ID:</b></label></td>
		<td align="center">	
			<select name="assnID">
			<?php
			$query = "SELECT AssnID FROM `assignment`";
			$result = mysql_query($query);
	
			while($row = mysql_fetch_array($result))
			{
			   ?> <option value="<?php print($row['AssnID']); ?>"><?php print($row['AssnID']); ?></option><?php
			}
			?>
			</select>
		</td>
		<td align="center"><label for="assnIDType">int(30)</label></td>

		</tr>
		
		
		</table>
		
		<br />
		<script src="admin_functions.js"></script>
		<input type="button" name="submitMemberofButton" value="Insert New Group Member" onclick="submitMemberof(this.form, '0', '0', '0', 'insert');" />

	</form>
	
	
	
	<?php
	
}



if ($table == "questions")
{
	?>
	<h3><u>INSERT NEW ROW INTO 'questions' TABLE</h3></u>
	<?php
	// Get largest questionID
	$query = "SELECT MAX(QuestionID) FROM `questions`";
    $result = mysql_query($query);
	
	while($row = mysql_fetch_array($result))
    {
       $newID = $row['MAX(QuestionID)'] + 1;  // newID = MAX(QuestionID) + 1
       echo "<br />";
    }
	
	?>
	
	<form name="insertAssnForm" id="insertAssnFormId" action="" method="GET">
		<table border="2">
		<tr>
			<td align="center"><label for="automarkIDLabel"><b>Question ID:</b></label></td>
			<td align="center"><label for="automarkID"><?php print($newID); ?></label></td>  
			<td align="center"><label for="automarkIDType">int(11)</label></td>
		</tr>
		<tr>
			<td align="center"><label for="sampleSolnLabel"><b>* Question Name:</b></label></td>
			<td align="center"><input type="text" name="questionName" id="sampleSolnId" size="20" maxlength="20" /></td>
			<td align="center"><label for="sampleSolnType">varchar(20)</label></td>
		</tr>
		<tr>
			<td align="center"><label for="sampleSolnLabel"><b>* Full Mark:</b></label></td>
			<td align="center"><input type="text" name="fullMark" id="sampleSolnId" size="11" maxlength="11" /></td>
			<td align="center"><label for="sampleSolnType">int(11)</label></td>
		</tr>
		<td align="center"><label for="assnIDLabel"><b>Assignment ID:</b></label></td>
		<td align="center">	
			<select name="assnID">
			<?php
			$query = "SELECT AssnID FROM assignment";
			$result = mysql_query($query);
	
			while($row = mysql_fetch_array($result))
			{
			   ?> <option value="<?php print($row['AssnID']); ?>"><?php print($row['AssnID']); ?></option><?php
			}
			?>
			</select>
		</td>
		<td align="center"><label for="assnIDType">int(30)</label></td>

		</tr>
		
		</table>
		
		<br />
		<script src="admin_functions.js"></script>
		<input type="button" name="submitAutomarkButton" value="Insert New Question" onclick="submitQuestion(this.form, '<?php print($newID) ?>', 'insert');" />

	</form>
	
	
	
	<?php
	
}



if ($table == "student")
{
	?>
	<h3><u>INSERT NEW ROW INTO 'student' TABLE</h3></u>
	
	
	<form name="insertAssnForm" id="insertAssnFormId" action="" method="GET">
		<table border="2">
		<tr>
			<td align="center"><label for="sampleSolnLabel"><b>* Student ID:</b></label></td>
			<td align="center"><input type="text" name="studentID" id="sampleSolnId" size="20" maxlength="20" /></td>
			<td align="center"><label for="sampleSolnType">varchar(20)</label></td>
		</tr>
		<tr>
			<td align="center"><label for="sampleSolnLabel"><b>* Major:</b></label></td>
			<td align="center"><input type="text" name="major" id="sampleSolnId" size="50" maxlength="50" /></td>
			<td align="center"><label for="sampleSolnType">varchar(50)</label></td>
		</tr>
		<tr>
			<td align="center"><label for="sampleSolnLabel"><b>* Last Name:</b></label></td>
			<td align="center"><input type="text" name="lastName" id="sampleSolnId" size="50" maxlength="100" /></td>
			<td align="center"><label for="sampleSolnType">varchar(100)</label></td>
		</tr>
		<tr>
			<td align="center"><label for="sampleSolnLabel"><b>* First Name:</b></label></td>
			<td align="center"><input type="text" name="firstName" id="sampleSolnId" size="50" maxlength="100" /></td>
			<td align="center"><label for="sampleSolnType">varchar(100)</label></td>
		</tr>
		</table>
		
		<br />
		<script src="admin_functions.js"></script>
		<input type="button" name="submitAutomarkButton" value="Insert New Student" onclick="submitStudent(this.form, '0', 'insert');" />

	</form>
	
	
	
	<?php
	
}


if ($table == "takes")
{
	?>
	<h3><u>INSERT NEW ROW INTO 'takes' TABLE</h3></u>
	
	
	<form name="insertGroupForm" id="insertGroupFormId" action="" method="GET">
		<table border="2">
		
		<td align="center"><label for="assnIDLabel"><b>Student ID:</b></label></td>
		<td align="center">	
			<select name="studentID">
			<?php
			$query = "SELECT StudentID FROM `student`";
			$result = mysql_query($query);
	
			while($row = mysql_fetch_array($result))
			{
			   ?> <option value="<?php print($row['StudentID']); ?>"><?php print($row['StudentID']); ?></option><?php
			}
			?>
			</select>
		</td>
		</tr>
		<td align="center"><label for="assnIDLabel"><b>Course ID:</b></label></td>
		<td align="center">	
			<select name="courseID">
			<?php
			$query = "SELECT CourseID FROM `course`";
			$result = mysql_query($query);
	
			while($row = mysql_fetch_array($result))
			{
			   ?> <option value="<?php print($row['CourseID']); ?>"><?php print($row['CourseID']); ?></option><?php
			}
			?>
			</select>
		</td>
		</tr>
		<tr>
			<td align="center"><label for="courseNameLabel"><b>Final Mark:</b></label></td>
			<td align="center">
			<select name="finalMark">
				<option value=""></option>
				<option value="Aplus">A+</option>
				<option value="A">A</option>
				<option value="A-">A-</option>
				<option value="Bplus">B+</option>
				<option value="B">B</option>
				<option value="B-">B-</option>
				<option value="Cplus">C+</option>
				<option value="C">C</option>
				<option value="C-">C-</option>
				<option value="Dplus">D+</option>
				<option value="D">D</option>
				<option value="D-">D-</option>
				<option value="F">F</option>
			</select>
			</td>
			
		</tr>
		<tr>
		
		</table>
		
		<br />
		<script src="admin_functions.js"></script>
		<input type="button" name="submitGroupButton" value="Insert New Takes Relation" onclick="submitTakes(this.form, '0', '0', 'insert');" />

	</form>
	
	
	
	<?php	
}


if ($table == "teaches")
{
	?>
	<h3><u>INSERT NEW ROW INTO 'teaches' TABLE</h3></u>
	
	
	<form name="insertGroupForm" id="insertGroupFormId" action="" method="GET">
		<table border="2">
		<td align="center"><label for="assnIDLabel"><b>Instructor ID:</b></label></td>
		<td align="center">	
		<select name="instructorID">
			<?php
			$query = "SELECT InstructorID FROM instructor";
			$result = mysql_query($query);
	
			while($row = mysql_fetch_array($result))
			{
			   ?> <option value="<?php print($row['InstructorID']); ?>"><?php print($row['InstructorID']); ?></option><?php
			}
			?>
		</select>
		</td>
		</tr>
		<tr>
		<td align="center"><label for="assnIDLabel"><b>Course ID:</b></label></td>
		<td align="center">	
			<select name="courseID">
			<?php
			$query = "SELECT CourseID FROM course";
			$result = mysql_query($query);
	
			while($row = mysql_fetch_array($result))
			{
			   ?> <option value="<?php print($row['CourseID']); ?>"><?php print($row['CourseID']); ?></option><?php
			}
			?>
			</select>
		</td>
		</tr>
		
		</table>
		
		<br />
		<script src="admin_functions.js"></script>
		<input type="button" name="submitGroupButton" value="Insert New Group" onclick="submitTeaches(this.form, '0', '0', 'insert');" />

	</form>
	
	
	
	<?php	
}


if ($table == "users")
{
	?>
	<h3><u>INSERT NEW ROW INTO 'users' TABLE</h3></u>
	
	
	<form name="insertAssnForm" id="insertAssnFormId" action="" method="GET">
		<table border="2">
		<tr>
			<td align="center"><label for="sampleSolnLabel"><b>* Username:</b></label></td>
			<td align="center"><input type="text" name="username" id="sampleSolnId" size="20" maxlength="20" /></td>
			<td align="center"><label for="sampleSolnType">varchar(20)</label></td>
		</tr>
		<tr>
			<td align="center"><label for="sampleSolnLabel"><b>* Password:</b></label></td>
			<td align="center"><input type="password" name="password1" id="sampleSolnId" size="50" maxlength="50" /></td>
			<td align="center"><label for="sampleSolnType">varchar(50)</label></td>
		</tr>
		<tr>
			<td align="center"><label for="sampleSolnLabel"><b>* Confirm Password:</b></label></td>
			<td align="center"><input type="password" name="password2" id="sampleSolnId" size="50" maxlength="50" /></td>
			<td align="center"><label for="sampleSolnType">varchar(50)</label></td>
		</tr>
		<tr>
			<td align="center"><label for="sampleSolnLabel"><b>* User Type:</b></label></td>
			<td align="center">
				<select name="userType">
				<option value=""></option>
				<option value="student">Student</option>
				<option value="instructor">Instructor</option>
				<option value="administrator">Administrator</option>
				</select>
			</td>
		</tr>
		</table>
		
		<br />
		<script src="admin_functions.js"></script>
		<input type="button" name="submitAutomarkButton" value="Insert New User" onclick="submitUser(this.form, '0', 'insert', '0');" />

	</form>
	
	
	
	<?php
	
}


?>
	<br />
	<div id="errorSpot"> </div>

