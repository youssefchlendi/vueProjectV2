<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate matiere object
include_once '../objects/matiere.php';
  
$database = new Database();
$db = $database->getConnection();
  
$matiere = new matiere($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
// make sure data is not empty
$err="";
if(empty($data->intitule)){
    $err.="Intitule";
}
if(empty($data->coefficient)){
    $err.=" coefficient";
}


if(
    !empty($data->intitule) &&
    !empty($data->coefficient)
){

    
    // set matiere property values
    $matiere->intitule = $data->intitule;
    $matiere->coefficient = $data->coefficient;
    $matiere->idProf = !empty($data->idProf) ? $data->idProf :NULL;
  
    // create the matiere
    if($matiere->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "matiere was created."));
    }
  
    // if unable to create the matiere, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create matiere."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create matiere. Data is incomplete.".$err.""));
}
?>