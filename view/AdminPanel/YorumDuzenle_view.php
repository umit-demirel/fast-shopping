<section class="content-header">
	<h1>Yorum Düzenle</h1>
</section>
<section class="content">
	<div class="box">
		<div class="box-body">
			<?php
			$id=""; $yorum_txt=""; $tarih="";
			foreach($yorum as $value)
			{
				$id = $value["YorumID"];
				$yorum_txt = $value["Yorum"];
				$tarih = $value["tarih"];
				
			}
			?>
			<form action="<?php echo SITE_URL; ?>/AdminYorum/duzenle/<?php echo $id; ?>" method="post">
				
				<textarea name="yorum" id="yorum" cols="30" rows="5" class="form-control"><?php echo $yorum_txt; ?></textarea>
				<br>
				<input type="submit" value="Güncelle" class="btn btn-primary" />
			</form>
		</div>
	</div>
</section>	