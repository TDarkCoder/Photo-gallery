<?php

require_once(LIB_PATH.DS.'database.php');

class DatabaseObject{

    protected static string $table;

    public static function find_all(){

        $result = self::find_by_sql("SELECT * FROM `".static::$table."`");
        return $result;

    }

    public static function find_by_id($id = '0'){

        global $db;
        $result = self::find_by_sql("SELECT * FROM `".static::$table."` WHERE `id` = ".$db->escape_value($id)." LIMIT 1");
        return !empty($result) ? array_shift($result) : false;

    }

    public static function find_by_sql($query = ''){

        global $db;
        $result = $db->query($query);
        $objects = [];
        while($row = $db->fetch_array($result)){
            $objects[] = self::instantiate($row);
        }
        return $objects;

    }

    public function save(){

        return ($this->id) ? $this->update() : $this->create();

    }

    protected function create(){

        global $db;

        $query = "INSERT INTO `".static::$table."` (`".join("`, `", array_keys($this->sanitized_attributes()))."`) VALUES ('".join("', '", array_values($this->sanitized_attributes()))."')";
        if($db->query($query)){
            $this->id = $db->insert_id();
            return true;
        }else{
            return false;
        }

    }

    protected function update(){

        global $db;

        $query = "UPDATE `".static::$table."` SET `first_name` = '".$db->escape_value($this->first_name)."', `last_name` = '".$db->escape_value($this->last_name)."', `username` = '".$db->escape_value($this->username)."', `password` = '".$db->escape_value($this->password)."' WHERE `id` = '$this->id'";

        $db->query($query);
        return ($db->affected_rows() === 1) ? true : false;

    }

    public function delete(){

        global $db;

        $query = "DELETE FROM `".static::$table."` WHERE `id` = ".$db->escape_value($this->id)." LIMIT 1";
        $db->query($query);
        return ($db->affected_rows()) ? true : false;

    }

    private static function instantiate($record){

        $object = new static;
        foreach($record as $attribute => $value){
            if($object->hasAttribute($attribute)){
                $object->$attribute = $value;
            }
        }
        return $object;

    }

    private function hasAttribute($attribute){

        $object_vars = $this->attributes();

        return array_key_exists($attribute, $object_vars);

    }

    public function attributes(){

        global $db;
        $result = $db->query("SHOW COLUMNS FROM ".static::$table);

        $attributes = [];
        while($row = $db->fetch_array($result)){
            if(property_exists($this, $row['Field'])){
                $field = $row['Field'];
                $attributes[$field] = $this->$field;
            }
        }

        return $attributes;

    }

    private function sanitized_attributes(){

        global $db;
        $attributes = [];

        foreach($this->attributes() as $key => $value){
            if($key !== 'id' && $key !== 'created_at'){
                $attributes[$key] = $db->escape_value($value);
            }
        }

        return $attributes;

    }

}
