<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/matiere.php';
  
// instantiate database and matiere object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$matiere = new matiere($db);
  
// get keywords
$keywords=isset($_GET["s"]) ? $_GET["s"] : "";
  
// query matieres
$stmt = $matiere->search($keywords);
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // matieres array
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
  
        $matiere_item=array(
            "id"=>$ID,
            "intitule" => $intitule,
            "coefficient" =>  $coefficient,
            "idProf" =>  $idProf

        );
  
        array_push($matieres_arr["matieres"], $matiere_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show matieres data
    echo json_encode($matieres_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no matieres found
    echo json_encode(
        array("message" => "No matieres found.")
    );
}
?>