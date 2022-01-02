<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// database connection will be here

// include database and object files
include_once '../config/database.php';
include_once '../objects/enseignant.php';
  
// instantiate database and enseignant object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$enseignant = new enseignant($db);
  
// read enseignants will be here
// query enseignants
$stmt = $enseignant->read();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $enseignant_arr=array();
    $enseignant_arr["enseignants"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $product_item=array(
            "id" => $ID,
            "nom" => $nom,
            "prenom" => $prenom,
            "cin" => $CIN
        );
  
        array_push($enseignant_arr["enseignants"], $product_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show enseignant data in json format
    echo json_encode($enseignant_arr);
}
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no enseignant found
    echo json_encode(
        array("message" => "No enseignant found.")
    );
}
// no enseignant found will be here