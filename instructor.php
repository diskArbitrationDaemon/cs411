<?php
    include "common.php";
    $username = $_SESSION['username'];

    $studentTable = "Student";
    $studentQuery = "SELECT * FROM " . $studentTable . "WHERE StudentID = '" . $username "'";
    $result = mysql_query($studentQuery);
    $resultRow = mysql_fetch_array($result);

    $firstName = $resultRow['FirstName'];
    $lastName = $resultRow['LastName'];
    
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-US" xml:lang="en-US" xmlns="http://www.w3.org/1999/xhtml">
    <head>v
        <title>Illinois CS Submission System</title>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    </head>

    <body>
        
    </body>

</html>
