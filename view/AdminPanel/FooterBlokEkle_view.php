<script type="text/javascript">
	$(document).ready(function(){
		$("#form1").validate({
			rules:{
				blok_adi:{
					required:true
				},
				sira_no:{
					required:true
				}
			},
			messages:{
				blok_adi:{
					required:"Blok Adı Giriniz!"
				},
				sira_no:{
					required:"Sıra No Giriniz!"
				}
			}
		});
	});
</script>

<section class="content-header">
	<h1>Blok Ekle</h1>
</section>
<section class="content">
	<div class="box">
		<div class="box-body">
			<form action="<?php echo SITE_URL; ?>/AdminFooter/blok_ekle" method="post" id="form1">
			<input type="hidden" name="state" value="state" />
			<label>Blok Adı</label>
			<input type="text" name="blok_adi" class="form-control" />
			<br>
			<label>Sıra No</label><br>
			<input type="number" name="sira_no" value="0" />
			(Blokların Hangi Sırada Gösterileceğini Belirleyin)
			<br><br>
			<input type="submit" value="Ekle" class="btn btn-primary" />
			</form>
		</div>
	</div>
</section>