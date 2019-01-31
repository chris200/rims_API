<?php
class Currenttemp{

    // database connection and table name
    private $conn;
    private $table_name = "atlog";
    public $index;
    public $temperture;
    public $timestamp;




    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read products

    function read(){

        // select all query
        $query = "SELECT
                    p.temperature as temperature
                FROM
                    " . $this->table_name . " p

                order by    p.timestamp DESC limit 0,1";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function readall(){



        // select all query

        $query = "SELECT
                    p.timestamp as timestamp,
                    p.temperature as temperature

                FROM

                    " . $this->table_name . " p



                order by    p.timestamp DESC ";



        // prepare query statement

        $stmt = $this->conn->prepare($query);



        // execute query

        $stmt->execute();



        return $stmt;

    }






}
