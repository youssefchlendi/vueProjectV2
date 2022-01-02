<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/class.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare class object
$class = new Classe($db);
  
// set ID property of record to read
$class->ID = isset($_GET['id']) ? $_GET['id'] : die();
  
// read the details of class to be edited
  
if($class->readOne()){
    // create array
    $class_arr = array(
        "intitule" =>  $class->intitule,
        "abbreviation" =>  $class->abr,
  
    );

    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($class_arr);
}else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user class does not exist
    echo json_encode(array("message" => "class does not exist."));
}
?>