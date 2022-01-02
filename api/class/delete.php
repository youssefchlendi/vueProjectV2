<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object file
include_once '../config/database.php';
include_once '../objects/class.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare class object
$class = new Classe($db);
  
// get class id
$data = json_decode(file_get_contents("php://input"));
  
// set class id to be deleted
$class->ID = $data->id;
  
// delete the class
$res=$class->delete();
if($res==1){
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "class was deleted."));
}
else if($res==2){


    // set response code - 200 ok
    http_response_code(404);
  
    // tell the user
    echo json_encode(array("message" => "class Id was not found."));


}
  
// if unable to delete the class
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to delete class."));
}
?>