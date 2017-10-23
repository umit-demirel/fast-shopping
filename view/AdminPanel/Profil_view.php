<section class="content-header">
	<h1>Profil İşlemleri</h1>
</section>
<section class="content">
	<div class="box">
		<div class="box-body">
			<?php
				if(isset($mesaj))
				{
					if($mesaj=="noimage")
					{
						echo "<div class='alert alert-error'>
							<b>Uyarı!</b> Resim Seçilmedi...
						</div>";
					}else if($mesaj=="type_error")
					{
						echo "<div class='alert alert-error'>
							<b>Geçersiz Dosya Tipi!</b> Bir Resim Dosyası Seçiniz...
						</div>";
					}
					else if($mesaj=="file_size_error")
					{
						echo "<div class='alert alert-error'>
							<b>Dosya Boyutu Hatası!</b> 2MB dan Büyük Resimler Yüklenemez...
						</div>";
					}
					else if($mesaj=="upload_error")
					{
						echo "<div class='alert alert-error'>
							<b>Resim Yükleme Hatası!</b> Profil Resmi Yüklenemedi...
						</div>";
					}
					else if($mesaj=="upload_success")
					{
						echo "<div class='alert alert-success'>
							<b>Profil Resmi Yüklendi!</b> Profil Resmi Başarıyla Yüklendi...
						</div>";
					}
					else if($mesaj=="upload_success_but_data_error")
					{
						echo "<div class='alert alert-warning'>
							Profil Resminiz Yüklenmiş Ancak Kayıt Edilirken Bir Sorun Oluşmuş Olabilir!
						</div>";
					}
					else if($mesaj=="update_data_success")
					{
						echo "<div class='alert alert-success'>
							Profil Bilgileri Güncellendi...
						</div>";
					}
					else if($mesaj=="update_data_error")
					{
						echo "<div class='alert alert-error'>
							Profil Bilgileri Güncellenemedi...
						</div>";
					}
					else if($mesaj=="parameters_error")
					{
						echo "<div class='alert alert-error'>
							Eksik Parametreler Tespit Edildi! Lütfen Yaptığınız İşlemlerdeki Tüm Alanları Eksiksiz Doldurunuz.
						</div>";
					}
					else if($mesaj=="login_data_error")
					{
						echo "<div class='alert alert-error'>
							Giriş Bilgileri Hatalı Olduğu İçin Yeni Hesap Bilgileriniz Güncellenemedi!
						</div>";
					}
					else if($mesaj=="new_login_error")
					{
						echo "<div class='alert alert-error'>
							Yeni Hesap Bilgileri Güncellenirken Bir Hata Oluştu!
						</div>";
					}
					
					
					
				}
			?>
			<?php
				$adsoyad=""; $eposta=""; $profil_resmi="";
				foreach($profil as $value)
				{
					$adsoyad = $value["AdSoyad"];
					$eposta = $value["EpostaAdresi"];
					$profil_resmi = $value["ProfilResmi"];
					
				}
			?>
			
			<div class="profil_content">
				<div class="profil_img">
					<?php
						if($profil_resmi=="default")
						{
							echo "<img src='".SITE_URL."/uploads/admin_images/default.gif' />";
						}else{
							echo "<img src='".SITE_URL."/uploads/admin_images/$profil_resmi' />";
						}
					?>
				</div>
				<div class="profil_detail">
					<form action="<?php echo SITE_URL; ?>/admin/profil_guncelle" method="post">
					<input type="hidden" name="state" value="state" />
					<label>Ad Soyad</label><br>
					<input type="text" name="adsoyad" value="<?php echo $adsoyad; ?>" class="form-control" />
					<br>
					<label>E-Posta Adresi</label><br>
					<i><?php echo $eposta; ?></i>
					<br>
					<input type="submit" class="btn btn-primary" value="Bilgileri Güncelle">
					</form>
					<br><br>
					<label>Profil Resmini Güncelle</label><br>
					<form action="<?php echo SITE_URL; ?>/admin/profil_resmi_yukle" method="post" enctype="multipart/form-data">
					<input type="file" name="profil_img" class="form form-control" /> (Max 2MB)
					<br>
					<input type="submit" value="Yükle" class="btn btn-primary" />
					</form>
					<br>
					<label>Giriş Bilgileri Güncelle (Bilgiler Güncellendiğinde Tekrar Giriş Yapmak Zorundasınız.)</label>
					<form action="<?php echo SITE_URL; ?>/admin/giris_bilgileri_guncelle" method="post">
						<input type="hidden" name="state" value="state" />
						<label>E-Posta Adresi</label>
						<input type="text" name="email" value="<?php echo $eposta; ?>" class="form-control" />
						<label>Geçerli Şifreniz</label>
						<input type="password" name="sifre" class="form-control" />
						<label>Yeni Şifre</label>
						<input type="password" name="yeni_sifre" class="form-control" />
						<br>
						<input type="submit" value="Giriş Bilgilerini Güncelle" class="btn btn-primary" />
					</form>
				</div>
			</div>
		</div>
	</div>
</section>	