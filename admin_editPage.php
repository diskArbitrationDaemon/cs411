<?php
include 'includes/mysqlAdminLoginAssignment.php';
		
mysql_select_db($uiucDB) or die("Cannot connect to uiucDB." . mysql_error());


$table=$_GET["table"];



if ($table == "assignment")
{
	$rowID=$_GET["rowID"];

	// Get data for default fields
	$query = "SELECT * FROM $table WHERE assnID=$rowID";
	$result = mysql_query($query);

	$row = mysql_fetch_array($result);
    $assnName = $row['AssnName'];
	$groupWork = $row['GroupWork'];
	$maxMark = $row['MaxMark'];
	$avgMark = $row['AvgMark'];
	$medianMark = $row['MedianMark'];
	$courseID = $row['CourseID'];
	$dueTime = $row['DueTime'];

	$phpdate = strtotime($dueTime);
	$dateArray = getdate($phpdate+(6*3600));   // Adjust Time to current timezone
	
	$year = $dateArray['year'];
	$month = $dateArray['mon'];
	$day = $dateArray['mday'];
	$hour = $dateArray['hours'];
	$minute = $dateArray['minutes'];
	$second = $dateArray['seconds'];
		
	?>
	<h3><u>EDIT ROW IN 'assignment' TABLE</h3></u>
	
	<br />
	
	<form name="editAssnForm" id="editAssnFormId" action="" method="GET">
		<table border="2">
		<tr>
			<td align="center"><label for="assnIDLabel"><b>Assignment ID:</b></label></td>
			<td align="center"><label for="assnID"><?php print($rowID); ?></label></td>  
			<td align="center"><label for="assnIDType">int(30)</label></td>
		</tr>
		<tr>
			<td align="center"><label for="assNameLabel"><b>* Assignment Name:</b></label></td>
			<td align="center"><input type="text" name="assnName" id="assnNameId" size="30" maxlength="30" value="<?php echo $assnName; ?>" /></td>
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
				if ($group == $groupWork)
				{
					?> <option value="<?php print($group); ?>" selected="selected"><?php print($group); ?> </option><?php
				}
				else
				{
					?> <option value="<?php print($group); ?>"><?php print($group); ?> </option><?php
				}
				$group++;
			}
			
			?>
			
			</select>
			</td>
			<td align="center"><label for="groupWorkType">tinyint(1)</label></td>
		</tr>
		
		
		<tr>
			<td align="center"><label for="maxMarkLabel"><b>Max Mark:</b></label></td>
			<td align="center"><input type="text" name="maxMark" size="3" maxlength="3" value=<?php print($maxMark) ?> /></td>
			<td align="center"><label for="maxMarkType">int(3)</label></td>
		</tr>
		<tr>
			<td align="center"><label for="avgMarkLabel"><b>Average Mark:</b></label></td>
			<td align="center"><input type="text" name="avgMark" size="30" maxlength="30" value=<?php print($avgMark) ?> /></td>
			<td align="center"><label for="avgMarkType">double</label></td>
		</tr>
		<tr>
			<td align="center"><label for="medianMarkLabel"><b>Median Mark:</b></label></td>
			<td align="center"><input type="text" name="medianMark" size="30" maxlength="30" value=<?php print($medianMark) ?> /></td>
			<td align="center"><label for="medianMarkType">double</label></td>
		</tr>
		<tr>
		<td align="center"><label for="courseNameLabel"><b>Distributing Course ID:</b></label></td>
		<td align="center">	
			<select name="courseID">
			<?php
			$query = "SELECT CourseID FROM `course`";
			$result = mysql_query($query);
	
			while($row = mysql_fetch_array($result))
			{
				if ($courseID == $row['CourseID'])
				{
					?> <option value="<?php print($row['CourseID']); ?>" selected="selected"><?php print($row['CourseID']); ?></option><?php
				}
				else
				{
					?> <option value="<?php print($row['CourseID']); ?>"><?php print($row['CourseID']); ?></option><?php
				}
			}
			?>
			</select>
		</td>
		</tr>
		<tr>
		<td align="center"><label for="dateLabel"><b>Date Due:</b></label></td>
		<td><label for="monthNameLabel"><b>Month:</b></label>
			<select name="monthName">
			<?php
			$monthNum = 1;
			while ($monthNum <= 12)
			{
				if ($month == $monthNum)
				{
					?> <option value="<?php print($monthNum); ?>" selected="selected"><?php print($monthNum); ?></option><?php
				}
				else
				{
					?> <option value="<?php print($monthNum); ?>"><?php print($monthNum); ?></option><?php
				}
				$monthNum++;
			}
			?>
			</select>
			
			<label for="dayNameLabel"><b>Day:</b></label>
			<select name="dayName">
			<?php
			$dayNum = 1;
			while ($dayNum <= 31)
			{
				if ($day == $dayNum)
				{
					?> <option value="<?php print($dayNum); ?>" selected="selected"><?php print($dayNum); ?></option><?php
				}
				else
				{
					?> <option value="<?php print($dayNum); ?>"><?php print($dayNum); ?></option><?php
				}
				$dayNum++;
			}
			?>
			</select>
			
			<label for="yearLabel"><b>Year:</b></label>
			<select name="year">
			<?php
			$yearNum = 2011;
			while ($yearNum <= 2099)
			{
				if ($year == $yearNum)
				{
					?> <option value="<?php print($yearNum); ?>" selected="selected"><?php print($yearNum); ?></option><?php
				}
				else
				{
					?> <option value="<?php print($yearNum); ?>"><?php print($yearNum); ?></option><?php
				}
				$yearNum++;
			}
			?>
			
			</select>
		</td>
		</tr>
		<tr>
		<td align="center"><label for="timeLabel"><b>Time Due:</b></label></td>
		<td><label for="hourLabel"><b>Hour:</b></label>
		<select name="hour">
		<?php
		$hourNum = 0;
		while ($hourNum <= 23)
		{
			if ($hour == $hourNum)
			{
				?> <option value="<?php print($hourNum); ?>" selected="selected"><?php print($hourNum); ?></option><?php
			}
			else
			{
				?> <option value="<?php print($hourNum); ?>"><?php print($hourNum); ?></option><?php
			}
			$hourNum++;
		}
		?>
		</select>
		
		<label for="minuteLabel"><b>Minute:</b></label>
		<select name="minute">
		<?php
		$minuteNum = 0;
		while ($minuteNum <= 59)
		{
			if ($minute == $minuteNum)
			{
				?> <option value="<?php print($minuteNum); ?>" selected="selected"><?php print($minuteNum); ?></option><?php
			}
			else
			{
				?> <option value="<?php print($minuteNum); ?>"><?php print($minuteNum); ?></option><?php
			}
			$minuteNum++;
		}
		?>
		</select>
	
		<label for="secondLabel"><b>Second:</b></label>
		<select name="second">
		<?php
		$secondNum = 0;
		while ($secondNum <= 59)
		{
			if ($second == $secondNum)
			{
				?> <option value="<?php print($secondNum); ?>" selected="selected"><?php print($secondNum); ?></option><?php
			}
			else
			{
				?> <option value="<?php print($secondNum); ?>"><?php print($secondNum); ?></option><?php
			}
			$secondNum++;
		}
		?>
		</select>	
		
		</td>
		</tr>
		</table>
		
		<br />
		<script src="admin_functions.js"></script>
		<input type="button" name="submitEditAssnButton" value="Confirm Changes" onclick="submitAssignment(this.form, '<?php print($rowID) ?>', 'edit');" />		
		<input type="button" name="goBackButton" value="Go Back" onclick="goBack('1');" />
	</form>
	
	<br />
		
	
	<?php
}


