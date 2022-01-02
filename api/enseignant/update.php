<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/enseignant.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare enseignant object
$enseignant = new enseignant($db);
  
// get id of enseignant to be edited
$data = json_decode(file_get_contents("php://input"));
  
// set ID property of enseignant to be edited
$enseignant->id = $data->id;
$oldenseignant = new enseignant($db);
$oldenseignant->id = $data->id;
$oldenseignant->readOne();
// set enseignant property values
$enseignant->nom = !empty($data->nom)?$data->nom:$oldenseignant->nom;
$enseignant->prenom = !empty($data->prenom)?$data->prenom:$oldenseignant->prenom;
$enseignant->cin = !empty($data->cin)?$data->cin:$oldenseignant->cin;
// update the enseignant
$res=$enseignant->update();
if($res==1){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "enseignant was updated."));
}else if($res==2){
        // set response code - 200 ok
        http_response_code(404);
  
        // tell the user
        echo json_encode(array("message" => "enseignant ID was not found."));
    
}
// if unable to update the enseignant, tell the user
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to update enseignant."));
}
?>