<script type="text/javascript" src="<?php echo SITE_URL; ?>/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL; ?>/ckeditor/_samples/sample.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL; ?>/ckeditor/_samples/sample.css"></script>

<section class="content-header">
	<h1>Makale Ekle</h1>
</section>
<section class="content">
	<div class="box">
		<div class="box-body">
			<form action="<?php echo SITE_URL; ?>/AdminMakale/makale_ekle" method="post" id="form-makale">
				<input type="hidden" name="state" value="state" />
				<label>Başlık</label>
				<input type="text" placeholder="Makale Başlığı" name="baslik" class="form-control" />
				<br>
				<label>İçerik</label>
<?php
include_once 'ckeditor/ckeditor.php' ;
require_once 'ckfinder/ckfinder.php' ;
$initialValue = "" ;
$ckeditor = new CKEditor( ) ;
$ckeditor->basePath  = 'ckeditor/' ;
CKFinder::SetupCKEditor( $ckeditor, 'ckfinder/' ) ;
$config['height'] = '300';
$config['toolbar'] = 'Full';
$ckeditor->editor('icerik', $initialValue, $config);
?>
<br>
			<label>Etiketler (Kelimeleri Virgül İle Ayırınız)</label>
			<input type="text" name="etiketler" class="form-control" />
			<br>
			<input type="submit" value="Kaydet" class="btn btn-primary" />
			</form>
		</div>
	</div>
</section>