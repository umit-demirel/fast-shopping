<section class="content-header">
	<h1>Ana Kategori Ekle</h1>
</section>
<section class="content">
	<div class="box">
		<div class="box-body">
			<form action="<?php echo SITE_URL; ?>/AdminKategori/ana_kategori_ekle" method="post">
				<input type="hidden" name="state" value="state" />
				<input type="text" name="kategori_adi" placeholder="Kategori Adı" class="form-control" />
				<br/>
				<textarea name="kategori_aciklama" placeholder="Açıklama Metni" class="form-control" style=""></textarea>
				<br/>
				<p align="right">
					<input type="submit" value="Kategori Oluştur" class="btn btn-primary" />
				</p>
			</form>
		</div>
	</div>
</section>