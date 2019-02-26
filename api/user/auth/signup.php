<?php

    //headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../../../config/Database.php');
include_once('../../../models/User.php');


$database = new Database();

$db = $database->connect();

$user = new User($db);

$user->firstName = $_POST['firstName'];
$user->lastName = $_POST['lastName'];
//$user->userName = $_POST['userName'];
$user->email = $_POST['email'];
$user->birthday = $_POST['birthday'];
$user->occupation = $_POST['occupation'];
$user->gender = $_POST['gender'];
$user->password = $_POST['password'];

if($user->signup()){
    $userArray = array(
        "status" => true,
        "message" => "successfully signup",
        "id" => $user->id ,
        "userName" => $user->email 
    );
}else{
    $userArray = array(
        "status" => false,
        "message" => "email already exists!"
    );
}

print_r(json_encode($userArray));



?>