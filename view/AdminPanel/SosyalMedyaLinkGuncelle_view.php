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
	<h1>Sosyal Medya Link Yönetimi - Link Düzenle</h1>
</section>
<section class="content">
	<div class="box">
		<?php
			$id=""; $link_adi=""; $link_url="";
			foreach($link as $value)
			{
				$id = $value["LinkID"];
				$link_adi = $value["LinkAdi"];
				$link_url = $value["Url"];
			}
		?>
			<div class="box-body">
				<form action="<?php echo SITE_URL; ?>/AdminSosyalMedyaLink/link_duzenle/<?php echo $id; ?>" method="post" id="form1">
				<input type="hidden" name="state" value="state" />
				Link Adı : <br><input type="text" name="link_adi" placeholder="örnek : Facebook" value="<?php echo $link_adi; ?>" />
				<br>
				Link Url Adresi : <br><input type="text" name="link_url" placeholder="örnek : http://www.facebook.com" value="<?php echo $link_url; ?>" /><br><br>
				<input type="submit" value="Güncelle" class="btn btn-primary" />
			</form>
			</div>
	</div>
</section>	