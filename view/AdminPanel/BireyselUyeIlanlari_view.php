<script type="text/javascript">
	$(document).ready(function(){
		$("#checkAll").click(function () {
			 $('input:checkbox').not(this).prop('checked', this.checked);
		 });
	});
</script>
<section class="content-header">
	<h1>Bireysel Üye Ilanları</h1>
</section>
<section class="content">
	<div class="box">
		<div class="box-body">
			<?php
			if(isset($mesaj))
			{
				if($mesaj=="success")
				{
					echo "<div class='alert alert-success'>
						<b>Başarılı</b> İşlemleriniz Başarıyla Tamamlandı.
					</div>";
				}else if($mesaj=="error")
				{
					echo "<div class='alert alert-error'>
						<b>Hatalı!</b> Bir Hata Nedeniyle İşlemleriniz Yapılamadı!
					</div>";
				}else if($mesaj=="notfound")
				{
					echo "<div class='alert alert-warning'>
						<b>Uyarı!</b> Ardaığınız Sayfa Bulunamadı! İşleminiz Gerçekleştirilemiyor...
					</div>";
				}
			}
			?>
			
			<form action="<?php echo SITE_URL; ?>/AdminIlanlar/bireysel_ilan_ara" method="post">
				<input type="text" name="kelime" placeholder="Ne Aramıştınız?" />
				<select name="tip" id="tip">
					<option value="1">Ürün Adı</option>
					<option value="2">Aktif İlanlar</option>
					<option value="3">Pasif İlanlar</option>
				</select>
				<input type="submit" value="Ara / Filtrele" />
			</form>
			
			<table border="1" width="100%" align="center" style="background-color:#f4f4f4; border:1px solid #ccc;">
				<tr>
					<td width="5%" style="padding:5px;" align="center">
						<input type="checkbox" id="checkAll">
					</td>
					<td width="10%" style="padding:5px;" align="center"><b>Resim</b></td>
					<td width="30%" align="center" style="padding:5px;"><b>Ürün Adı</b></td>
					<td width="15%" align="center"><b>Fiyat</b></td>
					<td width="15%" align="center"><b>Adet</b></td>
					<td width="25%" align="center"><b>Eylemler</b></td>
				</tr>
			</table>
			<table border="1" width="100%" align="center" style="border:1px solid #ccc;">
			<?php
			$sayac=0;
			foreach($ilanlar as $value)
			{
				$urun_id = $value["UrunID"];
				$uye_id = $value["UyeID"];
				$urun_adi = $value["UrunAd"];
				$urun_fiyat = $value["UrunFiyat"];
				$urun_resim = $value["UrunResim"];
				$urun_adet = $value["UrunAdet"];
				$sayac++;
				if($urun_resim=="default")
				{
					$urun_resim="<img width='50' height='50' src='".SITE_URL."/assets/images/no-image-thumb.png' />";
				}else{
					$urun_resim="<img width='50' height='50' src='".SITE_URL."/uploads/urunler/$urun_resim' />";
				}
				$ilan_durumu = "";
				if($value["UrunDurum"]==0)
				{
					$ilan_durumu = "<a href='".SITE_URL."/AdminIlanlar/aktif/$urun_id' class='btn btn-success'><i class='fa fa-check'></i> Onayla</a>";
				}else{
					$ilan_durumu = "<a href='".SITE_URL."/AdminIlanlar/pasif/$urun_id' class='btn btn-warning'><i class='fa fa-check'></i> Pasif Yap</a>";
				}
				echo "
					<tr>
					<td width='5%' style='padding:5px;' align='center'>
					<input type='checkbox' id='checkItem'>
					</td>
					<td width='10%' style='padding:5px;' align='center'>$urun_resim</td>
					<td width='30%' align='center' style='padding:5px;'>$urun_adi</td>
					<td width='15%' align='center'>$urun_fiyat</td>
					<td width='15%' align='center'>$urun_adet</td>
					<td width='25%' align='center'>
						<a href='".SITE_URL."/AdminUye/bireysel_uye_profili/$uye_id' class='btn btn-default'><i class='fa fa-user'></i> İlan Sahibi</a>
						
						$ilan_durumu
						
						<a href='".SITE_URL."/AdminIlanlar/bireysel_ilan_sil/$urun_id' class='btn btn-danger'><i class='fa fa-remove'></i> Sil</a>
					</td>
					</tr>
				";
				
			}
			if($sayac==0)
			{
				echo "<center><i>İlan Bulunamadı!</i></center>";
			}
			?>
			</table>
		</div>	
	</div>
</section>	