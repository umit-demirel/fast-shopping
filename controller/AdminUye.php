<?php
class AdminUye extends Controller{
	public function __construct(){
		parent::__construct();
	}
	public function bireysel_uyeler($mesaj=false)
	{
		if(isset($mesaj))
		{
			$data["mesaj"]=$mesaj;
		}
		$model = $this->load->model("adminModel");
		$data["uyeler"] = $model->getBireyselUyeler();
		$this->load->view("AdminTasarim/header");
		$this->load->view("AdminPanel/BireyselUyeler",$data);
		$this->load->view("AdminTasarim/footer");
	}
	public function bireysel_uye_sil($id=false)
	{
		if(empty($id) || !is_numeric($id))
		{
			header("Location:".SITE_URL."/AdminUye/bireysel_uyeler/notfound");
		}else{
			$model = $this->load->model("adminModel");
			$uye_kontrol = $model->getBireyselUyeKontrol($id);
			if($uye_kontrol==true)
			{
				$sil = $model->bireyselUyeSil($id);
				if($sil)
				{
					header("Location:".SITE_URL."/AdminUye/bireysel_uyeler/success");
				}else{
					header("Location:".SITE_URL."/AdminUye/bireysel_uyeler/error");
				}
			}else{
				header("Location:".SITE_URL."/AdminUye/bireysel_uyeler/notfound");
			}
		}
	}
	public function bireysel_uye_ara()
	{
		if(isset($_POST["kelime"]))
		{
			$kelime = trim($_POST["kelime"]);
			$arama_tipi = $_POST["arama_tipi"];
			$model = $this->load->model("adminModel");
			$data["uyeler"] = $model->bireyselUyeAra($kelime,$arama_tipi);
			$this->load->view("AdminTasarim/header");
			$this->load->view("AdminPanel/BireyselUyeler",$data);
			$this->load->view("AdminTasarim/footer");
		}else{
			header("Location:".SITE_URL."/AdminUye/bireysel_uyeler");
		}
	}
	public function bireysel_uye_profili($id=false)
	{
		if(isset($id) && is_numeric($id))
		{
			$model = $this->load->model("adminModel");
			$data["profil"] = $model->getBireyselUyeProfili($id);
			$this->load->view("AdminTasarim/header");
			$this->load->view("AdminPanel/BireyselUyeProfil",$data);
			$this->load->view("AdminTasarim/footer");
		}else{
			header("Location:".SITE_URL."/AdminUye/bireysel_uyeler/notfound");
		}
	}
	public function bireysel_uye_ilanlari($id=false)
	{
		if(isset($id) && is_numeric($id))
		{
			$model = $this->load->model("adminModel");
			$data["urunler"] = $model->getBireyselUyeUrunleri($id);
			$this->load->view("AdminTasarim/header");
			$this->load->view("AdminPanel/BireyselUyeUrunleri",$data);
			$this->load->view("AdminTasarim/footer");
		}else{
			header("Location:".SITE_URL."/AdminUye/bireysel_uyeler/notfound");
		}
	}
	public function firma_uyeler($mesaj=false)
	{
		if(isset($mesaj))
		{
			$data["mesaj"]=$mesaj;
		}
		$model = $this->load->model("adminModel");
		$data["uyeler"] = $model->getFirmaUyeler();
		$this->load->view("AdminTasarim/header");
		$this->load->view("AdminPanel/FirmaUyeler",$data);
		$this->load->view("AdminTasarim/footer");
	}
	public function firma_uye_ara()
	{
		if(isset($_POST["kelime"]))
		{
			$kelime = trim($_POST["kelime"]);
			$arama_tipi = $_POST["arama_tipi"];
			$model = $this->load->model("adminModel");
			$data["uyeler"] = $model->firmaUyeAra($kelime,$arama_tipi);
			$this->load->view("AdminTasarim/header");
			$this->load->view("AdminPanel/FirmaUyeler",$data);
			$this->load->view("AdminTasarim/footer");
		}else{
			header("Location:".SITE_URL."/AdminUye/bireysel_uyeler");
		}
	}
	public function firma_uye_ilanlari($id=false)
	{
		if(isset($id) && is_numeric($id))
		{
			$model = $this->load->model("adminModel");
			$data["urunler"] = $model->getFirmalUyeUrunleri($id);
			$this->load->view("AdminTasarim/header");
			$this->load->view("AdminPanel/FirmaUyeUrunleri",$data);
			$this->load->view("AdminTasarim/footer");
		}else{
			header("Location:".SITE_URL."/AdminUye/firma_uyeler/notfound");
		}
	}
	public function firma_uye_profili($id=false)
	{
		if(isset($id) && is_numeric($id))
		{
			$model = $this->load->model("adminModel");
			$data["profil"] = $model->getFirmaUyeProfili($id);
			$this->load->view("AdminTasarim/header");
			$this->load->view("AdminPanel/FirmaUyeProfil",$data);
			$this->load->view("AdminTasarim/footer");
		}else{
			header("Location:".SITE_URL."/AdminUye/firma_uyeler/notfound");
		}
	}
	public function firma_uye_sil($id=false)
	{
		if(empty($id) || !is_numeric($id))
		{
			header("Location:".SITE_URL."/AdminUye/firma_uyeler/notfound");
		}else{
			$model = $this->load->model("adminModel");
			$uye_kontrol = $model->getFirmaUyeKontrol($id);
			if($uye_kontrol==true)
			{
				$sil = $model->firmaUyeSil($id);
				if($sil)
				{
					header("Location:".SITE_URL."/AdminUye/firma_uyeler/success");
				}else{
					header("Location:".SITE_URL."/AdminUye/firma_uyeler/error");
				}
			}else{
				header("Location:".SITE_URL."/AdminUye/firma_uyeler/notfound");
			}
		}
	}
}
?>