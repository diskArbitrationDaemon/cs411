<?php

    include ('includes/mysqlInstrLogin.php');
	include ('includes/auth.php');
	

	//a diff is done on a per question basis. each test consists of an execution and a diff run.
	//this means that the student either passes one test or fails one test. A question can be
	//made out of many tests.

	//init page: 	the instructor sees all the questions available for one assignment
	//action: 		using checkboxes (which has QnIDs), select the questions to be automarked
	//submit: 		click on OK. QuestionIDs will be posted 
	
	//second page: 	let instructor insert shell scripts to execute for each question, and
	//				the sample solution to diff.
	//action:		Instructor will be prompted to select a file that is the sample solution
	//				which a student's assignment output will be diff-ed against
	//				Instructor will be prompted to select another file that is a shell script
	//				which executes submissions for questions in the submission directory:
	//				"Submissions/<semester>/<course>/<assignment>/<studentID>".
	//submit:		the location of sample files and location of shell scripts for each question, the
	//				questions themselves
	
	//third page:	for each question, find the AssnID and then all students who submitted the 
	//				assignment (everyone). Then, execute the shell script in 
	//				"Submissions/<semester>/<course>/<assignment>/<studentID>".
	//				with the output of the shell script compared with the sample solution
	//				using the function below, returning the marks lost for this student.
	//				The results table is updated as follows: StudentID|QuestionID: enter mark
	//				as: Mark=Question.FullMark-marksLost()
	
	
	
	//display questions for selected assignment
	if (empty($_POST['stage'])){
		//checks if the instructor has access
		$query = "SELECT * FROM Assignment as a, Course as c, Teaches as t, Instructor as i WHERE
		    i.InstructorID='$_SESSION[username]' AND
		    t.InstructorID=i.InstructorID AND
		    a.CourseID=c.courseID AND
		    t.courseID=c.courseID AND
		    a.AssnID=$_GET[AssnID]";
		$result = mysql_query($query);
		if (mysql_errno()) die ("error authenticating." . mysql_error());
		if (mysql_num_rows($result) == 0) die ("Not authorized.");
		
		//find all questions
		$questionQuery = "SELECT * FROM Questions WHERE AssnID='$_GET[AssnID]'";
		$questionResult = mysql_query($questionQuery);
		if (mysql_errno()) die ("error finding questions " . mysql_error());
		print ("<form name=\"selectQns\" action=\"instr_automark_display.php\" method=\"post\">");
		print ("<table border=0>");
		while ($questionRow = mysql_fetch_array($questionResult)){
			print ("<tr><td width=200><input type=checkbox name=automarkQns[] value=\"$questionRow[QuestionID]\">$questionRow[QuestionName]</td></tr>");
			print("<input type=hidden name=\"$questionRow[QuestionID]\" value=\"$questionRow[QuestionName]\">");
		}
		print ("<input type=hidden name=assnID value=$_GET[AssnID]>");
		print ("<tr><td><input type=submit name=\"addQns\" value=\"Select Questions For Automarking\" onclick=form.action=\"instr_automark_display.php?action=add\"></td></tr>");
		print ("<tr><td><input type=submit name=\"delQns\" value=\"Remove questions from Automarking\" onclick=form.action=\"instr_automark_display.php?action=del\"></td></tr>");
		print ("<input type=hidden name=stage value=2>");
		print ("</table>");
		
		print("</form>");
	} else if ($_POST['stage'] ==2){
		$questions = $_POST['automarkQns'];
		
		if($_POST['action'] == "add"){
			//a list of questionIDs in $_POST['automarkQns'][]
			
			print ("<FORM METHOD=POST ENCTYPE=\"multipart/form-data\" ACTION=\"instr_automark.php\" method=\"post\">");
			print ("<table border=0>");
			foreach ($questions as $key=>$value){
				//two dialogue boxes with upload
				print("<tr><td>$_POST[$value]</td></tr>");
				print ("<tr><td width=140>Script file:</td><td><input name=\"shellScriptFile[]\" type=\"file\"></td></tr>");
				print ("<tr><td width=140>Sample solution:</td><td><input name=\"sampleAnswers[]\" type=\"file\"></td></tr>");
				print("<tr><td height=20><input type=hidden name=\"questionIDs[]\" value=$value></td></tr>");
				
			}
			print ("<tr><td><input type=submit value=\"Upload scripts\"></td></tr>");
			print ("<input type=hidden name=stage value=3>");
			print ("<input type=hidden name=assnID value=$_POST[assnID]>");
			print("</table>");
		} else if ($_POST['action'] == "del"){
			foreach ($questions as $key=>$value){
				$query = "DELETE FROM automarking WHERE `QuestionID` = '$value'";
				$result = mysql_query($query);
				if (mysql_errno()) print ("erorr deleting Question $value. " . mysql_error());
				print ("Questions deleted.");
				print ("<meta http-equiv=\"REFRESH\" content=\"3;url=http://localhost/cs411/instr_viewAssns.html\"></HEAD>");
			}
		}
		
		
		print ("</form>");
	} else if ($_POST['stage'] == 3){
		//print $_POST['assnID'];
		//print_r($_FILES);
		//print_r($_POST['questionIDs']);
		//arrays we're interestd in: $_FILES[shellScriptFile][name], [type], [error], [tmp_name]
		//and $_FILES[sampleAnswers][name], [type], [error], [tmp_name]
		
		//step1: find $semester, $courseName, $assnName, $questionNames 
		//(different files go into different folders!)

		$courseQuery = "SELECT * FROM `course` WHERE CourseID= 
			(SELECT CourseID FROM assignment WHERE AssnID='$_POST[assnID]')";
		$courseResult = mysql_query($courseQuery);
		if (mysql_errno()) die ("Error finding course ID " . mysql_error());
		$courseRow = mysql_fetch_array($courseResult);
		
		$semester = $courseRow['SemesterName'];
		$courseName = $courseRow['CourseName'];
		
		$assnQuery = "SELECT * FROM assignment WHERE AssnID='$_POST[assnID]'";
		$assnResult = mysql_query($assnQuery);
		if (mysql_errno()) die ("Error finding assn." . mysql_error());
		$assnRow = mysql_fetch_array($assnResult);
		
		$assnName = $assnRow['AssnName'];
		
		//directory:
		//Submissions/<semester>/<course>/<assignment>/<_automark>
		$partialUploadDir = "Submissions/$semester/$courseName/$assnName/_automark/";
		if (!file_exists($partialUploadDir)) mkdir($partialUploadDir, 0777, true);
		$questions = $_POST['questionIDs'];
		foreach ($_FILES['sampleAnswers']['name'] as $key => $value){
			
			//the continues mean that the upload of files will continue iff when both files satisfy uploading conditions
			if ($_FILES['sampleAnswers']['error'][$key]) { print ("Error uploading \"" . $_FILES['sampleAnswers']['name'][$key] .
						"\" as sample answer file. Error Code: " . $_FILES['sampleAnswers']['error'][$key]) . "<br>"; continue; } //skip the whole loop if this file fails
			
			if ($_FILES['shellScriptFile']['error'][$key]){ print ("Error uploading " . $_FILES['sampleAnswers']['name'][$key] . 
						" as script file. Error Code: " . $_FILES['shellScriptFile']['error'][$key])  . "<br>"; continue; } //similarly skip the whole loop if this file fails also
			
			if ($_FILES['sampleAnswers']['size'][$key] > 100000) { print  ("sample answers too large, max size 100KB<br>"); continue; }
			
			if ($_FILES['shellScriptFile']['size'][$key] > 100000) { print ("shell script too large, max size 100KB<br>"); continue; }
			
			if (!($_FILES['shellScriptFile']['type'][$key] == "application/x-sh" || $_FILES['shellScriptFile']['type'][$key] == "application/octet-stream")) { 
				print ("File must be of shell script type. File is of type " . $_FILES['shellScriptFile']['type'][$key]); 
				continue; 
			}
			
			$questionQuery = "SELECT * FROM Questions WHERE QuestionID='". $questions[$key] ."'";
			$questionResult = mysql_query($questionQuery);
			if (mysql_errno()) die ("Error getting questions" . mysql_error());
			$questionRow = mysql_fetch_array($questionResult);
			$questionName = $questionRow['QuestionName'];
			
			$uploadDir = $partialUploadDir . $questionName;
			if(!file_exists($uploadDir))
					mkdir ($uploadDir);
			//with uploadDir, just upload SampleAnswers
			
			/*print ("moving :" . $_FILES['sampleAnswers']['tmp_name'][$key] . " to ".
			"$uploadDir/".$_FILES['sampleAnswers']['name'][$key]."<br>\n");
			*/
			
			move_uploaded_file($_FILES['sampleAnswers']['tmp_name'][$key], 
					"$uploadDir/".$_FILES['sampleAnswers']['name'][$key]);	    	
	    
		    $sampleAnswerLocation = "$uploadDir/".$_FILES['sampleAnswers']['name'][$key];
			
		    /*print ("moving :" . $_FILES['shellScriptFile']['tmp_name'][$key] . " to " .
			"$uploadDir/".$_FILES['shellScriptFile']['name'][$key] . "<br>\n");
			*/
		
	    	move_uploaded_file($_FILES['shellScriptFile']['tmp_name'][$key],
	    			"$uploadDir/" . $_FILES['shellScriptFile']['name'][$key]);		    
		    
		    $scriptLocation = "$uploadDir/" . $_FILES['shellScriptFile']['name'][$key];
		    
		    //chmod so script is executable
			chmod($scriptLocation, 0755);
		    //insert into database
		    $newAutomarkQuery = "INSERT into automarking VALUES ('$sampleAnswerLocation','$scriptLocation','$questions[$key]')
		    			ON DUPLICATE KEY Update SampleSolnFile='$sampleAnswerLocation', ScriptFile='$scriptLocation'";
		    $newAutomarkResult = mysql_query($newAutomarkQuery);
		    if (mysql_errno()) die ("Error inserting automark into table. " . mysql_error());
		    
		    
		}
		
		print("File upload Successful!\n");
		print ("<meta http-equiv=\"REFRESH\" content=\"3;url=instr_viewAssns.html\">");
			    	
		
	}
	
	


?>