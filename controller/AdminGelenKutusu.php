<?php
class AdminGelenKutusu  extends Controller{
	public function __construct()
	{
		parent::__construct();
	}
	public function gelen_kutusu($mesaj=false)
	{
		if(isset($mesaj))
		{
			$data["mesaj"] = $mesaj;
		}
		$model = $this->load->model("adminModel");
		if(isset($_POST["state"]))
		{
			$kelime = $_POST["kelime"];
			$secim = $_POST["secim"];
			$data["mesajlar"] = $model->mesajAra($kelime,$secim);
			$this->load->view("AdminTasarim/header");
			$this->load->view("AdminPanel/GelenKutusu",$data);
			$this->load->view("AdminTasarim/footer");
		}else{
			$data["mesajlar"] = $model->gelenMesajlar();
			$this->load->view("AdminTasarim/header");
			$this->load->view("AdminPanel/GelenKutusu",$data);
			$this->load->view("AdminTasarim/footer");
		}
		
	}
	public function mesaj_oku($id=false)
	{
		if(isset($id) && is_numeric($id))
		{
			$model = $this->load->model("adminModel");
			$data["mesaj"] = $model->getMesaj($id);
			$model->mesajOkundu($id);
			$this->load->view("AdminTasarim/header");
			$this->load->view("AdminPanel/MesajOku",$data);
			$this->load->view("AdminTasarim/footer");
		}else{
			header("Location:".SITE_URL."/AdminGelenKutusu/gelen_kutusu/notfound");
		}
		
	}
	public function mesaj_cevap()
	{
		if(isset($_POST["email"]))
		{
			$email = $_POST["email"];
			$konu = $_POST["konu"];
			$mesaj = $_POST["mesaj"]."<br><hr>FastShopping Destek";
			include 'mail/class.phpmailer.php';
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->SMTPAuth = true;
			$mail->Host = 'mail.umitdemirel.com';
			$mail->Port = 587;
			//$mail->SMTPSecure = 'tls';
			$mail->Username = 'info@umitdemirel.com';
			$mail->Password = 'JDka48R1';
			$mail->SetFrom($mail->Username, "fastshopping");
			$mail->AddAddress($email, "No Name");
			$mail->CharSet = 'UTF-8';
			$mail->Subject = $konu;
			$mail->MsgHTML($mesaj);
			if($mail->Send()) {
				header("Location:".SITE_URL."/AdminGelenKutusu/gelen_kutusu/success");
			}else{
				header("Location:".SITE_URL."/AdminGelenKutusu/gelen_kutusu/error");
			}
		}else{
			header("Location:".SITE_URL."/AdminGelenKutusu/gelen_kutusu/notfound");
		}
	}
	public function mesaj_sil($id=false)
	{
		if(isset($id) && is_numeric($id))
		{
			$model = $this->load->model("adminModel");
			$sil = $model->mesajSil($id);
			if($sil)
			{
				header("Location:".SITE_URL."/AdminGelenKutusu/gelen_kutusu/success");
			}else{
				header("Location:".SITE_URL."/AdminGelenKutusu/gelen_kutusu/error");
			}
		}else{
			header("Location:".SITE_URL."/AdminGelenKutusu/gelen_kutusu/notfound");
		}
	}
}
?>