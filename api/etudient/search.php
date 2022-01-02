<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/etudient.php';
  
// instantiate database and Etudient object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$Etudient = new Etudient($db);
  
// get keywords
$keywords=isset($_GET["s"]) ? $_GET["s"] : "";
  
// query Etudients
$stmt = $Etudient->search($keywords);
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // Etudients array
    $Etudients_arr=array();
    $Etudients_arr["etudients"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $Etudient_item=array(
            "id"=>$ID,
            "nom" => $nom,
            "prenom" => $prenom,
            "cin" => $CIN,
            "class" => $class,
            "numIns" => $numIns,
        );
  
        array_push($Etudients_arr["etudients"], $Etudient_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show Etudients data
    echo json_encode($Etudients_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no Etudients found
    echo json_encode(
        array("message" => "No Etudients found.")
    );
}
?>