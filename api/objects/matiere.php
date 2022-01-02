<?php

class matiere{

    // database connection and table name
    private $conn;
    private $table_name = "matiere";
  
    // object properties
    public $ID;
    public $intitule;
    public $cofficient;
    public $idProf;
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

     //read Matieres
     function read(){

        $query = "SELECT * from ".$this->table_name." ORDER BY ID";

          // prepare query statement
          $stmt = $this->conn->prepare($query);
      
          // execute query
          $stmt->execute();
        
          return $stmt;

    }  
    // create matiere
    function create(){

        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                intitule=:intitule,
                coefficient=:coefficient,
                idProf=:idProf";
    
        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->intitule=htmlspecialchars(strip_tags($this->intitule));
        $this->coefficient=htmlspecialchars(strip_tags($this->coefficient));
        $this->idProf=htmlspecialchars(strip_tags($this->idProf));
        $this->idProf=!empty($this->idProf)?$this->idProf:NULL;
        // bind values
        $stmt->bindParam(":intitule", $this->intitule);
        $stmt->bindParam(":coefficient", $this->coefficient);
        $stmt->bindParam(":idProf", $this->idProf);

        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }  

    // used when filling up the update matiere form
    function readOne(){

        // query to read single record
        $query = "SELECT
                *
                FROM
                " . $this->table_name . " e
                WHERE
                ID = ?
                LIMIT
                    0,1";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->ID);
    
        // execute query
        $stmt->execute();
        if ($stmt->rowCount()!=0){

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // set values to object properties
            $this->intitule = $row['intitule'];
            $this->coefficient = $row['coefficient'];
            $this->idProf = $row['idProf'];
            return true;
        }
                    // set values to NULL
                    $this->intitule =null;
                    $this->coefficient =null;
                    $this->idProf = null;
        
        return false;
    }
    // update the matiere
    function update(){
        $query="SELECT * FROM ".$this->table_name." WHERE id =:id ";
        $stm=$this->conn->prepare($query);
        $stm->execute(["id"=>$this->ID]);
        $res=$stm->rowCount();
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    intitule = :intitule,
                    coefficient = :coefficient,
                    idProf=:idProf
                WHERE
                    ID = :id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->intitule=htmlspecialchars(strip_tags($this->intitule));
        $this->coefficient=htmlspecialchars(strip_tags($this->coefficient));
        $this->idProf=htmlspecialchars(strip_tags($this->idProf));
   
        // bind new values
        $stmt->bindParam(':intitule', $this->intitule);
        $stmt->bindParam(':coefficient', $this->coefficient);
        $stmt->bindParam(':idProf', $this->idProf);
        $stmt->bindParam(':id', $this->ID);

        // execute the query
        if($stmt->execute()&&$res!=0){
            return 1;
        }else if($res==0){
            return 2;
        }
        return 0;
    }
     // delete the matiere
     function delete(){
        $query="SELECT * FROM ".$this->table_name." WHERE ID =:ID ";
        $stm=$this->conn->prepare($query);
        $stm->execute(["ID"=>$this->ID]);
        $res=$stm->rowCount();

        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE ID = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->ID=htmlspecialchars(strip_tags($this->ID));
    
        // bind ID of record to delete
        $stmt->bindParam(1, $this->ID);
    
        // execute query
        if($stmt->execute()&&$res!=0){
            return 1;
        }else if($res==0){
            return 2;
        }
    
        return 0;
    }
 // search matiere
 function search($keywords){
    
    // select all query
    $query = "SELECT
                *
            FROM
                " . $this->table_name . " p
            WHERE
                intitule LIKE ? OR coefficient LIKE ? 
            ";    
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        // bind
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);

        // execute query
        $stmt->execute();

        return $stmt;
    }
    // read matiere with pagination
    public function readPaging($from_record_num, $records_per_page){

        // select query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . " p
                LIMIT ?, ?";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind variable values
        $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);

        // execute query
        $stmt->execute();

        // return values from database
        return $stmt;
    }
        // used for paging matiere
    public function count(){
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $row['total_rows'];
    }
}
