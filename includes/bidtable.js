var cells=6;
var cellcount=0;
var table=document.getElementById("smtable");
var currrow;
var dbRes;

function generateTable(newRes){
	dbRes=newRes;
	setTableSize(); //Dynamically size to the user's screen
	//dbRes.forEach(element=>console.log(element));
	dbRes.forEach(generateCell); //For each character returned from the SQL query, create a table cell
	cellcount=0;
	window.addEventListener("resize", regenerateTable); //If the window is resized, then recreate the table
}

function generateCell(charInfo){ //This function creates a table cell for the item passed into it
	if(cellcount==0){ //If this is the start of the new row, create and place the table row item into the table
		currrow=document.createElement("tr");
		table.appendChild(currrow);
	}
	
	var charimg = document.createElement("img"); //Create the character icon picture
	charimg.setAttribute("src", "/edsa-Smash/icons/"+charInfo['character_name']+"HeadSSBUWebsite.png");
	charimg.setAttribute("style", "width:128px;height:128px;");
	
	var cname = document.createElement("p"); //Create the character name text object
	cname.appendChild(document.createTextNode(charInfo['character_name']));
	
	var cbid = document.createElement("p"); //Create the current bid text object
	cbid.appendChild(document.createTextNode("$"+charInfo['bid']));
	
	var bname = document.createElement("p"); //Create the buyer name text object
	bname.appendChild(document.createTextNode(charInfo['buyer_name']));
	if(charInfo['buyer_name']=="None yet"){ //If there is no current bidder, the name should appear red
		bname.setAttribute("style", "color:red");
	}
	
	var newcell = document.createElement("Button"); //Create the "invisible" button for the user to click on
	newcell.setAttribute("class", "charBtn");
	newcell.setAttribute("id", charInfo['id']);
	newcell.setAttribute("onClick", "charSelected(this.id)");
	
	newcell.appendChild(charimg); //Add all previously created elements into the button
	newcell.appendChild(cname);
	newcell.appendChild(cbid);
	newcell.appendChild(bname);
	
	var celltd = document.createElement("td");
	celltd.setAttribute("class", "cell");
	celltd.appendChild(newcell);
	currrow.appendChild(celltd); //Add the button into the table
	cellcount++;
	
	if(cellcount>=cells){ //If we've reached the cell cap for this row, reset the counter to make a new row when this function is run again
		cellcount=0;
	}
	//console.log("Generated a bid table record for "+charInfo['character_name']);
}

function setTableSize(){ //This checks the window's horizontal size, then sets the variable cells to how many cells the table should have per row
	var prevcells=cells;
	cells = (window.innerWidth-400)/200;
	cells=Math.floor(cells);
	if(cells<2) {cells=2;}
	console.log(cells);
	return prevcells==cells;
}

function regenerateTable(){ //This clears and regenerates the character table
	console.log("page resized");
	if(!setTableSize()){
		table.innerHTML="";
		dbRes.forEach(generateCell);
		cellcount=0;
	}
}