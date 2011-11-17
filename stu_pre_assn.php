<?php
    include ('includes/mysqlstudentLogin.php');
    include ('includes/auth.php');
    session_start();

    $query = "SELECT * FROM assignment as a, course as c, takes as t, student as s WHERE
    s.StudentID='$_SESSION[username]' AND
    t.StudentID=s.StudentID AND
    a.CourseID=c.CourseID AND
    t.CourseID=c.CourseID";
    $result = mysql_query($query);
    if (mysql_errno()) print(mysql_error());
    $row = mysql_fetch_array($result);
    if(!empty($row['AssnID'])){
        if (htmlspecialchars($_GET['q'] == "GetAssessments")){
            $query = "SELECT AssnName FROM assignment WHERE AssnID=" . htmlspecialchars($_GET['AssnID']);
            $result = mysql_query($query);
            if (mysql_errno()) print(mysql_error());
            $row = mysql_fetch_array($result);
            $assnName = $row['AssnName'];

            $query = "SELECT CourseName FROM course, assignment Where AssnID=".htmlspecialchars($_GET['AssnID']) . " AND 
            assignment.CourseID=course.CourseID";
            $result = mysql_query($query);
            if (mysql_errno()) print(mysql_error());
            $row = mysql_fetch_array($result);
            $courseName = $row['CourseName'];

            $query = "SELECT * FROM assignment WHERE AssnID=" . htmlspecialchars($_GET['AssnID']);
            $result = mysql_query($query);
            if (mysql_errno()) print(mysql_error());
            $row = mysql_fetch_array($result); 
            print("<table border=0 width=400>");
            print("<tr><td height=50>$assnName - $courseName</td></tr>");
            print("<tr><td>");
            print("<table border=0>");
        	print("<tr><td height=30 width=150>Maximum Mark:</td<td>$row[MaxMark]</td</tr>");
            print("<tr><td height=30 width=150>Median Mark: </td<td>$row[MedianMark]</td</tr>");
            print("<tr><td height=30 width=150>Average Mark: </td<td>$row[AvgMark]</td</tr>");
            print("</table>");
            print("</td></tr>");
            print("</table>");
            
        	$query1 = "SELECT GroupName FROM  memberof As m WHERE m.StudentID='$_SESSION[username]' AND m.AssnID=" . htmlspecialchars($_GET['AssnID']);
			
            $result1 = mysql_query($query1);
            print("<br>\n");
        	print("Assignment Type:");
        	$flag=0;
			while ($row1 = mysql_fetch_array($result1)){
				$flag=1;
			}        	
        	if($flag==0)
			{
				print(" Individual Assignment\n");
			}
			else
			{
				print("Group Assignment\n");
				print("<br>\n");
				$row1 = mysql_fetch_array($result1);
				print("Group Name-$row1[GroupName]");
				print("<br>\n");
				print("Group Members:");
				print("<br>\n");
				
				$query2 = "SELECT StudentID FROM  memberof WHERE GroupName=$row1[GroupName]";
			
				$result2 = mysql_query($query2);
				while ($row2 = mysql_fetch_array($result1)){
                 	print("$row2[StudentID] ");
                 	print("<br>\n");
        		}
			}
			
        } else if (htmlspecialchars($_GET['q'] == "GetQuestions")){
        
        	$query1 = "SELECT QuestionName, FullMark, Mark FROM questions As q, results As r WHERE q.QuestionID=r.QuestionID AND q.AssnID=" . htmlspecialchars($_GET['AssnID']);
			
            $result1 = mysql_query($query1);
            print("<tr><td width=200 height=45>");
        	print("\n\n\nGrades : \n");
        	
        	$flag=0;
            while ($row1 = mysql_fetch_array($result1)){
                print("<tr><td width=40%>");
                print("QuestionName : ");
                print("$row1[QuestionName] ");
                print("</td><td width=20%>");
                print("Marks : ");
                print("$row1[Mark]/$row1[FullMark]");
                print("</td>");
                $flag=1;
            }
            if($flag==0)
			{
			print("Grades not available, check later  \n");
			}
			print("<br>\n");
			print("<br>\n");
            print("</table>");
            
            $query = "SELECT * FROM questions WHERE AssnID=" . htmlspecialchars($_GET['AssnID']);
            $result = mysql_query($query);
            if (mysql_errno()) print(mysql_error());
            print("<table width=800 border=0>");
            print("<br>\n");
            print("View Comments. \n");
            while ($row = mysql_fetch_array($result)){
                print("<tr><td width=200 height=35>");
                print("<a href=\"stu_feedback.html?QeustionID=$row[QuestionID]\">$row[QuestionName]</a>");
                print("</td><td>");
                print("$row[FullMark]");
                print("</td></tr>");
            }

            print("</table>");
                    
            
        } 
    } else {

        if (htmlspecialchars($_GET['q'] == "GetAssessments")){
            print("You are not authorised to view this assignment. Please contact the database administrator");
        }
    }
    
?>