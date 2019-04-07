<?php
$debug = true;
#Amy Moczydlowski, Melissa Chodziutko, Shaina Razvi, Danielle Anderson
# Shows the records in prints
#shows table of items
function show_lost_records($dbc) {
	# Create a query to get the description, create_date, item_status
    #if ($time == 0){
	$query = "SELECT bid, update_date, character_name, buyer_name FROM smash" ;
    
  
	# Execute the query
	$results = mysqli_query( $dbc , $query ) ;
	check_results($results) ;
	# Show results
	if( $results )
	{
  		# But...wait until we know the query succeed before
  		# rendering the table start.
  		 echo '<H1>Roster</H1>' ;
		echo '<TABLE>';
		  echo '<table border = "1"';
		  echo '<TR>';
		  echo '<TH>Highest Bid</TH>';
		  echo '<TH>Last Bid</TH>';
		  echo '<TH>Character</TH>';
          echo '<TH>Current highest bidder</TH>';
		  echo '</TR>';
		  # For each row result, generate a table row
		  while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
          {
			echo '<TR>' ;
			
			#$alink = '<A HREF=losttable.php?id=' . $row['id']  . '>' . $row['id'] . '</A>' ;
			#echo '<TD ALIGN=right>' . $alink . '</TD>' ;
            echo '<TD>' . $row['bid'] . '</TD>' ;
			echo '<TD>' . $row['update_date'] . '</TD>' ;
			echo '<TD>' . $row['character_name'] . '</TD>' ;
            echo '<TD>' . $row['buyer_name'] . '</TD>' ;
			echo '</TR>' ;
		  }
		  # End the table
		  echo '</TABLE>';
		  # Free up the results in memory
		  mysqli_free_result( $results ) ;
    }
}
function change_status($dbc, $id, $status)
{
    $query = 'UPDATE stuff SET item_status ="' . $status . '" WHERE id=' . $id;
    #show_query($query);
    $results = mysqli_query($dbc,$query) ;
}
function insert_record($dbc, $id, $bid, $update, $buyer) {
  $query = 'UPDATE smash SET bid ="' . $bid . '", update_date ="' . $update . '", buyer_name ="' . $buyer . '" WHERE id=' . $id;
  show_query($query);
  $results = mysqli_query($dbc,$query) ;
  check_results($results) ;
  return $results ;
}
# Shows the query as a debugging aid
function show_query($query) {
  global $debug;
  if($debug)
    echo "<p>Records have been changed.</p>" ;
}
# Checks the query results as a debugging aid
function check_results($results) {
  global $dbc;
  if($results != true)
    echo '<p>SQL ERROR = ' . mysqli_error( $dbc ) . '</p>'  ; 
}
function valid_description($description) {  
#echo '<p> I am being called</p>'; 
if(empty($description) || is_numeric($description))
    return false ;   
else
  return true ; 
}
 function valid_date($date) {
	#echo '<p> I am being called</p>'; 
	if (empty($date)) 
		return false;
	else
		return true;
 }
function valid_status($item_status) {
    if(empty($item_status))
        return false;
    else
        return true;
}
?>