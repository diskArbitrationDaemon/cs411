<script src="instr_addQuestion.js">
</script>

<?php
    include ('includes/mysqlInstrLogin.php');
    include ('includes/auth.php');
	$spaceBetweenCols = 60;
	$spaceBetweenTR = 35;
	$widthCol1 = 135;
    
	//display
	if ($_GET['q'] == "GetAssessments" || $_GET['q'] == "GetQuestions"){
	    $query = "SELECT * FROM Assignment as a, Course as c, Teaches as t, Instructor as i WHERE
	    i.InstructorID='$_SESSION[username]' AND
	    t.InstructorID=i.InstructorID AND
	    a.CourseID=c.courseID AND
	    t.courseID=c.courseID AND
	    a.AssnID='$_GET[AssnID]'";
	    $result = mysql_query($query);
	    if (mysql_errno()) die(mysql_error());
	    $row = mysql_fetch_array($result);
	    if(!empty($row['AssnID'])){
	        if (htmlspecialchars($_GET['q'] == "GetAssessments")){
	            $query = "SELECT AssnName FROM Assignment WHERE AssnID=" . htmlspecialchars($_GET['AssnID']);
	            $result = mysql_query($query);
	            if (mysql_errno()) die(mysql_error());
	            $row = mysql_fetch_array($result);
	            $assnName = $row['AssnName'];
	
	            $query = "SELECT CourseName FROM Course, Assignment Where AssnID=".htmlspecialchars($_GET['AssnID']) . " AND 
	            Assignment.CourseID=Course.CourseID";
	            $result = mysql_query($query);
	            if (mysql_errno()) die(mysql_error());
	            $row = mysql_fetch_array($result);
	            $courseName = $row['CourseName'];
	
	            $query = "SELECT * FROM Assignment WHERE AssnID=" . htmlspecialchars($_GET['AssnID']);
	            $result = mysql_query($query);
	            if (mysql_errno()) die(mysql_error());
	            $row = mysql_fetch_array($result); 
	            print("<table border=0 width=400>");
	            print("<tr><td height=50>$assnName - $courseName</td</tr>");
	            print("<tr><td>");
	                print("<table border=0>");
	                    print("<tr><td height=30 width=150>Maximum Mark:</td<td>$row[MaxMark]</td</tr>");
	                    print("<tr><td height=30 width=150>Median Mark: </td<td>$row[MedianMark]</td</tr>");
	                    print("<tr><td height=30 width=150>Average Mark: </td<td>$row[AvgMark]</td</tr>");
	                    print("<tr><td height=30 width=150><a href=\"instr_viewSubmissions.html?AssnID=$_GET[AssnID]\">View Submissions</a</td<td</td</tr>");
	                print("</table>");
	            print("</td</tr>");
	            print("</table>");
	        } else if (htmlspecialchars($_GET['q'] == "GetQuestions")){
	            $query = "SELECT * FROM Questions WHERE AssnID=" . htmlspecialchars($_GET['AssnID']);
	            $result = mysql_query($query);
	            if (mysql_errno()) die(mysql_error());
	            print("<table width=800 border=0>");
	            while ($row = mysql_fetch_array($result)){
	
	                print("<tr><td width=200 height=35>");
	                print("$row[QuestionName]");
	                print("</td<td>");
	                print("$row[FullMark]");
	                print("</td</tr>");
	            }
	
	            print("</table>");
	
	        } else {
	            print("Invalid parameter.");
	        }
	    } else {
	
	        if (htmlspecialchars($_GET['q'] == "GetAssessments")){
	            die("You are not authorised to view or modify this assignment. Please contact the database administrator");
	        }
	
	    }
	
	//create/edit
	} else if ($_GET['q'] == "CreateAssessment" || $_GET['q'] == "EditAssessment"){
	    if ($_GET['q'] == "CreateAssessment") {
	    	$query = "SELECT * FROM Assignment as a, Course as c, Teaches as t, Instructor as i WHERE
	    			    i.InstructorID='$_SESSION[username]' AND
		    t.InstructorID=i.InstructorID AND
		    a.CourseID=c.courseID AND
		    t.courseID=c.courseID";
	    } else if ($_GET['q'] == "EditAssessment"){
	    		    	$query = "SELECT * FROM Assignment as a, Course as c, Teaches as t, Instructor as i WHERE
	    			    i.InstructorID='$_SESSION[username]' AND
		    t.InstructorID=i.InstructorID AND
		    a.CourseID=c.courseID AND
		    t.courseID=c.courseID AND
		    a.assnID='$_GET[AssnID]'";
	    }

		    $result = mysql_query($query);
		    if (mysql_errno()) die(mysql_error());
		    $row = mysql_fetch_array($result);
	    if(!empty($row['AssnID'])){
            
            $edit = 0;
            if ($_GET['q'] == "EditAssessment") $edit = 1;
            if ($edit){
                $assnID = $_GET['AssnID'];
                if (empty($assnID)) die ("Invalid Assignment");
                //populate ASSN fields
                $query = "SELECT * FROM Assignment WHERE AssnID='$assnID'";
                $result = mysql_query($query);
                $row = mysql_fetch_array($result);
                if (mysql_errno()) die ("Cannot find assignment in database");
                $assnName = $row['AssnName'];
                $groupWork = $row['GroupWork'];
                $maxMark = $row['MaxMark'];
                $courseID = $row['CourseID'];
                $dueDate = $row['DueTime'];
                //YYYY-mm-dd HH:MM:SS
                list($year, $month, $date, $hour, $min) = preg_split('/[-\ :]/', $dueDate);
            }

            print ("<table border=0>\n");
                print("<tr>\n");
                    print("<td align=right height=$spaceBetweenTR width=$widthCol1>\n");
                        print("Assignment Name\n");
                    print("</td>\n");
                    print ("<td width=$spaceBetweenCols>\n");
                    print("</td>\n");
                    print("<td align=left>\n");
                    	if (!isset($assnName)) $assnName = "";
                        print("<input type=text name=AssnName value=".$assnName.">\n");
                    print("</td>\n");
                print("</tr>\n");
                
                print("<tr>\n");
                    print("<td align=right height=$spaceBetweenTR width=$widthCol1>\n");
                        print("Max group members\n");
                    print("</td>\n");
                    print ("<td width=$spaceBetweenCols>\n");
                    print("</td>\n");
                    print("<td align=left>\n");
                    	if (!isset ($groupWork)) $groupWork = "";
                        print("<input type=text name=MaxGroupMembers value=$groupWork>\n");
                    print("</td>\n");
                print("</tr>\n");

                print("<tr>\n");
                    print("<td align=right height=$spaceBetweenTR width=$widthCol1>\n");
                        print("Maximum Mark\n");
                    print("</td>\n");
                    print ("<td width=$spaceBetweenCols>\n");
                    print("</td>\n");
                    print("<td align=left>\n");
                    	if (!isset($maxMark)) $maxMark = "";
                        print("<input type=text name=MaxMark value=$maxMark>\n");
                    print("</td>\n");
                print("</tr>\n");

                print("<tr>\n");
                    print("<td align=right height=$spaceBetweenTR width=$widthCol1>\n");
                        print("Course\n");
                    print("</td>\n");
                    print ("<td width=$spaceBetweenCols>\n");
                    print("</td>\n");
                    print("<td align=left>\n");
                        print("<select name=CourseList>\n");
                        $query = "SELECT CourseID, CourseName, SemesterName FROM Course ORDER BY CourseID Desc";
                        $result = mysql_query($query);
                        while ($row = mysql_fetch_array($result)){
                        	if ($row[CourseID] == $courseID){
                        		print("<option value=$row[CourseID] selected=\"selected\">$row[CourseName] | $row[SemesterName]</option>\n");
                        	}
                            print("<option value=$row[CourseID]>$row[CourseName] | $row[SemesterName]</option>\n");
                        }
                        print("</select>\n");
                    print("</td>\n");
                print("</tr>\n");

               print("<tr>\n");
                    print("<td align=right height=$spaceBetweenTR width=$widthCol1>\n");
                        print("Due Time\n");
                    print("</td>\n");
                    print ("<td width=$spaceBetweenCols>\n");
                    print("</td>\n");
                    print("<td align=left>\n");
                        print("<select name=Month>\n");
                        for($i = 1; $i <= 12; $i++){
                        	if ($i == $month){
                        	    print("<option value=$i selected=\"selected\">$i</option>\n");
                        	} else {
                            	print("<option value=$i>$i</option>\n");
                        	}
                        }
                        print("</select>\n");

                        print("<select name=Date>\n");
                        for($i = 1; $i <= 31; $i++){
                        	if ($i == $date){
                        		print("<option value=$i selected=\"selected\">$i</option>\n");
                        	} else {
                        		print("<option value=$i>$i</option>\n");
                        	
                        	}
                        }
                        print("</select>\n");
                        
                        print("<select name=Year>\n");
                        	$currentYear = date('Y');
                            print("<option value=".date('Y')." selected=\"selected\">".date('Y')."</option>\n");
                            print("<option value=". (date('Y') + 1).">".(date('Y') + 1)."</option>\n");
                        	
                        print("</select>\n");
                        
                        print("<select name=Hour>\n");
                        for($i = 0; $i < 24; $i++){
                        	if ($i == $hour){
                            	printf('<option value=%d selected=\"selected\">%02d</option>\n', $i, $i);
                        	} else {
                            	printf('<option value=%d>%02d</option>\n', $i, $i);
                        	}
                        }
                        print("</select>\n");

                        print("<select name=Minute>\n");
                        for($i = 0; $i < 60; $i++){
                        	if ($i == $minute){
                        		printf('<option value=%d selected=\"selected\">%02d</option>\n', $i, $i);
                        	} else {
                            	printf('<option value=%d>%02d</option>\n', $i, $i);
                        	}
                        }
                        print("</select>\n");

                    print("</td>\n");
                print("</tr>\n");
            print("</table>\n");
            if (!empty($assnID)) print("<input type=hidden name=AssnID value=$assnID> <br> <input type=hidden name=Edit value=true>");
	   	} else {
	            die("You are not authorised to view or modify this assignment. Please contact the database administrator");
   		}
			
	} else if ($_GET['q'] == "CreateQuestions" || $_GET['q'] == "EditQuestions"){
		 $query = "SELECT * FROM Assignment as a, Course as c, Teaches as t, Instructor as i WHERE
		    i.InstructorID='$_SESSION[username]' AND
		    t.InstructorID=i.InstructorID AND
		    a.CourseID=c.courseID AND
		    t.courseID=c.courseID";
		 if ($_GET['q'] == "EditQuestions") $query = $query."a.AssnID='$_GET[AssnID]'";
		 
		    $result = mysql_query($query);
		    if (mysql_errno()) die(mysql_error());
		    $row = mysql_fetch_array($result);
	    if(empty($row['AssnID'])) die();
		$edit = 0;
		if ($_GET['q'] == "EditQuestions"){
			$edit = 1;
			$assnID = $_GET['AssnID'];
			$query = "SELECT * FROM Questions WHERE AssnID='$assnID'";
			$result = mysql_query($query);
			
			while ($row = mysql_fetch_array($result)){
				print("<script src=\"instr_addQuestion.js\">\n");
				print("addQuestion($row[QuestionID], \"$row[QuestionName]\", $row[FullMark]);");
				print("</script>");
			}
		}
        
		
		print("<span id=Questions>");
        print("<table id=QuestionsTable border=0>");
        ?><tr><td><input type="button" value="Add Question" onClick="addQuestion();"></td></tr><?php
        print("</table>");
        print("</span>");
        ?><input type="submit" value="Add Assignment"><?php
        
    } else if ($_GET['q'] == "Submit"){
    	
    	
        $assnName = $_POST['AssnName'];
        $maxGroupMembers = $_POST['MaxGroupMembers'];
        $maxMark = $_POST['MaxMark'];
        $month = $_POST['Month'];
        $date = $_POST['Date'];
        $year = $_POST['Year'];
        $hour = $_POST['Hour'];
        $minute = $_POST['Minute'];
        $courseID = $_POST['CourseList'];
        
        print("AssnName: $assnName <br> Course:$courseID MaxGroupMembers: $maxGroupMembers <br> MaxMark: $maxMark <br> month: $month <br> day: $date <br> year: $year <br> hour: $hour <br> minute: $minute <br><br>");
        $questionNames = $_POST['QuestionName'];
        $questionMarks = $_POST['QuestionMark'];
        if (isset($_POST['UpdateQuestion'])){
        	$updateQuestions = $_POST['UpdateQuestion'];
        }
        /*print_r($questionNames);
        print("<br>");
        print_r($questionMarks);
        print("<br>|");
        print_r($updateQuestions);*/

		$mysqlDate = sprintf("%04d-%02d-%02d %02d:%02d:00", $year, $month, $date, $hour,$minute);
        
		//Insert or update Assignment
        if (!isset($_POST['edit'])){
	        $query = "INSERT into Assignment VALUES (NULL, '$assnName', '$maxGroupMembers', '$maxMark', NULL, NULL, '$courseID', '$mysqlDate')";
	        //print("Made a new assignment with query: $query<br>");
	        $resultInsertAssn = mysql_query($query);
	        //print $query;
	        if (mysql_errno()) die("Cannot add into database." . mysql_error());
	        $assnID = mysql_insert_id();
	        
	        //when creating an assignment, create all the submissions
	        $submQuery = "SELECT Course.SemesterName, Course.CourseName, Assignment.AssnID, Assignment.AssnName, Takes.StudentID FROM Takes, Course, Assignment WHERE
					Assignment.AssnID='$assnID' AND
					Course.CourseID=Assignment.CourseID AND
					Takes.CourseID = Course.CourseID ";
	        $submResult = mysql_query($submQuery);
	        print("All students: $submQuery <br>");
	        $timeNow = date('Y-m-d H:i:s');
	        while ($row = mysql_fetch_array($submResult)){
	        	$submAssnID = $row['AssnID'];
	        	$submStudentID = $row['StudentID'];
	        	$submFiles = "Submissions/$row[SemesterName]/$row[CourseName]/$row[AssnName]/$row[StudentID]";
	        	
	        	if (!mkdir($submFiles, 0777, true)) die ("Cannot make directory $submFiles");
	        	$insQuery = "INSERT into Submission VALUES ('$submAssnID', '$submStudentID', '$submFiles', NULL, '$timeNow')";
	        	mysql_query($insQuery);
	        	print "Inserted into submission: $submStudentID:  $insQuery<br>";
	        	if (mysql_errno()) die ("$query <br>" . mysql_error());
	        }
	    //edit assignment
        } else {
        	$assnID = $_POST['AssnID'];
        	$query = "UPDATE Assignment SET AssnName='$assnName', GroupWork='$maxGroupMembers', MaxMark='$maxMark', CourseID=$courseID, DueTime='$mysqlDate' WHERE
        		AssnID=$assnID";
        	        $resultInsertAssn = mysql_query($query);
        	//print $query;
        	if (mysql_errno()) die("Cannot add into database." . mysql_error());
        	
        }      

        
        //updateQuestions contains a list of questions (by QuestionID) to update. Therefore the difference in update/insert is implicit, i.e.
        //an insertion is done _all the time_ unless exempted by the updateQuestionsList.
        //With updating an Assignment, however, there requires an edit flag.
        foreach ($questionNames as $key => $value){
			if (isset($updateQuestions) && in_array($key, $updateQuestions)){
				$query = "UPDATE Questions SET QuestionName='$questionNames[$key]', FullMark='$questionMarks[$key]' WHERE QuestionID='$key'";
			} else {
            	$query = "INSERT into Questions VALUES (NULL, '$questionNames[$key]', '$questionMarks[$key]', '$assnID')";
			}
			print("<br>$query<br>");
            $result = mysql_query($query);
            if (mysql_errno()) die ("Cannot add question $i" . mysql_error());
        }
    }

    
?>
