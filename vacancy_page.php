

<!DOCTYPE html>
<html>
	<head>
		<title>Find and Fill Vacancies</title>
		<style>
			*{
				font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
			}
			#main{
				background-color:#e6e6e6;
				padding:30px;	
              	min-height:600px;
              	margin:20px;
              	margin-bottom:100px;
              	min-width:1060px;
              	margin-right:25%;
			}
			.acc{
				background-color:#cce6ff;
				border-radius:2px;
				box-shadow:2px 2px 10px gray;
				padding:0px;	
				text-align:center;
				margin-left:10%;
				cursor:pointer;
				transition:0.5s;
				border:1px solid lightgray;
			}
			.acc_header{
				margin:0px;
				padding:15px;	
			}
          #main ul{
            	width:95%;
            	min-width:820px;
            	float:left;
            	margin-right:20px;
            	padding:0px;
          }
			.content{	
				background-color:#e6f3ff;
				border-radius:2px;
				position:relative;
				transition:0.5s;
				opacity:0.0;
				display:none;
			}
			.down-arrow{
				width:20px;
				height:15px;	
			}
			.close-icon{
				width:20px;
				height:20px;
				margin:8px;
				float:right;
				cursor:pointer;	
			}
			.content_table{
				width:100%;	
				border-bottom:2px solid lightgray;
			}
			.content_table td{
				padding:10px;
			}
			.prof_td{
				width:40%;
				min-width:210px;	
				text-align:left;
			}
			.pos_td{
				width:10%;
				min-width:70px;	
			}
			.yr_td{
				width:7%;
			}
			.pt_td{
				width:5%;
			}
			.replace_td{
				width:38%;
				min-width:280px;
              text-align:left;
			}
			.replacement_input{
				padding:3px;	
			}
			li{
				display:block;	
			}
			.replace_button{
				background-color:#cccccc;
				border-radius:4px;
				border:1px solid gray;
				cursor:pointer;	
              display:inline-block;
			}
			.revert{
				background-color:#ffe6e6;
				border:1px solid lightgray;
				cursor:pointer;
				border-radius:4px;
              display:inline-block;
			}
			#submit_changes{
				background-color:#009999;
				color:white;
				padding:10px;
				margin-left:45%;
				margin-top:2%;
				font-size:16px;
				border:1px solid gray;
				transition:0.5s;
				border-radius:2px;	
			}
			#submit_changes:hover{
				box-shadow: 4px 4px 10px gray;
				cursor:pointer;	
			}
			.are_you_sure{
				display:none;
				background-color:#e6e6e6;
				border:1px solid #e6e6e6;
				border-radius:4px;
				box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 8px 20px 0 rgba(0, 0, 0, 0.19);
				padding:10px;
				position:fixed;
				top:25%;
				width:20%;
				left:35%;
				z-index:2;
				text-align:center;		
			}
			#blackout{
				position:fixed;
				display:none;
				z-index:1;
				width:100%;
				height:100%;
				margin:0px;
				top:0px;
				left:0px;
				background-color:black;
				opacity:0.7;	
			}
			.replace_lst{
				color:#009999;
				text-align:center;	
			}
			.bold_checkout{
				margin-left:10px;
				margin-right:10px;
				font-size:18px;	
			}
          #ok{
            background-color:#cccccc;
            border:1px solid #bfbfbf;
            border-radius:3px;
            cursor:pointer;
            padding:5px;
            font-size:15px;
            margin-left:42%;
            width:20px;
          }
          #ok:hover{
            background-color:#99bbff;
          }
          #no{
            background-color:#668cff;
            border:1px solid #668cff;
            border-radius:3px;
            cursor:pointer;
            padding:10px;
            font-size:15px;
            float:left;
          }
          #ok:hover{
            background-color:#99bbff;
          }
          #yes{
            background-color:#cccccc;
            border:1px solid #bfbfbf;
            border-radius:3px;
            cursor:pointer;
            padding:10px;
            font-size:15px;
            float:right;
          }
          #yes:hover{
            background-color:#99bbff;
          }
          #open-collapse{
            background-color:#cccccc;
            width:5%;
            position:fixed;
            top:15%;
            left:40px;
            padding:5px;
            height:35px;
            text-align:center;
            box-shadow:2px 2px 2px gray;
            border-radius:10px;
            cursor:pointer;
          }
          #filter_div{
            position:fixed;
            top:0%;
            right:0%;
            background-color:#b3b3b3;
            width:20%;
            height:100%;
            box-shadow: 5px 5px 10px gray;
            padding:10px;
            padding-top:30px;
            min-width:250px;
            
          }
          .filter_container{
            background-color:#e6f2ff;
            border:1px solid rgb(150, 150, 150);
            box-shadow: inset 2px 2px 8px rgb(150, 150, 150);
            padding:5px;
            margin:20px;
          }
          .filter_header{
	        margin-left:20px;
	        color:rgb(85, 85, 85);  
	       }
          .checkbox{
            margin:10px;
          }
          .replace_prof{
	       	font-size:15px;
	       	padding:0px;
	       	margin:0px;
	       	margin-left:5%;
	       	color:#7733ff;   
	      }
	      .replace_prof:hover{
		   	color:#4400cc;   
		  }
		  #home_icon{
			  width:25px;
			  height:20px; 
			  color:white; 
			  position:relative;
			  cursor:pointer;
			}
		#home{
			position:fixed;
			background-color:#4d4dff;
			color:white;
			opacity:0.8;	
			padding:5px;
			top:0px;
			left:0px;
			border-radius:2px;
			cursor:pointer;
		}
		#home_text{
			position:relative;
			bottom:3px;
			margin-right:5px;
			cursor:pointer;	
		}
		#your_changes{
			text-align:center;	
			font-size:18px;
		}
		#prof_left_bold{
			margin-left: 10px;
            margin-right: 10px;
            font-size: 18px;	
		}
		#prof_replace_bold{
			margin-left: 10px;
            font-size:18px;	
		}
		#do_you_wish_to_proceed{
			text-align:center;
            font-size:18px;
		}
		#no_changes{
			text-align:center;
            font-size:18px;
		}
		.replace_prof_opts{
			position:absolute;
			background-color:#f6f6f6;	
			margin:0px;
			width:128px;
			opacity:0.95;
			z-index:3;
			padding:0px;
			font-size:14px;
			display:none;
			max-height:140px;
			overflow:hidden;
		}
		.prof_opt{
			padding:1px;
			padding-left:4px;
			padding-right:4px;
			width:120px;
			margin:0px;	
		}
		.prof_opt:hover{
			background-color:#9ae5e5;
			cursor:pointer;
		}
		.replace_div{
			margin-left:5%;	
		}
		.prof_search_choice_text{
			font-size:16px;	
			margin-left:0px;
			cursor:pointer;
		}
		#prof_search_option_list{	
			width:100%;
			padding:0px;
			height:150px;
			margin-top:0px;
			overflow-y:scroll;
			overflow-x:hidden;
		}
		#prof_search_option_list::-webkit-scrollbar{
			display:none;	
		}
		#prof_search_option_list li{
			list-style-type:none;
			margin:0px;	
			margin-left:5px;
			width:100%;
			overflow:hidden;
		}
		#prof_search_option_list li:hover{
			background-color:#cce6ff;
			cursor:pointer;	
		}
		.search{
			padding:8px;
			border:0px;
			border-bottom:2px solid #737373;
			width:93%;
			margin-right:2%;	
			margin:5px;
			margin-bottom:0px;
			font-size:13px;
			border-radius:2px;
		}
		.search:focus{
			background-color:#cccccc;	
		}
		input[type=checkbox]{
			width:15px;
			height:15px;	
		}
		#reset{
			background-color:#b3b3ff;
			width:84%;
			padding:10px;
			text-align:center;	
			margin-left:5.5%;
			margin-top:10px;
			border:1px solid #9999ff;
			box-shadow:2px 2px 8px #666666;
			transition:0.5s;
		}
		#reset:hover{
			cursor:pointer;
			background-color:rgb(185, 185, 261);
			box-shadow:1px 1px 5px #666666;
		}

		.position_li:hover{
			background-color:#cce6ff;
			cursor:pointer;	
		}
		#hidden_pass_verif{
			display:none;
			text-align:center;	
		}
		#hidden_pass_verif input[type=password]{
			padding:10px;
			border:1px solid #cccccc;
			border-radius:5px;
			margin-right:15px;
		}
		#hidden_pass_verif input[type=submit]{
			padding:10px;
			background-color:#009999;
			border-radius:5px;
			box-shadow:1px 1px 4px gray;
			color:white;
			border:1px solid gray;
			cursor:pointer;
			font-size:14px;	
			transition:0.5s;
		}
		#hidden_pass_verif input[type=submit]:hover{
			background-color:rgb(5, 158, 158);	
			box-shadow:none;
		}
		#hidden_pass_verif input[type=password]:focus{
			background-color:#cccccc;
			outline:2px solid #cce6ff;	
		}
		.prof_choice_input{
			background-color:#e6f2ff;	
			padding:8px;
		}
		.prof_choice_input:hover{
			background-color:#cce6ff;	
		}
          
		</style>
		<script>
			
			PROFS_LEAVING = [];
			PROFS_REPLACING = [];
			ROT_DATES = [];
			
			PROFS =[];
          
  
 /*~~~~~~~~~~ Format Query to send to cgi ~~~~~~~~~~~~~~~~*/
         
          function formatQuery(){
	          var finalStr = "";
	          for (var i = 0; i < PROFS_LEAVING.length; i++){
		      	  finalStr += PROFS_LEAVING[i] + ":" + PROFS_REPLACING[i] + ":" + ROT_DATES[i] + ";";
		      }
		     document.getElementById("replacements_query").value = finalStr; 
	      }
  /*~~~~~~~~~~ Collapse/ Uncollapse Button ~~~~~~~~~~~~~~~~*/
          
          function toggleCollapseBtn(){
            var btn = document.getElementById("open-collapse");
            if (btn.innerHTML == "Open All"){
              btn.innerHTML = "Collapse All";
              btn.style.backgroundColor = "#737373";
              btn.style.color = "white";
              btn.style.boxShadow = "2px 2px 2px black";
            }
            else{
              btn.innerHTML = "Open All";
              btn.style.backgroundColor = "#cccccc";
              btn.style.color = "black";
              btn.style.boxShadow = "2px 2px 2px gray";
            }
          }
          
  /*~~~~~~~~~~~~~~~~~ Collapse/ Uncollapse ~~~~~~~~~~~~~~~~*/
          
          function toggleCollapse(){
            toggleCollapseBtn();
            var accs = document.getElementsByClassName("acc");
            var btn = document.getElementById("open-collapse");
            for (var i = 0; i < accs.length; i++){
	            var curAcc = accs[i];
	            var content = document.getElementById(accs[i].id + "_content_div");
	        	if (btn.innerHTML == "Collapse All"){
					content.style.display = "block";
					content.style.transition = "0.5s";
					content.style.opacity = "1.0";
              	}
              	else{	
	            	content.style.opacity = "0.0";
	            	content.style.display = "none";
					content.style.transition = "0.2s";
	            }
            }
          }
          
          
 /*~~~~~~~~~~~~~~~~~~ Toggle Individual Accordion ~~~~~~~~~~~~~~~~*/
          
			function toggleAcc(ID, contentID){
				var curAcc = document.getElementById(ID);
				var curAccLen = (document.getElementsByClassName(ID.substring(0,(ID.length - 4)) + "_acc_content")).length;
				var content = document.getElementById(contentID);
				if (content.style.display != "block"){
					content.style.transition = "0.5s";
					content.style.opacity = "1.0";
					content.style.display = "block";
				}
				else{
					content.style.transition = "0.2s";	
					content.style.opacity = "0.0";
					content.style.display = "none";	
				}
			}
          
          
 /*~~~~~~~~~~~~~~~~~~~~ Remove from Array ~~~~~~~~~~~~~~~*/
          
			function removeFromArray(name, array, index){
				if (index != -1){
					array.splice(index, 1);	
				}
			}



 /*~~~~~~~~~~~~~~~~~~~~ Helper for changeName--Deals with case where name is empty but rotation is changed ~~~~~~~~~~~~~~~*/
 
			function changeOnlyRotation(inputID, oldNameID, rot_date){
				var curName = document.getElementById(oldNameID).innerHTML;
					var curNameText = curName.substring(3, (curName.length - 4));
					var classNameCur = document.getElementById(oldNameID).className;
					if (curNameText == classNameCur.substring(0, (classNameCur.length - 8))){
						window.alert("If you wish to change the current member's rotation date, please type in his/her name and change the rotation date to the right.");	
					}
					else{
						var curIndex = PROFS_REPLACING.indexOf(curNameText);
						ROT_DATES[curIndex] = rot_date;	
						rot_date_td.innerHTML = rot_date;
					}
			} 
	  
          
 /*~~~~~~~~~~~~~~~~~~~~ Replace Name ~~~~~~~~~~~~~~~*/
			
			function changeName(inputID, oldNameID, rot_date){
				var rot_date_td = document.getElementById("rot_date_" + oldNameID);
				var input = document.getElementById(inputID).value;
				if (input == ""){
					changeOnlyRotation(inputID, oldNameID, rot_date);
				}
				else{
					var oldName = oldNameID;
					document.getElementById(oldNameID).innerHTML = "<b>" + input + "</b>";
					rot_date_td.innerHTML = rot_date;
					
					if ((document.getElementsByClassName('revert_' + oldName)).length == 0){
						var revertInput = createSpecialElement("INPUT","","","revert_" + oldName + " revert", "Revert");
						revertInput.type = "button";
						
						revertInput.onclick = function(){
							document.getElementById(oldNameID).innerHTML = "<b>" + document.getElementById(oldNameID).className.substring(0,(document.getElementById(oldNameID).className.length - 8)) + "</b>";
							var rotDatClass = rot_date_td.className;
							rot_date_td.innerHTML = rotDatClass.substring(0, (rotDatClass.length -  6));
							var parent = document.getElementById(inputID).parentElement;
							parent.removeChild(revertInput);
							
							var curIndex = PROFS_LEAVING.indexOf(oldName);
							removeFromArray(oldName, PROFS_LEAVING, curIndex);
							removeFromArray(input, PROFS_REPLACING, curIndex);
							removeFromArray(rot_date, ROT_DATES, curIndex);
						}
						
						var appendTo = document.getElementById(inputID).parentElement;
						appendTo.appendChild(revertInput);
						
						PROFS_LEAVING.push(oldName);
						PROFS_REPLACING.push(input);
						ROT_DATES.push(rot_date);
					}
					else{
						var curIndex = PROFS_LEAVING.indexOf(oldName);	
						PROFS_REPLACING[curIndex] = input;
						ROT_DATES[curIndex] = rot_date;
					}
					
					document.getElementById(inputID).value = "";
				}	
			}
          
          
