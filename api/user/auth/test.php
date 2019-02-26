<?php

    //headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../../../config/Database.php');
include_once('../../../models/Users.php');


$database = new Database();

$db = $database->connect();

$users = new Users($db);

$result = $users->read();

$num = $result->rowCount();

if($num > 0){
    $user_arr = array();
    $user_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $user_list = array(
            'id'=> $id ,
            'firstName'=> $first_name ,
            'lastName'=> $last_name ,
            'gender'=> $gender ,
            'email'=> $email ,
            'occupation'=> $occupation ,
            'birthday'=> $birthday 
        );

        array_push($user_arr['data'],$user_list);
        
    }

    echo json_encode($user_arr);

}else{
    echo json_encode(array('message'=>"there have no registered user"));
}

?>