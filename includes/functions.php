<?php

function redirect_to($location = null){

    if($location !== null){
        header("Location:$location");
        exit;
    }

}

function output_message($message = ""){

    if(!empty($message)){
        return "<p class=\"message text-danger\">$message</p>";
    }

}

spl_autoload_register('my_autoloader');

function my_autoloader($class_name){

    $class_name = strtolower($class_name);
    $path  = LIB_PATH.DS."models".DS."$class_name.php";

    if(file_exists($path)){
        require_once($path);
    }else{
        exit("Class ". ucfirst($class_name). " not found");
    }

}

function path($path = ''){

    $url = '/photogallery/public/'.$path;
    return $url;

}

function calendar($datetime = ""){

    $date = strtotime($datetime);
    return strftime("%B %d, %Y at %I:%M %p", $date);

}
