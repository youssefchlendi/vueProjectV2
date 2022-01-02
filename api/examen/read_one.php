<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/examen.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare examen object
$examen = new examen($db);
  
// set ID property of record to read
$examen->ID = isset($_GET['id']) ? $_GET['id'] : die();
  
// read the details of examen to be edited
  
if($examen->readOne()){
    // create 
    $examen_arr = array(
            "id" => $examen->ID,
            "idMatiere" => $examen->idMatiere,
            "idProf" =>  $examen->idProf,
            "intitule" => $examen->intitule,
            "coefficient" => $examen->coefficient,
    );

    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($examen_arr);
}else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user examen does not exist
    echo json_encode(array("message" => "examen does not exist."));
}
?>