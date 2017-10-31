<section class="content-header">
	<h1>Slider Resmi Güncelle</h1>
</section>
<section class="content">
	<div class="box">
		<div class="box-body">
			<?php
			foreach($slider_resmi as $value)
			{
				$id = $value["SliderItemID"];
				$resim = $value["Resim"];
				$sira_no = $value["SiraNo"]; 
			}
			?>
			<img src="<?php echo SITE_URL; ?>/uploads/sliders/tn/<?php echo $resim; ?>" />
			<br><br>
			<form action="<?php echo SITE_URL; ?>/AdminSlider/SliderImageUpdate/<?php echo $id; ?>" method="post">
			Sıra No : <input type="number" name="sira_no" value="<?php echo $sira_no; ?>" />
			<br><br>
			<input type="submit" value="Güncelle" class="btn btn-primary" >
			</form>
		</div>
	</div>
</section>