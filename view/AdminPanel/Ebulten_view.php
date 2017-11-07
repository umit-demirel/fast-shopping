<section class="content-header">
	<h1>Slider Resmi Yükle</h1>
</section>
<section class="content" style="min-height:auto;">
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
			<table border="1" width="100%" align="center" style="background-color:#f4f4f4; border:1px solid #ccc;">
				<tr>
					<td width="30%" style="padding:5px;">Ad Soyad</b></td>
					<td width="30%" style="padding:5px;">E-Posta Adresi</b></td>
					<td width="20%" align="center" style="padding:5px;">Eklenme Tarihi</b></td>
					<td width="20%" align="center">Eylemler</td>
				</tr>
			</table>
			<table border="1" width="100%" align="center" style="border:1px solid #ccc;">
			<?php
			$sayac=0;
			foreach($ebulten as $value)
			{
				$eposta = $value["Eposta"];
				$adsoyad = $value["AdSoyad"];
				$tarih = $value["Tarih"];
				$EbultenID = $value["EbultenID"];
				$sayac++;
				echo "<tr>
					<td width='30%' style='padding:5px;'>$adsoyad</b></td>
					<td width='30%' style='padding:5px;'>$eposta</b></td>
					<td width='20%' align='center' style='padding:5px;'>$tarih</b></td>
					<td width='20%' align='center'>
						<a href='".SITE_URL."/AdminEbulten/ebulten_sil/$EbultenID'><i class='fa fa-remove'></i> Sil</a>
					</td>
				</tr>";
			}
			if($sayac==0)
			{
				echo "<i><center>E-Bülten Listesi Boş!</center></i>";
			}
			?>
			</table>
		</div>
	</div>
</section>