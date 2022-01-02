
<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/core.php';
include_once '../shared/utilities.php';
include_once '../config/database.php';
include_once '../objects/examen.php';
  
// utilities
$utilities = new Utilities();
  
// instantiate database and examen object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$examen = new examen($db);
  
// query examens
$stmt = $examen->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // examens array
    $examens_arr=array();
    $examens_arr["examens"]=array(); 
    $examens_arr["paging"]=array();
  
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
  
  
    // include paging
    $total_rows=$examen->count();
    $page_url="{$home_url}examen/read_paging.php?";
    $paging=$utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
    $examens_arr["paging"]=$paging;
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($examens_arr);
}
  
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user examens does not exist
    echo json_encode(
        array("message" => "No examens found.")
    );
}
?>