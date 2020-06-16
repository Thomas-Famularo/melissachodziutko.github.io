<!DOCTYPE html>
<html>
<head>
	<title>Marist Smash Charity Tournament Signup</title>
	<link href="https://my.marist.edu/myMarist62-theme/images/favicon.ico" rel="Shortcut Icon"> <!--This is Marist's official favicon, taken from the my.marist.edu page -->
	<link rel="stylesheet" href="overall.css">
</head>
<body>

	<div class="header" id="hd"> <!--This section here establishes the top header of the page with the image and header text -->
		<div class="header-actor header-overlay"></div>
		<div class="header-actor header-image">
		</div>
		<div class="header-actor header-text">
			<h1>Marist Charity Smashdown</h1>
		</div>
	</div>
	
	<center> <!--Everything below this is the primary content of the page -->
	
		<?php 
			#This code sets the stage for our usages of PHP below
            $debug = false;
			#Includes key dbc functions
            require( 'includes/connect_db.php' ) ;
            #Includes additional helper functions
            require( 'includes/helpers_smash.php' ) ;
			
			#This PHP code block handles user input
			if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') { #If the method is POST, then the user just hit the submit button
				#Next, store the inputs as variables and cleanse them
				$id = $_POST['id'];
				$bid = $_POST['bid'] ;
				$buyer = trim($_POST['buyer_name']) ;
				$buyer = filter_var($buyer, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
				$buyer = trim($buyer);
				if ((!empty($id)&&!empty($bid)&&!(empty($buyer)||$buyer==='')) && (filter_var($bid, FILTER_VALIDATE_INT)) && (($bid>get_bid($dbc, $id))&&$bid>=2)) { #This checks that all the recorded inputs are not empty and are valid table entries
					$result = insert_record($dbc, $id, $bid, $buyer);
				}
				else{ #If it's not a valid input, check which is invalid and return a relevant error message to the user. These will appear just below the rolling message box
					if ($id == -1){
						echo '<script type="text/javascript"> window.alert("Something went wrong with character selection! Please let us know!");</script>' ;    
					} 
					else if (empty($bid)){
						echo '<script type="text/javascript"> window.alert("There was no bid! Please try again!");</script>' ;   
					} 
					else if (empty($buyer)|| $buyer===''){ 
						echo '<script type="text/javascript"> window.alert("The name field was empty or invalid. Please try again!");</script>' ;   
					}
					else if (($bid<=get_bid($dbc, $id))||$bid<2){
						echo '<script type="text/javascript"> window.alert("Your bid was too low! Please try again!");</script>' ;
					}
				}
			}
				
?>
		
		<!--This code block establishes the rolling message box, and runs the scripts to create the text messages and begin the scrolling -->
		<div class="ticker" id="ticker"> <br>
			<script src="includes/ticker.js"></script>
			<script>
				placeText(<?php echo json_encode(get_last_updates($dbc,0)) . ', ' 
					. json_encode(get_last_updates($dbc,1)) . ', '
					. json_encode(get_last_updates($dbc,2)) . ', '
					. json_encode(get_last_updates($dbc,3)) . ', '
					. json_encode(get_last_updates($dbc,4)) ?> ); //That previous code just grabs info from the SQL database and passes them through to the Javascript in ticker.js
				scrollDiv_init();
			</script>
		</div>

		<!--This code sets up the Bid/History buttons at the top. Their behavior is defined in tabswitcher.js -->
		<script type="text/javascript" src="includes/tabswitcher.js"></script>
		<div class="tab">
			<button class="tablinks" id="t1" onclick="openTab(event, 'bids')">Bids</button>
			<button class="tablinks" id="t2" onclick="openTab(event, 'history')">History</button>
		</div>
		
		<!--The following block is the main bidding table -->
		<div class="main" id="bids">
			<H1>Current Listings:</H1>
			<table border="1" id="smtable">
				<script src="includes/bidtable.js"></script>
				<script>
					generateTable(<?php echo json_encode(get_smash($dbc));?>); //This passes through all of the smash table records into bidtable.js, creating the table
				</script>
			</table>
					
			<p><h2>Note:</h2>Sans is a light fighter using the moves Laser Blaze, Flame Pillar, Cannon Jump Kick, and Echo Reflector.</p>
			<br>
			<br>
		</div>
		
		<!--This following block creates the history table,  -->
		<div class="main" id="history">
			<H1>Past Updates:</H1>
			<table class="htable" id="htable">
				<script src="includes/histtable.js"></script>
				<script>
					generateHTable(<?php echo json_encode(get_action($dbc));?>); //This passes all of the action table records to histtable.js, which creates the table
				</script>
			</table>
		</div>
		
		<script> document.getElementById("t1").click(); </script> <!--Upon loading the page, the Bids button is clicked automatically, making it the default version of the page -->
		
		<!--This block is the invisible submission box that appears upon clicking a button -->
		<div id="bidModal" class="modal">
			<div class="mod-content">
				<span class="close">&times;</span> <!--This is the "X" to close the box -->
				<h1 style="display:inline">You've chosen: </h1> <h1 style="color:yellow;display:inline;" id="selectedName"></h1>
				<h1>Place Your Bid:</h1>
				<form action="index.php" method="POST"> 
					<table>
						<tr style="display:none">
						<td>Select Your Character:</td> <!--In earlier iterations, this was a dropdown box. In order to keep things simple, it is now an invisible text box. Refer to modal.js's charSelected() to learn more. -->
							<td> <input type="number" name="id" id="charInput" value="-1"></td> 
						</tr>
						<tr>
						<td><span title="(Whole Dollar Amounts Only, Starts at $2)">Enter your bid:</span></td><td>$<input type="number" name="bid" id="bidin" min="2"></p> </td>
						</tr>
						<tr>
						<td>Enter your name:</td><td><input type="text" name="buyer_name" 
							value="<?php if (isset($_POST['buyer_name'])) echo $_POST['buyer_name']; ?>"></td> <!--The PHP statements contained within this <input> set the text values to what they were if the user is trying to resubmit -->
						</tr>
					</table>
					<p><input type="submit"></p>
				</form>
			</div>
		</div>
		
		<script src="includes/modal.js"></script> <!--This script sets the behavior for the above block of code -->
		
		<!--This is a small note of who the user is meant to contact should anything go wrong with the website. Put the Webmaster's name and contact info at down here.
		I did still make this website though, so feel free to contact me if you're really stumped! I'm sure it will be a fun blast from the past: Ryan Sheffler (Email: Ryan.Sheffler1@marist.edu, Discord:RYGUY722#7410)-->
		<p>Issues? Questions? Bugs?
			<br>Contact Ryan Sheffler (Email: Ryan.Sheffler1@marist.edu, Discord:RYGUY722#7410)<br><br><br>
		</p>
	</center>
</body>
</html>