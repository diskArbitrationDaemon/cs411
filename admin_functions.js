
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
			var courseName = form.courseName.options[form.courseName.selectedIndex].value;
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
								"&courseName="+courseName+
								"&month="+month+
								"&day="+day+
								"&year="+year+
								"&hour="+hour+
								"&minute="+minute+
								"&second="+second, true);
				xmlhttpAssn.send();
			}
        }
		
		
		// Function for showing the edit page
		function showEdit (table, rowID){
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
			
            xmlhttpAssn.open("GET", "admin_editPage.php?table="+table+"&rowID="+rowID, true);
            xmlhttpAssn.send();
        }
		
		
		// Function for showing the delete confirmation
		function showDelete (table, rowID){
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
				
				xmlhttpAssn.open("GET", "admin_deletePage.php?table="+table+"&rowID="+rowID, true);
				xmlhttpAssn.send();
			}
			
        }
		