<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript">
		var cells = (window.innerWidth-400)/200;
		cells=Math.floor(cells);
		if(cells<2) {cells=2;}
		console.log(cells);
		document.cookie = "cells=" + cells;
		if(cells!=<?php echo $_COOKIE['cells']; ?>){ location.reload(); }
	</script>
	<title>Marist Smash Chartiy Tournament Signup</title>
	<link href="https://my.marist.edu/myMarist62-theme/images/favicon.ico" rel="Shortcut Icon">
	<link rel="stylesheet" href="overall.css">
</head>
<body>
	<div class="header" id="hd">
		<div class="header-actor header-overlay"></div>
		<div class="header-actor header-image">
		</div>
		<div class="header-actor header-text">
			<h1>Smash Bids</h1>
		</div>
	</div>
	<center>
        <?php
                $debug = false;
				# Includes key dbc functions
                require( 'includes/connect_db.php' ) ;
                # Includes additional helper functions
                require( 'includes/helpers_smash.php' ) ;
				
				if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
					$id = $_POST['id'];
					$bid = $_POST['bid'] ;
					$buyer = trim($_POST['buyer_name']) ;
					$buyer = filter_var($buyer, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
					$buyer = trim($buyer);
					if ((!empty($id)&&!empty($bid)&&!(empty($buyer)||$buyer==='')) && (filter_var($bid, FILTER_VALIDATE_INT)) && (($bid>get_bid($dbc, $id))&&$bid>=2)) { #check that all inputs are valid
						$result = insert_record($dbc, $id, $bid, $buyer);
					}
					else{ #check for what is an invalid input
						if ($id == -1){
							echo '<p style="color:red">Please pick a character!</p>' ;    
						} 
						else if (empty($bid)){
							echo '<p style="color:red">Please input a bid!</p>' ;   
						} 
						else if (empty($buyer)|| $buyer===''){ 
							echo '<p style="color:red">Please fill out your name!</p>' ;   
						}
						else if (($bid<get_bid($dbc, $id))||$bid<2){
							echo '<p style="color:red">Your bid isn\'t high enough!</p>' ;
						}
					}
				}
				
				# Shows a ticker of up to the past 5 transactions
				echo '<div class="ticker" id="ticker"> <br>';
				echo '<script src="includes/ticker.js"></script>';
				echo '<script> ';
				echo 'placeText(' . json_encode(get_last_updates($dbc,0)) . ', ' 
				. json_encode(get_last_updates($dbc,1)) . ', '
				. json_encode(get_last_updates($dbc,2)) . ', '
				. json_encode(get_last_updates($dbc,3)) . ', '
				. json_encode(get_last_updates($dbc,4)) . '); ';
				echo 'scrollDiv_init();';
				echo '</script>';
				echo '</div>';
				
				# Shows the records in smash
				echo '<div class="main">';
                show_smash($dbc);
?>
		<p><h2>Note:</h2>Sans is a light fighter using the moves Laser Blaze, Flame Pillar, Cannon Jump Kick, and Echo Reflector.</p>
		<br>
		<br>
		</div>
		<script type="text/javascript">
			var header = document.getElementById("hd");
			var main = document.getElementsByClassName("main")[0];
			console.log(window.scrollY+", "+header.scrollHeight);
			if(window.scrollY<header.scrollHeight){
				main.style.animation="2s ease-out 0s 1 slideInFromBottom";
			}
		</script>
		
		<div id="bidModal" class="modal">
			<div class="mod-content">
				<span class="close">&times;</span>
				<h1>Place Your Bid:</h1>
				<form action="index.php" method="POST"> 
					<table>
						<tr style="display:none">
						<td>Select Your Character:</td>
							<td> <input type="number" name="id" id="charInput" value="-1">
							<!--<select name="id">
								<option value="-1"selected>Choose one...</option>
								<?php if (isset($_POST['id'])) $selid=$_POST['id'];
								get_smash_dropdown($dbc,$selid)?>
							</select>--></td>
						</tr>
						<tr>
						<td>Enter Your Bid (Whole Dollar Amounts Only, Starts at $2):</td><td>$<input type="number" name="bid" min="2"
							value="<?php if (isset($_POST['bid'])) echo $_POST['bid']; ?>"></p> </td>
						</tr>
						<tr>
						<td>Enter Your Name:</td><td><input type="text" name="buyer_name" 
							value="<?php if (isset($_POST['buyer_name'])) echo $_POST['buyer_name']; ?>"></td>
						</tr>
					</table>
					<p><input type="submit"></p>
				</form>
			</div>
		</div>
		
		<script src="includes/modal.js"></script>
		
		<p>
			Questions? Contact Melissa Chodziutko on Facebook or at Game Society. (if u have a problem with the way this website looks meet me outside)
			<br>(Or, if you want a meaningful conversation, contact Ryan Sheffler (RYGUY722#7410) instead.) <br><br><br>
		</p>
	</center>
</body>
</html>