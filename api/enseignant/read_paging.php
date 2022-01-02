<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/core.php';
include_once '../shared/utilities.php';
include_once '../config/database.php';
include_once '../objects/enseignant.php';
  
// utilities
$utilities = new Utilities();
  
// instantiate database and enseignant object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$enseignant = new enseignant($db);
  
// query enseignants
$stmt = $enseignant->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // enseignants array
    $enseignants_arr=array();
    $enseignants_arr["enseignants"]=array();
    $enseignants_arr["paging"]=array();
  
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
  
  
    // include paging
    $total_rows=$enseignant->count();
    $page_url="{$home_url}enseignant/read_paging.php?";
    $paging=$utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
    $enseignants_arr["paging"]=$paging;
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($enseignants_arr);
}
  
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user enseignants does not exist
    echo json_encode(
        array("message" => "No enseignants found.")
    );
}
?>