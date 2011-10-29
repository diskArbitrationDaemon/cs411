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
	Echo("INSERT NEW ASSIGNMENT INTO 'assignment' TABLE:");
	
	// Get largest assnID
	$query = "SELECT MAX(assnID) FROM assignment";
    $result = mysql_query($query);
	
	while($row = mysql_fetch_array($result))
    {
       $newID = $row['MAX(assnID)'] + 1;  // newID = MAX(assnID) + 1
       echo "<br />";
    }
	
	?>
	<br />
	
	<form name="insertAssnForm" id="insertAssnFormId" action="" method="GET">
		<table>
		<tr>
			<td><label for="assnIDLabel">Assignment ID:</label></td>
			<td><label for="assnID"><?php print($newID); ?></label></td>  
			<td><label for="assnIDType">int(30)</label></td>
		</tr>
		<tr>
			<td><label for="assNameLabel">* Assignment Name:</label></td>
			<td><input type="text" name="assnName" id="assnNameId" size="30" maxlength="30" /></td>
			<td><label for="assnNameType">varchar(30)</label></td>
		</tr>
		<tr>
			<td><label for="groupWorkLabel">Number of Group Members Allowed:</label></td>
			<td>
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
			<td><label for="groupWorkType">tinyint(1)</label></td>
		</tr>
		
		
		<tr>
			<td><label for="maxMarkLabel">Max Mark:</label></td>
			<td><input type="text" name="maxMark" size="3" maxlength="3" /></td>
			<td><label for="maxMarkType">int(3)</label></td>
		</tr>
		<tr>
			<td><label for="avgMarkLabel">Average Mark:</label></td>
			<td><input type="text" name="avgMark" size="30" maxlength="30"/></td>
			<td><label for="avgMarkType">double</label></td>
		</tr>
		<tr>
			<td><label for="medianMarkLabel">Median Mark:</label></td>
			<td><input type="text" name="medianMark" size="30" maxlength="30"/></td>
			<td><label for="medianMarkType">double</label></td>
		</tr>
		<td><label for="courseNameLabel">Distributing Course:</label></td>
		<td>	
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
		<td><label for="dateLabel">Date Due:</label></td>
		<td><label for="monthNameLabel">Month:</label>
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
			
			<label for="dayNameLabel">Day:</label>
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
			
			<label for="yearLabel">Year:</label>
			<select name="year">
			<?php
			$year = 2011;
			while ($year <= 2099)
			{
				?> <option value="<?php print($year); ?>"><?php print($year); ?></option><?php
				$year++;
			}
			?>
			
			</select>
		</td>
		</tr>
		<td><label for="timeLabel">Time Due:</label></td>
		<td><label for="hourLabel">Hour:</label>
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
		
		<label for="minuteLabel">Minute:</label>
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
	
		<label for="secondLabel">Second:</label>
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
		
		
		
		<input type="button" name="submitAssnButton" value="Insert New Assignment" onclick="submitAssignment(this.form, '<?php print($newID) ?>');" />

	</form>
	
	<br />
		
	
	<?php
	
}



?>