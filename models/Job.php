<?php

class Job
{
    private $conn;
    private $posts_table = 'jobs';
    private $logos_table = 'logos';

    //logos info
    public $logoImage;
    public $logoName;

    // job info
     
    public $jobTitle;
    public $companyName;
    
    public $location;
    public $remoteWork;
    public $jobType; 
    public $salaryType; 
    public $minSalary; 
    public $maxSalary; 
    public $programmingSkill; 
    public $designSkill; 
    public $othersSkill; 
    public $jobDescription; 
    public $approveStatus; 


    private $logoId;

    public function __construct($db)
    {
        $this->conn = $db;
    }

        // constructor with db

    public function __construct($db)
    {
        $this->conn = $db;
    }


    public function post(){

        //save logo
        saveLogo();


        $query = "INSERT INTO". $this->posts_table ." SET job_title=:job_title, company_name=:company_name ,logo_id=:logo_id,location=:location,remote_work=:remote_work,job_type=:job_type,salary_type=:salary_type,min_salary=:min_salary,max_salary=:max_salary,programming_skill=:programming_skill,design_skill=:design_skill,others_skill=:others_skill, job_description=:job_description" ; 


        $stmt = $this->conn->prepare($query);

        // bind values
        $stmt->bindParam(":job_title", $this->jobTitle);
        $stmt->bindParam(":company_name", $this->companyName);
        $stmt->bindParam(":logo_id", $this->logoId);
        $stmt->bindParam(":remote_work", $this->remoteWork);
        $stmt->bindParam(":job_type", $this->jobType);
        $stmt->bindParam(":salary_type", $this->salaryType);
        $stmt->bindParam(":min_salary", md5($this->minSalary));
        $stmt->bindParam(":max_salary", md5($this->maxSalary));
        $stmt->bindParam(":programming_skill", md5($this->programmingSkill));
        $stmt->bindParam(":design_skill", md5($this->designSkill));
        $stmt->bindParam(":job_description", md5($this->jobDescription));

        
        // execute query
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }
          return false;
    

       
    }

    private function saveLogo(){

        $logoQuery = "INSERT INTO". $this->logos_table ." SET img_name=:img_name, image=:image " ;

        
        $stmt = $this->conn->prepare($logoQuery);

        // bind values
        $stmt->bindParam(":img_name", $this->logoName);
        $stmt->bindParam(":image", $this->logoImage);

        // execute query
        if($stmt->execute()){
            $this->logoId = $this->conn->lastInsertId();
            return true;
        }
    
        return false;
    

    }


}    


?>