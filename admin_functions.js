		function getQueryVariable(variable) {
		  var query = window.location.search.substring(1);
		  var vars = query.split("&");
		  for (var i=0;i<vars.length;i++) {
			  var pair = vars[i].split("=");
				  if (pair[0] == variable) {
						return pair[1];
				  }
		  } 
		}

		// Function for showing the appropriate table
        function showTable (str){
			document.getElementById('area2').innerHTML="";			
		
            if(window.XMLHttpRequest){
                xmlhttpAssn = new XMLHttpRequest();
            }
            xmlhttpAssn.onreadystatechange=function()
            {
                if (xmlhttpAssn.readyState == 4 && xmlhttpAssn.status == 200){
                    document.getElementById("area1").innerHTML=xmlhttpAssn.responseText;
                }
            }
			
            xmlhttpAssn.open("GET", "admin_selectTable.php?table="+str, true);
            xmlhttpAssn.send();
        }
		
		// Function for showing the insert page
		function showInsert (str){
			document.getElementById('area2').innerHTML="";

		
            if(window.XMLHttpRequest){
                xmlhttpAssn = new XMLHttpRequest();
            }
            xmlhttpAssn.onreadystatechange=function()
            {
                if (xmlhttpAssn.readyState == 4 && xmlhttpAssn.status == 200){
                    document.getElementById("area1").innerHTML=xmlhttpAssn.responseText;
                }
            }
			
            xmlhttpAssn.open("GET", "admin_insertPage.php?table="+str, true);
            xmlhttpAssn.send();
        }
		
		
		// Reads form input from insertAssignment
		// Parameter type: 'insert', 'edit'
		function submitAssignment (form, assnID, type){ 
			var assnName = form.assnName.value;
			var groupWork = form.groupWork.options[form.groupWork.selectedIndex].value;
			var maxMark = form.maxMark.value;
			var avgMark = form.avgMark.value;
			var medianMark = form.medianMark.value;
			var courseID = form.courseID.options[form.courseID.selectedIndex].value;
			var month = form.monthName.options[form.monthName.selectedIndex].value;
			var day = form.dayName.options[form.dayName.selectedIndex].value;
			var year = form.year.options[form.year.selectedIndex].value;
			var hour = form.hour.options[form.hour.selectedIndex].value;
			var minute = form.minute.options[form.minute.selectedIndex].value;
			var second = form.second.options[form.second.selectedIndex].value;

			if (assnName == "")
			{
				document.getElementById("errorSpot").innerHTML="<font color=red>* You must enter an 'Assignment Name'</font>";
			}
			
			else
			{
				document.getElementById('errorSpot').innerHTML="";
				
				if(window.XMLHttpRequest)
				{
					xmlhttpAssn = new XMLHttpRequest();
				}
					xmlhttpAssn.onreadystatechange=function()
					{
						if (xmlhttpAssn.readyState == 4 && xmlhttpAssn.status == 200){
							document.getElementById("errorSpot").innerHTML=xmlhttpAssn.responseText;
						}
					}
				
				var url = "";
				if (type == 'insert')   // Type: Insert Assignment
				{
					url = "admin_insertToDB.php";
				}
				if (type == "edit")   // Type: Edit Assignment
				{
					url = "admin_editToDB.php";
				}
				
				xmlhttpAssn.open("GET", url+"?table="+"assignment"+
								"&assnID="+assnID+
								"&assnName="+assnName+
								"&groupWork="+groupWork+
								"&maxMark="+maxMark+
								"&avgMark="+avgMark+
								"&medianMark="+medianMark+
								"&courseID="+courseID+
								"&month="+month+
								"&day="+day+
								"&year="+year+
								"&hour="+hour+
								"&minute="+minute+
								"&second="+second, true);
				xmlhttpAssn.send();
			}
        }
		
		
		// Reads form input from insertAutomark
		// Parameter type: 'insert', 'edit'
		function submitAutomark (form, automarkID, type){ 
			var sampleSoln = form.sampleSoln.value;
			var configs = form.configs.value;
			var assnID = form.assnID.options[form.assnID.selectedIndex].value;

			if (sampleSoln == "")
			{
				document.getElementById("errorSpot").innerHTML="<font color=red>* You must enter a 'Sample Solution Directory'</font>";
			}
			
			else if (configs == "")
			{
				document.getElementById("errorSpot").innerHTML="<font color=red>* You must enter 'Configs'</font>";
			}
			
			else
			{
				document.getElementById('errorSpot').innerHTML="";
				
				if(window.XMLHttpRequest)
				{
					xmlhttpAssn = new XMLHttpRequest();
				}
					xmlhttpAssn.onreadystatechange=function()
					{
						if (xmlhttpAssn.readyState == 4 && xmlhttpAssn.status == 200){
							document.getElementById("errorSpot").innerHTML=xmlhttpAssn.responseText;
						}
					}
				
				var url = "";
				if (type == 'insert')   // Type: Insert Assignment
				{
					url = "admin_insertToDB.php";
				}
				if (type == "edit")   // Type: Edit Assignment
				{
					url = "admin_editToDB.php";
				}
				
				xmlhttpAssn.open("GET", url+"?table="+"automarking"+
								"&AutomarkID="+automarkID+
								"&SampleSoln="+sampleSoln+
								"&Configs="+configs+
								"&AssnID="+assnID, true);
				xmlhttpAssn.send();
			}
        }
		
		
		// Reads form input from insertCourse
		// Parameter type: 'insert', 'edit'
		function submitCourse (form, courseID, type){ 
			
			var courseName = form.courseName.value;
			var numStudents = form.numStudents.value;
			var season = form.season.options[form.season.selectedIndex].value;
			var year = form.year.options[form.year.selectedIndex].value;
				
			var yearEnd = year.substring(2);
			var semesterName = season + yearEnd;
			
			if (courseName == "")
			{
				document.getElementById("errorSpot").innerHTML="<font color=red>* You must enter a 'Course Name'</font>";
			}
			
			else if (numStudents == "")
			{
				document.getElementById("errorSpot").innerHTML="<font color=red>* You must enter the 'Number of Students'</font>";
			}
			
			else if (isNaN(numStudents))
			{
				document.getElementById("errorSpot").innerHTML="<font color=red>* Invalid input for 'Number of Students'</font>";
			}
			
			else
			{
				document.getElementById('errorSpot').innerHTML="";
				
				if(window.XMLHttpRequest)
				{
					xmlhttpAssn = new XMLHttpRequest();
				}
					xmlhttpAssn.onreadystatechange=function()
					{
						if (xmlhttpAssn.readyState == 4 && xmlhttpAssn.status == 200){
							document.getElementById("errorSpot").innerHTML=xmlhttpAssn.responseText;
						}
					}
				
				var url = "";
				if (type == 'insert')   // Type: Insert Assignment
				{
					url = "admin_insertToDB.php";
				}
				if (type == "edit")   // Type: Edit Assignment
				{
					url = "admin_editToDB.php";
				}
				
				xmlhttpAssn.open("GET", url+"?table="+"course"+
								"&CourseID="+courseID+
								"&CourseName="+courseName+
								"&NumStudents="+numStudents+
								"&SemesterName="+semesterName, true);
				xmlhttpAssn.send();
			}
        }
		
		
		// Reads form input from insertGroup
		// Parameter type: 'insert', 'edit'
		function submitGroup (form, oldGroup, oldAssn, type){ 				
			var groupName = form.groupName.value;
			var assnID = form.assnID.options[form.assnID.selectedIndex].value;
		
			if (groupName == "")
			{
				document.getElementById("errorSpot").innerHTML="<font color=red>* You must enter a 'Group Name'</font>";
			}
			
			else
			{
				document.getElementById('errorSpot').innerHTML="";
				
				if(window.XMLHttpRequest)
				{
					xmlhttpAssn = new XMLHttpRequest();
				}
					xmlhttpAssn.onreadystatechange=function()
					{
						if (xmlhttpAssn.readyState == 4 && xmlhttpAssn.status == 200){
							document.getElementById("errorSpot").innerHTML=xmlhttpAssn.responseText;
						}
					}
				
				var url = "";
				if (type == 'insert')   // Type: Insert Assignment
				{
					url = "admin_insertToDB.php";
				}
				if (type == "edit")   // Type: Edit Assignment
				{
					url = "admin_editToDB.php";
				}
				
				xmlhttpAssn.open("GET", url+"?table="+"group"+
								"&OldGroup="+oldGroup+
								"&OldAssn="+oldAssn+
								"&GroupName="+groupName+
								"&AssnID="+assnID, true);
				xmlhttpAssn.send();
			}
        }
		
		
		
		// Reads form input from insertGroup
		// Parameter type: 'insert', 'edit'
		function submitInstructor (form, id, type){ 				
		
			if (type == "insert")
				var instructorID = form.instructorID.value;
			else
				var instructorID = id;
				
			var firstName = form.firstName.value;
			var lastName = form.lastName.value;
			var phone1 = form.phone1.value;
			var phone2 = form.phone2.value;
			var phone3 = form.phone3.value;
			var officeLocation = form.officeLocation.value;
			var email = form.email.value;
			if (type == "insert")
				var user = form.user.options[form.user.selectedIndex].value;
			else
				var user = id;
			
			var phoneNumber = phone1+phone2+phone3;
			
			if (instructorID == "")
			{
				document.getElementById("errorSpot").innerHTML="<font color=red>* You must enter an 'Instructor ID'</font>";
			}
	
			else if (firstName == "")
			{
				document.getElementById("errorSpot").innerHTML="<font color=red>* You must enter a 'First Name'</font>";
			}
			
			else if (lastName == "")
			{
				document.getElementById("errorSpot").innerHTML="<font color=red>* You must enter a 'Last Name'</font>";
			}
			
			else if (phoneNumber == "")
			{
				document.getElementById("errorSpot").innerHTML="<font color=red>* You must enter a 'Phone Number'</font>";
			}
			
			else if ((phone1.length != 3 || isNaN(phone1)) || (phone2.length != 3 || isNaN(phone2)) || (phone3.length != 4 || isNaN(phone3)))
			{
				document.getElementById("errorSpot").innerHTML="<font color=red>* Invalid input for 'Phone Number'</font>";
			}
			
			else if (officeLocation == "")
			{
				document.getElementById("errorSpot").innerHTML="<font color=red>* You must enter an 'Office Location'</font>";
			}
			
			else if (email == "")
			{
				document.getElementById("errorSpot").innerHTML="<font color=red>* You must enter an 'Email'</font>";
			}
			
			if (user == "")
			{
				document.getElementById("errorSpot").innerHTML="<font color=red>* You must enter a 'Username'</font>";
			}
			
			else if (user != instructorID)
			{
				document.getElementById("errorSpot").innerHTML="<font color=red>* Instructor ID and Username MUST match.  May need to add user first.</font>";
			}
			
			else
			{
				document.getElementById('errorSpot').innerHTML="";
				
				if(window.XMLHttpRequest)
				{
					xmlhttpAssn = new XMLHttpRequest();
				}
					xmlhttpAssn.onreadystatechange=function()
					{
						if (xmlhttpAssn.readyState == 4 && xmlhttpAssn.status == 200){
							document.getElementById("errorSpot").innerHTML=xmlhttpAssn.responseText;
						}
					}
				
				var url = "";
				if (type == 'insert')   // Type: Insert Assignment
				{
					url = "admin_insertToDB.php";
				}
				if (type == "edit")   // Type: Edit Assignment
				{
					url = "admin_editToDB.php";
				}
				
				xmlhttpAssn.open("GET", url+"?table="+"instructor"+
								"&InstructorID="+instructorID+
								"&FirstName="+firstName+
								"&LastName="+lastName+
								"&PhoneNumber="+phoneNumber+
								"&OfficeLocation="+officeLocation+
								"&Username="+user+
								"&Email="+email, true);
				xmlhttpAssn.send();
			}
			
		}
        
		
		// Reads form input from insertMemberof
		// Parameter type: 'insert', 'edit'
		function submitMemberof (form, oldGroup, oldStudentID, oldAssnID, type){ 
			
			var groupName = form.groupName.options[form.groupName.selectedIndex].value;
			var studentID = form.studentID.options[form.studentID.selectedIndex].value;
			var assnID = form.assnID.options[form.assnID.selectedIndex].value;			
		
				document.getElementById('errorSpot').innerHTML="";
				
				if(window.XMLHttpRequest)
				{
					xmlhttpAssn = new XMLHttpRequest();
				}
					xmlhttpAssn.onreadystatechange=function()
					{
						if (xmlhttpAssn.readyState == 4 && xmlhttpAssn.status == 200){
							document.getElementById("errorSpot").innerHTML=xmlhttpAssn.responseText;
						}
					}
								
				var url = "";
				if (type == 'insert')   // Type: Insert Assignment
				{
					url = "admin_insertToDB.php";
				}
				if (type == "edit")   // Type: Edit Assignment
				{
					url = "admin_editToDB.php";
				}
				
				xmlhttpAssn.open("GET", url+"?table="+"memberof"+
								"&OldGroup="+oldGroup+
								"&OldStudentID="+oldStudentID+
								"&OldAssnID="+oldAssnID+
								"&GroupName="+groupName+
								"&StudentID="+studentID+
								"&AssnID="+assnID, true);
				xmlhttpAssn.send();
			
        }
		
		
		// Reads form input from insertQuestion
		// Parameter type: 'insert', 'edit'
		function submitQuestion (form, questionID, type){ 
			
			var questionName = form.questionName.value;
			var fullMark = form.fullMark.value;
			var assnID = form.assnID.options[form.assnID.selectedIndex].value;
			
			if (questionName == "")
			{
				document.getElementById("errorSpot").innerHTML="<font color=red>* You must enter a 'Question Name'</font>";
			}
			
			else if (fullMark == "")
			{
				document.getElementById("errorSpot").innerHTML="<font color=red>* You must enter the 'Full Mark'</font>";
			}
			
			else if (isNaN(fullMark))
			{
				document.getElementById("errorSpot").innerHTML="<font color=red>* Invalid input for 'Full Mark'</font>";
			}
			
			else
			{
				document.getElementById('errorSpot').innerHTML="";
				
				if(window.XMLHttpRequest)
				{
					xmlhttpAssn = new XMLHttpRequest();
				}
					xmlhttpAssn.onreadystatechange=function()
					{
						if (xmlhttpAssn.readyState == 4 && xmlhttpAssn.status == 200){
							document.getElementById("errorSpot").innerHTML=xmlhttpAssn.responseText;
						}
					}
				
				var url = "";
				if (type == 'insert')   // Type: Insert Assignment
				{
					url = "admin_insertToDB.php";
				}
				if (type == "edit")   // Type: Edit Assignment
				{
					url = "admin_editToDB.php";
				}
				
				xmlhttpAssn.open("GET", url+"?table="+"questions"+
								"&QuestionID="+questionID+
								"&QuestionName="+questionName+
								"&FullMark="+fullMark+
								"&AssnID="+assnID, true);
				xmlhttpAssn.send();
			}
        }
		
		
		
		// Reads form input from insertStudent
		// Parameter type: 'insert', 'edit'
		function submitStudent (form, id, type){ 
			
			if (type == "insert")
				var studentID = form.studentID.value;
			else
				var studentID = id;
				
			var major = form.major.value;
			var lastName = form.lastName.value;
			var firstName = form.firstName.value;
			if (type == "insert")
				var user = form.user.options[form.user.selectedIndex].value;
			else
				var user = id;
				
			if (studentID == "")
			{
				document.getElementById("errorSpot").innerHTML="<font color=red>* You must enter a 'Student ID'</font>";
			}
			
			else if (major == "")
			{
				document.getElementById("errorSpot").innerHTML="<font color=red>* You must enter a 'Major'</font>";
			}
			
			else if (lastName == "")
			{
				document.getElementById("errorSpot").innerHTML="<font color=red>* You must enter a 'Last Name'</font>";
			}
			
			else if (firstName == "")
			{
				document.getElementById("errorSpot").innerHTML="<font color=red>* You must enter a 'First Name'</font>";
			}
			
			if (user == "")
			{
				document.getElementById("errorSpot").innerHTML="<font color=red>* You must enter a 'Username'</font>";
			}
			
			else if (user != studentID)
			{
				document.getElementById("errorSpot").innerHTML="<font color=red>* Instructor ID and Username MUST match.  May need to add user first.</font>";
			}
			
			else
			{
				document.getElementById('errorSpot').innerHTML="";
				
				if(window.XMLHttpRequest)
				{
					xmlhttpAssn = new XMLHttpRequest();
				}
					xmlhttpAssn.onreadystatechange=function()
					{
						if (xmlhttpAssn.readyState == 4 && xmlhttpAssn.status == 200){
							document.getElementById("errorSpot").innerHTML=xmlhttpAssn.responseText;
						}
					}
				
				var url = "";
				if (type == 'insert')   // Type: Insert Assignment
				{
					url = "admin_insertToDB.php";
				}
				if (type == "edit")   // Type: Edit Assignment
				{
					url = "admin_editToDB.php";
				}
				
				xmlhttpAssn.open("GET", url+"?table="+"student"+
								"&StudentID="+studentID+
								"&Major="+major+
								"&LastName="+lastName+
								"&Username="+user+
								"&FirstName="+firstName, true);
				xmlhttpAssn.send();
			}
			
        }
		
		
		
		// Reads form input from insertTakes
		// Parameter type: 'insert', 'edit'
		function submitTakes (form, oldStudentID, oldCourseID, type){ 
			
			var studentID = form.studentID.options[form.studentID.selectedIndex].value;
			var courseID = form.courseID.options[form.courseID.selectedIndex].value;
			var finalMark = form.finalMark.value;

		
				document.getElementById('errorSpot').innerHTML="";
				
				if(window.XMLHttpRequest)
				{
					xmlhttpAssn = new XMLHttpRequest();
				}
					xmlhttpAssn.onreadystatechange=function()
					{
						if (xmlhttpAssn.readyState == 4 && xmlhttpAssn.status == 200){
							document.getElementById("errorSpot").innerHTML=xmlhttpAssn.responseText;
						}
					}
				
				var url = "";
				if (type == 'insert')   // Type: Insert Assignment
				{
					url = "admin_insertToDB.php";
				}
				if (type == "edit")   // Type: Edit Assignment
				{
					url = "admin_editToDB.php";
				}
				
				xmlhttpAssn.open("GET", url+"?table="+"takes"+
								"&OldStudentID="+oldStudentID+
								"&OldCourseID="+oldCourseID+
								"&StudentID="+studentID+
								"&CourseID="+courseID+
								"&FinalMark="+finalMark, true);
				xmlhttpAssn.send();
			
        }
		
		
		
		// Reads form input from insertGroup
		// Parameter type: 'insert', 'edit'
		function submitTeaches (form, oldInstructorID, oldCourseID, type){ 				
			var instructorID = form.instructorID.value;
			var courseID = form.courseID.options[form.courseID.selectedIndex].value;
		
				document.getElementById('errorSpot').innerHTML="";
				
				if(window.XMLHttpRequest)
				{
					xmlhttpAssn = new XMLHttpRequest();
				}
					xmlhttpAssn.onreadystatechange=function()
					{
						if (xmlhttpAssn.readyState == 4 && xmlhttpAssn.status == 200){
							document.getElementById("errorSpot").innerHTML=xmlhttpAssn.responseText;
						}
					}
				
				var url = "";
				if (type == 'insert')   // Type: Insert Assignment
				{
					url = "admin_insertToDB.php";
				}
				if (type == "edit")   // Type: Edit Assignment
				{
					url = "admin_editToDB.php";
				}
				
				xmlhttpAssn.open("GET", url+"?table="+"teaches"+
								"&OldInstructorID="+oldInstructorID+
								"&OldCourseID="+oldCourseID+
								"&InstructorID="+instructorID+
								"&CourseID="+courseID, true);
				xmlhttpAssn.send();
        }
		
		
		
		// Reads form input from insertUser
		// Parameter type: 'insert', 'edit'
		function submitUser (form, id, type, passwordChange){ 
			
			if (type == "insert")
				var username = form.username.value;
			else
				var username = id;
				
			var password1 = form.password1.value;
			var password2 = form.password2.value;
			var adminPerm = form.adminPerm.options[form.adminPerm.selectedIndex].value;
			
			if (passwordChange != password1)
				passwordChange = "";
			
			if (username == "")
			{
				document.getElementById("errorSpot").innerHTML="<font color=red>* You must enter a 'Username'</font>";
			}
			
			else if (password1 == "")
			{
				document.getElementById("errorSpot").innerHTML="<font color=red>* You must enter the 'Password'</font>";
			}
			
			else if (password2 == "")
			{
				document.getElementById("errorSpot").innerHTML="<font color=red>* You must enter the 'Password'</font>";
			}
			
			else if (password1 != password2)
			{
				document.getElementById("errorSpot").innerHTML="<font color=red>* Passwords do not match!</font>";
			}
			
			else
			{
				document.getElementById('errorSpot').innerHTML="";
				
				if(window.XMLHttpRequest)
				{
					xmlhttpAssn = new XMLHttpRequest();
				}
					xmlhttpAssn.onreadystatechange=function()
					{
						if (xmlhttpAssn.readyState == 4 && xmlhttpAssn.status == 200){
							document.getElementById("errorSpot").innerHTML=xmlhttpAssn.responseText;
						}
					}
				
				var url = "";
				if (type == 'insert')   // Type: Insert Assignment
				{
					url = "admin_insertToDB.php";
				}
				if (type == "edit")   // Type: Edit Assignment
				{
					url = "admin_editToDB.php";
				}
				
				xmlhttpAssn.open("GET", url+"?table="+"users"+
								"&Username="+username+
								"&Password="+password1+
								"&AdminPerm="+adminPerm+
								"&PasswordChange="+passwordChange, true);
				xmlhttpAssn.send();
			}
        }
		
		// Function for showing the edit page
		function showEdit (table, rowID, rowIDtwo, rowIDthree){
			document.getElementById('area2').innerHTML="";

		
            if(window.XMLHttpRequest){
                xmlhttpAssn = new XMLHttpRequest();
            }
            xmlhttpAssn.onreadystatechange=function()
            {
                if (xmlhttpAssn.readyState == 4 && xmlhttpAssn.status == 200){
                    document.getElementById("area1").innerHTML=xmlhttpAssn.responseText;
                }
            }
			
            xmlhttpAssn.open("GET", "admin_editPage.php?table="+table+"&rowID="+rowID+"&rowIDtwo="+rowIDtwo+"&rowIDthree="+rowIDthree, true);
            xmlhttpAssn.send();
        }
		
		
		// Function for showing the delete confirmation
		function showDelete (table, rowID, rowIDtwo, rowIDthree){
			document.getElementById('area2').innerHTML="";

			var alertBox = confirm("Are you sure you want to delete this record?");
			if (alertBox == true)
			{		
				if(window.XMLHttpRequest){
					xmlhttpAssn = new XMLHttpRequest();
				}
				xmlhttpAssn.onreadystatechange=function()
				{
					if (xmlhttpAssn.readyState == 4 && xmlhttpAssn.status == 200){
						document.getElementById("area2").innerHTML=xmlhttpAssn.responseText;
					}
				}
				
				xmlhttpAssn.open("GET", "admin_deletePage.php?table="+table+"&rowID="+rowID+"&rowIDtwo="+rowIDtwo+"&rowIDthree="+rowIDthree, true);
				xmlhttpAssn.send();
			}
			
        }
		
		