
/***************** SORT FUNCTION *****************/

/* Starting positions of the arrows-- "-1" translates to a down arrow, "1" translates to an up arrow */
var faculty, asc0= -1, 
asc1 = -1,
asc2 = -1;
asc3 = -1;
asc4 = -1;

window.onload = function () {
	faculty = document.getElementById("result_table_body");
}

function sort_table(tbody, col, asc) {
	/* gets the new arrow (multiplied by -1 in the html) */
	/* -1.png is the down arrow, 1.png is the up arrow */
	document.getElementById(col+"imgsort").src = asc+'.png'; 
	
	var rows = tbody.rows,
	rlen = rows.length,
	arr = new Array(),
	i, j, cells, clen;
	
	// fill the array with values from the table
	for (i = 0; i < rlen; i++) {
		cells = rows[i].cells;
		clen = cells.length;
		arr[i] = new Array();
		for (j = 0; j < clen; j++) {
			arr[i][j] = cells[j].innerHTML;
		}
	}
	// sort the array by the specified column number (col) and order (asc)
	arr.sort(function (a, b) {
		return (a[col] == b[col]) ? 0 : ((a[col] > b[col]) ? asc : -1 * asc);
	});
	// replace existing rows with new rows created from the sorted array
	for (i = 0; i < rlen; i++) {
		var row= ("<td style='width:30%;'>" + arr[i][0] +"</td>" +
		"<td style='width:15%;'>" + arr[i][1] +"</td>" +
		"<td style='width:10%;'>" + arr[i][2] +"</td>" +
		"<td style='width:10%;'>" + arr[i][3] +"</td>" +
		"<td style='width:35%;'>" + arr[i][4] +"</td>" )
		
		rows[i].innerHTML = row;
	}
}


/***************** Toggle Checkboxes *****************/

/*Turns the checkbox text teal if clicked (black if not)*/
function toggleCheckbox(labelID){
	var curElem = document.getElementById(labelID);
	var curElemInput = document.getElementById(curElem.htmlFor);
	if (curElemInput.checked){
		curElem.style.color = "#258e8e";
	}
	else{
		curElem.style.color = "black";
	}
}



/***************** Passes off the input string from the general search box to the search_professor.cgi file *****************/

function returnIndFacStr(){
	var str = "";
	str += document.getElementById("FacultyFullName").value;
	document.getElementById("hidden_ind_fac_input").value = str;
}



function assignValToQuery(queryStr, curInputID){
	if (queryStr != ""){
		queryStr += ("," + curInputID);  
	}   
	else{
		queryStr += curInputID;
	}
	return queryStr;
}

/******* Takes the ids from each of the checked boxes and formats them into a string for each field. 
Those strings become the values of hidden inputs which are then accessed in the search_professor.cgi file *******/

function formatQuery(){
		
	var allInputs = document.getElementsByTagName("input");
	var rankQuery = "";
	var divQuery = "";
	var numComQuery = "";
	var numPtQuery = "";
	var leaveQuery = "";
	for (var i = 0; i < allInputs.length; i++){
		if ((allInputs[i].type == "checkbox") && allInputs[i].checked){		
			if (allInputs[i].className == "rank checkbox"){
				rankQuery = assignValToQuery(rankQuery, allInputs[i].id);
			}
			else if (allInputs[i].className == "division checkbox"){
				divQuery = assignValToQuery(divQuery, allInputs[i].id);
			}
			else if (allInputs[i].className == "num_com checkbox"){
				numComQuery = assignValToQuery(numComQuery, allInputs[i].id);
			}
			else if (allInputs[i].className == "num_pt checkbox"){
				var labelText = document.getElementById(allInputs[i].id + "_label").innerHTML;
				numPtQuery = assignValToQuery(numPtQuery, labelText);
			}
		}
		else if ((allInputs[i].type == "radio") && (allInputs[i].checked)){
			if ((allInputs[i].id == "incl_plans")){
				leaveQuery += "include plans";
			}
			else{
				leaveQuery += "no plans";
			}
		}
	}
	document.getElementById("rank_submit").value = rankQuery;
	document.getElementById("division_submit").value = divQuery; 
	document.getElementById("num_com_submit").value = numComQuery;  
	document.getElementById("num_pt_submit").value = numPtQuery;
	document.getElementById("leave_info").value = leaveQuery;
}


/*********** Uncheck all Checkboxes ******************/

function clearAll(){
	var checkboxes = document.getElementsByClassName("checkbox");
	for (var i = 0; i < checkboxes.length; i++){
		checkboxes[i].checked = false;	
		document.getElementById(checkboxes[i].id + "_label").style.color = "black";
	}	
	document.getElementById('incl_plans').checked = true;
}
