<?php

header('Content-Type: text/html; charset=utf-8');

include(__DIR__ ."/config.php");
class Insert{
    private $host   = HOST;
    private $user   = USER;
    private $pass   = PASS;
    private $dbname = DBNAME;
    public $tablename;

    public $pdo;
    public $val;
    public function __construct($tablename = ""){
        $this->tablename = $tablename;
    }
    public function genared_stmt(){
        $input = file_get_contents("php://input");
        // echo $input;
        $input = explode("&", urldecode($input));
        // $input = implode("", $input);
        $val = array();
        $field = "";
        $ans = "";
        foreach($input as $key => $value){
            $value = explode("=", $value);
            $field .= $value[0] . ',';
            $val[] = $value[1];
            // echo "<pre>";
            // print_r($value[1]);
            // echo "</pre>";
            
        }
        // echo substr($field,0,-1);
        $this->val = $val;
        $field = substr($field,0,-1);
        for ($i=0; $i < count($val); $i++) { 
            $ans .= "?,";
        }
        $ans = substr($ans,0,-1);
        $sql = "INSERT INTO $this->tablename ($field) VALUES ($ans)";
        return $sql;
    }
    public function __destruct(){
        $this->pdo = NULL;
    }
    public function connect(){
        try {
            $pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8mb4",$this->user,$this->pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));     
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
    public function insert(){
        $stmt_insert = $this->genared_stmt();
        // echo "<pre>";
        // print_r($this->val);
        // echo "</pre>";
        $this->connect();
       
        // var_dump($this->val);
        // exit;
        $stmt = $this->pdo->prepare($stmt_insert);
        $stmt->execute($this->val);
        
        
        $this->disconnect();

    }
    
}

new Insert;
?>