if ($table == "automarking")
{	
$rowID=$_GET["rowID"];

	// Get data for default fields
	$query = "SELECT * FROM $table WHERE AutomarkID=$rowID";
	$result = mysql_query($query);

	$row = mysql_fetch_array($result);
    $sampleSoln = $row['SampleSoln'];
	$configs = $row['Configs'];
	$assnID = $row['AssnID'];
		
	?>
	<h3><u>EDIT ROW IN 'automarking' TABLE</h3></u>
	
	<br />
	
	<form name="insertAssnForm" id="insertAssnFormId" action="" method="GET">
		<table border="2">
		<tr>
			<td align="center"><label for="automarkIDLabel"><b>Automark ID:</b></label></td>
			<td align="center"><label for="automarkID"><?php print($rowID); ?></label></td>  
			<td align="center"><label for="automarkIDType">int(11)</label></td>
		</tr>
		<tr>
			<td align="center"><label for="sampleSolnLabel"><b>* Sample Solution Directory:</b></label></td>
			<td align="center"><input type="text" name="sampleSoln" id="sampleSolnId" size="50" maxlength="200" value="<?php echo $sampleSoln; ?>"/></td>
			<td align="center"><label for="sampleSolnType">varchar(200)</label></td>
		</tr>
		<tr>
			<td align="center"><label for="configsLabel"><b>* Configs:</b></label></td>			
			<td align="center"><textarea name="configs" cols="40" rows="10" ><?php print($configs); ?></textarea></td>
			<td align="center"><label for="configsType">text</label></td>
		</tr>
		<tr>
		<td align="center"><label for="assnIDLabel"><b>AssnID:</b></label></td>
		<td align="center">	
			<select name="assnID">
			<?php
			$query = "SELECT AssnID FROM assignment";
			$result = mysql_query($query);
	
			while($row = mysql_fetch_array($result))
			{
				if ($assnID == $row['AssnID'])
				{
					?> <option value="<?php print($row['AssnID']); ?>" selected="selected"><?php print($row['AssnID']); ?></option><?php
				}
				else
				{
					?> <option value="<?php print($row['AssnID']); ?>"><?php print($row['AssnID']); ?></option><?php
				}
			}
			?>
			</select>
		</td>
		<td align="center"><label for="assnIDType">int(30)</label></td>

		</tr>
		
		</table>
		
		<br />
		<script src="admin_functions.js"></script>
		<input type="button" name="submitEditAutomarkButton" value="Confirm Changes" onclick="submitAutomark(this.form, '<?php print($rowID) ?>', 'edit');" />		
		<input type="button" name="goBackButton" value="Go Back" onclick="goBack('2');" />
	</form>
	
	<br />
		
	
	<?php
}



