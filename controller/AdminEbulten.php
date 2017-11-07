<?php
class AdminEbulten extends Controller{
	public function __construct()
	{
		parent::__construct();
	}
	public function ebulten($mesaj=false)
	{
		if(isset($mesaj))
		{
			$data["mesaj"] = $mesaj;
		}
		$model = $this->load->model("adminModel");
		$data["ebulten"] = $model->getEbultenListesi();
		$this->load->view("AdminTasarim/header");
		$this->load->view("AdminPanel/Ebulten",$data);
		$this->load->view("AdminTasarim/footer");
		
	}
	public function ebulten_sil($id=false)
	{
		if(isset($id) && is_numeric($id))
		{
			$model = $this->load->model("adminModel");
			$kayit_kontrol = $model->ebultenKontrol($id);
			if($kayit_kontrol==true)
			{
				$sil = $model->ebultenSil($id);
				if($sil)
				{
					header("Location:".SITE_URL."/AdminEbulten/ebulten/success");
				}else{
					header("Location:".SITE_URL."/AdminEbulten/ebulten/error");
				}
			}else{
				header("Location:".SITE_URL."/AdminEbulten/ebulten/notfound");
			}
		}else{
			header("Location:".SITE_URL."/AdminEbulten/ebulten/notfound");
		}
	}
}
?>