<?php
class AdminReklam extends Controller{
	public function __construct()
	{
		parent::__construct();
	}
	public function Reklam($mesaj=false)
	{
		if(isset($mesaj))
		{
			$data["mesaj"] = $mesaj;
		}
		$model = $this->load->model("adminModel");
		if(isset($_POST["state"]))
		{
			$blok = $_POST["blok"];
			
			require 'controller/upload.class.php';
			$resimler = array();
				foreach ($_FILES['resimler'] as $k => $l) {
				  foreach ($l as $i => $v) {
				   if (!array_key_exists($i, $resimler))
					 $resimler[$i] = array();
				   $resimler[$i][$k] = $v;
				  }
				}
			foreach($resimler as $resim)
			{
				$handle = new Upload($resim);
				if($handle->uploaded)
				{
					  /* Resmi Yeniden Adlandır */
					  $rasgele = substr(base64_encode(uniqid(true)), 0, 20);
					  $handle->file_new_name_body = $rasgele;
					  
					  /* Resim Yükleme İzni */
					  $handle->allowed = array('image/*');
					  
					  
					  $handle->Process("uploads/reklamlar");//Resmi upload/ klasörüne kaydettik
					  $handle->file_new_name_body = $rasgele; //resmin adını yine aynı ismi verdik
					  $handle->image_resize = true;
					  $handle->image_y = "150";
					  $handle->image_x = "150";
					  $handle->Process("uploads/reklamlar/tn");//resmi boyutlandırıp birde küçük halini kaydettik
					  
					  /* Resmi İşle */
					  if ($handle->processed) {
							$resimAdi = $handle->file_dst_name;
							//resim veritabanı kayıt işlemleri
							$data_resimler = array(
								"Resim"=>"$resimAdi",
								"SiteReklamBlokID"=>"$blok",
								"aktif"=>0
							);
							$resim_kayit = $model->reklamImageEkle($data_resimler);
							if($resim_kayit)
							{
								header("Location:".SITE_URL."/AdminReklam/Reklam/success");
							}else{
								header("Location:".SITE_URL."/AdminReklam/Reklam/error");
							}
					  }else{
							echo $handle->error;
					  }

					  $handle-> Clean();
				}else{
					echo $handle->error;
				}
			}
			
		}else{
			$data["reklamlar"] = $model->getReklamlar();
			$this->load->view("AdminTasarim/header");
			$this->load->view("AdminPanel/Reklamlar",$data);
			$this->load->view("AdminTasarim/footer");
		}
		
	}
	public function ReklamSil($id=false)
	{
		if(isset($id) && is_numeric($id))
		{
			$model = $this->load->model("adminModel");
			$resim = $model->getReklamResmiAdi($id);
			$resim_adi="";
			if(count($resim)>0)
			{
				foreach($resim as $value)
				{
					$resim_adi = $value["Resim"];
				}
				$sil = $model->reklamSil($id);
				if($sil)
				{
					//dosyayı dizinden sil
					@unlink("uploads/reklamlar/".$resim_adi);
					@unlink("uploads/reklamlar/tn/".$resim_adi);
					header("Location:".SITE_URL."/AdminReklam/Reklam/success");
				}else{
					header("Location:".SITE_URL."/AdminReklam/Reklam/error");
				}
			}else{
				header("Location:".SITE_URL."/AdminReklam/Reklam/notfound");
			}
			
		}
	}
	public function ReklamGuncelle($id=false)
	{
		if(isset($id) && is_numeric($id))
		{
			$model = $this->load->model("adminModel");
			if(isset($_POST["state"]))
			{
				if($_FILES["resimler"]["name"]!="")
				{
					$mevcut_reklam = $model->getReklamResmiAdi($id);
					$mevcut_resim="";
					foreach($mevcut_reklam as $value)
					{
						$mevcut_resim=$value["Resim"];
					}
					$blok = $_POST["blok"];
			
					require 'controller/upload.class.php';

						$handle = new Upload($_FILES["resimler"]);
						if($handle->uploaded)
						{
							  /* Resmi Yeniden Adlandır */
							  $rasgele = substr(base64_encode(uniqid(true)), 0, 20);
							  $handle->file_new_name_body = $rasgele;
							  
							  /* Resim Yükleme İzni */
							  $handle->allowed = array('image/*');
							  
							  
							  $handle->Process("uploads/reklamlar");//Resmi upload/ klasörüne kaydettik
							  $handle->file_new_name_body = $rasgele; //resmin adını yine aynı ismi verdik
							  $handle->image_resize = true;
							  $handle->image_y = "150";
							  $handle->image_x = "150";
							  $handle->Process("uploads/reklamlar/tn");//resmi boyutlandırıp birde küçük halini kaydettik
							  
							  /* Resmi İşle */
							  if ($handle->processed) {
									$resimAdi = $handle->file_dst_name;
									//resim veritabanı kayıt işlemleri
									$data_resimler = array(
										"Resim"=>"$resimAdi",
										"SiteReklamBlokID"=>"$blok",
										"aktif"=>0
									);
									$resim_guncelle = $model->reklamImageGuncelle($data_resimler,$id);
									if($resim_guncelle)
									{
										@unlink("uploads/reklamlar/".$mevcut_resim);
										@unlink("uploads/reklamlar/tn/".$mevcut_resim);
										header("Location:".SITE_URL."/AdminReklam/Reklam/success");
									}else{
										header("Location:".SITE_URL."/AdminReklam/Reklam/error");
									}
							  }else{
									echo $handle->error;
							  }

							  $handle-> Clean();
						}else{
							echo $handle->error;
						}
					
				}else{
					echo "resim yok";
				}
			}else{
				$data["resim"] = $model->getReklamResmiAdi($id);
				$this->load->view("AdminTasarim/header");
				$this->load->view("AdminPanel/ReklamGuncelle",$data);
				$this->load->view("AdminTasarim/footer");
			}
			
		}else{
			header("Location:".SITE_URL."/AdminReklam/Reklam/notfound");
		}
	}
	public function ReklamPasifState($id=false)
	{
		if(isset($id) && is_numeric($id))
		{
			$model = $this->load->model("adminModel");
			$pasif = $model->reklamPasifState($id);
			if($pasif)
			{
				header("Location:".SITE_URL."/AdminReklam/Reklam/success");
			}else{
				header("Location:".SITE_URL."/AdminReklam/Reklam/error");
			}
		}else{
			header("Location:".SITE_URL."/AdminReklam/Reklam/notfound");
		}
	}
	public function ReklamAktifState($id=false)
	{
		if(isset($id) && is_numeric($id))
		{
			$model = $this->load->model("adminModel");
			$aktif = $model->reklamAktifState($id);
			if($aktif)
			{
				header("Location:".SITE_URL."/AdminReklam/Reklam/success");
			}else{
				header("Location:".SITE_URL."/AdminReklam/Reklam/error");
			}
		}else{
			header("Location:".SITE_URL."/AdminReklam/Reklamlar/notfound");
		}
	}
}
?>