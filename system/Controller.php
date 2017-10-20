<?php

class Controller{
    protected $load = array();
    public function __construct(){
        $this->load = new Load();
    }
    public function page($fileName,$data=false){
        if($data==true){
	extract($data);
	}
        include 'view/'.$fileName.".php";
    }
}