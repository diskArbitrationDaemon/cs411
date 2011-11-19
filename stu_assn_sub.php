<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-US" xml:lang="en-US" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Illinois CS Submission system</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<!TODO Remember to call the javascript function somewhere>
</head>
<body>
    <table width="100%" border="0">
        <tr>
            <td height="100" align="center">
            Illinois Submission System
            </td>
        </tr>
        <tr>
            <td>
                    <table width="100%" border="0">

                        <tr>
                            <td width=250>
                                <iframe width=250 frameBorder="0" src="menu.php">
                                </iframe>
                            </td>
                            <td align="left">
                                <table width="100%" border="0">
                        			<tr>
                            			<td align="left">
                                			<h3>Assignment Submission</h3>
                                			<?php
                                			ini_set( "display_errors", 0);
    										include ('includes/mysqlstudentLogin.php');
   											include ('includes/auth.php');
	  										session_start();
										    
									   		$assignmentID=$_SESSION['assignmentID'];
										    echo "Submission Details";
										    print("<br><br>\n");
											$StudentID=$_SESSION[username];

											$query2 = "SELECT AssnName, CourseID FROM assignment as a WHERE a.AssnID = $assignmentID ";
											$result2 = mysql_query($query2);

											$row2 = mysql_fetch_array($result2);
										   	$assnname=$row2['AssnName'];
										   	$courseid=$row2['CourseID'];  	
   	
										   	$query3 = "SELECT CourseName, SemesterName FROM course as c WHERE c.CourseID = $courseid ";
											$result3 = mysql_query($query3);
	
										    $row3 = mysql_fetch_array($result3);
										    $coursename=$row3['CourseName'];
										   	$semester=$row3['SemesterName'];

										  	if ($_FILES["file"]["error"] > 0)
										    {
										    	echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
										    	echo "File Missing" . "<br />";
										    }
										  	else
										    {
										    	echo "Upload: " . $_FILES["file"]["name"] . "<br />";
										    	echo "Type: " . $_FILES["file"]["type"] . "<br />";
										    	echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
										      	if(move_uploaded_file($_FILES["file"]["tmp_name"],
											      	"Submissions/$semester/$coursename/$assnname/$StudentID/" . $_FILES["file"]["name"]))
										      	{
													echo "Stored in: " . "Submissions/$semester/$coursename/$assnname/$StudentID/" . $_FILES["file"]["name"];
										    	}
										    	else
										    	{
										    		echo "File Submission Failed : Invalid Assignment";
										    	}
										    }
										    print("<br><br>\n");
											print("<a href=\"stu_assignment.html?AssnID=$assignmentID\">submit again</a>". "<br>");
											?>
                            			</td>
                        			</tr>
                         			
                    			</table>
                            </td>
                        </tr>
                    </table>    
            </td>
        </tr>
    </table>
</body>
</html>