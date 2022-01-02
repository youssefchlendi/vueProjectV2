<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/enseignant.php';
  
// instantiate database and enseignant object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$enseignant = new enseignant($db);
  
// get keywords
$keywords=isset($_GET["s"]) ? $_GET["s"] : "";
  
// query enseignants
$stmt = $enseignant->search($keywords);
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // enseignants array
    $enseignants_arr=array();
    $enseignants_arr["enseignants"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $enseignant_item=array(
            "id"=>$ID,
            "nom" => $nom,
            "prenom" => $prenom,
            "cin" => $CIN
        );
  
        array_push($enseignants_arr["enseignants"], $enseignant_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show enseignants data
    echo json_encode($enseignants_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no enseignants found
    echo json_encode(
        array("message" => "No enseignants found.")
    );
}
?>