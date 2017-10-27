<script type="text/javascript">
	$(document).ready(function(){
		$("#form1").validate({
			rules:{
				title:{
					required:true
				},
				description:{
					required:true
				}
			},
			messages:{
				title:{
					required:"Site Başlığını Giriniz!"
				},
				description:{
					required:"Site Açıklamasını Giriniz!"
				}
			}
		});
	});
</script>
<section class="content-header">
	<h1>Site Ayarları</h1>
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
						<b>Başarılı!</b> Güncelleme İşlemi Başarıyla Tamamlandı
					</div>";
				}else if($mesaj=="error"){
					echo "<div class='alert alert-error'>
						<b>Hata!</b> Bir Hata Nedeniyle İşleminiz Yapılamıyor.
					</div>";
				}
			}
			?>
			
			<?php
			$title=""; $description=""; $keyword=""; $google_code="";
			$i=0;
			foreach($site_ayarlari as $value)
			{
				$title=$value["Title"];
				$description=$value["Description"];
				$keyword=$value["Keyword"];
				$google_code=$value["GoogleCode"];
				$i++;
			}
			?>
			<?php
			if($i==0)
			{
			?>
				<div class="alert alert-warning">Site Ayarları Veritabanında Varsayılan Olarak Yapılandırılmamış!</div>
			<?php
			}else{
			?>
				<form action="<?php echo SITE_URL; ?>/admin/site_ayarlari" method="post" id="form1">
					<input type="hidden" name="state" value="state" />
					<label>Site Başlık</label>
					<input type="text" name="title" class="form-control" value="<?php echo $title; ?>" />
					<br>
					<label>Site Açıklaması</label>
					<input type="text" name="description" class="form-control" value="<?php echo $description; ?>" />
					<br>
					<label>Anahtar Kelimeler (Kelimeleri Virgül(,) İle Ayırınız)</label>
					<input type="text" name="keyword" class="form-control" value="<?php echo $keyword; ?>" />
					<br>
					<label>Google Analytics Kodu</label>
					<textarea name="google_code" id="google_code" cols="30" rows="5" class="form-control"><?php echo $google_code; ?></textarea>
					<br>
					<input type="submit" value="Güncelle" class="btn btn-primary" />
				</form>
			<?php
			}
			?>
		</div>
	</div>
</section>
