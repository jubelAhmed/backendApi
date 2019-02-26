<?php

class Database
{

    private $host = "localhost";
    private $db_name = "information-hub";
    private $user_name = "root";
    private $password = "";

        // db connect

    public function connect()
    {
        $this->conn = null;
      

        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->user_name, $this->password);

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "database connected";
        } catch (PDOException $e) {
            echo 'connection error : ' . $e->getMessage();
        }

        return $this->conn;
    }


}

?>