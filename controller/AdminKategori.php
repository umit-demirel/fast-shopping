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
	public function alt_kategori_ekle()
	{
		if(isset($_POST["state"]))
		{
			$ana_kategori = $_POST["ana_kategori"];
			$kategori_adi = $_POST["kategori_adi"];
			$kategori_aciklama = $_POST["kategori_aciklama"];
			
			$model = $this->load->model("adminModel");
			$data = array(
				"AnaKategoriID"=>"$ana_kategori",
				"KategoriAdi"=>"$kategori_adi",
				"Aciklama"=>"$kategori_aciklama"
			);
			$ekle = $model->altKategoriEkle($data);
			if($ekle==true)
			{
				header("Location:".SITE_URL."/AdminKategori/alt_kategoriler/success");
			}else{
				header("Location:".SITE_URL."/AdminKategori/alt_kategoriler/error");
			}
		}else{
			$model = $this->load->model("adminModel");
			$ana_kategoriler = $model->anaKategoriListesi();
			$data["ana_kategoriler"] = $ana_kategoriler;
			$data["ana_kategori_sayisi"] = count($ana_kategoriler);
			$this->load->view("AdminTasarim/header");
			$this->load->view("AdminPanel/AltKategoriEkle",$data);
			$this->load->view("AdminTasarim/footer");
		}
	}
	public function alt_kategoriler($mesaj=false)
	{
		if(isset($mesaj))
		{
			$data["mesaj"]=$mesaj;
		}
		$model = $this->load->model("adminModel");
		$data["kategoriler"] = $model->altKategoriListesi();
		
		$this->load->view("AdminTasarim/header");
		$this->load->view("AdminPanel/AltKategoriler",$data);
		$this->load->view("AdminTasarim/footer");
	}
	public function alt_kategori_sil($kategori_id=false)
	{
		if(isset($kategori_id))
		{
			$model = $this->load->model("adminModel");
			$kategoriKontrol = $model->kategoriKontrol($kategori_id);
			if($kategoriKontrol==true)
			{
				$sil = $model->altKategoriSil($kategori_id);
				if($sil)
				{
					header("Location:".SITE_URL."/AdminKategori/alt_kategoriler/success");
				}else{
					header("Location:".SITE_URL."/AdminKategori/alt_kategoriler/error");
				}
			}else{
				header("Location:".SITE_URL."/AdminKategori/alt_kategoriler/notfound");
			}
			
		}else{
			header("Location:".SITE_URL."/AdminKategori/alt_kategoriler/notfound");
		}
	}
	public function alt_kategori_duzenle($kategori_id=false)
	{
		$model = $this->load->model("adminModel");
		$kategoriKontrol = $model->kategoriKontrol($kategori_id);
		if($kategoriKontrol==true)
		{
			$ana_kategoriler = $model->anaKategoriListesi();
			$data["ana_kategoriler"] = $ana_kategoriler;
			$data["ana_kategori_sayisi"] = count($ana_kategoriler);
			$data["kategori"] = $model->getKategori($kategori_id);
			$this->load->view("AdminTasarim/header");
			$this->load->view("AdminPanel/AltKategoriDuzenle",$data);
			$this->load->view("AdminTasarim/footer");
		}else{
			header("Location:".SITE_URL."/AdminKategori/alt_kategoriler/notfound");
		}
		
	}
	public function alt_kategori_update($kategori_id=false)
	{
		if(isset($kategori_id))
		{
			$model = $this->load->model("adminModel");
			$kategoriKontrol = $model->kategoriKontrol($kategori_id);
			if($kategoriKontrol==true)
			{
				$ana_kategori = $_POST["ana_kategori"];
				$kategori_adi = $_POST["kategori_adi"];
				$kategori_aciklama = $_POST["kategori_aciklama"];
				$data = array(
					"AnaKategoriID"=>"$ana_kategori",
					"KategoriAdi"=>"$kategori_adi",
					"Aciklama"=>"$kategori_aciklama"
				);
				$guncelle = $model->kategoriUpdate($kategori_id,$data);
				if($guncelle)
				{
					header("Location:".SITE_URL."/AdminKategori/alt_kategoriler/success");
				}else{
					header("Location:".SITE_URL."/AdminKategori/alt_kategoriler/error");
				}
			}else{
				header("Location:".SITE_URL."/AdminKategori/alt_kategoriler/notfound");
			}
		}else{
			header("Location:".SITE_URL."/AdminKategori/alt_kategoriler/notfound");
		}
	}
	public function alt_kategori_ara()
	{
		if(isset($_POST["kategori_adi"]))
		{
			$kategori_adi = $_POST["kategori_adi"];
			$model = $this->load->model("adminModel");
			$data["kategoriler"] = $model->altKategoriAra($kategori_adi);
			$this->load->view("AdminTasarim/header");
			$this->load->view("AdminPanel/AltKategoriler",$data);
			$this->load->view("AdminTasarim/footer");
		}else{
			header("Location:".SITE_URL."/AdminKategori/alt_kategoriler/error");
		}
	}
	/*
	public function ana_kategori_arsiv($id=false)
	{
		$model = $this->load->model("adminModel");
		$arsiv_ekle = $model->arsivEkle($id);
		if($arsiv_ekle)
		{
			header("Location:".SITE_URL."/AdminKategori/ana_kategoriler/success");
		}else{
			header("Location:".SITE_URL."/AdminKategori/ana_kategoriler/error");
		}
	}
	public function kategori_arsivleri()
	{
		$model = $this->load->model("adminModel");
		$data["arsivler"] = $model->getKategoriArsivleri();
		$this->load->view("AdminTasarim/header");
		$this->load->view("AdminPanel/KategoriArsivleri",$data);
		$this->load->view("AdminTasarim/footer");
	}
	*/
}

?>