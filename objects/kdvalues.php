<?php
class Kdvalues{

    // database connection and table name
    private $conn;
    private $table_name = "kdvalues";
    public $kdvalues;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read products

function read(){
      // select all query
      $query = "SELECT
                p.kdvalue
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
                   kdvalue=:kdvalue";

      // prepare query
      print_r($query);

      $stmt = $this->conn->prepare($query);

      // sanitize

      $this->kdvalue=htmlspecialchars(strip_tags($this->kdvalue));

      // bind values

      $stmt->bindParam(":kdvalue", $this->kdvalue);

      // execute query
      if($stmt->execute()){
          return true;
      }
      return false;
  }

}
