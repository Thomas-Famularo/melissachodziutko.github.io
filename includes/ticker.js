var ScrollRate = 10000;
var LineHeight = 35;
var smscrcounter = 0;
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
		console.log("There are no bids yet. Be the first to bid!");
		ticker.appendChild(document.createElement("p").appendChild(document.createTextNode("There are no bids yet. Be the first to bid!")));
	}
	else{
		var textLine=normLines[Math.floor(Math.random() * normLines.length)];
		textLine=modifyText(textLine, row1);
		document.createElement("p").appendChild(document.createTextNode(textLine));
	}
}

function modifyText(textLine, row){
	textLine=textLine.replace("[id]",row['id']);
	textLine=textLine.replace("[char_id]",row[1]);
	textLine=textLine.replace("[char_name]",row[2]);
	textLine=textLine.replace("[update_date]",row[3]);
	textLine=textLine.replace("[bid]",row[4]);
	textLine=textLine.replace("[buyer_name]",row[5]);
	return textLine;
}

function scrollDiv_init(){
	console.log("began/restarted scrolling");
     ReachedMaxScroll = false;
     ticker.scrollTop = 0;
     PreviousScrollTop  = 0;    
     ScrollInterval = setInterval('scrollDiv()', ScrollRate);
}

function scrollDiv() {
     if (!ReachedMaxScroll) {
          Smooth = setInterval('smoothScroll()', 50);
     }
	 else{
		clearInterval(ScrollInterval);
		 scrollDiv_init();
	 }
}

function smoothScroll(){
    ticker.scrollTop = PreviousScrollTop;
    PreviousScrollTop++;
    ReachedMaxScroll = ticker.scrollTop >= (ticker.scrollHeight - ticker.offsetHeight);
	smscrcounter++
	if(smscrcounter>=LineHeight){
		smscrcounter=0;
		clearInterval(Smooth);
	}
}

function pauseDiv() {
     clearInterval(ScrollInterval);
}

function resumeDiv() {
     PreviousScrollTop = ticker.scrollTop;
     ScrollInterval    = setInterval('scrollDiv()', ScrollRate);
}