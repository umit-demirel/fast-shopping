<?php
class AdminYorum extends Controller{
	public function __construct()
	{
		parent::__construct();
	}
	public function yorumlar($mesaj=false)
	{
		if(isset($mesaj))
		{
			$data["mesaj"] = $mesaj;
		}
		$model = $this->load->model("adminModel");
		$data["yorumlar"] = $model->getYorumlar();
		$this->load->view("AdminTasarim/header");
		$this->load->view("AdminPanel/Yorumlar",$data);
		$this->load->view("AdminTasarim/footer");
	}
	public function cevapla($id=false)
	{
		if(empty($id) || !is_numeric($id))
		{
			header("Location:".SITE_URL."/AdminYorum/yorumlar/notfound");
		}else{
			$model = $this->load->model("adminModel");
			if(isset($_POST["cevap"]))
			{
				$sorgula = $model->getYorumSorgula($id);
				if($sorgula==true)
				{
					$cevap = $_POST["cevap"];
					$yorumyapan = 0;//0 admin kullanıcısını temsil eder
					$tarih=date("Y-m-d");
					$data = array(
						"YorumID"=>$id,
						"YorumYapanID"=>$yorumyapan,
						"Cevap"=>$cevap,
						"Tarih"=>$tarih
					);
					$cevap = $model->yorumCevap($data);
					if($cevap)
					{
						header("Location:".SITE_URL."/AdminYorum/yorumlar/success");
					}else{
						header("Location:".SITE_URL."/AdminYorum/yorumlar/error");
					}
				}else{
					header("Location:".SITE_URL."/AdminYorum/yorumlar/notfound");
				}
				
				
			}else{
				$data["yorum"] = $model->getYorum($id);
				//$data["cevapla"] = $model->getCevap($id);
				$this->load->view("AdminTasarim/header");
				$this->load->view("AdminPanel/YorumCevap",$data);
				$this->load->view("AdminTasarim/footer");
			}
		}
	}
	public function duzenle($id=false)
	{
		if(empty($id) || !is_numeric($id))
		{
			header("Location:".SITE_URL."/AdminYorum/yorumlar/notfound");
		}else{
			$model = $this->load->model("adminModel");
			if(isset($_POST["yorum"]))
			{
				$sorgula = $model->getYorumSorgula($id);
				if($sorgula==true)
				{
					$yorum = $_POST["yorum"];
					$data = array(
						"Yorum"=>$yorum
					);
					$ekle = $model->yorumDuzenle($data,$id);
					if($ekle)
					{
						header("Location:".SITE_URL."/AdminYorum/yorumlar/success");
					}else{
						header("Location:".SITE_URL."/AdminYorum/yorumlar/error");
					}
				}else{
					header("Location:".SITE_URL."/AdminYorum/yorumlar/notfound");
				}
				
				
			}else{
				$data["yorum"] = $model->getYorum($id);
				//$data["cevapla"] = $model->getCevap($id);
				$this->load->view("AdminTasarim/header");
				$this->load->view("AdminPanel/YorumDuzenle",$data);
				$this->load->view("AdminTasarim/footer");
			}
		}
	}
	public function sil($id=false)
	{
		if(empty($id) || !is_numeric($id))
		{
			header("Location:".SITE_URL."/AdminYorum/yorumlar/notfound");
		}else{
			$model = $this->load->model("adminModel");
			$sorgula = $model->getYorumSorgula($id);
			if($sorgula==true)
			{
				$sil = $model->yorumSil($id);
				if($sil)
				{
					header("Location:".SITE_URL."/AdminYorum/yorumlar/success");
				}else{
					header("Location:".SITE_URL."/AdminYorum/yorumlar/error");
				}
			}else{
				header("Location:".SITE_URL."/AdminYorum/yorumlar/notfound");
			}
		}
	}
}
?>