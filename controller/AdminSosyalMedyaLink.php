<?php
class AdminSosyalMedyaLink extends Controller{
	public function __construct()
	{
		parent::__construct();
	}
	public function sosyal_medya_linkleri($mesaj=false)
	{
		$model = $this->load->model("adminModel");
		if(isset($mesaj))
		{
			$data["mesaj"] = $mesaj;
		}
		if(isset($_POST["state"]))
		{
			$link_adi = trim($_POST["link_adi"]);
			$link_url = trim($_POST["link_url"]);
			$data = array(
				"LinkAdi"=>"$link_adi",
				"Url"=>"$link_url"
			);
			$ekle = $model->sosyalMedyaLinkEkle($data);
			if($ekle)
			{
				header("Location:".SITE_URL."/AdminSosyalMedyaLink/sosyal_medya_linkleri/success");
			}else{
				header("Location:".SITE_URL."/AdminSosyalMedyaLink/sosyal_medya_linkleri/error");
			}
		}else{
			$data["linkler"] = $model->sosyalMedyaLinkleri();
			$this->load->view("AdminTasarim/header");
			$this->load->view("AdminPanel/SosyalMedyaLinkleri",$data);
			$this->load->view("AdminTasarim/footer");
		}
	}
	public function link_sil($id=false)
	{
		if(empty($id) || !is_numeric($id))
		{
			header("Location:".SITE_URL."/AdminSosyalMedyaLink/sosyal_medya_linkleri/notfound");
		}else{
			$model = $this->load->model("adminModel");
			$sil = $model->sosyalMedyaLinkSil($id);
			if($sil)
			{
				header("Location:".SITE_URL."/AdminSosyalMedyaLink/sosyal_medya_linkleri/success");
			}else{
				header("Location:".SITE_URL."/AdminSosyalMedyaLink/sosyal_medya_linkleri/error");
			}
		}
	}
	public function link_duzenle($id)
	{
		if(empty($id) || !is_numeric($id))
		{
			header("Location:".SITE_URL."/AdminSosyalMedyaLink/sosyal_medya_linkleri/notfound");
		}else{
			$model = $this->load->model("adminModel");
			$sorgula = $model->sosyalMedyaLinkSorgula($id);
			if($sorgula==true)
			{
				if(isset($_POST["state"]))
				{
					$link_adi = trim($_POST["link_adi"]);
					$link_url = trim($_POST["link_url"]);
					$data = array(
						"LinkAdi"=>"$link_adi",
						"Url"=>"$link_url"
					);
					$guncelle = $model->sosyalMedyaLinkGuncelle($data,$id);
					if($guncelle)
					{
						header("Location:".SITE_URL."/AdminSosyalMedyaLink/sosyal_medya_linkleri/success");
					}else{
						header("Location:".SITE_URL."/AdminSosyalMedyaLink/sosyal_medya_linkleri/error");
					}
				}else{
					$data["link"] = $model->getSosyalMedyaLink($id);
					$this->load->view("AdminTasarim/header");
					$this->load->view("AdminPanel/SosyalMedyaLinkGuncelle",$data);
					$this->load->view("AdminTasarim/footer");
				}
			}else{
				header("Location:".SITE_URL."/AdminSosyalMedyaLink/sosyal_medya_linkleri/notfound");
			}
		}
	}
}
?>