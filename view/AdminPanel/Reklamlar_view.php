<style type="text/css">
	.images{
		display:block;
		overflow:hidden;
	}
	.images .image-item{
		display:block;
		float:left;
		margin-right:10px;
		margin-bottom:10px;
		padding:10px;
		border:1px solid #ccc;
		box-shadow:3px 3px 3px #ccc;
	}
	.images .image-item img{
		display:block;
		margin-bottom:3px;
	}
	.images .image-item .sequentially{
		display:block;
		position:absolute;
		padding:5px;
		margin-left:98px;
		text-align:center;
		background-color:black;
		color:white;
	}
</style>


<section class="content-header">
	<h1>Reklam Resmi Yükle</h1>
</section>
<section class="content" style="min-height:auto;">
	<div class="box">
		<div class="box-body">
			<form action="<?php echo SITE_URL; ?>/AdminReklam/Reklam" method="post" enctype="multipart/form-data" id="form1">
				<input type="hidden" name="state" value="state" />
				Resimler Seçiniz : <input type="file" multiple name="resimler[]"/>
				<br>
				Blok Seçiniz : <br>
				<select name="blok" id="blok">
					<option value="1">Site Sol Reklam Alanı</option>
					<option value="2">Site Sağ Reklam Alanı</option>
					<option value="3">Site Başı Reklam Alanı</option>
					<option value="4">Site Sonu Reklam Alanı</option>
				</select>
				<br>
				<font color='green'>Reklamın Gösterileceği Bloğu Seçiniz!</font>
				<br>
				<input type="submit" value="Yükle" class="btn btn-primary" />
			</form>
		</div>
	</div>
</section>


<section class="content-header">
	<h1>Reklam Yönetimi</h1>
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
			
			<div class="images">
			<?php
			$sayac=0;
			foreach($reklamlar as $value)
			{
				$resim = $value["Resim"];
				$blokid = $value["SiteReklamBlokID"];
				$id = $value["ReklamID"];
				$aktif = $value["aktif"];
				$state="";
				if($aktif==1)
				{
					$state="<font color='lightgreen'>Aktif</font>";
					$aktif = "<a href='".SITE_URL."/AdminReklam/ReklamPasifState/$id' class='btn btn-warning'>Pasif Yap</a>";
				}else{
					$state="<font color='orange'>Pasif</font>";
					$aktif = "<a href='".SITE_URL."/AdminReklam/ReklamAktifState/$id' class='btn btn-success'>Aktif Yap</a>";
				}
				$img = "<img src='".SITE_URL."/uploads/reklamlar/tn/".$value["Resim"]."'  />";
				echo "
					<div class='image-item'>
						<div class='sequentially'>$blokid - $state</div>
						$img
						<center>
						<a href='".SITE_URL."/AdminReklam/ReklamGuncelle/$id' class='btn btn-info'><i class='fa fa-edit'></i> Güncelle</a>
						<a href='".SITE_URL."/AdminReklam/ReklamSil/$id' class='btn btn-danger'><i class='fa fa-remove'></i> Sil</a><br><br>
						$aktif
						</center>
					</div>
				";
				$sayac++;
			}
			if($sayac==0)
			{
				echo "<center><i>Reklam Resmi Bulunamadı!</i></center>";
			}
			?>
			</div>
		</div>	
	</div>
</section>	