if ($table == "course")
{	
$rowID=$_GET["rowID"];

	// Get data for default fields
	$query = "SELECT * FROM $table WHERE CourseID=$rowID";
	$result = mysql_query($query);

	$row = mysql_fetch_array($result);
    $courseName = $row['CourseName'];
	$semesterName = $row['SemesterName'];
		
	$season = substr($semesterName, 0, -2);
	$yearEnd = substr($semesterName, -2);
	$year = "20" . $yearEnd;

	
	?>
	<h3><u>EDIT ROW IN 'course' TABLE</h3></u>
	
	<br />
	
	<form name="insertCourseForm" id="insertAssnFormId" action="" method="GET">
		<table border="2">
		<tr>
			<td align="center"><label for="courseIDLabel"><b>Course ID:</b></label></td>
			<td align="center"><label for="courseID"><?php print($rowID); ?></label></td>  
			<td align="center"><label for="courseIDType">int(4)</label></td>
		</tr>
		<tr>
			<td align="center"><label for="courseNameLabel"><b>* Course Name:</b></label></td>
			<td align="center"><input type="text" name="courseName" id="courseNameId" size="50" maxlength="100" value="<?php echo $courseName; ?>"/></td>
			<td align="center"><label for="courseNameType">varchar(100)</label></td>
		</tr>
		
		<tr>
		<td align="center"><label for="semesterNameLabel"><b>Semester Name:</b></label></td>
		<td>
		<label for="seasonLabel"><b>Season:</b></label>
			<select name="season">
			<?php
			if ($season == "Fall"){ ?>
				<option value="Fall" selected="selected">Fall</option>
				<option value="Spring">Spring</option>
				<option value="Summer">Summer</option>
			<?php }
			else if ($season == "Spring"){ ?>
				<option value="Fall">Fall</option>
				<option value="Spring" selected="selected">Spring</option>
				<option value="Summer">Summer</option>
				<?php } 
			else if ($season == "Summer"){ ?>
				<option value="Fall">Fall</option>
				<option value="Spring">Spring</option>
				<option value="Summer" selected="selected">Summer</option> <?php } ?>
			</select>
			
			<label for="yearLabel"><b>Year:</b></label>
			<select name="year">
			<?php
			$yearNum = 2011;
			while ($yearNum <= 2037)
			{
				if ($year == $yearNum)
				{
					?> <option value="<?php print($yearNum); ?>" selected="selected"><?php print($yearNum); ?></option><?php
				}
				else
				{
					?> <option value="<?php print($yearNum); ?>"><?php print($yearNum); ?></option><?php
				}
				$yearNum++;
			}
			?>
			</select>
		</td>

		</tr>
		
		</table>
		<br />
		<script src="admin_functions.js"></script>
		<input type="button" name="submitEditCourseButton" value="Confirm Changes" onclick="submitCourse(this.form, '<?php print($rowID) ?>', 'edit');" />		
		<input type="button" name="goBackButton" value="Go Back" onclick="goBack('3');" />
	</form>
	
	<br />
		
	
	<?php
}





