<section class="content-header">
	<h1>Bireysel Üyeler</h1>
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
			
			<form action="<?php echo SITE_URL; ?>/AdminUye/bireysel_uye_ara" method="post">
				<input type="text" name="kelime" placeholder="İsim Veya Kullanıcı Adı" />
				<select name="arama_tipi">
					<option value="1">Ad</option>
					<option value="2">Soyad</option>
					<option value="3">E-Posta Adresi</option>
					<option value="4">Kullanıcı Adı</option>
				</select>
				<input type="submit" value="Ara" />
				<a href="<?php echo SITE_URL; ?>/AdminUye/bireysel_uyeler">Tüm Kullanıcılar</a>
			</form>
			
			<table border="1" width="100%" align="center" style="background-color:#f4f4f4; border:1px solid #ccc;">
				<tr>
					<td width="60%" style="padding:5px;"><b>Ad Soyad</b></td>
					<td width="20%" align="center" style="padding:5px;"><b>Kullanıcı Adı</b></td>
					<td width="20%" align="center"><b>Eylemler</b></td>
				</tr>
			</table>
			<table border="1" width="100%" align="center" style="border:1px solid #ccc;">
			<?php
			$sayac=0;
			foreach($uyeler as $value)
			{
				$id = $value["UyeID"];
				$ad = $value["Ad"];
				$soyad = $value["Soyad"];
				$kullanici_adi = $value["KullaniciAd"];
				echo "
					<tr>
					<td width='60%' style='padding:5px;'>$ad $soyad</td>
					<td width='20%' align='center' style='padding:5px;'>$kullanici_adi</td>
					<td width='20%' align='center' style='padding:5px;'>
						<a href='".SITE_URL."/AdminUye/bireysel_uye_ilanlari/$id' class='btn btn-info'> İlanlar</a>
						<a href='".SITE_URL."/AdminUye/bireysel_uye_profili/$id' class='btn btn-success'> Profil</a>
						<a href='".SITE_URL."/AdminUye/bireysel_uye_sil/$id' class='btn btn-danger'> Sil</a>
					</td>
					</tr>
				";
			}
			?>
			</table>
		</div>
	</div>
</section>	