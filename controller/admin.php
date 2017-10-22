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
}

?>