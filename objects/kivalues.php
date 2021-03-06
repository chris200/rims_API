<?php
class Kivalues{

    // database connection and table name
    private $conn;
    private $table_name = "kivalues";
    public $kivalues;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read products

function read(){
      // select all query
      $query = "SELECT
                p.kivalue
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
                   kivalue=:kivalue";

      // prepare query

      $stmt = $this->conn->prepare($query);



      // sanitize


      $this->kivalue=htmlspecialchars(strip_tags($this->kivalue));
      // bind values

      $stmt->bindParam(":kivalue", $this->kivalue);
      // execute query
      if($stmt->execute()){
          return true;
      }
      return false;
  }






}
