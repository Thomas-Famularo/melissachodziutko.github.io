//This is the function that populates and runs the rolling message box, which I refer to as the "ticker."
const normLines = ["[buyer_name] bid $[bid] on [char_name].", "[char_name] is now worth $[bid]!", "Thanks to [buyer_name], [char_name] is now worth $[bid]!", "[char_name] now costs $[bid].", "[buyer_name] wants to play [char_name]!", "At [update_date], [buyer_name] put down $[bid] on [char_name].", "[char_name] is now worth $[bid]!", "Look out! [buyer_name] is willing to put down $[bid] for [char_name]!"]; //These are the lines that get used to construct phrases for the ticker
var ScrollRate = 6000; //This is the interval between scrolls in the ticker
var LineHeight = 35; //Set this equal to overall.css->.ticker->line-height
var smscrcounter = 0; 
var firstit = true; 
var Smooth; var Scroll;
var ticker = document.getElementById("ticker");
var row1;
var row2;
var row3;
var row4;
var row5;

function placeText(r1, r2, r3, r4, r5) { //This function creates and places text into the ticker text box
	//console.log("thought about text");
	row1=r1;
	row2=r2;
	row3=r3;
	row4=r4;
	row5=r5;
	if(row1==-1){ //-1 is the "nothing to return" value, so if row1=-1, then nothing was found
		console.log("No bids found."); 
		ticker.appendChild(document.createElement("p").appendChild(document.createTextNode("There are no bids yet. Be the first to bid!"))); //So tell the user!
		ticker.appendChild(document.createElement("br"));
		ticker.appendChild(document.createElement("p").appendChild(document.createTextNode("There are no bids yet. Be the first to bid!")));
	}
	else{ //Otherwise, create and place text
		console.log("Bids found.");
		var firtextLine=normLines[Math.floor(Math.random() * normLines.length)]; //This variable exists because the first line of text needs to be placed at the beginning and the end to properly create the infinite scrolling effect.
		firtextLine=modifyText(firtextLine, row1);
		ticker.appendChild(document.createElement("p").appendChild(document.createTextNode(firtextLine)));
		ticker.appendChild(document.createElement("br"));
		if(row2!=-1){ //If there is data for the line of text...
			var textLine=normLines[Math.floor(Math.random() * normLines.length)]; //Get a random message to fill in, then...
			textLine=modifyText(textLine, row2); //Merge the data and the template to create a unique line of text.
			ticker.appendChild(document.createElement("p").appendChild(document.createTextNode(textLine))); //Then, just place it in the ticker box.
			ticker.appendChild(document.createElement("br")); //Oh, and don't forget to line break!
			if(row3!=-1){
				var textLine=normLines[Math.floor(Math.random() * normLines.length)];
				textLine=modifyText(textLine, row3);
				ticker.appendChild(document.createElement("p").appendChild(document.createTextNode(textLine)));
				ticker.appendChild(document.createElement("br"));
				if(row4!=-1){
					var textLine=normLines[Math.floor(Math.random() * normLines.length)];
					textLine=modifyText(textLine, row4);
					ticker.appendChild(document.createElement("p").appendChild(document.createTextNode(textLine)));
					ticker.appendChild(document.createElement("br"));
					if(row5!=-1){
						var textLine=normLines[Math.floor(Math.random() * normLines.length)];
						textLine=modifyText(textLine, row5);
						ticker.appendChild(document.createElement("p").appendChild(document.createTextNode(textLine)));
						ticker.appendChild(document.createElement("br"));
					}
				}
			}
		}
		
		ticker.appendChild(document.createElement("p").appendChild(document.createTextNode(firtextLine)));
		ticker.appendChild(document.createElement("br"));
	}
}

function modifyText(textLine, row){ //This function takes a prefabbed line and a characters data to replace the placeholders in the line of text with the relevant data.
	if(textLine.includes("[update_date]")){ //Special case: If the last update time/date is not used in the phrase, tag it at the beginning.
		textLine=textLine.replace("[update_date]",row['update_date']);
	}
	else{
		textLine=row['update_date']+" - "+textLine;
	}
	textLine=textLine.replace("[id]",row['id']);
	textLine=textLine.replace("[char_id]",row['char_id']);
	textLine=textLine.replace("[char_name]",row['char_name']);
	textLine=textLine.replace("[bid]",row['bid']);
	textLine=textLine.replace("[buyer_name]",row['buyer_name']);
	return textLine;
}

function scrollDiv_init(){ //Below this is tickerbox behaviors. This begins and resets the scrolling behavior.
	console.log("began/restarted scrolling");
    ReachedMaxScroll = false; //Reset tracker values
    ticker.scrollTop = 0;
    PreviousScrollTop  = 0;
	smscrcounter=0;
	if(firstit){ //If it's the first iteration, then do some unique behavior to match the main div's scroll in animation
		Scroll = setTimeout('scrollDiv()', 1000);
		firstit=false;
	}
	else{ //Otherwise, ignore that first blank line and proceed as normal
		ticker.scrollTop += LineHeight; //These two make it ignore the empty first line, and since the bottom line matches the first line, the user won't be able to tell it moved back to the top
		PreviousScrollTop  += LineHeight;
		scrollDiv();
	}
}

function scrollDiv() { //This function manages whether the box will scroll or reset.
    if (!ReachedMaxScroll) { //If we can scroll more, then reset the counter and get scrolling.
		smscrcounter=0;
        Smooth = setInterval('smoothScroll()', 50);
		Scroll = -1;
    }
	 else{ //Otherwise, clear variables and reset by running scrollDiv_init().
		clearInterval(Smooth);
		clearTimeout(Scroll);
		scrollDiv_init();
	 }
}

function smoothScroll(){ //This makes the message box appear to scroll smoothly.
    ticker.scrollTop = PreviousScrollTop; //Move the text down.
	if(smscrcounter>=LineHeight){ //If we're at the end, 
		clearInterval(Smooth); //Reset a key value,
		//console.log(ticker.scrollTop+", "+ticker.scrollHeight); 
		ReachedMaxScroll = (ticker.scrollTop + LineHeight) > (ticker.scrollHeight - ticker.offsetHeight); //Check if we're at the bottom,
		if(Scroll==-1){ //Then, if it isn't set already
			Scroll = setTimeout('scrollDiv()', ScrollRate); //Set up a another delayed call back to scrollDiv().
		}
	}
	else if(smscrcounter<5||smscrcounter>(LineHeight-5)){ //If we're at the beginning or end of the line, scroll slower, or...
		PreviousScrollTop++;
		smscrcounter++;
	}
	else{ //If we're towards the middle, go faster. This creates a fake "ease-in/ease-out" effect, hence "smoothScroll()".
		PreviousScrollTop+=2;
		smscrcounter+=2;
	}
}