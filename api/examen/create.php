<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate examen object
include_once '../objects/examen.php';
  
$database = new Database();
$db = $database->getConnection();
  
$examen = new examen($db);
  
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
if(empty($data->idMatiere)){
    $err.=" idMatiere";
}

if(
    !empty($data->intitule) &&
    !empty($data->coefficient)&&
    !empty($data->idMatiere)
){

    
    // set examen property values
    $examen->intitule = $data->intitule;
    $examen->coefficient = $data->coefficient;
    $examen->idMatiere = $data->idMatiere;
    $examen->idProf = !empty($data->idProf)?$data->idProf:NULL;
  
    // create the examen
    if($examen->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "examen was created."));
    }
  
    // if unable to create the examen, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create examen."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create examen. Data is incomplete.".$err.""));
}
?>