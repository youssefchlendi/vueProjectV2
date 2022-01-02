<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/examen.php';
  
// instantiate database and examen object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$examen = new examen($db);
  
// get keywords
$keywords=isset($_GET["s"]) ? $_GET["s"] : "";
  
// query examens
$stmt = $examen->search($keywords);
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // examens array
    $examens_arr=array();
    $examens_arr["examens"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $examen_item=array(
            "id" => $ID,
            "idMatiere" => $idMatiere,
            "idProf" =>  $idProf,
            "intitule" => $intitule,
            "coefficient" => $coefficient,

        );
  
        array_push($examens_arr["examens"], $examen_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show examens data
    echo json_encode($examens_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no examens found
    echo json_encode(
        array("message" => "No examens found.")
    );
}
?>