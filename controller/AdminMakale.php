<?php
class AdminMakale extends Controller{
	public function __construct()
	{
		parent::__construct();
	}
	public function ckfinder(){
        header("Location:".SITE_URL."/ckfinder/ckfinder.html?type=Images&CKEditor=icerik&CKEditorFuncNum=2&langCode=tr");
    }
	public function makale_ekle()
	{
		if(isset($_POST["state"]))
		{
			$baslik = $_POST["baslik"];
			$icerik = $_POST["icerik"];
			$etiketler = $_POST["etiketler"];
			$tarih = date("Y-m-d");
			$model = $this->load->model("adminModel");
			$data = array(
				"Baslik"=>"$baslik",
				"Icerik"=>"$icerik",
				"tarih"=>"$tarih",
				"etiketler"=>"$etiketler"
			);
			$ekle = $model->makaleEkle($data);
			if($ekle)
			{
				header("Location:".SITE_URL."/AdminMakale/makaleler/success");
			}else{
				header("Location:".SITE_URL."/AdminMakale/makaleler/error");
			}
		}else{
			$this->load->view("AdminTasarim/header");
			$this->load->view("AdminPanel/MakaleEkle");
			$this->load->view("AdminTasarim/footer");
		}
	}
	public function makaleler($mesaj=false)
	{
		if(isset($mesaj))
		{
			$data["mesaj"] = $mesaj;
		}
		$model = $this->load->model("adminModel");
		$data["makaleler"] = $model->makaleListesi();
		$this->load->view("AdminTasarim/header");
		$this->load->view("AdminPanel/Makaleler",$data);
		$this->load->view("AdminTasarim/footer");
	}
	public function makale_sil($id=false)
	{
		if(empty($id))
		{
			header("Location:".SITE_URL."/AdminMakale/makaleler");
		}else{
			$model = $this->load->model("adminModel");
			$makale_kontrol = $model->getMakaleKontrol($id);
			if($makale_kontrol==true)
			{
				//silme islemleri
				$makale_sil = $model->makaleSil($id);
				
				if($makale_sil)
				{
					header("Location:".SITE_URL."/AdminMakale/makaleler/success");
				}else{
					header("Location:".SITE_URL."/AdminMakale/makaleler/error");
				}
			}else{
				//makale bulunamadı
				header("Location:".SITE_URL."/AdminMakale/makaleler/notfound");
			}
		}
	}
	public function makale_guncelle($id=false){
		if(empty($id))
		{
			header("Location:".SITE_URL."/AdminMakale/makaleler");
		}else{
			$model = $this->load->model("adminModel");
			$makale_kontrol = $model->getMakaleKontrol($id);
			if($makale_kontrol==true)
			{
				$data["makale"] = $model->getMakale($id);
				$this->load->view("AdminTasarim/header");
				$this->load->view("AdminPanel/MakaleGuncelle",$data);
				$this->load->view("AdminTasarim/footer");
			}else{
				//makale bulunamadı
				header("Location:".SITE_URL."/AdminMakale/makaleler/notfound");
			}
		}
	}
	public function makale_update($id=false){
		if(empty($id))
		{
			header("Location:".SITE_URL."/AdminMakale/makaleler/notfound");
		}else{
			$model = $this->load->model("adminModel");
			$makale_kontrol = $model->getMakaleKontrol($id);
			if($makale_kontrol==true)
			{
				if(isset($_POST["state"]))
				{
					$baslik = $_POST["baslik"];
					$icerik = $_POST["icerik"];
					$etiketler = $_POST["etiketler"];
					$tarih = date("Y-m-d");
					$data = array(
						"Baslik"=>"$baslik",
						"Icerik"=>"$icerik",
						"tarih"=>"$tarih",
						"etiketler"=>"$etiketler"
					);
					$guncelle = $model->makaleGuncelle($data,$id);
					if($guncelle)
					{
						header("Location:".SITE_URL."/AdminMakale/makaleler/success");
					}else{
						header("Location:".SITE_URL."/AdminMakale/makaleler/error");
					}
				}else{
					
				}
			}else{
				//makale bulunamadı
				header("Location:".SITE_URL."/AdminMakale/makaleler/notfound");
			}
		}
	}
}
?>