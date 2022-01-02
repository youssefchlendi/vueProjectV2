<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// database connection will be here

// include database and object files
include_once '../config/database.php';
include_once '../objects/class.php';
  
// instantiate database and Classe object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$class = new Classe($db);
  
// read Classes will be here
// query Classes
$stmt = $class->read();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $Classes_arr=array();
    $Classes_arr["classes"]=array();
  
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
            "intitule" => $intitule,
            "abbreviation" => $abr
        );
  
        array_push($Classes_arr["classes"], $product_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show Classe data in json format
    echo json_encode($Classes_arr);
}
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no Classe found
    echo json_encode(
        array("message" => "No Classe found.")
    );
}
// no Classe found will be here