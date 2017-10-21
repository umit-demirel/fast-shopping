<section class="content-header">
	<h1>Ana Kategori İşlemleri</h1>
</section>
<section class="content">
	<div class="box">
		<div class="box-body">
			<?php
			if(isset($mesaj))
			{
				if($mesaj=="success")
				{
					echo "
						<div class='alert alert-success'>
							İşlem Başarıyla Gerçekleşti...
						</div>
					";
				}else if($mesaj=="error"){
					echo "
						<div class='alert alert-error'>
							<b>Hata!</b> İşlem Bir Hata Nedeniyle Yapılamadı!
						</div>
					";
				}else if($mesaj=="notfound")
				{
					echo "
						<div class='alert alert-error'>
							<b>Bulunamadı!</b> Gitmek İstediğiniz İşlem Sayfası Bulunamadı!
						</div>
					";
				}
			}
			?>
			<form action="<?php echo SITE_URL; ?>/AdminKategori/ana_kategori_ara" method="post">
				<input type="text" name="kategori_adi" placeholder="Kategori Adı" />
				<input type="submit" value="Ara!" />
				<a href="<?php echo SITE_URL; ?>/AdminKategori/ana_kategoriler">
					Tüm Kategorileri Listele
				</a>
			</form>
			
			
			<table border="1" width="100%" align="center" style="background-color:#f4f4f4; border:1px solid #ccc;">
				<tr>
					<td width="30%" style="padding:5px;">Kategori Adı</b></td>
					<td width="50%" align="center">Açıklama</b></td>
					<td width="20%" align="center">Eylemler</td>
				</tr>
			</table>
			<table border="1" width="100%" align="center" style="border:1px solid #ccc;">
			<?php
			$sayac=0;
			foreach($kategoriler as $value)
			{
				$kategori_id = $value["kategoriID"];
				$kategori_adi = $value["kategoriAdi"];
				$kategori_aciklama = $value["aciklama"];
				echo "
					<tr>
					<td width='30%' style='padding:5px;'>$kategori_adi</b></td>
					<td width='50%' style='padding:5px;' >".substr($kategori_aciklama,0,50)."...</b></td>
					<td width='20%' align='center'>
						<a href='".SITE_URL."/AdminKategori/ana_kategori_duzenle/$kategori_id'><i class='fa fa-edit'></i> Düzenle</a> 
						<a href='".SITE_URL."/AdminKategori/ana_kategori_sil/$kategori_id'><i class='fa fa-remove'></i> Sil</a>
					</td>
					</tr>
				";
				$sayac++;
			}
			if($sayac==0)
			{
				echo "
					<div class='alert alert-warning'>
						<center><h4><i class='fa fa-warning'></i> <i>Kategori Listesi Boş! Bir Sonuç Bulunamadı.</i></h4></center>
					</div>
				";
			}
			?>
			</table>
		</div>
	</div>
</section>