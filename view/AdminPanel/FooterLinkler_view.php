<section class="content-header">
	<h1>Footer Link Listesi</h1>
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
					<td width="25%" style="padding:5px;"><b>Link Başlığı</b></td>
					<td width="20%" style="padding:5px;"><b>Blok Adı</b></td>
					<td width="20%" align="center" style="padding:5px;"><b>Makale</b></td>
					<td width="20%" align="center"><b>Url</b></td>
					<td width="15%" align="center"><b>Eylemler</b></td>
				</tr>
			</table>
			<table border="1" width="100%" align="center" style="border:1px solid #ccc;">
			<?php
			$link_sayac=0;
			$url_sayac=0;
			foreach($linkler as $value)
			{
				$link_id = $value["FooterLinkID"];
				$link_adi = $value["LinkAdi"];
				$url = $value["Url"];
				$makale = $value["Baslik"];
				$blok_adi = $value["BlokAdi"];
				echo "<tr>
					<td width='25%' style='padding:5px;'>$link_adi</b></td>
					<td width='20%' style='padding:5px;'>$blok_adi</b></td>
					<td width='20%' align='center' style='padding:5px;'>$makale</b></td>
					<td width='20%' align='center'>$url</td>
					<td width='15%' align='center'>
						<a href='".SITE_URL."/AdminFooter/link_duzenle/$link_id'><i class='fa fa-edit'></i> Düzenle</a>
						<a href='".SITE_URL."/AdminFooter/link_sil/$link_id'><i class='fa fa-remove'></i> Sil</a>
					</td>
				</tr>";
				$link_sayac++;
			}
			foreach($url_link as $value)
			{
				$link_id = $value["FooterLinkID"];
				$link_adi = $value["LinkAdi"];
				$url = $value["Url"];
				$blok_adi = $value["BlokAdi"];
				echo "<tr>
					<td width='25%' style='padding:5px;'>$link_adi</b></td>
					<td width='20%' style='padding:5px;'>$blok_adi</b></td>
					<td width='20%' align='center' style='padding:5px;'></b></td>
					<td width='20%' align='center'>$url</td>
					<td width='15%' align='center'>
						<a href='".SITE_URL."/AdminFooter/link_duzenle/$link_id'><i class='fa fa-edit'></i> Düzenle</a>
						<a href='".SITE_URL."/AdminFooter/link_sil/$link_id'><i class='fa fa-remove'></i> Sil</a>
					</td>
				</tr>";
				$link_sayac++;
			}
			if($link_sayac==0)
			{
				echo "<center><i>Footer Link Listesi Boş!</i></center>";
			}
			?>
			</table>
		</div>
	</div>
</section>	