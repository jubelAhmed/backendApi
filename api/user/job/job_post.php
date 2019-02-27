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

// log info
$job->logoImage = $_POST['logoImage'];// it will come by image upload file with encoded data
$job->logoName = $_POST['logoImage'];// it will come by image upload file with encoded data

//user info 
$job->userId = $_POST['userId']; // it will come by session

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

print_r(json_encode($jobArray));





?>

<?php
/* 
print_r($job->jobTitle);
print_r($job->companyName);
print_r($job->logoImage);
print_r($job->logoName);
print_r($job->userId);
print_r($job->location);
print_r($job->remoteWork);
print_r($job->jobType);
print_r($job->salaryType);
print_r($job->minSalary);
print_r($job->maxSalary);
print_r($job->programmingSkill);
print_r($job->designSkill);
print_r($job->othersSkill);
print_r($job->jobDescription);
 */
?>