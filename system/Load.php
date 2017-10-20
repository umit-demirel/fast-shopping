<?php

class Load{
    public function __construct(){

	}
	public function view($fileName,$data=false)
	{
		if($data==true){
			extract($data);
		}
		include "view/".$fileName."_view.php";
	}
	public function model($fileName)
	{
		include "model/".$fileName."_model.php";
		return new $fileName();
	}
        public function deneme(){
            echo "deneme load";
        }
}