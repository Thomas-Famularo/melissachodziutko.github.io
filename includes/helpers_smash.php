<?php
$debug = false;
#Amy Moczydlowski, Melissa Chodziutko, Shaina Razvi, Danielle Anderson, Ryan Sheffler

#This function gets the data from the SQL table and creates an HTML table based on it. As of June 2020, this isn't used anymore, but I figured it might be useful to know how this website used to work.
function show_smash($dbc) {
	#Create a query to get the characters
	$query = "SELECT id, bid, character_name, buyer_name FROM smash" ;

	#Execute the query
	$results = mysqli_query( $dbc , $query ) ;
	check_results($results) ;
	#Show results
	
	$cells = $_COOKIE['cells'];
	
	if( $results )
	{
		$counter=0;
  		#But...wait until we know the query succeed before
  		#rendering the table start.
  		echo '<H1>Current Listings:</H1>' ;
		 
		echo '<TABLE>';
		echo '<table border = "1"';
		echo '<TR>';
		#For each row result, generate a table row
		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) ){
			echo '<TD class="cell">';	//Create a new table segment		
			$counter=$counter+1; //Increment counter
			echo '<Button class="charBtn" id="'.$row['id'].'" onClick="charSelected(this.id)"> <img src="/edsa-Smash/icons/'.$row['character_name'].'HeadSSBUWebsite.png" style="width:128px;height:128px;">'; //Show character head icon
            echo '<p>' . $row['character_name'] . '</p>' ; //Show character name
			echo '<p>$' . $row['bid'] . '</p>' ; //Show the current bid
			if($row['buyer_name']=='None yet') //Show current buyer (in red if there's none)
				echo '<p style="color:red">' . $row['buyer_name'] . '</p>' ;
			else
				echo '<p>' . $row['buyer_name'] . '</p>' ;
			echo '</Button> </TD>';
			if($counter==$cells){
				echo '</TR>' ;
				echo '<TR>';
				$counter=0;
			}
		  }
		  #End the table
		  echo '</TABLE>';
		  #Free up the results in memory
		  mysqli_free_result( $results ) ;
    }
}

#This function simply gets and returns all the data in the SQL table "smash."
function get_smash($dbc) {
	#Create a query to get the characters
	$query = "SELECT id, bid, character_name, buyer_name FROM smash" ;

	#Execute the query
	$results = mysqli_query( $dbc , $query ) ;
	check_results($results) ;
	#Compile results
	
	if( $results )
	{
  		#But...wait until we know the query succeed before going any further
		$rowarr=array(); //Make our variable an array
		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) ){ //Then, add each row of results to the array
			array_push($rowarr, $row);
		}
		#This creates an array of arrays, which is essentially a 2D array since they don't exist here or in Javascript.
		
  		#Free up the results in memory
  		mysqli_free_result( $results ) ;
		
		return $rowarr; //Then return our new 2D array for use in other functions
    }
}

#This function simply gets and returns all the data in the SQL table "action." Refer to the last function for documentation, since it operates the exact same way.
function get_action($dbc) {
	#Create a query to get all previous transactions. It orders by descending to show the newest first in the history table.
	$query = "SELECT id, bid, char_name, buyer_name, update_date FROM action ORDER BY id DESC" ;
	$results = mysqli_query( $dbc , $query ) ;
	check_results($results) ;
	if( $results )
	{
		$rowarr=array();
		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) ){
			array_push($rowarr, $row);
		}
  		mysqli_free_result( $results ) ;
		return $rowarr;
    }
	else{ //There *can* be nothing in action, unlike smash. If that's the case, just return a -1.
  		mysqli_free_result( $results ) ;
		return -1;
	}
}

#Function to show all the characters from the smash table, formatted to fill a dropdown box. As of May 2020, this is no longer used, but I figured it might be educational or interesting to see how this site used to work.
function get_smash_dropdown($dbc, $selectedid) {
	#Create a query to get the character name and id from the smash table
	$query = 'SELECT character_name, id FROM smash ORDER BY id ASC' ;

	#Execute the query
	$results = mysqli_query($dbc, $query );
	check_results($results);
	
	#Show results
	if($results)
	{
  		#For each row result, output a selection box choice
  		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
  		{
			if($row['id']==$selectedid)
				echo '<option value="'.$row['id'].'" selected>'.$row['character_name'].'</option>';
			else
				echo '<option value="'.$row['id'].'">'.$row['character_name'].'</option>';
  		}

  		#Free up the results in memory
  		mysqli_free_result( $results ) ;
	}
}

#Function to get the current highest bid of a character at [id]. This is just used to check that the user's bid is higher than the previous bid.
function get_bid($dbc,$id){
	#Create a query to get the current highest bid for a character
	$query='SELECT bid FROM smash WHERE id='.$id;
	
	#Execute the query
	$results = mysqli_query($dbc, $query );
	check_results($results);
	
	if($results)
	{
  		#Return the bid
  		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
  		{
			#Free up the results in memory first
			mysqli_free_result( $results );
			return $row['bid'];
		}
	}
}

#This function gets the [$id]th most recent bid. This could probably be improved by making it and the functions that make use of it over in ticker.js use a 2D array of results instead of individual results.
function get_last_updates($dbc, $id) {
	$results = mysqli_query($dbc,'SELECT id FROM action ORDER BY id DESC') ; #this could use some work. using max killed everything, so I took an inefficient method instead.
	check_results($results) ;
	$row = mysqli_fetch_array( $results , MYSQLI_ASSOC); 
	$maxid = $row['id']; #This just gets the highest ID in the table, so that it can be used in math later on here.
	if(($maxid-$id)>0){ //If there are enough entries to go back $id entries, then proceed. Otherwise, skip to below and just return a null -1 value.
		$query = 'SELECT * FROM action WHERE id=' . ($maxid-$id); #Get the info from that row
		show_query($query);
		$results = mysqli_query($dbc,$query) ;
		check_results($results) ;
		return mysqli_fetch_array( $results , MYSQLI_ASSOC); //And return them.
	}
	else{
		#Free up the results in memory first
		mysqli_free_result( $results );
		return -1;
	}
}

#This is the function for handling a new bid. It updates 2 tables.
function insert_record($dbc, $id, $bid, $buyer) {
	
	#This updates the smash table. The smash table never expands, its rows are simply edited
	$query = 'UPDATE smash SET bid =' . $bid . ', update_date = Now(), buyer_name ="' . $buyer . '" WHERE id=' . $id;
	show_query($query);
	$results = mysqli_query($dbc,$query) ;
	check_results($results) ;
	
	#This places a new entry into the action table, which keeps track of all updates to the smash table. The user sees the contents of this in the history table and it can be used so that admins can more easily see all past updates.
	$query = 'INSERT INTO action (char_id, char_name, update_date, bid, buyer_name) VALUE (' . $id . ', (SELECT character_name FROM smash WHERE id=' . $id . '), Now(), ' . $bid . ', "' . $buyer . '")';
	show_query($query);
	$results = mysqli_query($dbc,$query) ;
	check_results($results) ;
	return $results ;
}

#Shows the query as a debugging aid
function show_query($query) {
  global $debug;
  if($debug)
    echo "<p>Records have been changed.</p>" ;
}

#Checks the query results as a debugging aid
function check_results($results) {
  global $dbc;
  if($results != true)
    echo '<p>SQL ERROR = ' . mysqli_error( $dbc ) . '</p>'  ; 
}
?>