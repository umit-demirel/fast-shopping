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
		margin-left:135px;
		text-align:center;
		background-color:black;
		color:white;
	}
</style>
<section class="content-header">
	<h1>Slider Resmi Yükle</h1>
</section>
<section class="content" style="min-height:auto;">
	<div class="box">
		<div class="box-body">
			<form action="<?php echo SITE_URL; ?>/AdminSlider/Slider" method="post" enctype="multipart/form-data" id="form1">
				<input type="hidden" name="state" value="state" />
				Resimler Seçiniz : <input type="file" multiple name="resimler[]"/>
				<br>
				Sıra No : <br><input type="number" name="sira_no" /><br><br>
				<input type="submit" value="Yükle" class="btn btn-primary" />
			</form>
		</div>
	</div>
</section>

<section class="content-header">
	<h1>Slider İşlemleri</h1>
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
						<b>Başarılı!</b> İşlem Başarıyla Tamamlandı.
					</div>";
				}
				else if($mesaj=="error")
				{
					echo "<div class='alert alert-error'>
						<b>Hata!</b> İşlem Bir Hata Nedeniyle Başarısız Oldu!
					</div>";
				}
				else if($mesaj=="notfound")
				{
					echo "<div class='alert alert-warning'>
						<b>Uyarı!</b> İşlem Sayfası Bulunamadı!
 					</div>";
				}
			}
			?>
			<div class="images">
			<?php
			$sayac=0;
			foreach($slider as $value)
			{
				$slider_id = $value["SliderItemID"];
				$img = "<img src='".SITE_URL."/uploads/sliders/tn/".$value["Resim"]."'  />";
				$sira_no = $value["SiraNo"];
				echo "
					<div class='image-item'>
						<div class='sequentially'>$sira_no</div>
						$img
						<center>
						<a href='".SITE_URL."/AdminSlider/SliderGuncelle/$slider_id' class='btn btn-success'><i class='fa fa-edit'></i> Düzenle</a>
						<a href='".SITE_URL."/AdminSlider/SliderSil/$slider_id' class='btn btn-warning'><i class='fa fa-remove'></i> Sil</a>
						</center>
					</div>
				";
				$sayac++;
			}
			if($sayac==0)
			{
				echo "<center><i>Slider Resmi Bulunamadı!</i></center>";
			}
			?>
			</div>
		</div>
	</div>
</section>