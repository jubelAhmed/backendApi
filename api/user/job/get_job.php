<?php

       //headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../../../config/Database.php');
include_once('../../../models/Job.php');


$database = new Database();

$db = $database->connect();

$job = new Job($db);

$result = $job->getAllPendingJobPost();

$num = $result->rowCount();

if($num > 0){
    $jobArray = array();
    $jobArray['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $jobList = array(
            'job_id'=> $id ,
            'user id'=>$user_id
        );

        array_push($jobArray['data'],$jobList);
        
    }

    echo json_encode($jobArray);

}else{
    echo json_encode(array('message'=>"there have no registered user"));
}



?>