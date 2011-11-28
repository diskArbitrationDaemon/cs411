<?php
	
	include ('includes/mysqlInstrLogin.php');
	include ('includes/auth.php');
	
	//automarks any questions that have AssnID in the URL
	//checks if the instructor has access
	$query = "SELECT * FROM Assignment as a, Course as c, Teaches as t, Instructor as i WHERE
	    i.InstructorID='$_SESSION[username]' AND
	    t.InstructorID=i.InstructorID AND
	    a.CourseID=c.courseID AND
	    t.courseID=c.courseID AND
	    a.AssnID=$_GET[AssnID]";
	$result = mysql_query($query);
	if (mysql_errno()) die ("error authenticating." . mysql_error());
	if (empty($_GET['AssnID'])) die ("Undefined AssnID.");
	
	//get all questions from Automark table based on AssnID
	$query = "SELECT * FROM Automarking, Questions WHERE
    Automarking.QuestionID = Questions.QuestionID AND
    Questions.AssnID='".$_GET['AssnID']."'";

	$result = mysql_query($query);
	if (mysql_errno()) die ("Error finding questions for Automarking" . mysql_error());
	
	$automarkQuestions = array();
	$index = 0;
	while ($rows = mysql_fetch_array($result)){
		$automarkQuestions[$index] = $rows['QuestionID'];
		$index++;
	}
	
	$assnID = $_GET['AssnID'];

	//find submissions for this assignment
	
	$query = "SELECT * FROM Submission WHERE AssnID='$assnID'";
	$result = mysql_query($query);
	if (mysql_errno()) die ("Coudl not select all submissions. " . mysql_error());
	$index = 0;
	$submissions = array();
	
	while ($row = mysql_fetch_array($result)){
		$submissions[$index]['studentID'] = $row['StudentID'];
		$submissions[$index]['submissionDir'] = $row['Files'];
		$index++;
	}
	
	//print_r ($automarkQuestions);
	//print_r ($submissions);
		
	foreach ($automarkQuestions as $key=>$questionID){
		$query = "SELECT * FROM automarking WHERE QuestionID=$questionID";
		$result = mysql_query ($query);
		if (mysql_errno()) die ("Cannot select question from Automarking table. Automarking halted. <br>\n" . mysql_error());
		$row = mysql_fetch_array($result);
		$sampleSolution = getcwd() . "/" . $row['SampleSolnFile'];
		$scriptFile = getcwd(). "/". $row['ScriptFile'];
		
		//foreach submission and question, run the shell script, then save output, and then diff
		foreach ($submissions as $key=>$submission){
			$studentID = $submission['studentID'];
			$submissionDir = $submission['submissionDir'];
			//print ("executing...<br>");
			//print ("Current working dir: " . getcwd() . "<br> cd \"$submissionDir\"; \"$scriptFile\"");
		
			$output = shell_exec("cd \"$submissionDir\"; \"$scriptFile\"");
			$fileName = $submissionDir."/"."__". $studentID ."Output.txt";
			$handle = fopen($fileName, 'w');
			fwrite($handle, $output);
			fclose($handle);
			$marksLost = numMarksLost($questionID, $studentID, $sampleSolution, $fileName, $submissionDir, 5);
			
			print ("Number of marks lost for $studentID is $marksLost<br>");
			
			//////update results ////
			
			//find full mark of questions
			$query = "SELECT FullMark FROM Questions WHERE QuestionID=$questionID";
			$result = mysql_query($query);
			if (mysql_errno()) die ("Could not find questionID. " . mysql_error());
			$row = mysql_fetch_array($result);
			$fullMark = $row['FullMark'];
			
			$marksRemaining = $fullMark - $marksLost;
			if ($marksRemaining < 0) $marksRemaining = 0;
			$query = "INSERT into results VALUES ('$studentID', '$questionID', '$marksRemaining') ON DUPLICATE KEY UPDATE Mark='$marksRemaining'";
			$result = mysql_query($query);
			if (mysql_errno()) die ("Error inserting mark into the database. " . mysql_error());
			
		}
		
				
	}
	
	print ("Automarking done!<br>\n Click <a href=\"instr_viewAssns.html\">here</a> to go back to assignments page.");
	
	print ("<meta http-equiv=\"REFRESH\" content=\"60;url=instr_viewAssns.html\">");
	
	
	function numMarksLost($questionID, $studentID, $sampleOutput, $studentOutput, $submissionDir, $marksLostPerDiff){
	
		$query = "SELECT AssnName, QuestionName, CourseName, SemesterName FROM questions as q, course as c, assignment as a WHERE 
		q.QuestionID='$questionID' AND
		q.AssnID=a.AssnID AND
		c.CourseID=a.CourseID";
		
		$result = mysql_query($query);
		if (mysql_errno()) die ("Error retrieving question for automarking. " . mysql_error());
		
		$row = mysql_fetch_array($result);
		$assnName = $row['AssnName'];
		$courseName = $row['CourseName'];
		$semesterName = $row['SemesterName'];
		$questionName = $row['QuestionName'];
		
		//$studentOutput = "TestAuto/$sampleOutputName";
		//$sampleOutput = "TestAuto/$studentOutputName";
		//print "diff |$studentOutput| |$sampleOutput|<br>";
		$output = "                    YOUR OUTPUT IS ON THE LEFT               ||                   SAMPLE OUTPUT ON THE RIGHT              \n\n";
		$output = $output . shell_exec("diff --side-by-side \"$studentOutput\" \"$sampleOutput\"");
		$outputForMatching = shell_exec("diff \"$studentOutput\" \"$sampleOutput\"");
		
		$output = $output. "\n";
		print "<pre>" . ($output) . "</pre><br>";
		$feedback = "$submissionDir/Feedback.txt";
		$fh = fopen($feedback, 'a');
		$notice = "=====================================\n";
		$notice = $notice . "AUTOMARK FEEDBACK FOR $studentID and Question '$questionName'\n";
		$notice = $notice . "=====================================\n";
		
		fwrite ($fh, $notice);
		fwrite($fh, $output);
		fclose($fh);
				
		$numMatches = preg_match_all("/\d+(,\d+)?[a-z]\d+(,\d+)?/", $outputForMatching, $matches);
		
		$marksLost = $numMatches * $marksLostPerDiff;
		return $marksLost;
	}

?>