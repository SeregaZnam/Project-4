<?php

class databaseConnect{
    private $link;
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "Project-5";

//Подключается к базе:
    public function __construct()
    {
        $this->link = mysqli_connect($this->host, $this->user, $this->password, $this->database) or die(mysqli_error($this->link));
    }

    public function connect(){
        $this->link = mysqli_connect($this->host, $this->user, $this->password, $this->database) or die(mysqli_error($this->link));
        mysqli_query($this->link, "SET NAMES utf8");
        return $this->link;
    }

    public function get($table, $condition, $flag = false){
        if($flag){
            $query = "SELECT $condition FROM $table";
        } else {
            $query = "SELECT * FROM $table WHERE $condition";
        }
        $result = $this->query($query);
        for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row );
        return $data;
    }

    public function save($table, $data){//data-пример массива title=>'какой то тайтл', text=>"какой то текст"
        $keys = array_keys($data);
        $keys = implode(', ', $keys);
        $values = array_values($data);
        $values = implode("', '", $values);
        $values = "'".$values."'";

        $query = "INSERT INTO $table ($keys) VALUES ($values)";
        $this->query($query);
    }

    public function update($query){
        $result = $this->query($query);
        return true;
    }

    public function delete($query){
        $result = $this->query($query);
        return true;
    }

    private function query($query){
        $result = mysqli_query($this->link, $query)or die(mysqli_error($this->link));
        return $result;
    }
}
?>