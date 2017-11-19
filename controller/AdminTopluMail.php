<?php
class AdminTopluMail extends Controller{
	public function __construct(){
		parent::__construct();
	}
	public function mail_gonder($mesaj=false){
		if(isset($mesaj))
		{
			$data["mesaj"] = $mesaj;
		}
		$this->load->view("AdminTasarim/header");
		$this->load->view("AdminPanel/TopluMail",$data);
		$this->load->view("AdminTasarim/footer");
	}
	public function gonder()
	{
		if(isset($_POST["state"]))
		{
			$kullanici_tipi = $_POST["tip"];
			$sablon = $_POST["sablon"];
			$baslik = $_POST["baslik"];
			$mesaj = $_POST["mesaj"];
			$model = $this->load->model("adminModel");
			$bireyselUyeMesajGonderilmeDurumu="";
			$firmaUyeMesajGonderilmeDurumu="";
			$ebultenUyeMesajGonderilmeDurumu="";
			for($i=0;$i<count($kullanici_tipi);$i++)
			{
				if($kullanici_tipi[$i]==1)
				{
					//Bireysel Üye
					$bireysel_uyeler = $model->getBireyselUyeler();
					$email_adresleri = array();
					$adsoyad = array();
					$i=0;
					foreach($bireysel_uyeler as $value)
					{
						$email_adresleri[$i] = $value["Email"];
						$adsoyad = $value["Ad"]." ".$value["Soyad"];
						$i++;
					}
					$state = $this->sender($email_adresleri,$adsoyad,$mesaj,$baslik,$sablon);
					if($state==true)
					{
						$bireyselUyeMesajGonderilmeDurumu="success";
					}else{
						$bireyselUyeMesajGonderilmeDurumu="false";
					}
				}else if($kullanici_tipi[$i]==2)
				{
					//Firmalar
					$firma_uyeler = $model->getFirmaUyeler();
					$email_adresleri = array();
					$adsoyad = array();
					$i=0;
					foreach($firma_uyeler as $value)
					{
						$email_adresleri[$i] = $value["FirmaEposta"];
						$adsoyad = $value["FirmaAd"];
						$i++;
					}
					$state = $this->sender($email_adresleri,$adsoyad,$mesaj,$baslik,$sablon);
					if($state==true)
					{
						$firmaUyeMesajGonderilmeDurumu="success";
					}else{
						$firmaUyeMesajGonderilmeDurumu="false";
					}
				}else if($kullanici_tipi[$i]==3)
				{
					//E-Bülten Üyeleri
					$ebulten_uyeler = $model->getEbultenListesi();
					$email_adresleri = array();
					$adsoyad = array();
					$i=0;
					foreach($ebulten_uyeler as $value)
					{
						$email_adresleri[$i] = $value["Eposta"];
						$adsoyad = $value["AdSoyad"];
						$i++;
					}
					$state = $this->sender($email_adresleri,$adsoyad,$mesaj,$baslik,$sablon);
					if($state==true)
					{
						$ebultenUyeMesajGonderilmeDurumu="success";
					}else{
						$ebultenUyeMesajGonderilmeDurumu="false";
					}
				}else{
					header("Location:".SITE_URL."/AdminTopluMail/notfound_usertype");
				}
			}
			if($bireyselUyeMesajGonderilmeDurumu=="success" || $firmaUyeMesajGonderilmeDurumu=="success" || $ebultenUyeMesajGonderilmeDurumu=="success")
			{
				header("Location:".SITE_URL."/AdminTopluMail/mail_gonder/success");
			}else{
				header("Location:".SITE_URL."/AdminTopluMail/mail_gonder/error");
			}
		}else{
			header("Location:".SITE_URL."/AdminTopluMail/mail_gonder");
		}
	}
	public function sender($email_adresleri,$adsoyad,$mesaj,$baslik,$sablon)
	{
			
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
			for($i=0;$i<count($email_adresleri);$i++)
			{
				$mail->AddAddress($email_adresleri[$i], $adsoyad[$i]);
				//echo $email_adresleri[$i]."<br>";
			}
			$mail->CharSet = 'UTF-8';
			$mail->Subject = $baslik;
			$mail->MsgHTML($this->sablon($sablon,$baslik,$mesaj));
			if($mail->Send()) {
				return true;
			}else{
				return false;
			}
	}
	public function sablon($sablon,$baslik,$mesaj)
	{
		if($sablon==1)
		{
			$str = "
		<div style='display:block; padding:20px; width:500px; border:1px solid #ccc; margin-left:auto; margin-right:auto;'>
		<div style='display:block; padding:10px; border-bottom:1px solid #ccc; text-align:center; font-weight:bold; font-size:20px; margin-bottom:10px;'>
			$baslik
		</div>
		<div style='display:block; font-size:16px;'>
			$mesaj
		</div>
		</div>
			";
			return $str;
		}else{
			$str = "
		<div style='display:block; padding:20px; width:500px; border:1px solid #ccc; margin-left:auto; margin-right:auto;'>
		<div style='display:block; padding:10px; border-bottom:1px solid #ccc; text-align:center; font-weight:bold; font-size:20px; margin-bottom:10px;'>
			$baslik
		</div>
		<div style='display:block; font-size:16px;'>
			$mesaj
		</div>
		
		<div style='display:block; border-top:1px dotted #ccc; text-align:center; padding:10px;  margin-top:50px;'>
			<a href='http://www.umitdemirel.com'>FastShopping | Online Sanal Mağaza</a>
		</div>

	</div>
			";
			return $str;
		}
		
	}
}
?>