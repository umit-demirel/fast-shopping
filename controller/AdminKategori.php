<?php

class AdminKategori extends Controller{
	public function __construct(){
		parent::__construct();
	}
	public function ana_kategoriler($gelenMesaj=false){
		if(isset($gelenMesaj))
		{
			$data["mesaj"] = $gelenMesaj;
		}
		$model = $this->load->model("adminModel");
		$data["kategoriler"] = $model->anaKategoriListesi();
		
		$this->load->view("AdminTasarim/header");
		$this->load->view("AdminPanel/AnaKategoriler",$data);
		$this->load->view("AdminTasarim/footer");
	}
	public function ana_kategori_ekle(){
		if(isset($_POST["state"]))
		{
			$kategori_adi = $_POST["kategori_adi"];
			$aciklama = $_POST["kategori_aciklama"];
			
			$model = $this->load->model("adminModel");
			$kategori_ekle = $model->anaKategoriEkle($kategori_adi,$aciklama);
			if($kategori_ekle==true)
			{
				header("Location:".SITE_URL."/AdminKategori/ana_kategoriler/success");
			}else{
				header("Location:".SITE_URL."/AdminKategori/ana_kategoriler/error");
			}
		}else{
			$this->load->view("AdminTasarim/header");
			$this->load->view("AdminPanel/AnaKategoriEkle");
			$this->load->view("AdminTasarim/footer");
		}
		
	}
	public function ana_kategori_duzenle($kategori_id=false)
	{
		if(isset($kategori_id))
		{
			$model = $this->load->model("adminModel");
			$data["kategori"] = $model->getKategori($kategori_id);
			$this->load->view("AdminTasarim/header");
			$this->load->view("AdminPanel/AnaKategoriDuzenle",$data);
			$this->load->view("AdminTasarim/footer");
		}else{
			header("Location:".SITE_URL."/AdminKategori/ana_kategoriler/error");
		}
	}
	public function ana_kategori_update($kategori_id=false)
	{
		if(isset($kategori_id))
		{
			if(isset($_POST["state"]))
			{
				$model = $this->load->model("adminModel");
				$kategori_adi = $_POST["kategori_adi"];
				$aciklama = $_POST["kategori_aciklama"];
				$data = array(
					"kategoriAdi"=>"$kategori_adi",
					"aciklama"=>"$aciklama"
				);
				$update = $model->kategoriUpdate($kategori_id,$data);
				if($update==true)
				{
					header("Location:".SITE_URL."/AdminKategori/ana_kategoriler/success");
				}else{
					header("Location:".SITE_URL."/AdminKategori/ana_kategoriler/error");
				}
			}else{
				header("Location:".SITE_URL."/AdminKategori/ana_kategoriler/error");
			}
		}else{
			header("Location:".SITE_URL."/AdminKategori/ana_kategoriler/error");
		}
	}
	public function ana_kategori_sil($kategori_id=false)
	{
		if(isset($kategori_id))
		{
			$model = $this->load->model("adminModel");
			$kategoriKontrol = $model->kategoriKontrol($kategori_id);
			if($kategoriKontrol==true)
			{
				$sil = $model->kategoriSil($kategori_id);
				if($sil)
				{
					header("Location:".SITE_URL."/AdminKategori/ana_kategoriler/success");
				}else{
					header("Location:".SITE_URL."/AdminKategori/ana_kategoriler/error");
				}
			}else{
				header("Location:".SITE_URL."/AdminKategori/ana_kategoriler/notfound");
			}
			
		}else{
			header("Location:".SITE_URL."/AdminKategori/ana_kategoriler/error");
		}
	}
	public function ana_kategori_ara()
	{
		if(isset($_POST["kategori_adi"]))
		{
			$kategori_adi = trim($_POST["kategori_adi"]);
			$model = $this->load->model("adminModel");
			$data["kategoriler"] = $model->anaKategoriAra($kategori_adi);
			$this->load->view("AdminTasarim/header");
			$this->load->view("AdminPanel/AnaKategoriler",$data);
			$this->load->view("AdminTasarim/footer");
		}else{
			header("Location:".SITE_URL."/AdminKategori/ana_kategoriler");
		}
	}
}

?>