<section class="content-header">
	<h1>Yorum Cevapla</h1>
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
			<?php 
			echo $yorum_txt;
			?>
			<br>
			<?php echo $tarih; ?><br>
			<form action="<?php echo SITE_URL; ?>/AdminYorum/cevapla/<?php echo $id; ?>" method="post">
				
				<textarea name="cevap" id="cevap" cols="30" rows="5" class="form-control"></textarea>
				<br>
				<input type="submit" value="Cevapla" class="btn btn-primary" />
			</form>
		</div>
	</div>
</section>	