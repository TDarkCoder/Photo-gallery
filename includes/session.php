<?php

class Session{

    private bool $logged_id = false;
    public int $user_id;
    public string $message;

    public function __construct(){

        session_start();
        $this->check_login();
        $this->check_message();
        if($this->is_logged_in()){}else{}

    }

    private function check_message(){

        if(isset($_SESSION['message'])){
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        }else{
            $this->message = "";
        }

    }

    public function message($text = ""){

        if(!empty($text)){
            $_SESSION['message'] = $text;
        }else{
            return $this->message;
        }

    }

    public function is_logged_in(){
        return $this->logged_id;
    }

    public function login($user = null){

        if($user !== null){
            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->logged_id = true;
        }

    }

    public function logout(){

        unset($this->user_id);
        unset($_SESSION['user_id']);
        $this->logged_id = false;


    }

    private function check_login(){

        if(isset($_SESSION['user_id'])){
            $this->user_id = $_SESSION['user_id'];
            $this->logged_id = true;
        }else{
            $this->logged_id = false;
        }

    }

}

$session = new Session();
