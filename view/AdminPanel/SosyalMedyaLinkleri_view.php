<script type="text/javascript">
	$(document).ready(function(){
		$("#form1").validate({
			rules:{
				link_adi:{
					required:true
				},
				link_url:{
					required:true
				}
			},
			messages:{
				link_adi:{
					required:"Link Adını Giriniz!"
				},
				link_url:{
					required:"Url Giriniz!"
				}
			}
		});
	});
</script>
<section class="content-header">
	<h1>Sosyal Medya Link Yönetimi</h1>
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
				}else if($mesaj=="validation_error")
				{
					echo "<div class='alert alert-warning'>
						<b>Uyarı!</b> Lütfen Tüm Alanları Doldurunuz...
					</div>";
				}
			}
			?>
			<div class="alert alert-info">Sosyal Medya Linki Ekle</div>
			<form action="<?php echo SITE_URL; ?>/AdminSosyalMedyaLink/sosyal_medya_linkleri" method="post" id="form1">
				<input type="hidden" name="state" value="state" />
				Link Adı : <br><input type="text" name="link_adi" placeholder="örnek : Facebook"/>
				<br>
				Link Url Adresi : <br><input type="text" name="link_url" placeholder="örnek : http://www.facebook.com" /><br><br>
				<input type="submit" value="Ekle" class="btn btn-primary" />
			</form>
			
			<div class="alert alert-info">Sosyal Medya Linkleri</div>
			<table border="1" width="100%" align="center" style="background-color:#f4f4f4; border:1px solid #ccc;">
				<tr>
					<td width="80%" style="padding:5px;"><b>Link Adı</b></td>
					<td width="20%" align="center"><b>Eylemler</td>
				</tr>
			</table>
			<table border="1" width="100%" align="center" style="border:1px solid #ccc;">
			<?php
			$sayac=0;
			foreach($linkler as $value)
			{
				$id = $value["LinkID"];
				$link_adi=$value["LinkAdi"];
				echo "<tr>
					<td width='80%' style='padding:5px;'>$link_adi</b></td>
					<td width='20%' align='center'>
						<a href='".SITE_URL."/AdminSosyalMedyaLink/link_duzenle/$id'><i class='fa fa-edit'></i> Düzenle</a>
						<a href='".SITE_URL."/AdminSosyalMedyaLink/link_sil/$id'><i class='fa fa-remove'></i> Düzenle</a>
					</td>
					</tr>";
				$sayac++;
			}
			if($sayac==0)
			{
				echo "<center><i>Kayıt Bulunamadı! Üst Kısımdaki Bölümden Link Ekleyebilirsiniz.</i></center>";
			}
			?>
			</table>
			
		</div>
	</div>
</section>