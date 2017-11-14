<?php
class AdminFooter extends Controller{
	public function __construct(){
		parent::__construct();
	}
	public function blok_ekle()
	{
		$model = $this->load->model("adminModel");
		if(isset($_POST["state"]))
		{
			$blok_adi = trim($_POST["blok_adi"]);
			$sira_no = trim($_POST["sira_no"]);
			$data = array(
				"BlokAdi"=>"$blok_adi",
				"BlokSiraNo"=>"$sira_no"
			);
			$ekle = $model->footerBlokEkle($data);
			if($ekle)
			{
				header("Location:".SITE_URL."/AdminFooter/bloklar/success");
			}else{
				header("Location:".SITE_URL."/AdminFooter/bloklar/error");
			}
		}else{
			$this->load->view("AdminTasarim/header");
			$this->load->view("AdminPanel/FooterBlokEkle");
			$this->load->view("AdminTasarim/footer");
		}
	}
	public function bloklar($mesaj=false)
	{
		if(isset($mesaj))
		{
			$data["mesaj"] = $mesaj;
		}
		$model = $this->load->model("adminModel");
		$data["bloklar"] = $model->footerBlokListesi();
		$this->load->view("AdminTasarim/header");
		$this->load->view("AdminPanel/FooterBloklari",$data);
		$this->load->view("AdminTasarim/footer");
	}
	public function blok_guncelle($id=false)
	{
		if(empty($id) || !is_numeric($id))
		{
			header("Location:".SITE_URL."/AdminFooter/bloklar/notfound");
		}else{
			$model = $this->load->model("adminModel");
			$sorgula = $model->footerBlokKontrol($id);
			if($sorgula==true)
			{
				if(isset($_POST["state"]))
				{
					$blok_adi = trim($_POST["blok_adi"]);
					$sira_no = trim($_POST["sira_no"]);
					$data = array(
						"BlokAdi"=>"$blok_adi",
						"BlokSiraNo"=>"$sira_no"
					);
					$guncelle = $model->footerBlokGuncelle($data,$id);
					if($guncelle)
					{
						header("Location:".SITE_URL."/AdminFooter/bloklar/success");
					}else{
						header("Location:".SITE_URL."/AdminFooter/bloklar/error");
					}
				}else{
					$data["blok"] = $model->getFooterBlok($id);
					$this->load->view("AdminTasarim/header");
					$this->load->view("AdminPanel/FooterBlokGuncelle",$data);
					$this->load->view("AdminTasarim/footer");
				}
			}else{
				header("Location:".SITE_URL."/AdminFooter/bloklar/notfound");
			}
		}
	}
	public function blok_sil($id=false)
	{
		if(empty($id) || !is_numeric($id))
		{
			header("Location:".SITE_URL."/AdminFooter/bloklar/notfound");
		}else{
			$model = $this->load->model("adminModel");
			$sorgula = $model->footerBlokKontrol($id);
			if($sorgula==true)
			{
				$sil = $model->footerBlokSil($id);
				if($sil)
				{
					header("Location:".SITE_URL."/AdminFooter/bloklar/success");
				}else{
					header("Location:".SITE_URL."/AdminFooter/bloklar/error");
				}
			}else{
				header("Location:".SITE_URL."/AdminFooter/bloklar/notfound");
			}
		}
	}
	public function linkler($mesaj=false)
	{
		if(isset($mesaj))
		{
			$data["mesaj"] = $mesaj;
		}
		$model = $this->load->model("adminModel");
		$data["linkler"] = $model->getFooterLinkler();
		$data["url_link"] = $model->getFooterLinkUrl();
		$this->load->view("AdminTasarim/header");
		$this->load->view("AdminPanel/FooterLinkler",$data);
		$this->load->view("AdminTasarim/footer");
	}
	public function link_ekle($mesaj=false)
	{
		if(isset($mesaj))
		{
			$data["mesaj"]=$mesaj;
		}
		$model = $this->load->model("adminModel");
		$data["makaleler"] = $model->makaleListesi();
		$data["bloklar"] = $model->footerBlokListesi();
		if(isset($_POST["state"]))
		{
			$link_adi = trim($_POST["link_adi"]);
			$makale_id = 0;
			$url=trim($_POST["url"]);
			$blok_id = "";
			
			if(isset($_POST["blok"]))
			{
				$blok_id=$_POST["blok"];
			}else{
				header("Location:".SITE_URL."/AdminFooter/link_ekle/blok_secilmedi");
			}
			$secim = $_POST["secim"];
			if($secim==0)
			{
				if(isset($_POST["makale"]))
				{
					$makale_id=$_POST["makale"];
				}else{
					header("Location:".SITE_URL."/AdminFooter/link_ekle/makale_secilmedi");
				}
			}else if($secim==1){
				$url = trim($_POST["url"]);
			}else{
				header("Location:".SITE_URL."/AdminFooter/link_ekle/secim_tanimsiz");
			}
			$data = array(
				"LinkAdi"=>"$link_adi",
				"FooterBlokID"=>$blok_id,
				"MakaleID"=>$makale_id,
				"Url"=>"$url"
			);
			$ekle = $model->footerLinkEkle($data);
			if($ekle)
			{
				header("Location:".SITE_URL."/AdminFooter/linkler/success");
				//print_r($data);
			}else{
				header("Location:".SITE_URL."/AdminFooter/linkler/error");
				//print_r($data);
			}
		}else{
			$this->load->view("AdminTasarim/header");
			$this->load->view("AdminPanel/FooterLinkEkle",$data);
			$this->load->view("AdminTasarim/footer");
		}
	}
	public function link_duzenle($id=false)
	{
		if(empty($id) || !is_numeric($id))
		{
			header("Location:".SITE_URL."/AdminFooter/linkler/notfound");
		}else{
			$model = $this->load->model("adminModel");
			$sorgula = $model->footerLinkSorgula($id);
			if($sorgula==true)
			{
				$data["makaleler"] = $model->makaleListesi();
				$data["bloklar"] = $model->footerBlokListesi();
				$data["footerLink"] = $model->getFooterLink($id);
				$this->load->view("AdminTasarim/header");
				$this->load->view("AdminPanel/FooterLinkGuncelle",$data);
				$this->load->view("AdminTasarim/footer");
			}else{
				header("Location:".SITE_URL."/AdminFooter/linkler/notfound");
			}
		}
		
	}
	public function link_sil($id=false)
	{
		if(empty($id) || !is_numeric($id))
		{
			header("Location:".SITE_URL."/AdminFooter/linkler/notfound");
		}else{
			$model = $this->load->model("adminModel");
			$sorgula = $model->footerLinkSorgula($id);
			if($sorgula==true)
			{
				$sil = $model->footerLinkSil($id);
				if($sil)
				{
					header("Location:".SITE_URL."/AdminFooter/linkler/success");
				}else{
					header("Location:".SITE_URL."/AdminFooter/linkler/error");
				}
			}else{
				header("Location:".SITE_URL."/AdminFooter/linkler/notfound");
			}
		}
	}
}
?>