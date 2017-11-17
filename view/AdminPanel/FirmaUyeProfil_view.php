<section class="content-header">
	<h1>Firma Üye Profili</h1>
</section>
<section class="content">
	<div class="box">
		<div class="box-body">
			<?php
				$sayac=0;
				foreach($profil as $value)
				{
					$firma_adi = $value["FirmaAd"];
					$email = $value["FirmaEposta"];
					$kullaniciadi = $value["FirmaKullaniciAd"];
					$adres = $value["FirmaAdres"];
					$telefon = $value["FirmaTelefon"];
					$sayac++;
				}
				if($sayac==0)
				{
					echo "<i><center><b>Kullanıcı Bulunamadı!</b></center></i>";
				}
			?>
			<label>Kullanıcı Adı</label><br>
			<?php echo $kullaniciadi; ?><br>
			<label>Firma Adı</label><br>
			<?php echo $firma_adi; ?><br>
			<label>Email Adresi</label><br>
			<?php echo $email; ?><br>
			<label>Telefon</label><br>
			<?php echo $telefon; ?><br>
			<label>Adres</label><br>
			<?php echo $adres; ?>
		</div>
	</div>
</section>	