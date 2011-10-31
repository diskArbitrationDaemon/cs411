<?php
include 'includes/mysqlAdminLoginAssignment.php';
		
mysql_select_db($uiucDB) or die("Cannot connect to uiucDB.");


$table=$_GET["table"];
$rowID=$_GET["rowID"];



if ($table == "assignment")
{
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
	$dateArray = getdate($phpdate+(7*3600));   // Adjust Time to current timezone
	
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
		<td align="center"><label for="courseNameLabel"><b>Distributing Course:</b></label></td>
		<td align="center">	
			<select name="courseName">
			<?php
			$query = "SELECT courseName FROM course";
			$result = mysql_query($query);
	
			while($row = mysql_fetch_array($result))
			{
				//Get courseID for assignment's course
				$rowVar = $row['courseName'];
				$query = "SELECT CourseID FROM course WHERE CourseName = '$rowVar'";
				$result2 = mysql_query($query);
				$course_row = mysql_fetch_array($result2);
				$thisCourseID = $course_row['CourseID'];				
			
				if ($courseID == $thisCourseID)
				{
					?> <option value="<?php print($rowVar); ?>" selected="selected"><?php print($rowVar); ?></option><?php
				}
				else
				{
					?> <option value="<?php print($rowVar); ?>"><?php print($rowVar); ?></option><?php
				}
			}
			?>
			</select>
		</td>
		</tr>
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

	</form>
	
	<br />
		
	
	<?php
}

?>

	<br />
	<div id="errorSpot"> </div>