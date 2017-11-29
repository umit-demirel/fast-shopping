<script type="text/javascript">
	$(document).ready(function(){
		$("#checkAll").click(function () {
			 $('input:checkbox').not(this).prop('checked', this.checked);
		 });
	});
</script>
<section class="content-header">
	<h1>Yorum Yönetimi</h1>
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
				}
			}
			?>
			<table border="1" width="100%" align="center" style="background-color:#f4f4f4; border:1px solid #ccc;">
				<tr>
					<td width="5%" style="padding:5px;" align="center">
						<input type="checkbox" id="checkAll">
					</td>
					<td width="55%" style="padding:5px;" align="center"><b>Yorum</b></td>
					<td width="15%" align="center"><b>Tarih</b></td>
					<td width="25%" align="center"><b>Eylemler</b></td>
				</tr>
			</table>
			<table border="1" width="100%" align="center" style="border:1px solid #ccc;">
				<?php
				foreach($yorumlar as $value)
				{
					$id = $value["YorumID"];
					$yorum = $value["Yorum"];
					$tarih = $value["tarih"];
					echo "
						<tr>
							<td width='5%' style='padding:5px;' align='center'>
								<input type='checkbox' id='checkItem'>
							</td>
							<td width='55%' style='padding:5px;' align='left'>".substr($yorum,0,30)."</td>
							<td width='15%' align='center'>$tarih</td>
							<td width='25%' align='center' style='padding:5px;'>
								<a href='".SITE_URL."/AdminYorum/cevapla/$id' class='btn btn-info'><i class='fa fa-edit'></i> Cevapla</a>
								<a href='".SITE_URL."/AdminYorum/duzenle/$id' class='btn btn-success'><i class='fa fa-edit'></i> Düzenle</a>
								<a href='".SITE_URL."/AdminYorum/sil/$id' class='btn btn-danger'><i class='fa fa-remove'></i> Sil</a>
							</td>
						</tr>
					";
				}
				?>
			</table>
		</div>
	</div>
</section>