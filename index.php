<!DOCTYPE html>
<html>

         
        <div class="hero-image">
            <link rel="stylesheet" href="overall.css">
  <div class="hero-text">
    <h1>Smash Bids</h1>
  </div>
</div>
    </head>
    <body>
       

        <center>
        <p>
           Instructions:
        </p>
        <p>
           Enter in your bid (whole numbers only, no decimals)
        </p>
        <p>
            Select your character from the dropdown
        </p>
        <p>
            Enter your full name (we won't be able to verify you otherwise)
        </p>
         <p>
            Questions? Contact Melissa Chodziutko on facebook or at game society. (if u have a problem with the way this website looks meet me outside)
        </p> 
        <?php
                #$time = $_POST['id'];
                $debug = true;
                require( 'includes/connect_db.php' ) ;
                # Includes these helper functions
                require( 'includes/helpers_limbo.php' ) ;
                # Shows the records in prints
		if($_SERVER[ 'REQUEST_METHOD' ] == 'GET') {
                    if(isset($_GET['id'])) 
		                  show_record($dbc, $_GET['id']) ;
                }
                show_lost_records($dbc);
########            
if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
    $id = $_POST['id'];
    $bid = $_POST['bid'] ;
    $update = date('Y-m-d G:i:s');
    $buyer = $_POST['buyer_name'] ;
	#$dob = '0000-00-00 00:00:00'
    if (!empty($id) || !empty($bid) || !empty($buyer)) {
       #check for valid inputs
        if ($id == 0){
        echo '<p style="color:red">Please pick a character!</p>' ;    
        } else if (empty($bid)){
                    echo '<p style="color:red">Please fill out all required information!</p>' ;   
                    } else if (empty($buyer)){  
                                echo '<p style="color:red">Please fill out all requiredhhhhh information!</p>' ;   
                                }  else if (empty($bid)  && empty($buyer)){
                                    echo '<p style="color:red">Please fill out all required information!</p>' ;
                                    }
                                    else{  
                        $result = insert_record($dbc, $id, $bid, $update, $buyer) ;
                                        }
    }
      #echo "<p>Added " . $result . " new print(s) ". $num . " @ $" . $fname . " . $lname . "</p>" ; 
        
   
 # Close the connection
}
            mysqli_close( $dbc ) ;
            #######
?>
            <br>
            <br>
       
    </body>
        <form action="losttable.php" method="POST"> 

<p>Character: 

    <select id="id" name="id">                      

  <option value="0">--Select Character--</option>

    <option value="1">Bayonetta</option>

    <option value="2">Bowser</option>

    <option value="3">Bowser Jr.</option>

    <option value="4">Captain Falcon</option>

    <option value="5">Chrom</option>

    <option value="6">Cloud</option>

    <option value="7">Corrin</option>

    <option value="8">Daisy</option>

    <option value="9">Dark Pit</option>

    <option value="10">Dark Samus</option>

    <option value="11">Diddy Kong</option>

    <option value="12">Donkey Kong</option>

    <option value="13">Dr. Mario</option>

    <option value="14">Duck Hunt</option>

    <option value="15">Falco</option>

    <option value="16">Fox</option>

    <option value="17">Ganondorf</option>

    <option value="18">Greninja</option>

    <option value="19">Ice Climbers</option>

    <option value="20">Ike</option>

    <option value="21">Incineroar</option>

    <option value="22">Jigglypuff</option>

    <option value="23">Joker</option>

    <option value="24">Ken</option>

    <option value="25">King DeDeDe</option>

    <option value="26">King K Rool</option>

    <option value="27">Kirby</option>

    <option value="28">Link</option>

    <option value="29">Little Mac</option>

    <option value="30">Lucario</option>

    <option value="31">Lucas</option>

    <option value="32">Lucina</option>

    <option value="33">Luigi</option>

    <option value="34">Mario</option>

    <option value="35">Marth</option>

    <option value="36">Megaman</option>

    <option value="37">Meta Knight</option>

    <option value="38">Mewtwo</option>

    <option value="39">Mr. Game and Watch</option>

    <option value="40">Ness</option>

    <option value="41">Olimar</option>

    <option value="42">Pac-Man</option>

    <option value="43">Palutena</option>

    <option value="44">Peach</option>

    <option value="45">Pichu</option>

    <option value="46">Pikachu</option>

    <option value="47">Pit</option>
        
    <option value="48">Pirahna Plant</option>

    <option value="49">Pokemon Trainer</option>

    <option value="50">ROB</option>

    <option value="51">Richter</option>

    <option value="52">Ridley</option>

    <option value="53">Robin</option>

    <option value="54">Rosalina</option>

    <option value="55">Roy</option>

    <option value="56">Ryu</option>

    <option value="57">Samus</option>

    <option value="58">Sheik</option>

    <option value="59">Shulk</option>

    <option value="60">Simon</option>

    <option value="61">Snake</option>
        
    <option value="62">Sonic</option>

    <option value="63">Toon Link</option>

    <option value="64">Villager</option>

    <option value="65">Wario</option>

    <option value="66">Wii Fit Trainer</option>

    <option value="67">Wolf</option>

    <option value="68">Yoshi</option>

    <option value="69">Young Link</option>

    <option value="70">Zelda</option>

    <option value="71">Zero Suit Samus</option>

</select>
        <?php 
    if (isset($_POST['id']))  ?> </p> 

<p>Bid: <input type="text" name="bid" value="<?php 
    if (isset($_POST['bid'])) echo $_POST['bid']; ?>"></p> 

<p>Your name: <input type="text" name="buyer_name" value="<?php 
    if (isset($_POST['buyer_name'])) echo $_POST['buyer_name']; ?>"></p>

<p><input type="submit"></p> 
            <br>
 </center>
            
</html>