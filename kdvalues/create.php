<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

// instantiate product object
include_once '../objects/kvalues.php';

$database = new Database();
$db = $database->getConnection();

$product = new Kvalues($db);

// if (!isset($data)) {
//  $data = new stdClass();
// }
// // get posted data
// $data =  (file_get_contents("php://input"));
//
// print_r($data);
// print_r(" ");
if($_POST){
$Kp=$_POST['Kp'];
$Ki=$_POST['Ki'];
$Kd=$_POST['Kd'];
print_r($Kp );
}

//$data=['targettemperature']->$targettemperature;




$data->Kp=$Kp;
$data->Ki=$Ki;
$data->Kd=$Kd;

//print_r($data);
//print_r($data->targettemperature);
// make sure data is not empty
if(
    !empty($data->Kp) &&
    !empty($data->Ki) &&
    !empty($data->Kd)


){

    // set product property values
    $product->Kp = $data->Kp;
    $product->Ki = $data->Ki;
    $product->Kd = $data->Kd;

    // create the product
    if($product->create()){
        echo "<div class='alert alert-success'>Product was created.</div>";
    }

    // if unable to create the product, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to create product.</div>";
    }




    // if($product->create()){
    //
    //     // set response code - 201 created
    //     http_response_code(201);
    //
    //     // tell the user
    //     echo json_encode(array("message" => "Product was created."));
    //
    // }
    //
    // // if unable to create the product, tell the user
    // else{
    //
    //     // set response code - 503 service unavailable
    //     http_response_code(503);
    //
    //     // tell the user
    //     echo json_encode(array("message" => "Unable to create product."));
    // }
}

// tell the user data is incomplete
else{

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
}

echo "<script >";
echo "setInterval(function(){window.open('index.php');},2000);";
echo "</script>";
?>

<script >
setInterval(function(){window.open('index.php');},500);
</script>
