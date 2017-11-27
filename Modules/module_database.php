<?php

class Module_Database
{
    private $DBH, $table=NULL, $tables=[];
    private static $inst=NULL;
    private function __construct()
    {
        $cfg=Module_Config::load("database");
        $this->DBH = new PDO("mysql:host={$cfg["host"]};dbname={$cfg["dbname"]};charset={$cfg["charset"]}",
            $cfg["user"],
            $cfg["pass"],
            [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );
        $sth=$this->DBH->query("SHOW TABLES");
        $this->tables = $sth->fetchAll(PDO::FETCH_COLUMN);
    }

    public  static function instance(){
        return self::$inst ? self::$inst : self::$inst=new self();
    }

    function __get($name)
    {
        if (!in_array($name, $this->tables)) throw new Exception("table not found", 1001);
        $this->table=$name;
        return $this;
    }

    public function getAllNoteWithCountComment(){
        if(!$this->table)throw new Exception("table was not selected", 1002);
        $q = "SELECT {$this->table}.*, COUNT(comment.note_id) as count_comment FROM `{$this->table}` LEFT JOIN comment ON {$this->table}.id = comment.note_id GROUP BY {$this->table}.id";
        $sth = $this->DBH->prepare($q);
        $sth->execute();
        $this->table=NULL;
        return $sth->fetchAll();
    }

    public function getAll($where="1", array $params=[]){
        if(!$this->table)throw new Exception("table was not selected", 1002);
        $q = "SELECT * FROM `{$this->table}` WHERE {$where}";
        $sth = $this->DBH->prepare($q);
        $sth->execute($params);
        $this->table=NULL;
        return $sth->fetchAll();
    }

    public  function insert(array $data){
        if(!$this->table) throw new Exception("table was not selected", 1002);
        $fields = array_keys($data);
        $q = "INSERT INTO `{$this->table}`(`".implode("`,`", $fields)."`) VALUES (:".implode(", :", $fields).")";
        $sth = $this->DBH->prepare($q);
        $sth->execute($data);
        $this->table=NULL;
    }
}