<?php

class Index extends Model{
	//Site ile ilgili veritabanı işlemleri yapılabilir.
    public function __construct() {
        parent::__construct();
    }
    public function login($user,$pass){
        return $this->db->select("select * from uye where eposta='$user' and sifre='$pass'");
    }
    public function ekle($table,$data){
       // return $data["mesaj"] = "wad";
       return $this->db->insert($table,$data);
    }
	public function sil($table,$where)
	{
		return $this->db->delete($table,$where);
	}
    public function sorgula($sql){
        return $this->db->select($sql);
    }
    public function guncelle($table,$data,$where){
        return $this->db->update($table,$data,$where);
    }
}