<?php

class admin extends Controller{
	public function __construct(){
		parent::__construct();
	}
	public function login(){
		if(isset($_POST["state"]))
		{
			//Eğer login form post edilmiş ise sorgulama yap
			$eposta=$_POST["eposta"];
			$parola=$_POST["parola"];
			$model = $this->load->model("adminModel");
			$isLogin = $model->adminLogin($eposta,$parola);
			if($isLogin==true)
			{
				$_SESSION["admin_username"]=$eposta;
				//Cookie Kontrolü
				if(isset($_POST["beni_hatirla"]))
				{
					//Cookie oluştur
					setcookie("fastshoppingAdminEmail",$eposta,time()+60*60*24*365);
					setcookie("fastshoppingAdminPassword",md5($parola),time()+60*60*24*365);
					
				}
				header("Location:".SITE_URL."/admin/dashboard");
			}else{
				$data["mesaj"] = "<font color='maroon'>Eposta Veya Parola Hatalı!</font>";
				$this->load->view("AdminPanel/adminLogin",$data);
			}
		}else{
			$this->load->view("AdminPanel/adminLogin");
		}
		
	}
	public function dashboard()
	{
		$this->load->view("AdminTasarim/header");
		$this->load->view("AdminPanel/Dashboard");
		$this->load->view("AdminTasarim/footer");
	}
	public function cikis(){
		session_destroy();
		setcookie("fastshoppingAdminEmail",md5($eposta),time()-60*60*24*365);
		setcookie("fastshoppingAdminPassword",md5($parola),time()-60*60*24*365);
		header("Location:".SITE_URL."/admin/login");
	}
	public function sifremi_unuttum(){
		if(isset($_POST["eposta"]))
		{
			$model = $this->load->model("index");
			
			$eposta = $_POST["eposta"];
			$parola_query = $model->sorgula("select * from admin where EpostaAdresi='$eposta'");
			if(count($parola_query)>0)
			{
				//Admin eposta adresi doğru ise parolayı al
				$parola="";
				foreach($parola_query as $val)
				{
					$parola = $val["parola"];
				}
				//Parolayı E-Mail Adresine Gönder
				
				include 'mail/class.phpmailer.php';
				$mesaj = "Şifreniz : ".$parola;
				$mail = new PHPMailer();
				$mail->IsSMTP();
				$mail->SMTPAuth = true;
				$mail->Host = 'mail.umitdemirel.com';
				$mail->Port = 587;
				//$mail->SMTPSecure = 'tls';
				$mail->Username = 'info@umitdemirel.com';
				$mail->Password = 'JDka48R1';
				$mail->SetFrom($mail->Username, "fastshopping");
				$mail->AddAddress("$eposta", "Admin User");
				$mail->CharSet = 'UTF-8';
				$mail->Subject = "Hatırlatma Parolası";
				$mail->MsgHTML($mesaj);
				if($mail->Send()) {
					$data["mesaj"] = "<font color='green'>Hatırlatma Parolası Belirtilen E-Mail Adresine Gönderildi. Lütfen Kontrol Ediniz.</font>";
					$this->load->view("AdminPanel/adminSifremiUnuttum",$data);
				}else{
					$data["mesaj"] = "<font color='maroon'>Hatırlatma Parolası Gönderilemedi!</font>";
					$this->load->view("AdminPanel/adminSifremiUnuttum",$data);
				}
			}else{
				$data["mesaj"] = "<font color='maroon'>Admin E-Posta Adresi Hatalı!</font>";
				$this->load->view("AdminPanel/adminSifremiUnuttum",$data);
			}
			
		}else{
			$this->load->view("AdminPanel/adminSifremiUnuttum");
		}
	}
	public function profil($mesaj=false)
	{
		if(isset($mesaj))
		{
			$data["mesaj"] = $mesaj;
		}
		$model = $this->load->model("adminModel");
		$admin_email = $_SESSION["admin_username"];
		$admin_email_kotrol = $model->adminEmailKontrol($admin_email);
		if($admin_email_kotrol==true)
		{
			$data["profil"] = $model->getProfil($admin_email);
			$this->load->view("AdminTasarim/header");
			$this->load->view("AdminPanel/Profil",$data);
			$this->load->view("AdminTasarim/footer");
		}else{
			//Admin epostası yanlış ise cookie veya session değiştirilmiştir.
			//Bu nedenle cikis a yönlendirildi.
			header("Location:".SITE_URL."/admin/cikis");
		}
		
	}
	public function profil_resmi_yukle()
	{
		$tmp_name = $_FILES["profil_img"]["tmp_name"];
		if($tmp_name==null)
		{
			header("Location:".SITE_URL."/admin/profil/noimage");
		}else{
			$file_type = $_FILES["profil_img"]["type"];
			$file_size = $_FILES["profil_img"]["size"];
			$file_name = $_FILES["profil_img"]["name"];
			if($file_type=="image/jpeg" || $file_type=="image/png" || $file_type=="image/gif" || $file_type=="image/bmp")
			{
				if($file_size<=1048576)
				{
					//dosya yüklenebilir
					$uzanti = explode(".",$file_name);
					$yeni_adi = "profile_image.".$uzanti[1];
					$upload = move_uploaded_file($tmp_name,"uploads/admin_images/profile_image.".$uzanti[1]);
					if($upload)
					{
						$model = $this->load->model("adminModel");
						$data = array(
							"ProfilResmi"=>"$yeni_adi"
						);
						$image_update = $model->profilGuncelle($data);
						if(!$image_update)
						{
							header("Location:".SITE_URL."/admin/profil/upload_success_but_data_error");
						}
						header("Location:".SITE_URL."/admin/profil/upload_success");
					}else{
						header("Location:".SITE_URL."/admin/profil/upload_error");
					}
				}else{
					//dosya boyutu 2M dan büyük
					header("Location:".SITE_URL."/admin/profil/file_size_error");
				}
			}else{
				header("Location:".SITE_URL."/admin/profil/type_error");
			}
			
			
			
			
		}
	}
	public function profil_guncelle()
	{
		if(isset($_POST["state"]))
		{
			$adsoyad = $_POST["adsoyad"];
			$model = $this->load->model("adminModel");
			$data = array(
				"AdSoyad"=>"$adsoyad"
			);
			$update = $model->profilGuncelle($data);
			if($update)
			{
				header("Location:".SITE_URL."/admin/profil/update_data_success");
			}else{
				header("Location:".SITE_URL."/admin/profil/update_data_error");
			}
		}else{
			
		}
	}
	public function giris_bilgileri_guncelle()
	{
		if(isset($_POST["state"]))
		{
			if(isset($_POST["email"]) && isset($_POST["sifre"]) && isset($_POST["yeni_sifre"]))
			{
				$email = $_POST["email"];
				$sifre = $_POST["sifre"];
				$yeni_sifre = $_POST["yeni_sifre"];
				$model = $this->load->model("adminModel");
				$sorgula = $model->adminLogin($email,$sifre);
				if($sorgula==true)
				{
					$data = array(
					"EpostaAdresi"=>"$email",
					"Sifre"=>"$yeni_sifre"
					);
					$update = $model->profilGuncelle($data);
					if($update)
					{
						header("Location:".SITE_URL."/admin/cikis");
					}else{
						header("Location:".SITE_URL."/admin/profil/new_login_error");
					}
				}else{
					header("Location:".SITE_URL."/admin/profil/login_data_error");
				}
				
			}
			else{
				header("Location:".SITE_URL."/admin/profil/parameters_error");
			}
		}
		else{
			header("Location:".SITE_URL."/admin/profil");
		}
	}
}

?>