<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<?php
include(__DIR__ ."/config.php");
class Select{
    private $host   = HOST;
    private $user   = USER;
    private $pass   = PASS;
    private $dbname = DBNAME;
    public $pdo;
    public $tablename;
    public $setOption;
    public $where;
    public function setOption($option){
        $this->setOption = $option;
    }
    public function setTable($tablename){
        $this->tablename = $tablename;
        
    }
    public function where($where){
        $this->where = $where;
        
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
    public function query(){
        $this->connect();
        if(empty($this->where)){
            $optionStart = "1=1";
        } else {
            $optionStart = "1=1 AND ";
        }
        $stmt = "select {$this->setOption} from {$this->tablename} where {$optionStart} {$this->where}";
        $stmt = $this->pdo->query($stmt);
        $this->disconnect();
        return $stmt;
    }
}


?>