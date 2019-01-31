<?php
class Temp{

    // database connection and table name
    private $conn;
    private $table_name = "ferm";
    public $index;
    public $temp;
    public $timestamp;
    public $sensor_int;



    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read products
function read(){

      // select all query
      $query = "SELECT
                   p.index, p.temp, p.timestamp, p.sensor_int
              FROM
                  " . $this->table_name . " p
                  order by
                  p.timestamp DESC";

      // prepare query statement

      $stmt = $this->conn->prepare($query);

      // execute query
      $stmt->execute();
//print_r($stmt);
      return $stmt;
  }

function readOne(){

    // query to read single record

$query = "SELECT
          p.index, p.temp, p.timestamp, p.sensor_int
          FROM
          " . $this->table_name . " p
          WHERE
              p.index = ?
          LIMIT
              0,1";
            //  echo $query;
    // prepare query statement
    $stmt = $this->conn->prepare( $query );

    // bind id of product to be updated
    $stmt->bindParam(1, $this->index);

    // execute query
    $stmt->execute();

    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // set values to object properties
    $this->index = $row['index'];
    $this->temp = $row['temp'];
    $this->timestamp = $row['timestamp'];
    $this->sensor_int = $row['sensor_int'];

}
function readLast(){

$query = "SELECT
          p.index, p.temp, p.timestamp, p.sensor_int
          FROM
          " . $this->table_name . " p
          WHERE
              p.sensor_int = ?
          Order by p.timestamp DESC
          LIMIT
              0,1";

              //echo $query;
    // prepare query statement
    $stmt = $this->conn->prepare( $query );

    // bind id of product to be updated
    $stmt->bindParam(1, $this->sensor_int);

    // execute query
    $stmt->execute();

    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // set values to object properties
    $this->index = $row['index'];
    $this->temp = $row['temp'];
    $this->timestamp = $row['timestamp'];
    $this->sensor_int = $row['sensor_int'];

}










// search products
function read30days($keywords){
  $today = date("Y-m-d H:i:s");
  $yesterday=date('Y-m-d',strtotime('- 1 day',strtotime($today)));
    // select all query
    $query = "SELECT
              p.index, p.temp, p.timestamp, p.sensor_int
              FROM
              " . $this->table_name . " p
              WHERE
                p.timestamp between '".$yesterday ."' and '".$today ."'
              and
                  p.sensor_int = ?
              Order by p.timestamp
            ";
    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // sanitize
  //  $keywords=htmlspecialchars(strip_tags($keywords));
  //  $keywords = "%{$keywords}%";

    // bind
    $stmt->bindParam(1, $keywords);


    // execute query
    $stmt->execute();

    return $stmt;
}



function search($keywords){
  $today = date("Y-m-d H:i:s");
  $yesterday=date('Y-m-d',strtotime('- 30 day',strtotime($today)));
    // select all query
    $query = "SELECT
              p.index, p.temp, p.timestamp, p.sensor_int
              FROM
              " . $this->table_name . " p
              WHERE
                p.timestamp between '".$yesterday ."' and '".$today ."'
              and
                  p.sensor_int = ?
              Order by p.timestamp
            ";
    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // sanitize
  //  $keywords=htmlspecialchars(strip_tags($keywords));
  //  $keywords = "%{$keywords}%";

    // bind
    $stmt->bindParam(1, $keywords);


    // execute query
    $stmt->execute();

    return $stmt;
}





}
