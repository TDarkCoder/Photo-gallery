<?php

require_once(LIB_PATH.DS.'config.php');

class MySQL{

    private object $connection;
    private $last_query;

    public function __construct(){
        $this->connect();
    }

    private function connect(){

        $this->connection = mysqli_connect(host, user, password);

        if(!$this->connection){
            exit('No server connect'.mysqli_error());
        }else{
            $db = mysqli_select_db($this->connection, db);
            if(!$db){
                exit('No connection to database'. mysqli_error());
            }
        }

    }

    public function disconnect(){

        if(isset($this->connection)){
            mysqli_close($this->connection);
            unset($this->connection);
        }

    }

    public function query($query){

        $this->last_query = $query;
        $result = mysqli_query($this->connection, $query);
        $this->confirm_query($result);
        return $result;

    }

    public function fetch_array($result){
        return mysqli_fetch_array($result);
    }

    public function escape_value($result){

        $result = mysqli_real_escape_string($this->connection, htmlspecialchars(trim($result)));
        return $result;

    }

    public function num_rows($result){
        return mysqli_num_rows($result);
    }

    public function insert_id(){
        return mysqli_insert_id($this->connection);
    }

    public function affected_rows(){
        return mysqli_affected_rows($this->connection);
    }

    private function confirm_query($result){
        if(!$result){
            $message = 'Database query failed'. mysqli_error().'<br>';
            $message .= 'Last SQL query: '.$this->last_query;
            exit($message);
        }
    }

}

$db = new MySQL();
