<?php
$stage = htmlspecialchars($_POST['stage']);

include ('includes/mysqlInstrLogin.php');
include ('includes/auth.php');

if (empty($stage)){

    //GET vars required:
    //AssnID, StudentID
    $query = "SELECT * FROM Assignment as a, Course as c, Teaches as t, Instructor as i WHERE
        i.NetID='$_SESSION[username]' AND
        t.NetID=i.NetID AND
        a.CourseID=c.courseID AND
        t.courseID=c.courseID";
    $result = mysql_query($query);
    if (mysql_errno()) print(mysql_error());
    if(mysql_num_rows($result)){

        $row = mysql_fetch_array($result);
        //get questions
        $query = "SELECT QuestionName, Questions.QuestionID, Mark FROM Questions, Assignment, Course, Takes, Results WHERE
        Assignment.AssnID='". htmlspecialchars($_GET['AssnID']) ."' AND
        Takes.CourseID = Course.CourseID AND
        Takes.StudentID = '".htmlspecialchars($_GET['StudentID'])."' AND
        Assignment.CourseID = Course.CourseID AND
        Questions.AssnID = Assignment.AssnID AND
        Results.QuestionID = Questions.QuestionID";
        $result = mysql_query($query);
        if (mysql_errno()) print(mysql_error());
        if (mysql_num_rows($result) == 0){
            die ("this assignment/student combination does not exist");
        } else {
            print("<form name=form action=mark.html  method=\"post\">\n");
            print("<table border=0 width=400>\n");
            $i = 0;
            while ($row = mysql_fetch_array($result)){
                print("<tr><td >" . $row['QuestionName'] . "</td><td><input type=text name=Q". $row['QuestionID'] ." length=5 value=\"".$row['Mark']."\"></td></tr>\n");
                print("<input type=hidden name=Question$i value=".$row['QuestionID'].">\n<br>");
                $i++;
            }
            print("<input type=hidden name=stage value=1>\n");
            print("<input type=hidden name=numQuestions value=$i>\n");
            print("<input type=hidden name=redirect value=".$_GET['redirect'].">\n");
            print("<input type=hidden name=student value=".$_GET['StudentID'].">\n");
            print("<input type=hidden name=AssnID value=".$_GET['AssnID'].">\n");
            print("<tr><td><input type=\"button\" name=\"SubmitMarksButton\" value=\"Enter Grades\" onclick=\"submitMarks(this.form);\"></td><td></td></tr>\n");
            print("</table>\n");
            print("</form>\n");

        }
    } else {
        die("You do not have permission to access this page");
    }
} else if ($stage = 1){
    $studentID = $_POST['StudentID'];
    $assnID = $_POST['AssnID'];
    foreach ($_POST['Question'] as $key => $value){ 
        mysql_query("INSERT into Results VALUES ('$studentID', '$key', '$value')

        ON DUPLICATE KEY UPDATE mark='$value'");
        if (mysql_errno() > 0) print("error: " . mysql_error() . "<br> Query: " . $query);
    }
    print("<meta http-equiv=\"REFRESH\" content=\"0;url=viewSubmissions.html?AssnID=$assnID\">");
}
?>