/*~~~~~~~~~~~~~~~~~~~~ Remove HTML element ~~~~~~~~~~~~~~~*/
          
          function removeElement(element){
            var parent = element.parentElement;
            parent.removeChild(element);
          }

          
/*~~~~~~~~~~~~~~~~~~~~ Close Submit Message ~~~~~~~~~~~~~~~*/
          
          function closeMsg(curDiv){
            curDiv.style.display = "none";
		    document.getElementById("blackout").style.display = "none";
          }
          
 
 /*~~~~~~~~~~~~~~~~~~~~ Create an html element with all of your specifications, 
 including id, value,className, etc~~~~~~~~~~~~~~~*/
          
          function createSpecialElement(elementType, ID, textNode, className, value){

	          var element = document.createElement(elementType);
	          
	          if (ID != ""){
		      	element.id = ID;
		      }   	
		      if (textNode != ""){
			    element.appendChild(document.createTextNode(textNode));
			  } 
			  if (className != ""){
				  element.className = className;
			  }  
			  if (value != ""){
				  element.value = value;
			  } 
			  
			  return element;
	      }
	     	               
          
 /*~~~~~~~~~~~~~~~~~~~~ Submit function ~~~~~~~~~~~~~~~*/
          
			function checkout(){				
				document.getElementById("blackout").style.display = "block";				
                if (PROFS_LEAVING.length != 0){ 
                  document.getElementById('changes_div').style.display = 'block';
                }
              else{
	              document.getElementById('no_changes_div').style.display = 'block';
              }		
			}
          
          
 /*~~~~~~~~~~~~~~~~~~~~ Toggle Checkbox ~~~~~~~~~~~~~~~*/
          
          function toggleCheckbox(ID){
            var curElem = document.getElementById(ID);
            var curElemInput = document.getElementById(curElem.htmlFor);
            if (curElemInput.checked){
              curElem.style.color = "#258e8e";
            }
            else{
              curElem.style.color = "black";
            }
          }
          
          
