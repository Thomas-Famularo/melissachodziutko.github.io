var ScrollRate = 7000;
var LineHeight = 35;
var smscrcounter = 0;
var firstit = true;
var Smooth; var Scroll;
const normLines = ["[buyer_name] bid $[bid] on [char_name].", "[char_name] is now worth $[bid]!"];
var ticker = document.getElementById("ticker");
var row1;
var row2;
var row3;
var row4;
var row5;

function placeText(r1, r2, r3, r4, r5) {
	console.log("thought about text");
	row1=r1;
	row2=r2;
	row3=r3;
	row4=r4;
	row5=r5;
	//row1.forEach(element => console.log(element));
	if(row1==-1){
		console.log("No bids found.");
		ticker.appendChild(document.createElement("p").appendChild(document.createTextNode("There are no bids yet. Be the first to bid!")));
		ticker.appendChild(document.createElement("br"));
		ticker.appendChild(document.createElement("p").appendChild(document.createTextNode("There are no bids yet. Be the first to bid!")));
	}
	else{
		console.log("Bids found.");
		var firtextLine=normLines[Math.floor(Math.random() * normLines.length)];
		firtextLine=modifyText(firtextLine, row1);
		ticker.appendChild(document.createElement("p").appendChild(document.createTextNode(firtextLine)));
		ticker.appendChild(document.createElement("br"));
		if(row2!=-1){
			var textLine=normLines[Math.floor(Math.random() * normLines.length)];
			textLine=modifyText(textLine, row2);
			ticker.appendChild(document.createElement("p").appendChild(document.createTextNode(textLine)));
			ticker.appendChild(document.createElement("br"));
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

function modifyText(textLine, row){
	if(textLine.includes("[update_date]")){
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

function scrollDiv_init(){
	console.log("began/restarted scrolling");
    ReachedMaxScroll = false;
    ticker.scrollTop = 0;
    PreviousScrollTop  = 0;
	smscrcounter=0;
	if(firstit){
		Scroll = setTimeout('scrollDiv()', 1000);
		firstit=false;
	}
	else{
		ticker.scrollTop += LineHeight;
		PreviousScrollTop  += LineHeight;
		scrollDiv();
		Scroll = setTimeout('scrollDiv()', ScrollRate+(50*LineHeight));
	}
}

function scrollDiv() {
    if (!ReachedMaxScroll) {
        Smooth = setInterval('smoothScroll()', 50);
		Scroll = -1;
    }
	 else{
		clearInterval(Smooth);
		scrollDiv_init();
	 }
}

function smoothScroll(){
    ticker.scrollTop = PreviousScrollTop;
	if(smscrcounter>=LineHeight){
		clearInterval(Smooth);
		smscrcounter=0;
		console.log(ticker.scrollTop+", "+ticker.scrollHeight);
		ReachedMaxScroll = (ticker.scrollTop + LineHeight) > (ticker.scrollHeight - ticker.offsetHeight);
		if(Scroll==-1){
			Scroll = setTimeout('scrollDiv()', ScrollRate);
		}
	}
	else if(smscrcounter<5||smscrcounter>(LineHeight-5)){
		PreviousScrollTop++;
		smscrcounter++;
	}
	else{
		PreviousScrollTop+=2;
		smscrcounter+=2;
	}
}