if ($table == "group")
{
	$rowID=$_GET["rowID"];
	$rowIDtwo=$_GET["rowIDtwo"];

	// Get data for default fields
	$query = "SELECT * FROM `" . $table . "` WHERE GroupName='$rowID' AND AssnID='$rowIDtwo'";
	$result = mysql_query($query);

	$row = mysql_fetch_array($result);
    $groupName = $row['GroupName'];
	$assnID = $row['AssnID'];

	
	?>
	<h3><u>EDIT ROW IN 'group' TABLE</h3></u>
	
	<br />
	
	<form name="insertCourseForm" id="insertAssnFormId" action="" method="GET">
		<table border="2">
		<tr>
			<td align="center"><label for="courseNameLabel"><b>* Group Name:</b></label></td>
			<td align="center"><input type="text" name="groupName" id="courseNameId" size="50" maxlength="100" value="<?php echo $groupName; ?>" /></td>
			<td align="center"><label for="courseNameType">varchar(100)</label></td>
		</tr>
		<tr>
		<td align="center"><label for="assnIDLabel"><b>AssnID:</b></label></td>
		<td align="center">	
			<select name="assnID">
			<?php
			$query = "SELECT AssnID FROM assignment";
			$result = mysql_query($query);
	
			while($row = mysql_fetch_array($result))
			{
				if ($assnID == $row['AssnID'])
				{
					?> <option value="<?php print($row['AssnID']); ?>" selected="selected"><?php print($row['AssnID']); ?></option><?php
				}
				else
				{
					?> <option value="<?php print($row['AssnID']); ?>"><?php print($row['AssnID']); ?></option><?php
				}
			}
			?>
			</select>
		</td>
		<td align="center"><label for="assnIDType">int(30)</label></td>

		</tr>
		
		</table>
		
		
		<br />
		<script src="admin_functions.js"></script>
		<input type="button" name="submitEditButton" value="Confirm Changes" onclick="submitGroup(this.form, '<?php print($groupName) ?>', '<?php print($assnID) ?>', 'edit');" />		
		<input type="button" name="goBackButton" value="Go Back" onclick="goBack('4');" />
	</form>
	
	<br />
		
	
	<?php
}


if ($table == "instructor")
{	
	$rowID=$_GET["rowID"];

	// Get data for default fields
	$query = "SELECT * FROM $table WHERE InstructorID='$rowID'";
	$result = mysql_query($query);

	$row = mysql_fetch_array($result);
    $firstName = $row['FirstName'];
	$lastName = $row['LastName'];
	$phoneNumber = $row['PhoneNumber'];
	$officeLocation = $row['OfficeLocation'];
	$email = $row['Email'];
	
	$phone1 = substr($phoneNumber, 0, 3);
	$phone2 = substr($phoneNumber, 3, 3);
	$phone3 = substr($phoneNumber, 6, 4);
	
	$users_uiucDB = "assignments_users_uiuc";	
	mysql_select_db($users_uiucDB) or die("Cannot connect to assignments_uiuc database.");
		
	$query = "SELECT * FROM `users` WHERE Username = '$rowID'";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result))
	{
		$username = $row['Username'];	
	}
	
	$users_uiucDB = "assignments_uiuc";	
	mysql_select_db($users_uiucDB) or die("Cannot connect to assignments_uiuc database.");
	
	
	?>
	<h3><u>EDIT ROW IN 'instructor' TABLE</h3></u>
	
	<br />
	
	<form name="insertAssnForm" id="insertAssnFormId" action="" method="GET">
		<table border="2">
		<tr>
			<td align="center"><label for="assNameLabel"><b>* Instructor ID:</b></label></td>
			<td align="center"><label for="instructorID"><?php print($rowID); ?></label></td>  
			<td align="center"><label for="assnNameType">varchar(20)</label></td>
		</tr>
		<tr>
			<td align="center"><label for="maxMarkLabel"><b>* First Name:</b></label></td>
			<td align="center"><input type="text" name="firstName" size="50" maxlength="100" value="<?php echo $firstName; ?>"/></td>
			<td align="center"><label for="maxMarkType">varchar(100)</label></td>
		</tr>
		<tr>
			<td align="center"><label for="avgMarkLabel"><b>* Last Name:<b></label></td>
			<td align="center"><input type="text" name="lastName" size="50" maxlength="100" value="<?php echo $lastName; ?>"/></td>
			<td align="center"><label for="avgMarkType">varchar(100)</label></td>
		</tr>
		<tr>
			<td align="center"><label for="medianMarkLabel"><b>* Phone Number:</b></label></td>
			<td align="center">(<input type="text" name="phone1" size="3" maxlength="3" value="<?php echo $phone1; ?>"/>) <input type="text" name="phone2" size="3" maxlength="3" value="<?php echo $phone2; ?>"/> - <input type="text" name="phone3" size="4" maxlength="4" value="<?php echo $phone3; ?>"/></td>
			
		</tr>
		<tr>
			<td align="center"><label for="avgMarkLabel"><b>* Office Location:<b></label></td>
			<td align="center"><input type="text" name="officeLocation" size="50" maxlength="100" value="<?php echo $officeLocation; ?>"/></td>
			<td align="center"><label for="avgMarkType">varchar(100)</label></td>
		</tr>
		<tr>
			<td align="center"><label for="avgMarkLabel"><b>* Email:<b></label></td>
			<td align="center"><input type="text" name="email" size="50" maxlength="100" value="<?php echo $email; ?>"/></td>
			<td align="center"><label for="avgMarkType">varchar(100)</label></td>
		</tr>
		<tr>
			<td align="center"><label for="assNameLabel"><b>Username:</b></label></td>
			<td align="center"><label for="instructorID"><?php print($rowID); ?></label></td>  
		</tr>
		
		
		
		</table>
		
		
		
		<br />
		<script src="admin_functions.js"></script>
		<input type="button" name="submitEditInstructorButton" value="Confirm Changes" onclick="submitInstructor(this.form, '<?php print($rowID) ?>', 'edit');" />		
		<input type="button" name="goBackButton" value="Go Back" onclick="goBack('5');" />
	</form>
	
	<br />
		
	
	<?php
}



