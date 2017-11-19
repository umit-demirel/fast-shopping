<section class="content-header">
	<h1>Toplu Mail Gönder</h1>
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
				}else if($mesaj=="notfound_usertype")
				{
					echo "<div class='alert alert-warning'>
						<b>Uyarı!</b> Geçersiz Kullanıcı Tipi
					</div>";
				}
			}
			?>
			<form action="<?php echo SITE_URL; ?>/AdminTopluMail/gonder" method="post">
				<input type="hidden" name="state" value="state" />
				<label>Kullanıcı Tipi Seçiniz</label><br>
				<input type="checkbox" name="tip[]" value="1" /> Bireysel Üyeler<br>
				<input type="checkbox" name="tip[]" value="2" /> Üye Firmalar<br>
				<input type="checkbox" name="tip[]" value="3" /> E-Bülten Üyeleri<br>
				<br>
				<label>Mail Şablonu Seçiniz</label><br>
				<label>
					<input type="radio" name="sablon" value="1" checked />
					<img src="<?php echo SITE_URL; ?>/assets/images/mail-sablon-1.png" alt="Mail Şablonu 1" />
				</label>
				<label>
					<input type="radio" name="sablon" value="2" />
					<img src="<?php echo SITE_URL; ?>/assets/images/mail-sablon-2.png" alt="Mail Şablonu 1" />
				</label>
				<br>
				<label>Başlık</label><br>
				<input type="text" name="baslik" class="form-control" /><br>
				<label>Mesajınız</label><br>
				<textarea name="mesaj" id="mesaj" cols="30" rows="10" class="form-control"></textarea><br>
				<br>
				<input type="submit" value="Gönder" class="btn btn-primary" />
			</form>
		</div>
	</div>
</section>	