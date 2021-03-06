
<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// <script >
// setInterval(function(){window.open('index.php');},2000);
// </script>


// get database connection
include_once '../config/database.php';

// instantiate product object
include_once '../objects/currenttemprefresh.php';

$database = new Database();
$db = $database->getConnection();

$product = new Currenttemprefresh($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));
print_r($data);

if(
    !empty($data->refreshseconds)
){
    // set product property values
    $product->refreshseconds = $data->refreshseconds;
    // create the product
    if($product->create()){

        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo json_encode(array("message" => "Product was created."));
        ?>

        <?php
    }

    // if unable to create the product, tell the user
    else{

        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(array("message" => "Unable to create product."));
    }
}

// tell the user data is incomplete
else{

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));


}


?>
