<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate class object
include_once '../objects/class.php';
  
$database = new Database();
$db = $database->getConnection();
  
$class = new Classe($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
// make sure data is not empty
$err="";
if(empty($data->intitule)){
    $err.="Intitule";
}
if(empty($data->abbreviation)){
    $err.=" abbreviation";
}

if(
    !empty($data->intitule) &&
    !empty($data->abbreviation)
){

    
    // set class property values
    $class->intitule = $data->intitule;
    $class->abr = $data->abbreviation;
  
    // create the class
    if($class->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "class was created."));
    }
  
    // if unable to create the class, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create class."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
    http_response_message("mmchtch");
  
    // tell the user
    echo json_encode(array("message" => "Unable to create class. Data is incomplete.".$err.""));
}
?>