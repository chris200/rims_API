<?php
class Settingsflags{

    // database connection and table name
    private $conn;
    private $table_name = "settingsflags";
    public $indexdb;
    public $field;
    public $flag;




    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read products
function read(){

      // select all query
      $query = "SELECT
                p.indexDB, p.field
              FROM
                  " . $this->table_name . " p
                  where flag=1
                  order by
                  p.timestampcreated DESC  ";

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
                  targettemperature=:targettemperature";

      // prepare query
      $stmt = $this->conn->prepare($query);

      // sanitize
      $this->targettemperature=htmlspecialchars(strip_tags($this->targettemperature));


      // bind values
      $stmt->bindParam(":targettemperature", $this->targettemperature);

      // execute query
      if($stmt->execute()){
          return true;
      }

      return false;

  }





}
