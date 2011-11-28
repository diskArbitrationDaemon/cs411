
<script src="instr_getQueryVar.js">
</script>
<script type="text/javascript">
        function selectQns (){
            if(window.XMLHttpRequest){
                xmlhttpSelectQn = new XMLHttpRequest(); //TODO: need one per AJAX request
            }
            xmlhttpSelectQn.onreadystatechange=function()//TODO need a copy of this for each request
            {
                if (xmlhttpSelectQn.readyState == 4 && xmlhttpSelectQn.status == 200){
                    document.getElementById("automarking").innerHTML=xmlhttpSelectQn.responseText;
                }
            }

            xmlhttpSelectQn.open("GET", "instr_automark.php?AssnID=" + getQueryVariable("AssnID"), true); //TODO: fill in php filename and any arguments 
            xmlhttpSelectQn.send();
        }
        
        
        //send everything on the first page to the second stage in the PHP file
        //i.e. send the contents displayed by the above function (namely send just checkboxes)
        function addSamplesAndScripts(){
        	if(window.XMLHttpRequest){
                xmlhttpSampleScript = new XMLHttpRequest(); //TODO: need one per AJAX request
            }
            xmlhttpSampleScript.onreadystatechange=function()//TODO need a copy of this for each request
            {
                if (xmlhttpSampleScript.readyState == 4 && xmlhttpSampleScript.status == 200){
                    document.getElementById("automarking").innerHTML=xmlhttpSampleScript.responseText;
                }
            }
            
			
            xmlhttpSampleScript.open("POST", "instr_automark.php", true); //TODO: fill in php filename and any arguments 
            xmlhttpSampleScript.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xmlhttpSampleScript.send(
                    <?php                    	print("\"");
                     if (!empty($_POST['stage']) && ($_POST['stage'] == 2)){
                     	foreach ($_POST['automarkQns'] as $key => $value){
                    		print("automarkQns[]=$value&");
                    		print("$value=$_POST[$value]&");
                    	}
                    	
                    	print ("assnID=".$_POST['assnID']);
						print ("&action=".$_GET['action']);
                     }
                    	print("&stage=2\"");
                    	?>);
        	
        }

        
    </script>
    
<head>

<title>Illinois CS Submission system</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<script type="text/javascript">
	<?php if (empty($_POST['stage'])){
		print("selectQns();");
	} else if ($_POST['stage'] == 2){
		print ("addSamplesAndScripts();");
	}
	?>
</script>
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
							<td width=250 valign="top">
                                <iframe width=250 frameBorder="0" src="menu.php">
                                </iframe>
                            </td>

                            <td align="left">
                                <div id="automarking"">
                                </div>
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
