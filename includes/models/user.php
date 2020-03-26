<?php

class User extends DatabaseObject{

    protected static string $table = 'users';
    public $id;
    public $username;
    public $first_name;
    public $last_name;
    public $password;

    public function full_name(){

        if(!empty($this->first_name) && !empty($this->last_name)){
            return $this->first_name.' '.$this->last_name;
        }else{
            return "";
        }

    }

    public static function authenticate($username = "", $password = ""){

        global $db;
        $query = "SELECT * FROM `".self::$table."` WHERE `username` = '".$db->escape_value($username)."' AND `password` = '".$db->escape_value($password)."' LIMIT 1";
        $result = self::find_by_sql($query);
        return !empty($result) ? array_shift($result) : false;

    }

}
