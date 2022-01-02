<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/etudient.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare Etudient object
$Etudient = new Etudient($db);
  
// get id of Etudient to be edited
$data = json_decode(file_get_contents("php://input"));
  
// set ID property of Etudient to be edited
$Etudient->id = $data->id;
$oldEtudient = new Etudient($db);
$oldEtudient->id = $data->id;
$oldEtudient->readOne();
// set Etudient property values
$Etudient->nom = !empty($data->nom)?$data->nom:$oldEtudient->nom;
$Etudient->prenom = !empty($data->prenom)?$data->prenom:$oldEtudient->prenom;
$Etudient->cin = !empty($data->cin)?$data->cin:$oldEtudient->cin;
$Etudient->class = !empty($data->class)?$data->class:(!empty($oldEtudient->class)?$oldEtudient->class:null);
$Etudient->numIns = !empty($data->numIns)?$data->numIns:$oldEtudient->numIns;
// update the Etudient
$res=$Etudient->update();
if($res==1){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "Etudient was updated."));
}else if($res==2){
        // set response code - 200 ok
        http_response_code(404);
  
        // tell the user
        echo json_encode(array("message" => "Etudient ID was not found."));
    
}
// if unable to update the Etudient, tell the user
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to update Etudient."));
}
?>