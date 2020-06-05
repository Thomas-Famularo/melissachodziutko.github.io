var htable=document.getElementById("htable");
var hdbRes;

function generateHTable(newRes){
	if(newRes==-1){
		document.getElementById("history").appendChild(document.createElement("h1").appendChild(document.createTextNode("The bidding has just begun! Be the first to bid!")));
	}
	else{
		hdbRes=newRes;
		//hdbRes.forEach(element=>console.log(element));
		hdbRes.forEach(generateHRow); //For each character returned from the SQL query, create a table cell
	}
}

function generateHRow(charInfo){
	var charimg = document.createElement("img"); //Create the character icon picture
	charimg.setAttribute("src", "/edsa-Smash/icons/"+charInfo['char_name']+"HeadSSBUWebsite.png");
	charimg.setAttribute("style", "width:150px;height:150px;");
	
	var udate = document.createElement("p"); //Create the update date text object
	udate.appendChild(document.createTextNode("At "+charInfo['update_date']+":"));
	
	var uinfo = document.createElement("p"); //Create the short line of text describing the change
	uinfo.appendChild(document.createTextNode(charInfo['buyer_name']+" bid $"+charInfo['bid']+" on "+charInfo['char_name']+"."));
	
	var imgtd=document.createElement("td"); //Add all previously created elements into table segments
	imgtd.setAttribute("style", "width:150px;height:150px;");
	imgtd.appendChild(charimg);
	var texttd=document.createElement("td");
	texttd.appendChild(udate);
	texttd.appendChild(uinfo);
	
	var urow=document.createElement("tr"); //Add table segments to a new row
	urow.appendChild(imgtd);
	urow.appendChild(texttd);
	htable.appendChild(urow);
	//console.log("Generated a history table record for "+charInfo['char_name']);
}