if ($table == "memberof")
{
	$rowID=$_GET["rowID"];
	$rowIDtwo=$_GET["rowIDtwo"];
	$rowIDthree=$_GET["rowIDthree"];
	
	// Get data for default fields
	$query = "SELECT * FROM `" . $table . "` WHERE GroupName='$rowID' AND StudentID='$rowIDtwo' AND AssnID='$rowIDthree'";
	$result = mysql_query($query);

	$row = mysql_fetch_array($result);
    $groupName = $row['GroupName'];
	$studentID = $row['StudentID'];
	$assnID = $row['AssnID'];

	
	?>
	<h3><u>EDIT ROW IN 'memberof' TABLE</h3></u>
	
	<br />
	
	<form name="insertCourseForm" id="insertAssnFormId" action="" method="GET">
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
				if ($groupName == $row['GroupName'])
				{
					?> <option value="<?php print($row['GroupName']); ?>" selected="selected"><?php print($row['GroupName']); ?></option><?php
				}
				else
				{
					?> <option value="<?php print($row['GroupName']); ?>"><?php print($row['GroupName']); ?></option><?php
				}
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
				if ($studentID == $row['StudentID'])
				{
					?> <option value="<?php print($row['StudentID']); ?>" selected="selected"><?php print($row['StudentID']); ?></option><?php
				}
				else
				{
					?> <option value="<?php print($row['StudentID']); ?>"><?php print($row['StudentID']); ?></option><?php
				}
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
				if ($assnID == $row['AssnID'])
				{
					?> <option value="<?php print($row['AssnID']); ?>" selected="selected"><?php print($row['AssnID']); ?></option><?php
				}
				else
				{
					?> <option value="<?php print($row['AssnID']); ?>"><?php print($row['AssnID']); ?></option><?php
				}
			}
			?>
			</select>
		</td>
		<td align="center"><label for="assnIDType">int(30)</label></td>

		</tr>
		
		
		</table>
		
		
		<br />
		<script src="admin_functions.js"></script>
		<input type="button" name="submitEditButton" value="Confirm Changes" onclick="submitMemberof(this.form, '<?php print($groupName) ?>', '<?php print($studentID) ?>', '<?php print($assnID) ?>', 'edit');" />		
		<input type="button" name="goBackButton" value="Go Back" onclick="goBack('6');" />
	</form>
	
	<br />
		
	<?php
}



