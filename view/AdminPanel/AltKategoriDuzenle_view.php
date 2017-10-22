<section class="content-header">
	<h1>Alt Kategori Ekle</h1>
</section>
<section class="content">
	<div class="box">
		<div class="box-body">
			<?php
				if($ana_kategori_sayisi==0)
				{
					echo "<div class='alert alert-warning'>
						Ana Kategori Bulunamadığı İçin Alt Kategori Eklenemiyor. Lütfen Öncelikle Bir Ana Kategori Ekleyiniz.
					</div>";
				}
				else{
			?>
			<?php
			foreach($kategori as $value)
			{
				$gelenkategori_id = $value["KategoriID"];
				$gelenkategori_adi = $value["KategoriAdi"];
				$gelenaciklama = $value["Aciklama"];
				$gelenana_kategori = $value["AnaKategoriID"];
			}
			?>
			<form action="<?php echo SITE_URL; ?>/AdminKategori/alt_kategori_update/<?php echo $gelenkategori_id; ?>" method="post">
				<input type="hidden" name="state" value="state" />
				<label>Ana Kategori Seçiniz</label>
				<select name='ana_kategori' class='form-control'>
				<?php
				foreach($ana_kategoriler as $value)
				{
					$kategori_id = $value["KategoriID"];
					$kategori_adi = $value["KategoriAdi"];
					$kategori_aciklama = $value["Aciklama"];
					if($kategori_id==$gelenana_kategori)
					{
						echo "<option selected='selected' value='$kategori_id' title='$kategori_aciklama'>$kategori_adi</option>";
					}else{
						echo "<option value='$kategori_id' title='$kategori_aciklama'>$kategori_adi</option>";
					}
					
				}
				?>
				</select>
				<br/>
				<label>Alt Kategori Adı</label>
				<input type="text" name="kategori_adi" placeholder="Alt Kategori Adı" class="form-control" value="<?php echo $gelenkategori_adi; ?>" />
				<br/>
				<label>Açıklama</label>
				<textarea name="kategori_aciklama" placeholder="Açıklama Metni" class="form-control" style=""><?php echo $gelenaciklama; ?></textarea>
				<br/>
				<p align="right">
					<input type="submit" value="Alt Kategori Oluştur" class="btn btn-primary" />
				</p>
			</form>
			<?php
				}
			?>
		</div>
	</div>
</section>