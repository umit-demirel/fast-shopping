<?php

class adminModel extends Model{
	public function __construct(){
		parent::__construct();
	}
	/*Admin Login İşlemleri*/
	public function adminLogin($eposta,$parola){
		$login_query = $this->db->select("select * from admin where EpostaAdresi='$eposta' and Sifre='$parola'");
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
	/*-------------------------------------------------------------------*/
	/*Kategori İşlemleri*/
	public function anaKategoriEkle($kategori_adi,$kategori_aciklama){
		$data = array(
			"AnaKategoriID"=>0,
			"KategoriAdi"=>"$kategori_adi",
			"Aciklama"=>"$kategori_aciklama"
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
		return $this->db->select("select * from kategoriler where AnaKategoriID=0 order by KategoriAdi asc");
	}
	public function getKategori($id)
	{
		return $this->db->select("select * from kategoriler where KategoriID=$id");
	}
	public function kategoriUpdate($kategori_id,$data)
	{
		return $this->db->update("kategoriler",$data,"KategoriID=$kategori_id");
	}
	public function kategoriSil($kategori_id)
	{
		return $this->db->delete("kategoriler","KategoriID=$kategori_id");
	}
	public function kategoriKontrol($kategori_id){
		$query = $this->db->select("select * from kategoriler where KategoriID=$kategori_id");
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
		return $this->db->select("select * from kategoriler where KategoriAdi like '%".$kategori_adi."%' order by KategoriAdi asc");
	}
	public function altKategoriEkle($data){
		$query = $this->db->insert("kategoriler",$data);
		if($query)
		{
			return true;
		}else{
			return false;
		}
	}
	public function altKategoriListesi(){
		return $this->db->select("SELECT altKT.KategoriID, altKT.KategoriAdi, altKT.Aciklama, ustKT.KategoriAdi AS 'ustkategoriadi' FROM kategoriler AS altKT, kategoriler AS ustKT  WHERE ustKT.KategoriID=altKT.AnaKategoriID");
	}
	public function altKategoriAra($kategori_adi){
		return $this->db->select("SELECT altKT.KategoriID, altKT.KategoriAdi, altKT.Aciklama, ustKT.KategoriAdi AS 'ustkategoriadi' FROM kategoriler AS altKT, kategoriler AS ustKT  WHERE ustKT.KategoriID=altKT.AnaKategoriID and altKT.KategoriAdi like '%".$kategori_adi."%'");
	}
	public function altKategoriSil($kategori_id)
	{
		return $this->db->delete("kategoriler","KategoriID=$kategori_id");
	}
	/*-----------------------------------------------------------------------*/
	/*Profil İşlemleri*/
	public function adminEmailKontrol($admin_email)
	{
		$query = $this->db->select("select * from admin where EpostaAdresi='$admin_email'");
		if(count($query)>0)
		{
			return true;
		}else{
			return false;
		}
	}
	public function getProfil($admin_email)
	{
		return $this->db->select("select * from admin where EpostaAdresi='$admin_email'");
	}
	public function profilGuncelle($data)
	{
		return $this->db->update("admin",$data,"AdminID=1");
	}
	/*-------------------------------------------*/
	/*Makale İşlemleri*/
	public function makaleListesi()
	{
		return $this->db->select("select * from makaleler order by MakaleID desc");
	}
	public function makaleEkle($data){
		$query = $this->db->insert("makaleler",$data);
		if($query)
		{
			return true;
		}else{
			return false;
		}
	}
	public function getMakaleKontrol($id)
	{
		$query = $this->db->select("select * from makaleler where MakaleID='$id'");
		if(count($query)>0)
		{
			return true;
		}else{
			return false;
		}
	}
	public function getMakale($id)
	{
		$query = $this->db->select("select * from makaleler where MakaleID='$id'");
		return $query;
	}
	public function makaleSil($id)
	{
		return $this->db->delete("makaleler","MakaleID=$id");
	}
	public function makaleGuncelle($data,$id)
	{
		return $this->db->update("makaleler",$data,"MakaleID=$id");
	}
	/*--------------------------------------------*/
	
}