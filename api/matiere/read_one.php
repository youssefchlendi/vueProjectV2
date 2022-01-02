<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/matiere.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare matiere object
$matiere = new matiere($db);
  
// set ID property of record to read
$matiere->ID = isset($_GET['id']) ? $_GET['id'] : die();
  
// read the details of matiere to be edited
  
if($matiere->readOne()){
    // create array
    $matiere_arr = array(
        "intitule" =>  $matiere->intitule,
        "coefficient" =>  $matiere->coefficient,
        "idProf" =>  $matiere->idProf
    );

    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($matiere_arr);
}else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user matiere does not exist
    echo json_encode(array("message" => "matiere does not exist."));
}
?>