<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/enseignant.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare enseignant object
$enseignant = new enseignant($db);
  
// set ID property of record to read
$enseignant->id = isset($_GET['id']) ? $_GET['id'] : die();
  
// read the details of enseignant to be edited

  
if($enseignant->readOne()){
    // create array
    $enseignant_arr = array(
        "id" =>  $enseignant->id,
        "nom" =>  $enseignant->nom,
        "prenom" => $enseignant->prenom,
        "cin" => $enseignant->cin,  
    );

    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($enseignant_arr);
}else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user enseignant does not exist
    echo json_encode(array("message" => "enseignant does not exist."));
}
?>