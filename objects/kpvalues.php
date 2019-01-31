<?php
class Kpvalues{

    // database connection and table name
    private $conn;
    private $table_name = "kpvalues";
    public $kpvalues;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read products

function read(){
      // select all query
      $query = "SELECT
                p.kpvalue
              FROM
                  " . $this->table_name . " p
                  order by
                  p.timestamp DESC  limit 0,1";

      // prepare query statement
 
      $stmt = $this->conn->prepare($query);

      // execute query
      $stmt->execute();
//print_r($stmt);
      return $stmt;
  }





  // create product
  function create(){

      // query to insert record
      $query = "INSERT INTO
                  " . $this->table_name . "
              SET
                  Kp=:Kp, Ki=:Ki , Kd=:Kd";

      // prepare query

      $stmt = $this->conn->prepare($query);

      // sanitize
      $this->Kp=htmlspecialchars(strip_tags($this->Kp));
      $this->Ki=htmlspecialchars(strip_tags($this->Ki));
      $this->Kd=htmlspecialchars(strip_tags($this->Kd));

      // bind values
      $stmt->bindParam(":Kp", $this->Kp);
      $stmt->bindParam(":Ki", $this->Ki);
      $stmt->bindParam(":Kd", $this->Kd);

      // execute query
      if($stmt->execute()){
          return true;
      }

      return false;

  }





}
