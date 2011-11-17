<?php

include('includes/auth.php');
    include('includes/mysqlInstrLogin.php');
	
    if ($_GET['action'] == "DownloadFile"){
	    
	    $fileName = $_GET['File'];
		$assnID = $_SESSION[$fileName];
	    
	    $query = "SELECT * FROM Assignment as a, Course as c, Teaches as t, Instructor as i WHERE
	        i.InstructorID='$_SESSION[username]' AND
	        t.InstructorID=i.InstructorID AND
	        a.CourseID=c.courseID AND
	        t.courseID=c.courseID AND
	        a.assnID='" . $assnID ."'";
	    $result = mysql_query($query);
	    if (mysql_errno()) die(mysql_error());
	    
	    //print_r($_POST);
	    //print("Mode: ". $_POST['mode']);
	    //print_r($_GET);
	    
	    if (mysql_num_rows($result)){
    	   	header('Content-disposition: attachment; filename='.$fileName);
			header('Content-type: unknown/unknown');
			readfile($fileName);    	
	
	    } else {
	    	print("Not Authorized.");
	    }
    } else if ($_GET['action'] == "SaveFeedback"){
    	$assnID = $_POST['assnID'];
	    
	    $query = "SELECT * FROM Assignment as a, Course as c, Teaches as t, Instructor as i WHERE
	        i.InstructorID='$_SESSION[username]' AND
	        t.InstructorID=i.InstructorID AND
	        a.CourseID=c.courseID AND
	        t.courseID=c.courseID AND
	        a.assnID='" . $assnID ."'";
	    $result = mysql_query($query);
	    if (mysql_errno()) die(mysql_error());
	    if (mysql_num_rows($result) == 0) die ("Not authorized");
	    
	    
    	if (!empty($_POST['feedback'])){
  			$fileContent = $_POST['feedback'];
  			$fileName = $_POST['fileName'];
  			//print $fileContent;
   			$handle = fopen($fileName, "w");
   			fwrite($handle, $fileContent);
   			fclose($handle);
   		}
   		print("<meta http-equiv=\"REFRESH\" content=\"0;url=instr_viewSubmissions.html?AssnID=$assnID\">");
   		
    }

?>