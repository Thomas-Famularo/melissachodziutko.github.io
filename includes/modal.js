var modal = document.getElementById("bidModal");

var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
function charSelected(charID) {
	modal.style.display = "block";
	document.getElementById("charInput").value=charID;
	charID--;
	document.getElementById("selectedName").innerHTML=dbRes[charID]['character_name'];
	var bidup = dbRes[charID]['bid'];
	bidup++;
	if(bidup==1){ bidup++; }
	document.getElementById("bidin").value=bidup;
	
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
	modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
	if (event.target == modal) {
		modal.style.display = "none";
	}
}