<?php

class Comment extends DatabaseObject{

    protected static string $table = 'comments';

    public $id;
    public $photo_id;
    public $author;
    public $body;
    public $created_at;

    public static function make($photo_id = "", $author = 'Anonymous', $body = ""){

        if($photo_id !== "" && $body !== "" && !empty(trim($author))){

            $comment = new Comment();
            $comment->photo_id = $photo_id;
            $comment->author = $author;
            $comment->body = $body;
            return $comment;

        }else{
            return false;
        }

    }

    public static function photo_comments($photo_id = null){

        if($photo_id !== null && Photo::find_by_id($photo_id)){

            global $db;
            $query = "SELECT * FROM `comments` WHERE `photo_id` = ".$db->escape_value($photo_id)." ORDER BY created_at DESC";
            $result = self::find_by_sql($query);
            return $result;

        }else{
            return false;
        }

    }

}

