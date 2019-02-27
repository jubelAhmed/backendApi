<?php

class User
{
    private $conn;
    private $table = 'users';

    public $firstName;
    public $lastName;
    public $email;
    public $birthday;
    public $occupation;
    public $gender;
    public $password; 

        // constructor with db

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // signup function

    public function signup(){
        if($this->isAlreadyExist()){
            return false;
        }

     
        // query to insert record
        $query = "INSERT INTO" . $this->table. "
                SET first_name=:first_name, last_name=:last_name, email=:email , birthday=:birthday,occupation=:occupation,gender=:gender,password=:password";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->firstName=htmlspecialchars(strip_tags($this->firstName));
        $this->lastName=htmlspecialchars(strip_tags($this->lastName));
        $this->email=htmlspecialchars(strip_tags($this->email));
    
        // bind values
        $stmt->bindParam(":first_name", $this->firstName);
        $stmt->bindParam(":last_name", $this->lastName);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":birthday", $this->birthday);
        $stmt->bindParam(":occupation", $this->occupation);
        $stmt->bindParam(":gender", $this->gender);
        $stmt->bindParam(":password", md5($this->password));
       
    
        // execute query
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }
    
        return false;
    }

    // signin function

    public function login(){


        // select all query
        $query = "SELECT `id`, `first_name`, `last_name`, `email`, `birthday`, `occupation`, `gender`, `password`
        FROM " . $this->table . " 
        WHERE email='".$this->email."' AND password='".$this->password."'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }

    // is already exist check

    public function isAlreadyExist(){
        
        $query = "SELECT *
        FROM " . $this->table . " 
        WHERE email='".$this->email."'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }



   /*  // get all registered user
    public function read()
    {
        $query = "SELECT `id`, `first_name`, `last_name`, `email`, `birthday`, `occupation`, `gender`, `password` FROM $this->table ";
        

        $stmt = $this->conn->query($query);

        return $stmt;

    }

    // get single user
 */
    



}

?>