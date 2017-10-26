<script type="text/javascript" src="<?php echo SITE_URL; ?>/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL; ?>/ckeditor/_samples/sample.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL; ?>/ckeditor/_samples/sample.css"></script>

<section class="content-header">
	<h1>Makale Ekle</h1>
</section>
<section class="content">
	<div class="box">
		<div class="box-body">
			<?php
			$id=""; $baslik=""; $tarih=""; $icerik=""; $etiketler="";
			foreach($makale as $value)
			{
				$id=$value["MakaleID"];
				$baslik=$value["Baslik"];
				$icerik=$value["Icerik"];
				$tarih=$value["tarih"];
				$etiketler=$value["etiketler"];
			}
			?>
			<form action="<?php echo SITE_URL; ?>/AdminMakale/makale_update/<?php echo $id; ?>" method="post" id="form-makale">
				<input type="hidden" name="state" value="state" />
				<label>Başlık</label>
				<input type="text" value="<?php echo $baslik; ?>" name="baslik" class="form-control" />
				<br>
				<label>İçerik</label>
<?php
include_once 'ckeditor/ckeditor.php' ;
require_once 'ckfinder/ckfinder.php' ;
$initialValue = $icerik;
$ckeditor = new CKEditor();
$ckeditor->basePath  = 'ckeditor/';
CKFinder::SetupCKEditor( $ckeditor, 'ckfinder/' );
$config['height'] = '300';
$config['toolbar'] = 'Full';
$ckeditor->editor('icerik', $initialValue, $config);
?>
<br>
			<label>Etiketler (Kelimeleri Virgül İle Ayırınız)</label>
			<input type="text" name="etiketler" value="<?php echo $etiketler; ?>" class="form-control" />
			<br>
			<input type="submit" value="Güncelle" class="btn btn-primary" />
			</form>
		</div>
	</div>
</section>