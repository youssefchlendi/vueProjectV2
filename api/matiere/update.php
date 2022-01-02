<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/matiere.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare matiere object
$matiere = new matiere($db);
  
// get id of matiere to be edited
$data = json_decode(file_get_contents("php://input"));
  
// set ID property of matiere to be edited
$matiere->ID = $data->id;
$oldData=new matiere($db);
$oldData->ID=$data->id;
$oldData->readOne();

// set matiere property values
$matiere->intitule = isset($data->intitule)?$data->intitule:$oldData->intitule;
$matiere->coefficient = isset($data->coefficient)?$data->coefficient:$oldData->coefficient;
$matiere->idProf = isset($data->idProf)?$data->idProf:(empty($data->idProf)?$oldData->idProf:NULL);
// update the matiere
$res=$matiere->update();
if($res==1){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "matiere was updated."));
}else if($res==2){
        // set response code - 200 ok
        http_response_code(404);
  
        // tell the user
        echo json_encode(array("message" => "matiere ID was not found."));
    
}
// if unable to update the matiere, tell the user
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to update matiere."));
}
?>