/*~~~~~~~~~~~~~~~~~~~~ Checks if the HTML has a class ~~~~~~~~~~~~~~~*/
          
          function hasClass(target, classname) {
             var lst = target.classList;   
             var lstWords = classname.split(" ");
             var hasWord = true;
             for (var i = 0; i < lstWords.length; i++){
	         	hasWord = hasWord && lst.contains(lstWords[i]);   
	         }
	         return hasWord;
          }
          
          
 /*~~~~~~~~~~~~~~~~~~~~ Restore all of the Divs after unchecking a filter input ~~~~~~~~~~~~~~~*/
          
          function restore(){
            var allAccs = document.getElementsByClassName("acc");
            for (var i = 0; i < allAccs.length; i++){
              allAccs[i].style.display = "block";
            }
            
            var allInputs = document.getElementsByClassName("checkbox");
            for (var j = 0; j < allInputs.length; j++){
	            var curElem = allInputs[j];
	            var curElemId = curElem.id;
              if (curElem.checked){
                filter(curElemId, (curElemId + "_text"));
              }
            }
            var checkedProf = document.getElementsByClassName("chosen")[0];
            filterAccProf(checkedProf.id);
          }
          
          
/*~~~~~~~~~~~~~~~~~~~~ Filter ~~~~~~~~~~~~~~~*/
          
          function filter(classname, label){
            toggleCheckbox(label);
            var allAccs = document.getElementsByClassName("acc");
            var curInput = document.getElementById(document.getElementById(label).htmlFor);
			
            if (curInput.checked){
              for (var i = 0; i < allAccs.length; i++){
                if (!hasClass(allAccs[i], classname)){
                  allAccs[i].style.display = "none";
                }
              }
            }
            else{
               restore();
            }
          }
          
          
    		function filterAccProf(choiceID){
	    		var allAccs = document.getElementsByClassName("acc"); 	
	    		var curChoice = document.getElementById(choiceID);
	    		var choiceName = choiceID.substring(12,curChoice.length);
	    		
	    		if (hasClass(curChoice, "chosen") == true){
		    		for (var i = 0; i < allAccs.length; i++){
		    			if (!hasClass(allAccs[i], choiceName)){
			    			allAccs[i].style.display = "none";
		    			}
		    		}	
		    	}
		    	else{
			    	restore();	
			    }
	    	}



