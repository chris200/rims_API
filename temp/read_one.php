<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/temp.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$temp = new Temp($db);

// set ID property of product to be edited
$temp->index = isset($_GET['index']) ? $_GET['index'] : die();

// read the details of product to be edited
$temp->readOne();

// create array
$temp_arr = array(
    "index" =>  $temp->index,
    "temp" => $temp->temp,
    "timestamp" => $temp->timestamp,
    "sensor_int" => $temp->sensor_int,


);

// make it json format
print_r(json_encode($temp_arr));
?>
