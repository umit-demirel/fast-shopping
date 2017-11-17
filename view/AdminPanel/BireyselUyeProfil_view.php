<section class="content-header">
	<h1>Bireysel Üye Profili</h1>
</section>
<section class="content">
	<div class="box">
		<div class="box-body">
			<?php
				$sayac=0;
				foreach($profil as $value)
				{
					$adsoyad = $value["Ad"]." ".$value["Soyad"];
					$email = $value["Email"];
					$kullaniciadi = $value["KullaniciAd"];
					$sayac++;
				}
				if($sayac==0)
				{
					echo "<i><center><b>Kullanıcı Bulunamadı!</b></center></i>";
				}
			?>
			<label>Kullanıcı Adı</label><br>
			<?php echo $kullaniciadi; ?><br>
			<label>Ad Soyad</label><br>
			<?php echo $adsoyad; ?><br>
			<label>Email Adresi</label><br>
			<?php echo $email; ?>
		</div>
	</div>
</section>	