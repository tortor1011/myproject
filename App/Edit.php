<?php
include(__DIR__."/config.php");
class Edit {
    private $host   = HOST;
    private $user   = USER;
    private $pass   = PASS;
    private $dbname = DBNAME;
    public $tablename;

    public $pdo;
    public function __destruct(){
        $this->pdo = NULL;
    }
    public function __construct(){

    }
    public function connect(){
        try {
            $pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname;",$this->user,$this->pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));     
            $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);  
            // echo "Connection Success";
            return $this->pdo = $pdo;
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
    }
    public function disconnect(){
        $this->pdo = NULL;
    }
    public function update($sql, $val){
        $this->connect();
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($val);
        $this->disconnect();
    }
}

?>