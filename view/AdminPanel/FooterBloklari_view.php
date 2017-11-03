<section class="content-header">
	<h1>Footer Blok Listesi</h1>
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
					<td width="60%" style="padding:5px;">Blok Adı</b></td>
					<td width="20%" align="center" style="padding:5px;">Sıra No</b></td>
					<td width="20%" align="center">Eylemler</td>
				</tr>
			</table>
			<table border="1" width="100%" align="center" style="border:1px solid #ccc;">
			<?php
			$sayac=0;
			foreach($bloklar as $value)
			{
				$blok_id = $value["FooterBlokID"];
				$blok_adi = $value["BlokAdi"];
				$sira_no = $value["BlokSiraNo"];
				echo "
				<tr>
					<td width='60%' style='padding:8px;'>$blok_adi</td>
					<td width='20%' align='center'>$sira_no</td>
					<td width='20%' align='center'>
						<a href='".SITE_URL."/AdminFooter/blok_guncelle/$blok_id' class='btn btn-success'><i class='fa fa-edit'> Güncelle</i></a>
						<a href='".SITE_URL."/AdminFooter/blok_sil/$blok_id' class='btn btn-warning'><i class='fa fa-remove'> Sil</i></a>
					</td>
				</tr>";
				$sayac++;
			}
			if($sayac==0)
			{
				echo "<center><i>Blok Listesi Boş!</i></center>";
			}
			?>
			</table>
		</div>
	</div>
</section>	