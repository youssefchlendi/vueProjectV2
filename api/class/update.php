<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/class.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare class object
$class = new Classe($db);
  
// get id of class to be edited
$data = json_decode(file_get_contents("php://input"));
  
// set ID property of class to be edited
$class->ID = $data->id;
$oldData=new Classe($db);
$oldData->ID=$data->id;
$oldData->readOne();
// set class property values
$class->intitule = isset($data->intitule)?$data->intitule:$oldData->intitule;
$class->abr = isset($data->abbreviation)?$data->abbreviation:$oldData->abr;
// update the class
$res=$class->update();
if($res==1){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "class was updated."));
}else if($res==2){
        // set response code - 200 ok
        http_response_code(404);
  
        // tell the user
        echo json_encode(array("message" => "class ID was not found."));
    
}
// if unable to update the class, tell the user
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to update class."));
}
?>