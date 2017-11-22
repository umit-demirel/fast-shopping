<section class="content-header">
	<h1>Gelen Kutusu</h1>
</section>
<section class="content" style="min-height:auto;">
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
				}
			}
			?>
			
			<form action="<?php echo SITE_URL; ?>/AdminGelenKutusu/gelen_kutusu" method="post" id="form1">
				<input type="hidden" name="state" value="state" />
				<input type="text" name="kelime" placeholder="Ne Aramıştınız?" />
				<select name="secim" id="secim">
					<option value="1">Konu</option>
					<option value="2">E-Posta Adresi</option>
					<option value="3">Okunan Mesajlar</option>
					<option value="4">Okunmayan Mesajlar</option>
				</select>
				<input type="submit" value="Ara!" />
			</form>
			
			<table border="1" width="100%" align="center" style="background-color:#f4f4f4; border:1px solid #ccc;">
				<tr>
					<td width="30%" style="padding:5px;"><b>Konu</b></td>
					<td width="30%" style="padding:5px;"><b>E-Posta Adresi</b></td>
					<td width="20%" align="center" style="padding:5px;"><b>Gönderilme Tarihi</b></td>
					<td width="20%" align="center"><b>Eylemler</b></td>
				</tr>
			</table>
			<table border="1" width="100%" align="center" style="border:1px solid #ccc;">
				<?php
				$sayac=0;
				foreach($mesajlar as $value)
				{
					$id = $value["IletisimID"];
					$email = $value["Email"];
					$konu = $value["Konu"];
					$tarih = $value["Tarih"];
					$okundumu = $value["Okundumu"];
					$renk="";
					$okunan_icon="";
					if($okundumu==1)
					{
						$renk="white";
						$okunan_icon="<i class='fa fa-eye'></i>";
					}else{
						$renk="#f4f4f4";
						$okunan_icon="";
					}
					echo "
						<tr bgcolor='$renk'>
							<td width='30%' style='padding:5px;'>$okunan_icon <a href='".SITE_URL."/AdminGelenKutusu/mesaj_oku/$id'>$konu</a></td>
							<td width='30%' style='padding:5px;'>$email</td>
							<td width='20%' align='center' style='padding:5px;'>$tarih</td>
							<td width='20%' align='center' style='padding:5px;'>
								<a class='btn btn-warning' href='".SITE_URL."/AdminGelenKutusu/mesaj_sil/$id'><i class='fa fa-remove'></i> Sil</a>
							</td>
						</tr>
					";
				}
				?>
			</table>
		</div>
	</div>
</section>	