if ($table == "questions")
{	
	$rowID=$_GET["rowID"];

	// Get data for default fields
	$query = "SELECT * FROM $table WHERE QuestionID=$rowID";
	$result = mysql_query($query);

	$row = mysql_fetch_array($result);
    $questionName = $row['QuestionName'];
	$fullMark = $row['FullMark'];
	$assnID = $row['AssnID'];
		
	?>
	<h3><u>EDIT ROW IN 'questions' TABLE</h3></u>
	
	<br />
	
	<form name="insertAssnForm" id="insertAssnFormId" action="" method="GET">
		<table border="2">
		<tr>
			<td align="center"><label for="automarkIDLabel"><b>Question ID:</b></label></td>
			<td align="center"><label for="automarkID"><?php print($rowID); ?></label></td>  
			<td align="center"><label for="automarkIDType">int(11)</label></td>
		</tr>
		<tr>
			<td align="center"><label for="sampleSolnLabel"><b>* Question Name:</b></label></td>
			<td align="center"><input type="text" name="questionName" id="sampleSolnId" size="20" maxlength="20" value="<?php echo $questionName; ?>"/></td>
			<td align="center"><label for="sampleSolnType">varchar(20)</label></td>
		</tr>
		<tr>
			<td align="center"><label for="sampleSolnLabel"><b>* Full Mark:</b></label></td>
			<td align="center"><input type="text" name="fullMark" id="sampleSolnId" size="11" maxlength="11" value="<?php echo $fullMark; ?>"/></td>
			<td align="center"><label for="sampleSolnType">int(11)</label></td>
		</tr>
		<td align="center"><label for="assnIDLabel"><b>Assignment ID:</b></label></td>
		<td align="center">	
			<select name="assnID">
			<?php
			$query = "SELECT AssnID FROM `assignment`";
			$result = mysql_query($query);
	
			while($row = mysql_fetch_array($result))
			{
				if ($assnID == $row['AssnID'])
				{
					?> <option value="<?php print($row['AssnID']); ?>" selected="selected"><?php print($row['AssnID']); ?></option><?php
				}
				else
				{
					?> <option value="<?php print($row['AssnID']); ?>"><?php print($row['AssnID']); ?></option><?php
				}
			}
			?>
			</select>
		</td>
		<td align="center"><label for="assnIDType">int(30)</label></td>

		</tr>
		
		</table>
		
		<br />
		<script src="admin_functions.js"></script>
		<input type="button" name="submitEditAutomarkButton" value="Confirm Changes" onclick="submitQuestion(this.form, '<?php print($rowID) ?>', 'edit');" />		
		<input type="button" name="goBackButton" value="Go Back" onclick="goBack('7');" />
	</form>
	
	<br />
		
	
	<?php
}



if ($table == "student")
{	
	$rowID=$_GET["rowID"];

	// Get data for default fields
	$query = "SELECT * FROM $table WHERE StudentID='$rowID'";
	$result = mysql_query($query);

	$row = mysql_fetch_array($result);
    $major = $row['Major'];
	$lastName = $row['LastName'];
	$firstName = $row['FirstName'];
		
	?>
	<h3><u>EDIT ROW IN 'student' TABLE</h3></u>
	
	<br />
	
	<form name="insertAssnForm" id="insertAssnFormId" action="" method="GET">
		<table border="2">
		<tr>
			<td align="center"><label for="sampleSolnLabel"><b>* Student ID:</b></label></td>
			<td align="center"><label for="studentID"><?php print($rowID); ?></label></td>  
			<td align="center"><label for="sampleSolnType">varchar(20)</label></td>
		</tr>
		<tr>
			<td align="center"><label for="sampleSolnLabel"><b>* Major:</b></label></td>
			<td align="center"><input type="text" name="major" id="sampleSolnId" size="50" maxlength="50" value="<?php echo $major; ?>"/></td>
			<td align="center"><label for="sampleSolnType">varchar(50)</label></td>
		</tr>
		<tr>
			<td align="center"><label for="sampleSolnLabel"><b>* Last Name:</b></label></td>
			<td align="center"><input type="text" name="lastName" id="sampleSolnId" size="50" maxlength="100" value="<?php echo $lastName; ?>"/></td>
			<td align="center"><label for="sampleSolnType">varchar(100)</label></td>
		</tr>
		<tr>
			<td align="center"><label for="sampleSolnLabel"><b>* First Name:</b></label></td>
			<td align="center"><input type="text" name="firstName" id="sampleSolnId" size="50" maxlength="100" value="<?php echo $firstName; ?>"/></td>
			<td align="center"><label for="sampleSolnType">varchar(100)</label></td>
		</tr>
		<tr>
			<td align="center"><label for="assNameLabel"><b>Username:</b></label></td>
			<td align="center"><label for="instructorID"><?php print($rowID); ?></label></td>  
		</tr>
		</table>
		
		<br />
		<script src="admin_functions.js"></script>
		<input type="button" name="submitEditAutomarkButton" value="Confirm Changes" onclick="submitStudent(this.form, '<?php print($rowID) ?>', 'edit');" />		
		<input type="button" name="goBackButton" value="Go Back" onclick="goBack('8');" />
	</form>
	
	<br />
		
	
	<?php
}


