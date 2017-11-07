<?php
class e_bulten extends Controller{
	public function __construct(){
		parent::__construct();
	}
	public function ebulten_kayit($mesaj=false)
	{
		if(isset($mesaj))
		{
			$data["mesaj"] = $mesaj;
		}
		if(!isset($_POST["state"]))
		{
			/*Site tasarım viewları oluşturulmadığı için daha sonradan bu kısım yapılacak ve burada e-bülten kayıt formu sayfası olacak.*/
		}else{
			$model = $this->load->model("adminModel");
			$adsoyad = $_POST["adsoyad"];
			$eposta = $_POST["eposta"];
			$tarih = date("Y-m-d");
			$data = array(
				"AdSoyad"=>"$adsoyad",
				"Eposta"=>"$eposta",
				"Tarih"=>"$tarih"
			);
			$ekle = $model->ebultenKayit($data);
			if($ekle)
			{
				//header("Location:".SITE_URL."/sayfa/ebulten_kayit/success");
				//sayfalar daha sonra oluşturulacak
				echo "e-bulten kayit basarili";
			}else{
				//header("Location:".SITE_URL."/sayfa/ebulten_kayit/error");
				//sayfalar daha sonra oluşturulacak
				echo "bir hata olustu!";
			}
		}
	}
}
?>