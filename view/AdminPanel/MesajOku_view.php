<section class="content-header">
	<h1>Mesaj Oku</h1>
</section>
<section class="content" style="min-height:auto;">
	<div class="box">
		<div class="box-body">
			<?php
			$sayac=0;
			$konu=""; $metin=""; $tarih=""; $email="";
			foreach($mesaj as $value)
			{
				$konu = $value["Konu"];
				$metin = $value["Mesaj"];
				$tarih = $value["Tarih"];
				$email = $value["Email"];
			}
			?>
			<h3><?php echo $konu; ?></h3>
			<font size="-1">Gönderen : <?php echo $email; ?></font><br><br>
			<?php echo $metin; ?><br><br>
			<form action="<?php echo SITE_URL; ?>/AdminGelenKutusu/mesaj_cevap" method="post">
				<b>Cevap Yaz</b><br>
				<textarea name="mesaj" id="mesaj" cols="30" rows="5" class="form-control"></textarea><br>
				<input type="hidden" name="email" value="<?php echo $email; ?>" />
				<input type="hidden" name="konu" value="<?php echo $konu; ?>" />
				<input type="submit" value="Cevapla" class="btn btn-primary" />
			</form>
		</div>
	</div>
</section>	