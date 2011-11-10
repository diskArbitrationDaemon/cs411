	
function addQuestion(){ 

    var table = document.getElementById ('QuestionsTable'); 
    var row1 = table.insertRow(table.rows.length); 
    var row2 = table.insertRow(table.rows.length);
    var row3 = table.insertRow(table.rows.length);
    
    var cell0 = row1.insertCell(0); 
    var cell1 = row1.insertCell(1);
    var cell2 = row1.insertCell(2);
    
    var cell0Width = 135;
    var cell1Width = 60;
    var cell2Width = 350;
    
    cell0.innerHTML="Question Name"; 
    cell0.width=cell0Width;
    cell0.align="right";
    
    cell1.width=cell1Width;
    
    var element = document.createElement("input"); 
    element.setAttribute("type", "input"); 
    element.setAttribute("name", "QuestionName[]");
    element.setAttribute("size", "25");
    cell2.appendChild(element); 
    cell2.align="Left"; 
    cell2.cell2Width=350;
    
    var cell0 = row2.insertCell(0); 
    var cell1 = row2.insertCell(1);
    var cell2 = row2.insertCell(2);
    
    cell0.innerHTML="Full mark";
    cell0.width=cell0Width;
    cell0.align="right";
    
    cell1.width=cell1Width;
    var element = document.createElement("input"); 
    element.setAttribute("type", "input"); 
    element.setAttribute("name", "QuestionMark[]");
    element.setAttribute("size", "25");
    cell2.appendChild(element); 
    cell2.align="Left"; 
    cell2.cell2Width=350;
    
    var cell0 = row3.insertCell(0); 
    var cell1 = row3.insertCell(1);
    var cell2 = row3.insertCell(2);
    var paddRowHeight = 20;
    cell0.height=paddRowHeight;
    cell1.height=paddRowHeight;
    cell2.height=paddRowHeight;
    

} 
