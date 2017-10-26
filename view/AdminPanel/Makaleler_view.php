<section class="content-header">
	<h1>Makale İşlemleri</h1>
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
		
			<table border="1" width="100%" align="center" style="background-color:#f4f4f4; border:1px solid #ccc;">
				<tr>
					<td width="60%" style="padding:5px;">Makale Başlığı</b></td>
					<td width="20%" align="center" style="padding:5px;">Eklenme Tarihi</b></td>
					<td width="20%" align="center">Eylemler</td>
				</tr>
			</table>
			<table border="1" width="100%" align="center" style="border:1px solid #ccc;">
			<?php
			$sayac=0;
			foreach($makaleler as $value)
			{
				$makale_id = $value["MakaleID"];
				$baslik = $value["Baslik"];
				$tarih = $value["tarih"];
				$etiketler = $value["etiketler"];
				echo "
					<tr>
					<td width='60%' style='padding:5px;'>$baslik</b></td>
					<td width='20%' align='center' style='padding:5px;'>$tarih</b></td>
					<td width='20%' align='center'>
						<a href='".SITE_URL."/AdminMakale/makale_guncelle/$makale_id'><i class='fa fa-edit'></i> Düzenle</a>
						<a href='".SITE_URL."/AdminMakale/makale_sil/$makale_id'><i class='fa fa-remove'></i> Sil</a>
					</td>
					</tr>
				";
				$sayac++;
			}
			if($sayac==0)
			{
				echo "<i><center>Makale Bulunamadı!</center></i>";
			}
			?>
			</table>
			
		</div>
	</div>	
</section>		