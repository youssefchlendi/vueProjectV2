<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate Etudient object
include_once '../objects/etudient.php';
  
$database = new Database();
$db = $database->getConnection();
  
$Etudient = new Etudient($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
// make sure data is not empty
$err="";
if(empty($data->nom)){
    $err.="Nom";
}
if(empty($data->prenom)){
    $err.=" Prenom";
}
if(empty($data->cin)){
    $err.=" Cin";
}
if(empty($data->numIns)){
    $err.=" numIns";
}
if(
    !empty($data->nom) &&
    !empty($data->prenom) &&
    !empty($data->cin) &&
    !empty($data->numIns)

){

    
    // set Etudient property values
    $Etudient->nom = $data->nom;
    $Etudient->prenom = $data->prenom;
    $Etudient->cin = $data->cin;
    $Etudient->class = isset($data->class)?$data->class:null;
    $Etudient->numIns = $data->numIns;
  
    // create the Etudient
    if($Etudient->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Etudient was created."));
    }
  
    // if unable to create the Etudient, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create Etudient."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create Etudient. Data is incomplete.".$err.""));
}
?>