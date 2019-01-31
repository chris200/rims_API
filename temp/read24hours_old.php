<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/temp.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$temp = new Temp($db);

// get keywords
$sensor_int=isset($_GET["sensor_int"]) ? $_GET["sensor_int"] : "";
echo $sensor_int;
// query products


$stmt->bindParam(1, $sensor_int);
$stmt = $temp->read24hours($sensor_int);
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){

    // products array
    $temp_arr=array();
    $temp_arr["records"]=array();

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $temp_item = array(
            "index" =>  $temp->index,
            "temp" => $temp->temp,
            "timestamp" => $temp->timestamp,
            "sensor_int" => $temp->sensor_int,


        );

        array_push($temp_arr["records"], $temp_item);
    }

    echo json_encode($temp_arr);
}

else{
    echo json_encode(
        array("message" => "No temps found.")
    );
}
?>
