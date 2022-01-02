<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/etudient.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare Etudient object
$Etudient = new Etudient($db);
  
// set ID property of record to read
$Etudient->id = isset($_GET['id']) ? $_GET['id'] : die();
  
// read the details of Etudient to be edited

  
if($Etudient->readOne()){
    // create array
    $Etudient_arr = array(
        "id" =>  $Etudient->id,
        "nom" =>  $Etudient->nom,
        "prenom" => $Etudient->prenom,
        "cin" => $Etudient->cin,
        "class" => $Etudient->class,
        "numIns" => $Etudient->numIns,
  
    );

    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($Etudient_arr);
}else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user Etudient does not exist
    echo json_encode(array("message" => "Etudient does not exist."));
}
?>