<?php
include(__DIR__."/config.php");
class Delete
{
    private $host   = HOST;
    private $user   = USER;
    private $pass   = PASS;
    private $dbname = DBNAME;
    public $pdo;
    public $setTable;
    public $id,$del;
    public function __construct(){

    }
    public function setTable($tablename){
        $this->setTable = $tablename;
    }
    public function setID($del, $id){
        $this->id = $id;
        $this->del = $del;
        
    }

    public function start_delete(){
        $this->connect();
        $del = $this->pdo->query("DELETE FROM $this->setTable WHERE $this->del  = $this->id");
    }
    public function __destruct(){
        $this->pdo = NULL;
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
}
?>