if ($table == "takes")
{
	$rowID=$_GET["rowID"];
	$rowIDtwo=$_GET["rowIDtwo"];

	// Get data for default fields
	$query = "SELECT * FROM `" . $table . "` WHERE StudentID='$rowID' AND CourseID='$rowIDtwo'";
	$result = mysql_query($query);

	$row = mysql_fetch_array($result);
    $studentID = $row['StudentID'];
	$courseID = $row['CourseID'];
	$finalMark = $row['FinalMark'];

	
	?>
	<h3><u>EDIT ROW IN 'takes' TABLE</h3></u>
	
	<br />
	
	<form name="insertCourseForm" id="insertAssnFormId" action="" method="GET">
		<table border="2">
		
		<td align="center"><label for="assnIDLabel"><b>Student ID:</b></label></td>
		<td align="center">	
			<select name="studentID">
			<?php
			$query = "SELECT StudentID FROM `student`";
			$result = mysql_query($query);
	
			while($row = mysql_fetch_array($result))
			{
				if ($studentID == $row['StudentID'])
				{
					?> <option value="<?php print($row['StudentID']); ?>" selected="selected"><?php print($row['StudentID']); ?></option><?php
				}
				else
				{
					?> <option value="<?php print($row['StudentID']); ?>"><?php print($row['StudentID']); ?></option><?php
				}
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
				if ($courseID == $row['CourseID'])
				{
					?> <option value="<?php print($row['CourseID']); ?>" selected="selected"><?php print($row['CourseID']); ?></option><?php
				}
				else
				{
					?> <option value="<?php print($row['CourseID']); ?>"><?php print($row['CourseID']); ?></option><?php
				}
			}
			?>
			</select>
		</td>
		</tr>
		<tr>
			<td align="center"><label for="courseNameLabel"><b>Final Mark:</b></label></td>
			<td align="center">
			<select name="finalMark">
				<?php if ($finalMark == ""){ ?>
					<option value="" selected="selected"></option>
				<?php }else{ ?>
					<option value=""></option>
				<?php	}
				if ($finalMark == "A+"){ ?>
					<option value="Aplus" selected="selected">A+</option>
				<?php }else{ ?>
					<option value="Aplus">A+</option>
				<?php	}
				if ($finalMark == "A"){ ?>
					<option value="A" selected="selected">A</option>
				<?php }else{ ?>
					<option value="A">A</option>
				<?php	}
				if ($finalMark == "A-"){ ?>
					<option value="A-" selected="selected">A-</option>
				<?php }else{ ?>
					<option value="A-">A-</option>
				<?php	}
				if ($finalMark == "B+"){ ?>
					<option value="Bplus" selected="selected">B+</option>
				<?php }else{ ?>
					<option value="Bplus">B+</option>
				<?php	}				
				if ($finalMark == "B"){ ?>
					<option value="B" selected="selected">B</option>
				<?php }else{ ?>
					<option value="B">B</option>
				<?php	}
				if ($finalMark == "B-"){ ?>
					<option value="B-" selected="selected">B-</option>
				<?php }else{ ?>
					<option value="B-">B-</option>
				<?php	}
				if ($finalMark == "C+"){ ?>
					<option value="Cplus" selected="selected">C+</option>
				<?php }else{ ?>
					<option value="Cplus">C+</option>
				<?php	}
				if ($finalMark == "C"){ ?>
					<option value="C" selected="selected">C</option>
				<?php }else{ ?>
					<option value="C">C</option>
				<?php	}
				if ($finalMark == "C-"){ ?>
					<option value="C-" selected="selected">C-</option>
				<?php }else{ ?>
					<option value="C-">C-</option>
				<?php	}
				if ($finalMark == "D+"){ ?>
					<option value="Dplus" selected="selected">D+</option>
				<?php }else{ ?>
					<option value="Dplus">D+</option>
				<?php	}
				if ($finalMark == "D"){ ?>
					<option value="D" selected="selected">D</option>
				<?php }else{ ?>
					<option value="D">D</option>
				<?php	}
				if ($finalMark == "D-"){ ?>
					<option value="D-" selected="selected">D-</option>
				<?php }else{ ?>
					<option value="D-">D-</option>
				<?php	}
				if ($finalMark == "F"){ ?>
					<option value="F" selected="selected">F</option>
				<?php }else{ ?>
					<option value="F">F</option>
				<?php	} ?>
				
			</select>
			</td>
			
		</tr>
		<tr>
		
		</table>
		
		
		<br />
		<script src="admin_functions.js"></script>
		<input type="button" name="submitEditButton" value="Confirm Changes" onclick="submitTakes(this.form, '<?php print($studentID) ?>', '<?php print($courseID) ?>', 'edit');" />		
		<input type="button" name="goBackButton" value="Go Back" onclick="goBack('10');" />
	</form>
	
	<br />
		
	
	<?php
}