/*~~~~~~~~~~~~~~~~~~~~~~~ Filter Profs in replacement input textbox ~~~~~~~~~~~~~~~~~~~~~~~*/
	
		function filterProfs(inputID, classname){
			var profs = document.getElementsByClassName(classname);
			var curInput = document.getElementById(inputID).value.toLowerCase();
			var inputLen = curInput.length;
			
			var i;
			for (i = 0; i < profs.length; i++){
				var curElem = profs[i];
				var curElemText = profs[i].innerHTML;
				var commaIndex = curElemText.indexOf(",");
				var firstName = curElemText.substring((commaIndex + 2), curElemText.length) + " " + curElemText.substring(0,commaIndex);
				var curSubStr = curElemText.substring(0,inputLen).toLowerCase();
				var curFirstSubStr = firstName.substring(0, inputLen).toLowerCase();
				
				if ((curSubStr !== curInput) && (curInput !== curFirstSubStr)){
					profs[i].style.display = "none";	
				}	
				else{
					profs[i].style.display = "block";	
				}
			}
		}
		

 /*~~~~~~~~~~~~~~~~~~~~ Filters profs in the filter bar on the right side ~~~~~~~~~~~~~~~*/
 		
		function filterByProfs(inputID,choiceClassName){
			var profs = document.getElementsByClassName(choiceClassName);
			var curInput = document.getElementById(inputID).value.toLowerCase();
			var inputLen = curInput.length;
			
			var i;
			for (i = 0; i < profs.length; i++){
				var curElem = profs[i];
				var curElemText = profs[i].innerHTML;
				var commaIndex = curElemText.indexOf(",");
				var firstName = curElemText.substring((commaIndex + 2), curElemText.length) + " " + curElemText.substring(0,commaIndex);
				var curSubStr = curElemText.substring(0,inputLen).toLowerCase();
				var curFirstSubStr = firstName.substring(0, inputLen).toLowerCase();
				
				if ((curSubStr !== curInput) && (curInput !== curFirstSubStr)){
					profs[i].style.display = "none";
				}	
				else{
					profs[i].style.display = "block";
				}
			}
		}
	
	
	
 /*~~~~~~~~~~~~~~~~~~~~ Creates the initial list of profs for the autocorrect list ~~~~~~~~~~~~~~~*/
 	
		function createProfOpts(dropdownID, inputID){
			var dropdown = document.getElementById(dropdownID);
			var input = document.getElementById(inputID);
			
			if (dropdown.innerHTML == ""){
				var choice;
				for (var i = 0; i < PROFS.length; i++)(function(i){
					choice = createSpecialElement("P",("prof_opt_" + PROFS[i]),PROFS[i],"prof_opt","");
					choice.onclick = function(){
						input.value = String(PROFS[i]);
					}
					dropdown.appendChild(choice);	
				})(i);
			}	
		}
		
		
 /*~~~~~~~~~~~~~~~~~~~~ finds current date ~~~~~~~~~~~~~~~*/
 
		function findCurrentDate(){
			var curDate = new Date();
			var formattedDate = "";
			
			var curYear = curDate.getFullYear();
			formattedDate += String(curYear).substring(2,4);
			return formattedDate;
		}
		
		

 /*~~~~~~~~~~~~~~~~~~~~ Hides the current submit message ~~~~~~~~~~~~~~~*/
 
		function hideMsg(ID){
			var msg = document.getElementById(ID);
			msg.style.display = 'none';
			document.getElementById('blackout').style.display = 'none';	
		}
		
		
		var chosen = false;
		function highlightChoice(choice){
			if ((chosen == false) && (hasClass(choice, "chosen") == false)){
				choice.style.backgroundColor = "#cce6ff";
				choice.className += " chosen";
				chosen = true;	
			} 
			else if ((chosen == true) && (hasClass(choice, "chosen") == true)){
				choice.style.backgroundColor = "#e6f2ff";
				chosen = false;	
				choice.className = "prof_choice_input";
			}
			else if ((chosen == true) && (hasClass(choice,"chosen") == false)){
				var chosen_li = document.getElementsByClassName("chosen");
				var oldChoice = chosen_li[0];
				oldChoice.style.backgroundColor = "#e6f2ff";
				oldChoice.className = "prof_choice_input";
				choice.style.backgroundColor = "#cce6ff";
				choice.className += " chosen";		
			}
			filterAccProf(choice.id);
		}
		
		 /*~~~~~~~~~~~~~~~~~~~~ Unchecks all of the checkboxes ~~~~~~~~~~~~~~~*/
 
		function resetCheckboxes(){
			var checkboxes = document.getElementsByClassName("checkbox");
			
			for (var i = 0; i < checkboxes.length; i++)(function(i){
				document.getElementById(checkboxes[i].id + "_text").style.color = "black";
				
				checkboxes[i].checked = false;
					
			})(i);
			var allAccs = document.getElementsByClassName("acc");
            for (var i = 0; i < allAccs.length; i++){
              allAccs[i].style.display = "block";
            }
            
            if (chosen){
            	var chosenProf = document.getElementsByClassName("chosen")[0];
            	chosenProf.style.backgroundColor = "#e6f2ff";
            	chosenProf.className = "prof_choice_input";
            	chosen = false;
            }
		}
		
		</script>
	</head>
	<body>
      
      
      <!--~~~~~~~~~~~~~~~~~ Blackout ~~~~~~~~~~~~~~~~~~~~~-->
      
		<div id="blackout">
		</div>
      
      
      <!--~~~~~~~~~~~~~~~~~ Header ~~~~~~~~~~~~~~~~~~~~~~~-->
      
		<h1 style="font-size:40px;text-align:left;margin-left:20%;">Find and Fill Upcoming Vacancies</h1>
		<div id="home" onclick="document.getElementById('home_link').click();">
      		<img src="white_home.png" id="home_icon"/>
	     	<label id="home_text"><a id="home_link" style="color:white;text-decoration:none;" href="http://mcs3.davidson.edu/workloadtracker/home.html">Home</a></label>
	    </div>
      
       <!--~~~~~~~~~~~~~~ Filter Profs ~~~~~~~~~~~~-->
              
            <div id="filter_div">
              <p style="text-align:center;border-bottom:1px solid black;">Filter By</p>
              
              <!--~~~~~~~~~~~ Only Vacancies ~~~~~~~~~~~~-->
              <input type="checkbox" class="checkbox" id="vacancy" onclick="filter('vacancy','vacancy_text');"/><label for="vacancy" id="vacancy_text">Only committees with vacancies</label>
              
              
              <!--~~~~~~~~~~~~~~~ Professor ~~~~~~~~~~~~~~~-->
              <p class="filter_header">Professor:</p>
              <div class="filter_container" style="margin:0 auto;width:90%;">
              	<input type="text" placeholder="Search..." id="search_prof" class="search" oninput="filterByProfs(this.id, 'prof_choice_input');"/>
              	<div id="prof_search_option_list">
              	<ul style="padding:0px;">
	              	{% for prof in faculty_list|sort %}
	              	<!--<li onclick="document.getElementById('search_prof_{{prof}}').click();"><input type="checkbox" class="checkbox prof_choice_input" id="search_prof_{{prof}}" onclick="this.click(); filter('{{prof}}', 'search_prof_{{prof}}_text')"><label onclick="document.getElementById('search_prof_{{prof}}').click();" for="search_prof_{{prof}}" class="prof_search_choice_text" id="search_prof_{{prof}}_text">{{prof}}</label></li>-->
	              	<li class="prof_choice_input" id="search_prof_{{prof}}" onclick="highlightChoice(this);">{{prof}}</li>
	              	{% endfor %}
	            </ul>
	            </div>
              </div>
              
              
              <!--~~~~~~~~~~~~~~~ Position ~~~~~~~~~~~~~~~-->
              <p class="filter_header">Position:</p>
              <div class="filter_container">
	              
                <div class="position_li" onclick="document.getElementById('AL').click();"><input type="checkbox" class="checkbox" id="AL" onclick="this.click();filter(this.id, (this.id + '_text'));"/><label for="AL" id="AL_text" style="cursor:pointer;" onclick="document.getElementById('AL').click();">At Large (AL)</label></div>
                
                <div class="position_li" onclick="document.getElementById('PRES').click();"><input type="checkbox" class="checkbox" id="PRES" onclick="this.click(); filter(this.id, (this.id + '_text'));"/><label style="cursor:pointer;" for="PRES" id="PRES_text" onclick="document.getElementById('PRES').click();">Presidential Appointment (PRES)</label></div>
                
                <div class="position_li" onclick="document.getElementById('SS').click();"><input type="checkbox" class="checkbox" id="SS" onclick="this.click(); filter(this.id, (this.id + '_text'));"/><label style="cursor:pointer;" for="SS" id="SS_text" onclick="document.getElementById('SS').click();">Social Sciences (SS)</label></div>
                
                <div class="position_li" onclick="document.getElementById('NSM').click();"><input type="checkbox" class="checkbox" id="NSM" onclick="this.click(); filter(this.id, (this.id + '_text'));"/><label style="cursor:pointer;" for="NSM" id="NSM_text" onclick="document.getElementById('NSM').click();">Natural Science and Math (NSM)</label></div>
                
                <div class="position_li" onclick="document.getElementById('HUM').click();"><input type="checkbox" class="checkbox" id="HUM" onclick="this.click(); filter(this.id, (this.id + '_text'));"/><label style="cursor:pointer;" for="HUM" id="HUM_text" onclick="document.getElementById('HUM').click();">Humanities (HUM)</label></div>
              </div>
              
              <!--~~~~~~~~~~~~~~~~~ Points ~~~~~~~~~~~~~~~-->
              <p class="filter_header">Points:</p>
              <div class="filter_container">
                <input type="checkbox" class="checkbox" id="0_pt" onclick="filter(this.id, (this.id + '_text'));"/><label for="0_pt" id="0_pt_text">0</label>
                <input type="checkbox" class="checkbox" id="1_pt" onclick="filter(this.id, (this.id + '_text'));"/><label for="1_pt" id="1_pt_text">1</label>
                <input type="checkbox" class="checkbox" id="2_pt" onclick="filter(this.id, (this.id + '_text'));"/><label for="2_pt" id="2_pt_text">2</label>
                <input type="checkbox" class="checkbox" id="3_pt" onclick="filter(this.id, (this.id + '_text'));"/><label for="3_pt" id="3_pt_text">3+</label>
              </div><br>
              <p id="reset" onclick="resetCheckboxes();">Reset</p>
            </div>
          
             <form action="election_changes.cgi" method="post">
             <input type="text" name="replacements_query" id="replacements_query" value="" hidden/> 

      <!--~~~~~~~~~~~~~~~~~ Main ~~~~~~~~~~~~~~~~~~~~~~~~-->
      
		<div id="main">
          <p id="open-collapse" onclick="toggleCollapse();">Open All</p>
          
			<!-- Generate for each committee -->
			<ul>
				{% for i in data|sort %}
				<li>
					<script>classname = "acc ";</script>
					
			<div id="({{i}})_acc" onclick="" class="">
				<img src="Grey_close_x.png" class="close-icon" onclick="document.getElementById('({{i}})_acc').style.display = 'none';">
				<p class="acc_header" onclick="toggleAcc('({{i}})_acc','({{i}})_acc_content_div');">{{i}}</p>
				<div class="content" id="({{i}})_acc_content_div">
					{% for j in data[i] %}
					<table class="({{i}})_acc_content content_table">
						<tr>
							<td class="{{j[2]}} prof_td" id="{{j[0]}}"><b>{{j[2]}}</b></td>
							<td class="pos_td">{{j[3]}}</td>
							<td class="{{j[4]}} yr_td" id="rot_date_{{j[0]}}">'{{j[4]}}</td>
							<td class="pt_td" style="white-space:nowrap;">{{j[1]}} pt</td>
							<td class="replace_td" id="{{j[0]}}_replace"></td>
							<script>
								var curYear = findCurrentDate();
								if (classname.indexOf("{{j[2]}}") == -1){
									classname += "{{j[2]}} ";	
								}
								if (classname.indexOf("{{j[3]}}") == -1){
									classname += "{{j[3]}} ";
								} 
								if (classname.indexOf("{{j[1]}}") == -1){
									classname += "{{j[1]}}_pt ";
								} 
								if ((classname.indexOf("vacancy") == -1) && ("{{j[4]}}" == curYear)){
									classname += "vacancy ";
								}  
								
								var replace_td = document.getElementById("{{j[0]}}_replace");
								
								/* Purple Replace Member that only shows if that position is
								not expiring soon.*/
								if ({{j[4]}} != curYear){
									var replace_prof_manual = createSpecialElement("P","replace_prof_{{j[0]}}","Replace Member","replace_prof","");
								}
								
								/* div that holds all of the replacement elements, like 
								the textbox, rotation year, Enter, and Revert*/
								var replace_div = createSpecialElement("DIV","replace_div_{{j[0]}}","","replace_div","");
								
								if ({{j[4]}} != curYear){ /* only hidden if not expiring soon */
									replace_div.style.display = "none";	
								}
								
								/* Textbox for replacing a member */
								var replace_input = createSpecialElement("INPUT","replace_{{j[0]}}","","replacement_input","");
								replace_input.type = "text";
								replace_input.placeholder = "Replacement Member";
								replace_input.autocomplete = "off";
								replace_div.appendChild(replace_input);
								
								/* Rotation year select menu */
								var replace_rot_date = createSpecialElement("SELECT","replace_rot_{{j[0]}}","","","");
								for (var i = parseInt(curYear); i < (parseInt(curYear) + 5); i++){
									var opt = document.createElement("option");
									opt.innerHTML = String(i);
									opt.value = String(i);
									replace_rot_date.add(opt);	
								}
								replace_div.appendChild(replace_rot_date);
								
								/* Enter button */
								var inputBtn = createSpecialElement("INPUT","","","replace_button","Enter");
								inputBtn.type = "button";
								inputBtn.onclick = function(){ /*Javascript stores changes */
									changeName("replace_{{j[0]}}","{{j[0]}}",replace_rot_{{j[0]}}.value); 
								};
								replace_div.appendChild(inputBtn);
								
								/* Sets function for when "Replace Member" is clicked. Only
								when term is not expiring. */
								if ({{j[4]}} != curYear){
									replace_prof_manual.onclick = function(){
										document.getElementById("replace_div_{{j[0]}}").style.display = "block";
										document.getElementById("replace_prof_{{j[0]}}").style.display = "none";
									}
									replace_td.appendChild(replace_prof_manual);
								}
								
								/* Div that will contain the autocomplete options */
								var replaceProfOpts = createSpecialElement("DIV","replace_prof_opts_{{j[0]}}","","replace_prof_opts","");
								replace_div.appendChild(replaceProfOpts);
								
								/* When someone clicks the input box, the list of professors is 
								generated and the div is shown*/
								replace_input.onclick = function (){
									createProfOpts("replace_prof_opts_{{j[0]}}","replace_{{j[0]}}");	
								}
								
								/* Starts filtering professors after every letter you enter */
								replace_input.oninput = function(){
									document.getElementById("replace_prof_opts_{{j[0]}}").style.display = "block";
									filterProfs("replace_{{j[0]}}", "prof_opt");	
								}
								
								/* When the input textbox is no longer in focus, the 
								autocomplete div disappears */
								replace_input.onblur = function(e){
																	setTimeout(function(){document.getElementById("replace_prof_opts_{{j[0]}}").style.display = "none"}, 500);
									
								}	
								replace_td.appendChild(replace_div);
								</script>
							
						</tr>
					</table>
					{% endfor %}
					
					<script>document.getElementById("({{i}})_acc").className = classname;</script>
				<div>
			</div>
			</li>
			{% endfor %}			
			</ul>
			
			{% for prof in faculty_list %}
				<script>PROFS.push("{{prof}}");</script>
			{% endfor %}
			      
			 <!--~~~~~~~~~~~~~~~ Submit ~~~~~~~~~~~~~~~~-->
			<input type="button" value="Submit Changes" id="submit_changes" onclick="checkout()"/>
			<input type="submit" id="submit_final" hidden/>
			</form>
			<div class="are_you_sure" id="no_changes_div">
				<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/4c/Grey_close_x.svg/1024px-Grey_close_x.svg.png" class="close-icon" id="close_msg" onclick="hideMsg('no_changes_div');">
				<p>You have made no changes.</p>
				<p id="ok" onclick="hideMsg('no_changes_div')">OK</p>
			</div>  
			
			<div class="are_you_sure" id="changes_div">
				<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/4c/Grey_close_x.svg/1024px-Grey_close_x.svg.png" class="close-icon" id="close_msg" onclick="hideMsg('changes_div');">
				<div id="changes_warning">
				<p>Are you sure you wish to proceed? These changes will be permanent.</p>
				<input type="button" id="no" onclick="hideMsg('changes_div')" value="No"/>
				<input type="button" id="yes" value="Yes" onclick="document.getElementById('hidden_pass_verif').style.display = 'block';document.getElementById('changes_warning').style.display = 'none';"/>
				</div>
				<div id="hidden_pass_verif">
					<p>Please enter the password:</p>
					<input type="password" required="required" name="password" id="input_pass"/>
					<input type="submit" onclick="formatQuery();" id="submit_pass"/>
				</div>
			</div>       
              
		</div> <!--main body end -->
	</body>
</html>
