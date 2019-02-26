<?php

    //headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../../../config/Database.php');
include_once('../../../models/User.php');


$database = new Database();

$db = $database->connect();

$user = new User($db);

// set ID property of user to be edited
$user->email = isset($_GET['email']) ? $_GET['email'] : die();
$user->password = md5( isset($_GET['password']) ? $_GET['password'] : die());

// read the details of user to be edited
$stmt = $user->login();
if($stmt->rowCount() > 0){
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // create array
    $user_arr=array(
        "status" => true,
        "message" => "Successfully Login!",
        "id" => $row['id'],
        "email" => $row['email']
    );
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "Invalid eamil or Password!",
    );
}
// make it json format
print_r(json_encode($user_arr));

?>