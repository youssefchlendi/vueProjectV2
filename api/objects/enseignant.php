<?php

class enseignant{


    // database connection and table name
    private $conn;
    private $table_name = "enseignant";
  
    // object properties
    public $id;
    public $nom;
    public $prenom;
    public $cin;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function read(){
  
        // select all query
        $query = "SELECT
                   ID,nom,prenom,CIN
                FROM
                    " . $this->table_name . " e
                ORDER BY
                    ID";
      
        // prepare query statement
        $stmt = $this->conn->prepare($query);
      
        // execute query
        $stmt->execute();
      
        return $stmt;
    }
        // create enseignant
    function create(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                nom=:nom,
                prenom=:prenom,
                CIN=:cin";
    
        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->nom=htmlspecialchars(strip_tags($this->nom));
        $this->prenom=htmlspecialchars(strip_tags($this->prenom));
        $this->cin=htmlspecialchars(strip_tags($this->cin));
    
        // bind values
        $stmt->bindParam(":nom", $this->nom);
        $stmt->bindParam(":prenom", $this->prenom);
        $stmt->bindParam(":cin", $this->cin);

        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }
        // used when filling up the update enseignant form
    function readOne(){
    
        // query to read single record
        $query = "SELECT
                ID,nom,prenom,CIN
                FROM
                " . $this->table_name . " e
                WHERE
                ID = ?
                LIMIT
                    0,1";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of enseignant to be updated
        $stmt->bindParam(1, $this->id);
    
        // execute query
        $stmt->execute();

        if($stmt->rowCount()!=0){
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // set values to object properties
            $this->id = $row['ID'];
            $this->nom = $row['nom'];
            $this->prenom = $row['prenom'];
            $this->cin = $row['CIN'];

            return true;
        }
        return false;
    }
        // update the enseignant
    function update(){
        $query="SELECT * FROM ".$this->table_name." WHERE id =:id ";
        $stm=$this->conn->prepare($query);
        $stm->execute(["id"=>$this->id]);
        $res=$stm->rowCount();
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    nom = :nom,
                    prenom = :prenom,
                    CIN = :cin

                WHERE
                    id = :id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->nom=htmlspecialchars(strip_tags($this->nom));
        $this->prenom=htmlspecialchars(strip_tags($this->prenom));
        $this->cin=htmlspecialchars(strip_tags($this->cin));

    
        // bind new values
        $stmt->bindParam(':nom', $this->nom);
        $stmt->bindParam(':prenom', $this->prenom);
        $stmt->bindParam(':cin', $this->cin);

        $stmt->bindParam(':id', $this->id);

        // execute the query
        if($stmt->execute()&&$res!=0){
            return 1;
        }else if($res==0){
            return 2;
        }
        return 0;
    }
            // delete the enseignant
    function delete(){
        $query="SELECT * FROM ".$this->table_name." WHERE id =:id ";
        $stm=$this->conn->prepare($query);
        $stm->execute(["id"=>$this->id]);
        $res=$stm->rowCount();

        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->id);
    
        // execute query
        if($stmt->execute()&&$res!=0){
            return 1;
        }else if($res==0){
            return 2;
        }
    
        return 0;
    }
        // search enseignants
    function search($keywords){
    
        // select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . " p
                WHERE
                    nom LIKE ? OR prenom LIKE ? 
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
    // read enseignants with pagination
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
        // used for paging enseignants
    public function count(){
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $row['total_rows'];
    }

}