<html>
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
                    <table width="100%" border="6">
                        <tr>
                            <td width=300>
                                <h2><a href="http://localhost/cs411/student.html"> MENU</a></h2>
                            </td>
                            <td align="left">
                <!--The Student Content table-->
                <table width="100%" border="1">
                <tr>
                  <td width=500 align="center">
                    <h2>Welcome:</h2>
<?php
    include ('includes/mysqlstudentLogin.php');
    include ('includes/auth.php');
    $redirect_pauseTime = 0;
    //session_start();
    print( $_SESSION['username']."\n <br><br><br>");
    if(empty($_SESSION['username'])){
        print("<meta http-equiv=\"REFRESH\" content=\"". $redirect_pauseTime . ";url=login.html?notLoggedIn=1\">");
    } 
    else {
        $loginDb = "assignments_uiuc";
        mysql_select_db($loginDb) or die("Can not connect to login table." . mysql_error());
        $coursesQuery = "SELECT CourseName, SemesterName  FROM course As c, takes As t WHERE t.StudentID = '". $_SESSION['username'] . "' AND c.CourseID = t.CourseID ";
       // $coursesQuery = "SELECT * FROM course;
       $result = mysql_query($coursesQuery);
        echo "<table border='1'>
		<tr>
		<th>Course Name</th>
		<th>Semester Name</th>
		</tr>";
		while($row = mysql_fetch_array($result))
  		{
  		echo "<tr>";
  		echo "<td>" . $row['CourseName'] . "</td>";
  		echo "<td>" . $row['SemesterName'] . "</td>";
  		echo "</tr>";
  		}
		echo "</table>";
    	print("<br><br>");
    	while ($row = mysql_fetch_array($result)){
        print($row['CourseName'] . "<br>");
        }
    }
   //print("Username:" . $_SESSION['username']);
?>

                  </td>
                </tr>
                </table>
                <!--table ends here-->

                            </td>
                        </tr>
                    </table>

                    <script>
                   </script>
            </td>
        </tr>
    </table>
</body>
</html>
