<?php

class adminModel extends Model{
	public function __construct(){
		parent::__construct();
	}
	/*Admin Login İşlemleri*/
	public function adminLogin($eposta,$parola){
		$login_query = $this->db->select("select * from admin where EpostaAdresi='$eposta' and Sifre='$parola'");
		$isValue = count($login_query);
		if($isValue > 0)
		{
			//Sorgulama Başarılı
			return true;
		}else{
			//Sorgula Başarısız!
			return false;
		}
	}
	/*-------------------------------------------------------------------*/
	/*Kategori İşlemleri*/
	public function anaKategoriEkle($kategori_adi,$kategori_aciklama){
		$data = array(
			"AnaKategoriID"=>0,
			"KategoriAdi"=>"$kategori_adi",
			"Aciklama"=>"$kategori_aciklama"
		);
		$kategori_ekle = $this->db->insert("kategoriler",$data);
		if($kategori_ekle)
		{
			return true;
		}else{
			return false;
		}
	}
	
	public function anaKategoriListesi(){
		return $this->db->select("select * from kategoriler where AnaKategoriID=0 order by KategoriAdi asc");
		/*return $this->db->select("select * from kategoriler where AnaKategoriID=0 and KategoriID not in (select kategori_arsiv.KategoriID FROM kategori_arsiv) order by KategoriAdi asc");*/
	}
	public function getKategori($id)
	{
		return $this->db->select("select * from kategoriler where KategoriID=$id");
	}
	public function kategoriUpdate($kategori_id,$data)
	{
		return $this->db->update("kategoriler",$data,"KategoriID=$kategori_id");
	}
	public function kategoriSil($kategori_id)
	{
		return $this->db->delete("kategoriler","KategoriID=$kategori_id");
	}
	public function kategoriKontrol($kategori_id){
		$query = $this->db->select("select * from kategoriler where KategoriID=$kategori_id");
		$isValue = count($query);
		if($isValue > 0)
		{
			//Sorgulama Başarılı
			return true;
		}else{
			//Sorgula Başarısız!
			return false;
		}
	}
	public function anaKategoriAra($kategori_adi)
	{
		return $this->db->select("select * from kategoriler where KategoriAdi like '%".$kategori_adi."%' order by KategoriAdi asc");
	}
	public function altKategoriEkle($data){
		$query = $this->db->insert("kategoriler",$data);
		if($query)
		{
			return true;
		}else{
			return false;
		}
	}
	public function altKategoriListesi(){
		return $this->db->select("SELECT altKT.KategoriID, altKT.KategoriAdi, altKT.Aciklama, ustKT.KategoriAdi AS 'ustkategoriadi' FROM kategoriler AS altKT, kategoriler AS ustKT  WHERE ustKT.KategoriID=altKT.AnaKategoriID");
	}
	public function altKategoriAra($kategori_adi){
		return $this->db->select("SELECT altKT.KategoriID, altKT.KategoriAdi, altKT.Aciklama, ustKT.KategoriAdi AS 'ustkategoriadi' FROM kategoriler AS altKT, kategoriler AS ustKT  WHERE ustKT.KategoriID=altKT.AnaKategoriID and altKT.KategoriAdi like '%".$kategori_adi."%'");
	}
	public function altKategoriSil($kategori_id)
	{
		return $this->db->delete("kategoriler","KategoriID=$kategori_id");
	}
	/*-----------------------------------------------------------------------*/
	/*Profil İşlemleri*/
	public function adminEmailKontrol($admin_email)
	{
		$query = $this->db->select("select * from admin where EpostaAdresi='$admin_email'");
		if(count($query)>0)
		{
			return true;
		}else{
			return false;
		}
	}
	public function getProfil($admin_email)
	{
		return $this->db->select("select * from admin where EpostaAdresi='$admin_email'");
	}
	public function profilGuncelle($data)
	{
		return $this->db->update("admin",$data,"AdminID=1");
	}
	/*-------------------------------------------*/
	/*Makale İşlemleri*/
	public function makaleListesi()
	{
		return $this->db->select("select * from makaleler order by MakaleID desc");
	}
	public function makaleEkle($data){
		$query = $this->db->insert("makaleler",$data);
		if($query)
		{
			return true;
		}else{
			return false;
		}
	}
	public function getMakaleKontrol($id)
	{
		$query = $this->db->select("select * from makaleler where MakaleID='$id'");
		if(count($query)>0)
		{
			return true;
		}else{
			return false;
		}
	}
	public function getMakale($id)
	{
		$query = $this->db->select("select * from makaleler where MakaleID='$id'");
		return $query;
	}
	public function makaleSil($id)
	{
		echo "sil";
		return $this->db->delete("makaleler","MakaleID=$id");
	}
	public function makaleGuncelle($data,$id)
	{
		return $this->db->update("makaleler",$data,"MakaleID=$id");
	}
	/*--------------------------------------------*/
	/*Site Ayarları*/
	public function getSiteAyarlari()
	{
		return $this->db->select("select * from siteayarlari where SiteAyariID=1");
	}
	public function siteAyarGuncelle($data)
	{
		return $this->db->update("siteayarlari",$data,"SiteAyariID=1");
	}
	/*--------------------------------------------*/
	/*Ana Kategori Arşivleme (Şu an kullanılmıyor...)*/
	public function arsivEkle($id)
	{
		$data = array(
			"KategoriID"=>$id
		);
		return $this->db->insert("kategori_arsiv",$data);
		
	}
	public function getKategoriArsivleri()
	{
		return $this->db->select("select * from kategori_arsiv,kategoriler where kategori_arsiv.KategoriID = kategoriler.KategoriID");
	}
	/*----------------------------------------------*/
	/*Slider Resimleri*/
	public function getSliderImages()
	{
		return $this->db->select("select * from sliderresimleri order by SiraNo asc");
	}
	public function sliderImageEkle($data)
	{
		return $this->db->insert("sliderresimleri",$data);
	}
	public function sliderImageKontrol($id)
	{
		$query = $this->db->select("select * from sliderresimleri where SliderItemID='$id'");
		if(count($query)>0)
		{
			return true;
		}else{
			return false;
		}
	}
	public function sliderImageSil($id)
	{
		$query = $this->db->delete("sliderresimleri","SliderItemID=$id");
		if($query)
		{
			return true;
		}else{
			return false;
		}
	}
	public function getSliderImage($id)
	{
		return $this->db->select("select * from sliderresimleri where SliderItemID=$id");
	}
	public function sliderImageUpdate($data,$id)
	{
		return $this->db->update("sliderresimleri",$data,"SliderItemID=$id");
	}
	/*----------------------------------------------*/
	/*Footer Blok İşlemleri*/
	public function footerBlokEkle($data)
	{
		return $this->db->insert("footerbloklari",$data);
	}
	public function footerBlokListesi()
	{
		return $this->db->select("select * from footerbloklari order by BlokSiraNo asc");
	}
	public function footerBlokKontrol($id)
	{
		$query = $this->db->select("select * from footerbloklari where FooterBlokID=$id");
		if(count($query)>0)
		{
			return true;
		}else{
			return false;
		}
	}
	public function getFooterBlok($id)
	{
		return $this->db->select("select * from footerbloklari where FooterBlokID=$id");
	}
	public function footerBlokGuncelle($data,$id)
	{
		return $this->db->update("footerbloklari",$data,"FooterBlokID=$id");
	}
	public function footerBlokSil($id)
	{
		return $this->db->delete("footerbloklari","FooterBlokID=$id");
	}
	public function getFooterLinkler()
	{
		return $this->db->select("select * from footerlinkleri,footerbloklari,makaleler where footerlinkleri.MakaleID=makaleler.MakaleID and footerlinkleri.FooterBlokID=footerbloklari.FooterBlokID");
	}
	public function getFooterLinkUrl()
	{
		return $this->db->select("select * from footerlinkleri,footerbloklari where footerlinkleri.FooterBlokID=footerbloklari.FooterBlokID and footerlinkleri.Url!=''");
	}
	public function footerLinkEkle($data){
		return $this->db->insert("footerlinkleri",$data);
	}
	public function footerLinkSorgula($id)
	{
		$query = $this->db->select("select * from footerlinkleri where FooterLinkID=$id");
		if(count($query)>0)
		{
			return true;
		}else{
			return false;
		}
	}
	public function getFooterLink($id)
	{
		return $this->db->select("select * from footerlinkleri,footerbloklari,makaleler where footerlinkleri.MakaleID=makaleler.MakaleID and footerlinkleri.FooterBlokID=footerbloklari.FooterBlokID and FooterLinkID=$id");
	}
	public function footerLinkSil($id)
	{
		return $this->db->delete("footerlinkleri","FooterLinkID=$id");
	}
	/*----------------------------------------------*/
	/*E-Bülten Kayıt Modülü*/
	public function ebultenKayit($data)
	{
		return $this->db->insert("ebulten",$data);
	}
	public function getEbultenListesi()
	{
		return $this->db->select("select * from ebulten order by EbultenID desc");
	}
	public function ebultenKontrol($id)
	{
		$query = $this->db->select("select * from ebulten where EbultenID=$id");
		if(count($query)>0)
		{
			return true;
		}else{
			return false;
		}
	}
	public function ebultenSil($id)
	{
		return $this->db->delete("ebulten","EbultenID=$id");
	}
	/*----------------------------------------------*/
	/*Sosyal Medya Linkleri*/
	public function sosyalMedyaLinkleri()
	{
		return $this->db->select("select * from sosyalmedyalinkleri");
	}
	public function sosyalMedyaLinkEkle($data)
	{
		return $this->db->insert("sosyalmedyalinkleri",$data);
	}
	public function sosyalMedyaLinkSil($id)
	{
		return $this->db->delete("sosyalmedyalinkleri","LinkID=$id");
	}
	public function sosyalMedyaLinkSorgula($id)
	{
		$query = $this->db->select("select * from sosyalmedyalinkleri where LinkID=$id");
		if(count($query)>0)
		{
			return true;
		}else{
			return false;
		}
	}
	public function getSosyalMedyaLink($id)
	{
		return $this->db->select("select * from sosyalmedyalinkleri where LinkID=$id");
	}
	public function sosyalMedyaLinkGuncelle($data,$id)
	{
		return $this->db->update("sosyalmedyalinkleri",$data,"LinkID=$id");
	}
	/*----------------------------------------------*/
	/*Üye İşlemleri*/
	public function getBireyselUyeler()
	{
		return $this->db->select("select * from bireyseluye order by UyeID desc");
	}
	public function getBireyselUyeKontrol($id)
	{
		$query = $this->db->select("select * from bireyseluye where UyeID=$id");
		if(count($query)>0)
		{
			return true;
		}else{
			return false;
		}
	}
	public function bireyselUyeSil($id)
	{
		return $this->db->delete("bireyseluye","UyeID=$id");
	}
	public function bireyselUyeAra($kelime,$arama_tipi)
	{
		if($arama_tipi==1)
		{
			//Ad alanına göre arama yap
			return $this->db->select("select * from bireyseluye where Ad like '%$kelime%'");
		}else if($arama_tipi==2)
		{
			//Soyad alanına göre arama yap
			return $this->db->select("select * from bireyseluye where Soyad like '%$kelime%'");
		}else if($arama_tipi==3){
			//Eposta Adresine göre arama yap
			return $this->db->select("select * from bireyseluye where Email like '%$kelime%'");
		}
		else if($arama_tipi==4){
			//Kulllanıcı adına göre arama yap
			return $this->db->select("select * from bireyseluye where KullaniciAd like '%$kelime%'");
		}
		else{
			return null;
		}
	}
	public function getBireyselUyeProfili($id)
	{
		return $this->db->select("select * from bireyseluye where UyeID=$id");
	}
	public function getBireyselUyeUrunleri($id)
	{
		return $this->db->select("select * from bireyselurun,kategoriler where bireyselurun.UyeID=$id and UrunKategoriID=kategoriler.KategoriID");
	}
	/*----------------------------------------------*/
	/*Üye Firma işlemleri*/
	public function getFirmaUyeler()
	{
		return $this->db->select("select * from firmauye order by UyeID desc");
	}
	public function firmaUyeAra($kelime,$arama_tipi)
	{
		if($arama_tipi==1)
		{
			//Firma Adı alanına göre arama yap
			return $this->db->select("select * from firmauye where FirmaAd like '%$kelime%'");
		}else if($arama_tipi==2)
		{
			//Firma Eposta alanına göre arama yap
			return $this->db->select("select * from firmauye where FirmaEposta like '%$kelime%'");
		}
		else{
			return null;
		}
	}
	public function getFirmalUyeUrunleri($id)
	{
		return $this->db->select("select * from firmaurun,kategoriler where firmaurun.FirmaID=$id and UrunKategoriID=kategoriler.KategoriID");
	}
	public function getFirmaUyeProfili($id)
	{
		return $this->db->select("select * from firmauye where UyeID=$id");
	}
	public function getFirmaUyeKontrol($id)
	{
		$query = $this->db->select("select * from firmauye where UyeID=$id");
		if(count($query)>0)
		{
			return true;
		}else{
			return false;
		}
	}
	public function firmaUyeSil($id)
	{
		return $this->db->delete("firmauye","UyeID=$id");
	}
	/*----------------------------------------------*/
	/*Reklam Yönetim İşlemleri*/
	public function getReklamlar()
	{
		return $this->db->select("select * from reklamlar");
	}
	public function reklamImageEkle($data)
	{
		return $this->db->insert("reklamlar",$data);
	}
	public function getReklamResmiAdi($id)
	{
		return $this->db->select("select * from reklamlar where ReklamID=$id");
	}
	public function reklamSil($id)
	{
		return $this->db->delete("reklamlar","ReklamID=$id");
	}
	public function reklamImageGuncelle($data,$id)
	{
		return $this->db->update("reklamlar",$data,"ReklamID=$id");
	}
	public function reklamPasifState($id)
	{
		$data = array(
			"aktif"=>0
		);
		return $this->db->update("reklamlar",$data,"ReklamID=$id");
	}
	public function reklamAktifState($id)
	{
		$data = array(
			"aktif"=>1
		);
		return $this->db->update("reklamlar",$data,"ReklamID=$id");
	}
	/*----------------------------------------------*/
	/*Gelen Kutusu*/
	public function gelenMesajlar()
	{
		return $this->db->select("select * from iletisim order by IletisimID desc");
	}
	public function mesajAra($kelime,$secim)
	{
		if($secim==1)
		{
			return $this->db->select("select * from iletisim where Konu like '%$kelime%'");
		}else if($secim==2){
			return $this->db->select("select * from iletisim where Email like '%$kelime%'");
		}else if($secim==3){
			return $this->db->select("select * from iletisim where Okundumu=1");
		}else if($secim==4){
			return $this->db->select("select * from iletisim where Okundumu=0");
		}else{
			return false;
		}
	}
	public function getMesaj($id)
	{
		return $this->db->select("select * from iletisim where IletisimID=$id");
	}
	public function mesajOkundu($id)
	{
		$data = array(
			"Okundumu"=>"1"
		);
		return $this->db->update("iletisim",$data,"IletisimID=$id");
	}
	public function mesajSil($id)
	{
		return $this->db->delete("iletisim","IletisimID=$id");
	}
	/*----------------------------------------------*/
}