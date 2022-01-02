<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/examen.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare examen object
$examen = new examen($db);
  
// get id of examen to be edited
$data = json_decode(file_get_contents("php://input"));
  
// set ID property of examen to be edited
$examen->ID = $data->id;
$oldData=new examen($db);
$oldData->ID=$data->id;
$oldData->readOne();
// var_dump($oldData);

// set examen property values
$examen->intitule = isset($data->intitule)?$data->intitule:$oldData->intitule;
$examen->coefficient = isset($data->coefficient)?$data->coefficient:$oldData->coefficient;
$examen->idMatiere = isset($data->idMatiere)?$data->idMatiere:$oldData->idMatiere;
$examen->idProf = isset($data->idProf)?$data->idProf:(empty($data->idProf)?$oldData->idProf:NULL);
// update the examen
$res=$examen->update();
if($res==1){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "examen was updated."));
}else if($res==2){
        // set response code - 200 ok
        http_response_code(404);
  
        // tell the user
        echo json_encode(array("message" => "examen ID was not found."));
    
}
// if unable to update the examen, tell the user
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to update examen."));
}
?>