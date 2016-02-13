<?php
 
  //Create a connection to the database
  $mysqli = new mysqli("127.0.0.1", "dotrohoni", "dotrohoni", "dotrohoni");
 
  //The default result to be output to the browser
  $result = "{'success':false}";
 
  //Select everything from the table containing the marker informaton
  $query = "SELECT * FROM etablissement";
 
  //Run the query
  $dbresult = $mysqli->query($query);
 
  //Build an array of markers from the result set
  $markers = array();
 
  while($row = $dbresult->fetch_array(MYSQLI_ASSOC)){
 
    $markers[] = array(
      'id' => $row['idetablissement'],
      'name' => $row['etablissementlibelle'],
      'lat' => $row['etablissementlatitude'],
      'lng' => $row['etablissementlongitude'],
      'cont'=> $row['etablissementcontact1']
    );
  }
 
  //If the query was executed successfully, create a JSON string containing the marker information
  if($dbresult){
  	$result = array('success'=>true, 'markers'=> ($markers));        
  }
  else
  {
    $result = "{'success':false}";
  }
 
  //Set these headers to avoid any issues with cross origin resource sharing issues
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
  header('Access-Control-Allow-Headers: Content-Type,x-prototype-version,x-requested-with');
  header('Content-Type: application/json');
  
  //Output the result to the browser so that our Ionic application can see the data
  echo json_encode(($result));
  
 
?>