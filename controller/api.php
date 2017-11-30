<?php
class api extends Controller{
	public function __construct()
	{
		parent::__construct();
	}
	public function get_product($id=false)
	{
		$message="";
		$list=array();
		$sayac=0;
		if(empty($id) || !is_numeric($id))
		{
			$message="Kimlik Parametresi Uygun Değil!";
		}else{
			$model = $this->load->model("index");
			$query = $model->sorgula("select * from bireyselurun where UrunID=$id");
			
			foreach($query as $value)
			{
				$list[$sayac]["UrunID"]=$value["UrunID"];
				$list[$sayac]["UyeID"]=$value["UyeID"];
				$list[$sayac]["UrunKategoriID"]=$value["UrunKategoriID"];
				$list[$sayac]["UrunAd"]=$value["UrunAd"];
				$list[$sayac]["UrunFiyat"]=$value["UrunFiyat"];				
				$list[$sayac]["UrunResim"]=$value["UrunResim"];
				$list[$sayac]["UrunAdet"]=$value["UrunAdet"];
				$list[$sayac]["UrunDurum"]=$value["UrunDurum"];
				$sayac++;
			}
			if($sayac==0)
			{
				$message="Ürün Bulunamadı!";
			}else{
				$message="Sonuçlar Listelendi";
			}
		}
		$data = array(
			"message"=>$message,
			"product"=>$list
		);
		echo json_encode($data);
		
	}
	public function get_categories()
	{
		$message="";
		$list=array();
		$sayac=0;
		$model = $this->load->model("index");
		$query = $model->sorgula("select * from kategoriler where AnaKategoriID=0");
		foreach($query as $value)
		{
			$list[$sayac]["KategoriID"] = $value["KategoriID"];
			$list[$sayac]["AnaKategoriID"] = $value["AnaKategoriID"];
			$list[$sayac]["KategoriAdi"] = $value["KategoriAdi"];
			$sayac++;
		}
		$data = array(
			"message"=>$message,
			"categories"=>$list
		);
		echo json_encode($data);
	}
	public function get_subcategories()
	{
		$message="";
		$list=array();
		$sayac=0;
		$model = $this->load->model("index");
		$query = $model->sorgula("select * from kategoriler where AnaKategoriID!=0");
		foreach($query as $value)
		{
			$list[$sayac]["KategoriID"] = $value["KategoriID"];
			$list[$sayac]["AnaKategoriID"] = $value["AnaKategoriID"];
			$list[$sayac]["KategoriAdi"] = $value["KategoriAdi"];
			$sayac++;
		}
		$data = array(
			"message"=>$message,
			"categories"=>$list
		);
		echo json_encode($data);
	}
	public function add_product_for_person($parameters)
	{
		$message="";
		$email="";$pass="";
		$cat_id="";$product_name="";$descript="";$price="";$count="";
		$degerler = explode("*",$parameters);
		$email = @$degerler[0];
		$pass = @$degerler[1];
		$cat_id = @$degerler[2];
		$product_name = @$degerler[3];
		$descript = @$degerler[4];
		$price = @$degerler[5];
		$count = @$degerler[6];
		if(empty($email) || empty($pass))
		{
			$message="Giriş Bilgileri Eksik!";
		}else{
			$model = $this->load->model("index");
			$query = $model->sorgula("select * from bireyseluye where Email='$email' && Sifre='$pass'");
			$UyeID = @$query[0]["UyeID"];
			
			if(count($query)>0)
			{
				$data = array(
					"UyeID"=>$UyeID,
					"UrunKategoriID"=>$cat_id,
					"UrunAd"=>$product_name,
					"UrunFiyat"=>$price,
					"UrunAciklama"=>$descript,
					"UrunResim"=>"default",
					"UrunAdet"=>$count,
					"UrunDurum"=>0
				);
				$add = $model->ekle("bireyselurun",$data);
				if($add)
				{
					$message="Ürün Eklendi!";
				}else{
					$message="Bir Sorun Oluştu!";
				}
			}else{
				$message="Giriş Bilgileri Hatalı!";
			}
		}
		$data = array(
			"message"=>$message
		);
		echo json_encode($data);
	}
	public function add_product_for_company($parameters)
	{
		$message="";
		$email="";$pass="";
		$cat_id="";$product_name="";$descript="";$price="";$count="";
		$degerler = explode("*",$parameters);
		$email = @$degerler[0];
		$pass = @$degerler[1];
		$cat_id = @$degerler[2];
		$product_name = @$degerler[3];
		$descript = @$degerler[4];
		$price = @$degerler[5];
		$count = @$degerler[6];
		$kdv=@$degerler[7];
		$minalimmikrari=@$degerler[8];
		if(empty($email) || empty($pass))
		{
			$message="Giriş Bilgileri Eksik!";
		}else{
			$model = $this->load->model("index");
			$query = $model->sorgula("select * from firmauye where FirmaEposta='$email' && FirmaSifre='$pass'");
			$FirmaID = @$query[0]["UyeID"];
			
			if(count($query)>0)
			{
				$data = array(
					"FirmaID"=>$FirmaID,
					"UrunKategoriID"=>$cat_id,
					"UrunAdi"=>$product_name,
					"UrunFiyat"=>$price,
					"EkAciklama"=>$descript,
					"UrunResim"=>"default",
					"UrunAdet"=>$count,
					"KdvOrani"=>$kdv,
					"MinAlimMiktari"=>$minalimmikrari,
					"UrunDurum"=>0
				);
				$add = $model->ekle("firmaurun",$data);
				if($add)
				{
					$message="Ürün Eklendi!";
				}else{
					$message="Bir Sorun Oluştu!";
				}
			}else{
				$message="Giriş Bilgileri Hatalı!";
			}
		}
		$data = array(
			"message"=>$message
		);
		echo json_encode($data);
	}
	public function delete_product_for_person($parameters)
	{
		$message="";
		$email="";$pass="";$product_id="";
		$degerler = explode("*",$parameters);
		$email = @$degerler[0];
		$pass = @$degerler[1];
		$product_id = @$degerler[2];
		if(empty($email) || $email==null || $email=="" || empty($pass) || $pass==null || $pass=="")
		{
			$message="Email Veya Parola Bilgisi Yok";
		}else{
			$model = $this->load->model("index");
			$query = $model->sorgula("select * from bireyseluye where Email='$email' && Sifre='$pass'");
			$UyeID = @$query[0]["UyeID"];
			if(count($query)>0)
			{
				$sil = $model->sil("bireyselurun","UrunID=$product_id and UyeID=$UyeID");
				if($sil)
				{
					$message="Silme İşlemi Başarıyla Yapıldı.";
				}else{
					$message="Bir Hata Oluştu!";
				}
			}else{
				$message = "Kullanıcı Adı Veya Parola Hatalı!";
			}
			
			
		}
		$data = array(
			"message"=>$message
		);
		echo json_encode($data);
			
	}
	public function delete_product_for_company($parameters)
	{
		$message="";
		$email="";$pass="";$product_id="";
		$degerler = explode("*",$parameters);
		$email = @$degerler[0];
		$pass = @$degerler[1];
		$product_id = @$degerler[2];
		if(empty($email) || $email==null || $email=="" || empty($pass) || $pass==null || $pass=="")
		{
			$message="Email Veya Parola Bilgisi Yok";
		}else{
			$model = $this->load->model("index");
			$query = $model->sorgula("select * from firmauye where FirmaEposta='$email' && FirmaEposta='$pass'");
			$UyeID = @$query[0]["UyeID"];
			if(count($query)>0)
			{
				$sil = $model->sil("firmaurun","UrunID=$product_id and FirmaID=$UyeID");
				if($sil)
				{
					$message="Silme İşlemi Başarıyla Yapıldı.";
				}else{
					$message="Bir Hata Oluştu!";
				}
			}else{
				$message = "Kullanıcı Adı Veya Parola Hatalı!";
			}
			
			
		}
		$data = array(
			"message"=>$message
		);
		echo json_encode($data);
			
	}
	public function get_campaign()
	{
		$message="";
		$model = $this->load->model("index");
		$query = $model->sorgula("select * from kampanyalar order by KampanyaID desc");
		$sayac=0;
		$list=array();
		foreach($query as $value)
		{
			$list[$sayac]["KampanyaAdi"]=$value["KampanyaAdi"];
			$list[$sayac]["KampanyaSartlari"]=$value["KampanyaSartlari"];
			$list[$sayac]["KampanyaResim"]=$value["KampanyaResim"];
			$list[$sayac]["KampanyaUrunID"]=$value["KampanyaUrunID"];
			$list[$sayac]["KampanyaUrunAdet"]=$value["KampanyaUrunAdet"];
			$list[$sayac]["KampanyaDurum"]=$value["KampanyaDurum"];
		}
		if($sayac==0)
		{
			$message="Kampanya Bulunamadı!";
		}else{
			$message="Kampanyalar Listelendi";
		}
		$data = array(
			"message"=>$message,
			"list"=>$list
		);
		echo json_encode($data);
	}
	public function get_order($parameters)
	{
		$message="";
		$degerler = explode("*",$parameters);
		$email=@$degerler[0];
		$pass=@$degerler[1];
		$order_code = @$degerler[2];
		$list=array();
		if(empty($email) || $email==null || $email=="" || $pass=="" || $pass==null || empty($pass))
		{
			$message="Giriş Bilgileri Eksik!";
		}else{
			$model = $this->load->model("index");
			$query = $model->sorgula("select * from bireyseluye where Email='$email' and Sifre='$pass'");
			$UyeID=@$query[0]["UyeID"];
			if(count($query)>0)
			{
				$order = $model->sorgula("select * from siparis where UyeID='$UyeID' and SiparisID='$order_code'");
				$sayac=0;
				foreach($order as $value)
				{
					$list[$sayac]["SiparisID"]=$value["SiparisID"];
					$list[$sayac]["UrunID"]=$value["UrunID"];
					$list[$sayac]["UyeID"]=$value["UyeID"];
					$list[$sayac]["UrunAdet"]=$value["UrunAdet"];
					$list[$sayac]["SiparisTarih"]=$value["SiparisTarih"];
					$list[$sayac]["SiparisDurum"]=$value["SiparisDurum"];
					$list[$sayac]["ToplamFiyat"]=$value["ToplamFiyat"];
					$sayac++;
				}
				if($sayac==0)
				{
					$message="Sipariş Bulunamadı!";
				}else{
					$message="Siparişler Listelendi.";
				}
			}else{
				$message="Kullanıcı Adı Veya Parola Hatalı!";
			}
		}
		$data = array(
			"message"=>$message,
			"list"=>$list
		);
		echo json_encode($data);
	}
}
?>