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
	public function anaKategoriEkle($kategori_adi,$kategori_aciklama){
		$data = array(
			"kategoriAdi"=>"$kategori_adi",
			"altKategoriID"=>0,
			"aciklama"=>"$kategori_aciklama"
		);
		$kategori_ekle = $this->db->insert("kategoriler",$data);
		if($kategori_ekle)
		{
			return true;
		}else{
			return false;
		}
	}
	public function anaKategoriListesi(){
		return $this->db->select("select * from kategoriler where altKategoriID=0 order by kategoriAdi asc");
	}
	public function getKategori($id)
	{
		return $this->db->select("select * from kategoriler where kategoriID=$id");
	}
	public function kategoriUpdate($kategori_id,$data)
	{
		return $this->db->update("kategoriler",$data,"kategoriID=$kategori_id");
	}
	public function kategoriSil($kategori_id)
	{
		return $this->db->delete("kategoriler","kategoriID=$kategori_id");
	}
	public function kategoriKontrol($kategori_id){
		$query = $this->db->select("select * from kategoriler where kategoriID=$kategori_id");
		$isValue = count($query);
		if($isValue > 0)
		{
			//Sorgulama Başarılı
			return true;
		}else{
			//Sorgula Başarısız!
			return false;
		}
	}
	public function anaKategoriAra($kategori_adi)
	{
		return $this->db->select("select * from kategoriler where kategoriAdi like '%".$kategori_adi."%' order by kategoriAdi asc");
	}
}