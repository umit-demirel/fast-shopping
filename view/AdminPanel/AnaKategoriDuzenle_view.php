<section class="content-header">
	<h1>Ana Kategori Ekle</h1>
</section>
<section class="content">
	<div class="box">
		<div class="box-body">
			<?php
			$sayac=0;
			$kategori_adi=""; $kategori_id=""; $aciklama="";
			foreach($kategori as $value)
			{
				$kategori_adi = $value["KategoriAdi"];
				$kategori_id = $value["KategoriID"];
				$aciklama = $value["Aciklama"];
				$sayac++;
			}
			if($sayac==0)
			{
				header("Location:".SITE_URL."/AdminKategori/ana_kategoriler/notfound");
			}
			?>
			<form action="<?php echo SITE_URL; ?>/AdminKategori/ana_kategori_update/<?php echo $kategori_id; ?>" method="post">
				<input type="hidden" name="state" value="state" />
				<input type="text" name="kategori_adi" placeholder="Kategori Adı" value="<?php echo $kategori_adi; ?>" class="form-control" />
				<br/>
				<textarea name="kategori_aciklama" placeholder="Açıklama Metni" class="form-control"><?php echo $aciklama; ?></textarea>
				<br/>
				<p align="right">
					<input type="submit" value="Güncelle" class="btn btn-primary" />
				</p>
			</form>
		</div>
	</div>
</section>