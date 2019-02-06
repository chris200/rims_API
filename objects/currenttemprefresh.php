<?php
class Currenttemprefresh{

    // database connection and table name
    private $conn;
    private $table_name = "currenttemprefresh";
    public $index;
    public $refreshseconds;




    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read products

    function read(){

        // select all query
        $query = "SELECT
                    p.refreshseconds as refreshseconds
                FROM
                    " . $this->table_name . " p

                order by    p.timestamp DESC limit 0,1";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // create product
    function create(){

        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    refreshseconds=:refreshseconds";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->refreshseconds=htmlspecialchars(strip_tags($this->refreshseconds));


        // bind values
        $stmt->bindParam(":refreshseconds", $this->refreshseconds);

        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;

    }






}
