<?php

class Photo extends DatabaseObject{

    protected static string $table = 'photos';

    private array $errors = [
        UPLOAD_ERR_OK => 'No errors.',
        UPLOAD_ERR_INI_SIZE => 'File should not exceed 2MB.',
        UPLOAD_ERR_FORM_SIZE => 'File should not exceed 2MB.',
        UPLOAD_ERR_PARTIAL => 'File was partially uploaded.',
        UPLOAD_ERR_NO_FILE => 'No file selected.',
        UPLOAD_ERR_NO_TMP_DIR => 'No temporary directory chosen.',
        UPLOAD_ERR_CANT_WRITE => 'Can\'t write to disk.',
        UPLOAD_ERR_EXTENSION => 'File upload stopped by extension.'
    ];

    public string $error;
    private string $tmp_path;
    protected string $upload_dir = 'img';

    public $id;
    public $filename;
    public $type;
    public $size;
    public $caption;

    public function image_path(){
        return $this->upload_dir.'/'.$this->filename;
    }

    public function size(){

        if($this->size < 1024){
            return "$this->size bytes";
        }else if($this->size < 1048576){
            $size = round($this->size / 1024);
            return "$size KB";
        }else{
            $size = round($this->size / 1048576, 1);
            return "$size MB";
        }

    }

    public function comments(){
        return Comment::photo_comments($this->id);
    }

    public function attach_file($file){

        if(!$file || empty($file) || !is_array($file)){
            $this->error = 'No file uploaded';
            return false;
        }else if($file['error'] !== 0){
            $this->error = $this->errors[$file['error']];
            return false;
        }else{
            $this->tmp_path = $file['tmp_name'];
            $this->filename = basename($file['name']);
            $this->type = $file['type'];
            $this->size = $file['size'];
        }

        return true;

    }

    public function create(){

        if(!empty($this->error)) false;

        if(strlen($this->caption) >= 255){
            $this->error = 'Caption can maximum consists of 255 characters';
            return false;
        }

        if(empty($this->filename) || empty($this->tmp_path)){
            $this->error = 'File directory is invalid';
            return false;
        }

        $path = SITE_ROOT.DS.'public'.DS.$this->upload_dir.DS.$this->filename;

        if(file_exists($path)){
            $this->error = 'There is already file in this directory with this name';
            return false;
        }

        if(move_uploaded_file($this->tmp_path, $path)){
            if(parent::create()){
                unset($this->tmp_path);
                return true;
            }
        }else{
            $this->error = 'File was not uploaded';
            return false;
        }


    }

    public function destroy(){

        if($this->delete()){

            $path = SITE_ROOT.DS.'public'.DS.$this->image_path();

            if(file_exists($path)){
                return unlink($path) ? true : false;
            }

            return true;

        }else{
            return false;
        }

    }

}
