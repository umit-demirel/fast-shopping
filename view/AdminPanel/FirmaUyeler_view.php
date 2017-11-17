<section class="content-header">
	<h1>Firma Üyeler</h1>
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
			
			<form action="<?php echo SITE_URL; ?>/AdminUye/firma_uye_ara" method="post">
				<input type="text" name="kelime" placeholder="Firma Adı Veya E-Posta Adresi" />
				<select name="arama_tipi">
					<option value="1">Firma Adı</option>
					<option value="2">E-Posta Adresi</option>
				</select>
				<input type="submit" value="Ara" />
				<a href="<?php echo SITE_URL; ?>/AdminUye/firma_uyeler">Tüm Firmalar</a>
			</form>
			
			<table border="1" width="100%" align="center" style="background-color:#f4f4f4; border:1px solid #ccc;">
				<tr>
					<td width="40%" style="padding:5px;"><b>Firma Adı</b></td>
					<td width="20%" align="center" style="padding:5px;"><b>E-Posta Adresi</b></td>
					<td width="20%" align="center" style="padding:5px;"><b>Telefon</b></td>
					<td width="20%" align="center"><b>Eylemler</b></td>
				</tr>
			</table>
			<table border="1" width="100%" align="center" style="border:1px solid #ccc;">
			<?php
			$sayac=0;
			foreach($uyeler as $value)
			{
				$id = $value["UyeID"];
				$firma_adi = $value["FirmaAd"];
				$eposta = $value["FirmaEposta"];
				$telefon = $value["FirmaTelefon"];
				echo "
					<tr>
					<td width='40%' style='padding:5px;'>$firma_adi</td>
					<td width='20%' align='center' style='padding:5px;'>$eposta</td>
					<td width='20%' align='center' style='padding:5px;'>$telefon</td>
					<td width='20%' align='center' style='padding:5px;'>
						<a href='".SITE_URL."/AdminUye/firma_uye_ilanlari/$id' class='btn btn-info'> İlanlar</a>
						<a href='".SITE_URL."/AdminUye/firma_uye_profili/$id' class='btn btn-success'> Profil</a>
						<a href='".SITE_URL."/AdminUye/firma_uye_sil/$id' class='btn btn-danger'> Sil</a>
					</td>
					</tr>
				";
			}
			?>
			</table>
		</div>
	</div>
</section>	