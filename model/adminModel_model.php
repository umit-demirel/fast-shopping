<?php

class adminModel extends Model{
	public function __construct(){
		parent::__construct();
	}
	public function adminLogin($eposta,$parola){
		$login_query = $this->db->select("select * from admin where email='$eposta' and parola='$parola'");
		$isValue = count($login_query);
		if($isValue > 0)
		{
			//Sorgulama Başarılı
			return true;
		}else{
			//Sorgula Başarısız!
			return false;
		}
	}
}