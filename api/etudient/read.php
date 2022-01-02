<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// database connection will be here

// include database and object files
include_once '../config/database.php';
include_once '../objects/etudient.php';
  
// instantiate database and Etudient object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$Etudient = new Etudient($db);
  
// read Etudients will be here
// query Etudients
$stmt = $Etudient->read();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $Etudient_arr=array();
    $Etudient_arr["etudients"]=array();
  
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
            "cin" => $CIN,
            "class" => $class,
            "numins" => $numIns
        );
  
        array_push($Etudient_arr["etudients"], $product_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show Etudient data in json format
    echo json_encode($Etudient_arr);
}
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no Etudient found
    echo json_encode(
        array("message" => "No Etudient found.")
    );
}
// no Etudient found will be here