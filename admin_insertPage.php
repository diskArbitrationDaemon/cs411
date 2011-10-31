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
		<td align="center"><label for="courseNameLabel"><b>Distributing Course:</b></label></td>
		<td align="center">	
			<select name="courseName">
			<?php
			$query = "SELECT courseName FROM course";
			$result = mysql_query($query);
	
			while($row = mysql_fetch_array($result))
			{
			   ?> <option value="<?php print($row['courseName']); ?>"><?php print($row['courseName']); ?></option><?php
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

?>
	<br />
	<div id="errorSpot"> </div>