if ($table == "teaches")
{
	$rowID=$_GET["rowID"];
	$rowIDtwo=$_GET["rowIDtwo"];

	// Get data for default fields
	$query = "SELECT * FROM `" . $table . "` WHERE InstructorID='$rowID' AND CourseID='$rowIDtwo'";
	$result = mysql_query($query);

	$row = mysql_fetch_array($result);
    $instructorID = $row['InstructorID'];
	$courseID = $row['CourseID'];

	
	?>
	<h3><u>EDIT ROW IN 'teaches' TABLE</h3></u>
	
	<br />
	
	<form name="insertCourseForm" id="insertAssnFormId" action="" method="GET">
		<table border="2">
		<td align="center"><label for="assnIDLabel"><b>Instructor ID:</b></label></td>
		<td align="center">	
		<select name="instructorID">
			<?php
			$query = "SELECT InstructorID FROM `instructor`";
			$result = mysql_query($query);
	
			while($row = mysql_fetch_array($result))
			{
				if ($instructorID == $row['InstructorID'])
				{
					?> <option value="<?php print($row['InstructorID']); ?>" selected="selected"><?php print($row['InstructorID']); ?></option><?php
				}
				else
				{
					?> <option value="<?php print($row['InstructorID']); ?>"><?php print($row['InstructorID']); ?></option><?php
				}
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
			$query = "SELECT CourseID FROM `course`";
			$result = mysql_query($query);
	
			while($row = mysql_fetch_array($result))
			{
				if ($courseID == $row['CourseID'])
				{
					?> <option value="<?php print($row['CourseID']); ?>" selected="selected"><?php print($row['CourseID']); ?></option><?php
				}
				else
				{
					?> <option value="<?php print($row['CourseID']); ?>"><?php print($row['CourseID']); ?></option><?php
				}
			}
			?>
			</select>
		</td>
		</tr>
		
		</table>
		
		
		<br />
		<script src="admin_functions.js"></script>
		<input type="button" name="submitEditButton" value="Confirm Changes" onclick="submitTeaches(this.form, '<?php print($instructorID) ?>', '<?php print($courseID) ?>', 'edit');" />		
		<input type="button" name="goBackButton" value="Go Back" onclick="goBack('11');" />
	</form>
	
	<br />
		
	
	<?php
}


if ($table == "users")
{	
	$rowID=$_GET["rowID"];
	
	$users_uiucDB = "assignments_users_uiuc";	
	mysql_select_db($users_uiucDB) or die("Cannot connect to assignments_uiuc database.");
	
	// Get data for default fields
	$query = "SELECT * FROM `$table` WHERE Username='$rowID'";
	$result = mysql_query($query);

	$row = mysql_fetch_array($result);
    $password = $row['Password'];
	$userType = $row['UserType'];
	
	?>
	<h3><u>EDIT ROW IN 'users' TABLE</h3></u>
	
	<br />
	
	<form name="insertCourseForm" id="insertAssnFormId" action="" method="GET">
		<table border="2">
		<tr>
			<td align="center"><label for="sampleSolnLabel"><b>Username:</b></label></td>
			<td align="center"><label for="username"><?php print($rowID); ?></label></td>  
			<td align="center"><label for="sampleSolnType">varchar(20)</label></td>
		</tr>
		<tr>
			<td align="center"><label for="sampleSolnLabel"><b>* Password:</b></label></td>
			<td align="center"><input type="text" name="password1" id="sampleSolnId" size="50" maxlength="50" value="<?php echo $password; ?>"/></td>
			<td align="center"><label for="sampleSolnType">varchar(50)</label></td>
		</tr>
		<tr>
			<td align="center"><label for="sampleSolnLabel"><b>* Confirm Password:</b></label></td>
			<td align="center"><input type="text" name="password2" id="sampleSolnId" size="50" maxlength="50" value="<?php echo $password; ?>"/></td>
			<td align="center"><label for="sampleSolnType">varchar(50)</label></td>
		</tr>
		<tr>
			<td align="center"><label for="sampleSolnLabel"><b>Grant Admin Permission:</b></label></td>
			<td align="center">
				<select name="adminPerm">
				<?php
				$isAdmin = $userType & 1;
				
				if ($isAdmin == 0){ ?>
					<option value="no" selected="selected">No</option>
				<?php }else{ ?>
					<option value="no">No</option>
				<?php	}
				if ($isAdmin == 1){ ?>
					<option value="yes" selected="selected">Yes</option>
				<?php }else{ ?>
					<option value="yes">Yes</option> <?php } ?>
				</select>
			</td>
		</tr>
		</table>
		<br />
		<script src="admin_functions.js"></script>
		<input type="button" name="submitEditCourseButton" value="Confirm Changes" onclick="submitUser(this.form, '<?php print($rowID) ?>', 'edit', '<?php print($password) ?>');" />		
		<input type="button" name="goBackButton" value="Go Back" onclick="goBack('12');" />
	</form>
	
	<br />
		
	
	<?php
}

?>

	<br />
	<div id="errorSpot"> </div>
