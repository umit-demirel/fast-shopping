<section class="content-header">
	<h1>Reklam Resmi Güncelle</h1>
</section>
<section class="content" style="min-height:auto;">
	<div class="box">
		<div class="box-body">
			<?php
			$id=""; $resim_adi=""; $blok=""; $aktif="";
			foreach($resim as $value)
			{
				$id = $value["ReklamID"];
				$resim_adi = $value["Resim"];
				$blok = $value["SiteReklamBlokID"];
				$aktif = $value["aktif"];
			}
			?>
			Şuanki Mevcut Resim<br>
			<img src="<?php echo SITE_URL; ?>/uploads/reklamlar/tn/<?php echo $resim_adi; ?>">
			<form action="<?php echo SITE_URL; ?>/AdminReklam/ReklamGuncelle/<?php echo $id; ?>" method="post" enctype="multipart/form-data" id="form1">
				<input type="hidden" name="state" value="state" />
				Güncellenecek Resmi Seçiniz : <input type="file" name="resimler"/>
				<br>
				Blok Seçiniz : <br>
				<select name="blok" id="blok">
					<option value="1" <?php if($blok==1)echo 'selected'; ?>>Site Sol Reklam Alanı</option>
					<option value="2" <?php if($blok==2)echo 'selected'; ?>>Site Sağ Reklam Alanı</option>
					<option value="3" <?php if($blok==3)echo 'selected'; ?>>Site Başı Reklam Alanı</option>
					<option value="4" <?php if($blok==4)echo 'selected'; ?>>Site Sonu Reklam Alanı</option>
				</select>
				<br>
				<font color='green'>Reklamın Gösterileceği Bloğu Seçiniz!</font>
				<br>
				<input type="submit" value="Güncelle" class="btn btn-primary" />
			</form>
		</div>
	</div>
</section>