<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate enseignant object
include_once '../objects/enseignant.php';
  
$database = new Database();
$db = $database->getConnection();
  
$enseignant = new enseignant($db);
  
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

if(
    !empty($data->nom) &&
    !empty($data->prenom) &&
    !empty($data->cin) 

){

    
    // set enseignant property values
    $enseignant->nom = $data->nom;
    $enseignant->prenom = $data->prenom;
    $enseignant->cin = $data->cin;
  
    // create the enseignant
    if($enseignant->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "enseignant was created."));
    }
  
    // if unable to create the enseignant, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create enseignant."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create enseignant. Data is incomplete.".$err.""));
}
?>