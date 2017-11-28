<?php
class AdminIlanlar extends Controller{
	public function __construct()
	{
		parent::__construct();
	}
	public function bireysel_ilanlar($mesaj=false)
	{
		if(isset($mesaj))
		{
			$data["mesaj"] = $mesaj;
		}
		$model = $this->load->model("adminModel");
		$data["ilanlar"] = $model->bireyselUyeIlanlari();
		$this->load->view("AdminTasarim/header");
		$this->load->view("AdminPanel/BireyselUyeIlanlari",$data);
		$this->load->view("AdminTasarim/footer");
	}
	public function aktif($id=false)
	{
		if(empty($id) || !is_numeric($id))
		{
			header("Location:".SITE_URL."/AdminIlanlar/bireysel_ilanlar/notfound");
		}else{
			$model = $this->load->model("adminModel");
			$aktif = $model->bireyselIlanAktifEt($id);
			if($aktif)
			{
				header("Location:".SITE_URL."/AdminIlanlar/bireysel_ilanlar/success");
			}else{
				header("Location:".SITE_URL."/AdminIlanlar/bireysel_ilanlar/error");
			}
		}
	}
	public function pasif($id=false)
	{
		if(empty($id) || !is_numeric($id))
		{
			header("Location:".SITE_URL."/AdminIlanlar/bireysel_ilanlar/notfound");
		}else{
			$model = $this->load->model("adminModel");
			$pasif = $model->bireyselIlanPasifEt($id);
			if($pasif)
			{
				header("Location:".SITE_URL."/AdminIlanlar/bireysel_ilanlar/success");
			}else{
				header("Location:".SITE_URL."/AdminIlanlar/bireysel_ilanlar/error");
			}
		}
	}
	public function bireysel_ilan_sil($id=false)
	{
		if(empty($id) || !is_numeric($id))
		{
			header("Location:".SITE_URL."/AdminIlanlar/bireysel_ilanlar/notfound");
		}else{
			$model = $this->load->model("adminModel");
			$sil = $model->bireyselIlanSil($id);
			if($sil)
			{
				header("Location:".SITE_URL."/AdminIlanlar/bireysel_ilanlar/success");
			}else{
				header("Location:".SITE_URL."/AdminIlanlar/bireysel_ilanlar/error");
			}
		}
	}
	public function bireysel_ilan_ara()
	{
		if(isset($_POST["kelime"]))
		{
			$kelime = $_POST["kelime"];
			$tip = $_POST["tip"];
			$model = $this->load->model("adminModel");
			$data["ilanlar"] = $model->bireyselIlanAra($kelime,$tip);
			$this->load->view("AdminTasarim/header");
			$this->load->view("AdminPanel/BireyselUyeIlanlari",$data);
			$this->load->view("AdminTasarim/footer");
		}
	}
	/*-------------------------------------------------------------------*/
	public function firma_ilanlar($mesaj=false)
	{
		if(isset($mesaj))
		{
			$data["mesaj"] = $mesaj;
		}
		$model = $this->load->model("adminModel");
		$data["ilanlar"] = $model->firmaUyeIlanlari();
		$this->load->view("AdminTasarim/header");
		$this->load->view("AdminPanel/FirmaUyeIlanlari",$data);
		$this->load->view("AdminTasarim/footer");
	}
	public function firma_ilan_aktif($id=false)
	{
		if(empty($id) || !is_numeric($id))
		{
			header("Location:".SITE_URL."/AdminIlanlar/firma_ilanlar/notfound");
		}else{
			$model = $this->load->model("adminModel");
			$aktif = $model->firmaIlanAktifEt($id);
			if($aktif)
			{
				header("Location:".SITE_URL."/AdminIlanlar/firma_ilanlar/success");
			}else{
				header("Location:".SITE_URL."/AdminIlanlar/firma_ilanlar/error");
			}
		}
	}
	public function firma_ilan_pasif($id=false)
	{
		if(empty($id) || !is_numeric($id))
		{
			header("Location:".SITE_URL."/AdminIlanlar/firma_ilanlar/notfound");
		}else{
			$model = $this->load->model("adminModel");
			$aktif = $model->firmaIlanPasifEt($id);
			if($aktif)
			{
				header("Location:".SITE_URL."/AdminIlanlar/firma_ilanlar/success");
			}else{
				header("Location:".SITE_URL."/AdminIlanlar/firma_ilanlar/error");
			}
		}
	}
	public function firma_ilan_sil($id)
	{
		if(empty($id) || !is_numeric($id))
		{
			header("Location:".SITE_URL."/AdminIlanlar/firma_ilanlar/notfound");
		}else{
			$model = $this->load->model("adminModel");
			$sil = $model->firmaIlanSil($id);
			if($sil)
			{
				header("Location:".SITE_URL."/AdminIlanlar/firma_ilanlar/success");
			}else{
				header("Location:".SITE_URL."/AdminIlanlar/firma_ilanlar/error");
			}
		}
	}
	public function firma_ilan_ara()
	{
		if(isset($_POST["kelime"]))
		{
			$kelime = $_POST["kelime"];
			$tip = $_POST["tip"];
			$model = $this->load->model("adminModel");
			$data["ilanlar"] = $model->firmaIlanAra($kelime,$tip);
			$this->load->view("AdminTasarim/header");
			$this->load->view("AdminPanel/FirmaUyeIlanlari",$data);
			$this->load->view("AdminTasarim/footer");
		}
	}
}
?>