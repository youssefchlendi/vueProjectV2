<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// database connection will be here

// include database and object files
include_once '../config/database.php';
include_once '../objects/matiere.php';
  
// instantiate database and matieree object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$matiere = new matiere($db);
  
// read matierees will be here
// query matierees
$stmt = $matiere->read();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $matieres_arr=array();
    $matieres_arr["matieres"]=array();
  
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
            "coefficient" => $coefficient,
            "idProf" => $idProf
        );
  
        array_push($matieres_arr["matieres"], $product_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show matieree data in json format
    echo json_encode($matieres_arr);
}
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no matieree found
    echo json_encode(
        array("message" => "No matiere found.")
    );
}
// no matieree found will be here