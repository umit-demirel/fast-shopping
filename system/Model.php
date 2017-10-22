<?php

class Model{
    protected $db = array();
    public function __construct(){
	$this->db = new Database("mysql:host=localhost;dbname=e-ticaret","root","");
    }
}