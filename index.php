<!DOCTYPE html>
<html>
<head>
	<div class="hero-image">
		<link rel="stylesheet" href="overall.css">
		<div class="hero-text">
			<h1>Smash Bids</h1>
		</div>
	</div>
</head>
<body>
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
					$buyer = $_POST['buyer_name'] ;
					$buyer = filter_var($buyer, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
					if ((!empty($id)||!empty($bid)||!empty($buyer)) && (filter_var($bid, FILTER_VALIDATE_INT)) && (($bid>get_bid($dbc, $id))&&$bid>=2)) { #check that all inputs are valid
						$result = insert_record($dbc, $id, $bid, $buyer);
					}
					else{ #check for what is an invalid input
						if ($id == -1){
							echo '<p style="color:red">Please pick a character!</p>' ;    
						} 
						else if (empty($bid)){
							echo '<p style="color:red">Please input a bid!</p>' ;   
						} 
						else if (empty($buyer)){ 
							echo '<p style="color:red">Please fill out your name!</p>' ;   
						}
						else if (($bid<get_bid($dbc, $id))||$bid<2){
							echo '<p style="color:red">Your bid isn\'t high enough!</p>' ;
						}
					}
				}
				# Shows the records in smash
                show_smash($dbc);
?>
		<p><h2>Note:</h2>Sans is a light fighter using the moves Laser Blaze, Flame Pillar, Cannon Jump Kick, and Echo Reflector.</p>
		<br>
		<br>
		
		<h1>Place Your Bid:</h1>
		<form action="index.php" method="POST"> 
			<table>
				<tr>
				<td>Select Your Character:</td>
					<td><select name="id">
						<option value="-1"selected>Choose one...</option>
						<?php if (isset($_POST['id'])) $selid=$_POST['id'];
						get_smash_dropdown($dbc,$selid)?>
					</select></td>
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
		
		<p>
			Questions? Contact Melissa Chodziutko on Facebook or at Game Society. (if u have a problem with the way this website looks meet me outside)
			<br>(Or, if you want a meaningful conversation, contact Ryan Sheffler (RYGUY722#7410) instead.) <br><br><br>
		</p>
	</center>
</body>
</html>