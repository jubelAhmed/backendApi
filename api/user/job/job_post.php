<?php

    //headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../../../config/Database.php');
include_once('../../../models/Job.php');


$database = new Database();

$db = $database->connect();

$job = new Job($db);


$job->jobTitle = $_POST['jobTitle'];
$job->companyName = $_POST['companyName'];

$job->logoImage = $_POST['logoImage'];
$job->location = $_POST['location'];
$job->remoteWork = $_POST['remoteWork'];
$job->jobType = $_POST['jobType'];
$job->salaryType = $_POST['salaryType'];
$job->minSalary = $_POST['minSalary'];
$job->maxSalary = $_POST['maxSalary'];
$job->programmingSkill = $_POST['programmingSkill'];
$job->designSkill = $_POST['designSkill'];
$job->othersSkill = $_POST['othersSkill'];
$job->jobDescription = $_POST['jobDescription'];



if($job->post()){
    $jobArray = array(
        "status" => true,
        "message" => "successfully job post",
        "id" => $job->id ,
        
    );
}else{
    $jobArray = array(
        "status" => false,
        "message" => "job post failed"
    );
}

print_r(json_encode($userArray));





?>