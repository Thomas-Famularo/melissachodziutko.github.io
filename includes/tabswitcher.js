//If I'm honest, most of this code comes from W3Schools
function openTab(evt, tabName) {
	var i, tabcontent, tablinks;

	// Get all elements with class="tabcontent" and hide them (Both tabs are hidden by default)
	tabcontent = document.getElementsByClassName("main");
	for (i = 0; i < tabcontent.length; i++) {
		tabcontent[i].style.display = "none";
	}

	// Get all elements with class="tablinks" and remove the class "active"
	tablinks = document.getElementsByClassName("tablinks");
	for (i = 0; i < tablinks.length; i++) {
		tablinks[i].className = tablinks[i].className.replace(" active", "");
	}

	// Show the current tab, and add an "active" class to the button that opened the tab
	document.getElementById(tabName).style.display = "block";
	evt.currentTarget.className += " active ";
	
	//This gives the tables their slide in animation.
	//There are issues where the page will force a scroll if the animation plays while only that div is on screen, so if the user is below a certain point (which is unlikely without a refresh), it will simply pop in.
	var header = document.getElementById("hd");
	var main = document.getElementsByClassName("main");
	console.log(window.scrollY+", "+header.scrollHeight);
	Array.from(main).forEach(function(e){
		if(window.scrollY<header.scrollHeight){
			e.style.animation="1s ease-out 0s 1 slideInFromBottom";
		}
	})
}