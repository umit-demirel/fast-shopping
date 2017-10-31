<?php
class AdminSlider extends Controller{
	public function __construct()
	{
		parent::__construct();
	}
	public function Slider($mesaj=false)
	{
		if(isset($mesaj))
		{
			$data["mesaj"] = $mesaj;
		}
		$model = $this->load->model("adminModel");
		if(isset($_POST["state"]))
		{
			$sira_no = $_POST["sira_no"];
			require 'controller/upload.class.php';
				$resimler = array();
				foreach ($_FILES['resimler'] as $k => $l) {
				  foreach ($l as $i => $v) {
				   if (!array_key_exists($i, $resimler))
					 $resimler[$i] = array();
				   $resimler[$i][$k] = $v;
				  }
				}
				foreach ($resimler as $resim){

				   $handle = new Upload($resim);
				   if ($handle->uploaded) {
					  
					  /* Resmi Yeniden Adlandır */
					  $rasgele = substr(base64_encode(uniqid(true)), 0, 20);
					  $handle->file_new_name_body = $rasgele;
					  $handle->image_resize = true;
					  $handle->image_y = "400";
					  $handle->image_x = "500";
					  
					  /* Resim Yükleme İzni */
					  $handle->allowed = array('image/*');
					  
					  
					  $handle->Process("uploads/sliders");//Resmi upload/ klasörüne kaydettik
					  $handle->file_new_name_body = $rasgele; //resmin adını yine aynı ismi verdik
					  $handle->image_resize = true;
					  $handle->image_y = "150";
					  $handle->image_x = "150";
					  $handle->Process("uploads/sliders/tn");//resmi boyutlandırıp birde küçük halini kaydettik
					  
					  /* Resmi İşle */
					  if ($handle->processed) {
							$resimAdi = $handle->file_dst_name;
							//resim veritabanı kayıt işlemleri
							$data_resimler = array(
								"Resim"=>"$resimAdi",
								"SiraNo"=>"$sira_no"
							);
							$resim_kayit = $model->sliderImageEkle($data_resimler);
							if($resim_kayit)
							{
								header("Location:".SITE_URL."/AdminSlider/Slider/success");
							}else{
								header("Location:".SITE_URL."/AdminSlider/Slider/error");
							}
					  }else{
							echo $handle->error;
					  }

					  $handle-> Clean();

				   } else {
					  echo $handle->error;
				   }

				}
		}else{
			$data["slider"] = $model->getSliderImages();
			$this->load->view("AdminTasarim/header");
			$this->load->view("AdminPanel/Slider",$data);
			$this->load->view("AdminTasarim/footer");
		}
		
	}
	public function SliderSil($id=false)
	{
		if(isset($id) && is_numeric($id))
		{
			$model = $this->load->model("adminModel");
			$sliderKontrol = $model->sliderImageKontrol($id);
			if($sliderKontrol==true)
			{
				$slider_resmi = $model->getSliderImage($id);
				$resim="";
				foreach($slider_resmi as $value)
				{
					$resim=$value["Resim"];
				}
				$sil = $model->sliderImageSil($id);
				$file_delete=unlink("uploads/sliders/".$resim);
				$file_delete2=unlink("uploads/sliders/tn/".$resim);
				if($sil && $file_delete && $file_delete2)
				{
					header("Location:".SITE_URL."/AdminSlider/Slider/success");
					
				}else{
					header("Location:".SITE_URL."/AdminSlider/Slider/error");
				}
			}else{
				header("Location:".SITE_URL."/AdminSlider/Slider/notfound");
			}
		}else{
			header("Location:".SITE_URL."/AdminSlider/Slider");
		}
	}
	public function SliderGuncelle($id=false)
	{
		if(isset($id) && is_numeric($id))
		{
			$model = $this->load->model("adminModel");
			$sliderKontrol = $model->sliderImageKontrol($id);
			if($sliderKontrol==true)
			{
				$slider_resmi = $model->getSliderImage($id);
				$data["slider_resmi"] = $slider_resmi;
				$this->load->view("AdminTasarim/header");
				$this->load->view("AdminPanel/SliderResmiGuncelle",$data);
				$this->load->view("AdminTasarim/footer");
 			}else{
				
			}
		}else{
			header("Location:".SITE_URL."/AdminSlider/Slider");
		}
	}
	public function SliderImageUpdate($id=false)
	{
		if(isset($id) && is_numeric($id))
		{
			$model = $this->load->model("adminModel");
			$sliderKontrol = $model->sliderImageKontrol($id);
			if($sliderKontrol==true)
			{
				$sira_no=$_POST["sira_no"];
				$data=array(
					"SiraNo"=>"$sira_no"
				);
				$update = $model->sliderImageUpdate($data,$id);
				if($update)
				{
					header("Location:".SITE_URL."/AdminSlider/Slider/success");
				}else{
					header("Location:".SITE_URL."/AdminSlider/Slider/error");
				}
 			}else{
				header("Location:".SITE_URL."/AdminSlider/Slider/notfound");
			}
		}else{
			header("Location:".SITE_URL."/AdminSlider/Slider");
		}
	}
}
?>