<?php

    include ('includes/mysqlInstrLogin.php');
    include ('includes/auth.php');
	
    if (!empty($_GET['AssnID'])){
    	$assnID = $_GET['AssnID'];
    } else if (!empty($_POST['assnID'])){
    	$assnID = $_POST['assnID'];
    }
    
    $query = "SELECT * FROM Assignment as a, Course as c, Teaches as t, Instructor as i WHERE
        i.InstructorID='$_SESSION[username]' AND
        t.InstructorID=i.InstructorID AND
        a.CourseID=c.courseID AND
        t.courseID=c.courseID AND
        a.assnID='" . $assnID ."'";
    $result = mysql_query($query);
    if (mysql_errno()) print(mysql_error());
    
    //print_r($_POST);
    //print("Mode: ". $_POST['mode']);
    //print_r($_GET);
    if (mysql_num_rows($result)){
    	
    	//list all submissions
    	if (!empty($_GET['mode']) && $_GET['mode'] == "ListFiles"){
    		$query = "SELECT * FROM submission WHERE AssnID='".$_GET['AssnID']."' AND StudentID='".$_GET['StudentID']."'";
    		$result = mysql_query($query);
    		//there should be only one result
    		if (mysql_errno()) die ("Error finding submission. " . mysql_error());
    		if (mysql_num_rows($result) == 0) die ("No submission found.");
    		$row = mysql_fetch_array($result);
    		$directory = $row['Files'];
    		$handler = opendir($_SERVER['DOCUMENT_ROOT'] ."/cs411/". $directory);
    		$files = array();
    		while($file = readdir($handler)){
    			if ($file != "." && $file != "..") $files[] = $file;
    		}
    		closedir($handler);
    		
    		//$files contains all the files in this directory. list them in a table.
    		print ("<table border=0>");
    		print("<tr><td width=300><input type=radio name=viewOption value=download> Download checked files </td></tr>");
    		print("<tr><td width=300><input type=radio name=viewOption value=display> Display checked files in plain text</td></tr>");
    		if (file_exists("$directory/Feedback.txt")){
    			print("<tr><td width=300><input type=radio name=viewOption value=existing> View existing feedback file </td></tr>");
    		}
    		print("<tr><td height=10></td></tr>");
    		if (count($files) == 0){
    			$fullDir = $_SERVER['DOCUMENT_ROOT'] ."/cs411/Submissions/". $directory;
    			print("<tr><td> There are no files found for this submission. $fullDir </td></tr>");
    		}
    		for ($i = 0; $i < count($files); $i++){
    			//don't display the feedback file
    			//escape files with __
    			if ($files[$i] != "Feedback.txt" || preg_match("\\^__", $files[$i], $matches)) print ("<tr><td width=300><input type=checkbox name=files[] value=\"$directory/$files[$i]\">$files[$i] </td></tr>");
    			
    		}
    		print ("<tr><td><input type=submit value=submit></td></tr>");
    		print("<input type=hidden name=mode value=viewFiles>");
    		print("<input type=hidden name=assnID value=".$_GET['AssnID'].">");
    		print("<input type=hidden name=directory value=\"$directory\">");
    		print("</table>");
	        
	    //list a particular submission
    	} else if (!empty($_POST['mode']) && $_POST['mode'] == "viewFiles"){
	    	//print_r ($_POST['viewOption']);
			if (!empty($_POST['files'])) $files = $_POST['files'];
			$viewOption = $_POST['viewOption'];
			if ($viewOption == "display" || $viewOption == "existing"){
				$output = "";
				$rows = 0;
				if ($viewOption == "display"){
					foreach ($files as $key => $fileName){
						$lines = file($fileName);
						$output = $output . "####################################################\n";
						$output = $output . "\n$fileName\n\n";
						$output = $output . "####################################################\n\n\n";
						
						$rows +=7;
						foreach ($lines as $lineNum =>$line){
							$output = $output."# $lineNum\t$line";
							$rows++;
						}
						
						$output = $output. "\n\n\n\n\n";
						$rows += 6;
					}
					$output = trim($output);
					$rows -= 6;					
				} else if ($viewOption == "existing"){
					$lines = file($_POST['directory']."/Feedback.txt");
					foreach ($lines as $lineNum =>$line){
							$output = $output.$line;
							$rows++;
					}
				}
				
				print("<form name=textarea action=\"instr_download.php?action=SaveFeedback\" method=Post>");
				print ("<textarea name=feedback rows=$rows cols=100>$output</textarea>");
				print ("<input type=submit value=\"Save changes as comments\">");
				print ("<input type=hidden name=fileName value=\"$_POST[directory]/Feedback.txt\">");
				print ("<input type=hidden name=assnID value=$assnID>");
				print("</form>");
			} else if ($viewOption == "download"){
				
				foreach ($files as $key => $fileName){
					print ("<a href=\"instr_download.php?action=DownloadFile&File=$fileName\">$fileName</a><br>");
					$_SESSION[$fileName] = $assnID;
				}
			}
			
    	} else if ($_GET['mode'] == "ListAllSubmissions") {
    		
    		$assnID = $_GET['AssnID'];
	       
	        $query = "SELECT AssnName FROM Assignment WHERE AssnID=$assnID";
	        $result = mysql_query($query);
	        $row = mysql_fetch_array($result);
	        $assnName = $row['AssnName'];
	        $query = "SELECT StudentID FROM Submission WHERE AssnID=$assnID";
	        $result = mysql_query($query);
	        if (mysql_errno() > 0) print("Mysql error: " . mysql_error());
	        
	        print("Submissions for <a href=\"instr_assignment.html?AssnID=$assnID\">$assnName</a><br><br>");
	        while($row = mysql_fetch_array($result)){
	
	            print "<a href=\"instr_viewSubmissions.html?AssnID=$_GET[AssnID]&StudentID=$row[StudentID]\">$row[StudentID]</a><br>";
	            print("\n<br>\n");
	        }
    	} else {
    		print ("Invalid mode: ". $_GET['mode']);
    	}
    } else {
        print ("Not authorized.");
        
    }
    
?>
