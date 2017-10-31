<section class="content-header">
	<h1>Kategori Arşivi</h1>
</section>
<section class="content">
	<div class="box">
		<div class="box-body">
			<table border="1" width="100%" align="center" style="background-color:#f4f4f4; border:1px solid #ccc;">
				<tr>
					<td width="80%" style="padding:5px;">Kategori Adı</b></td>
					<td width="20%" align="center">Sil</td>
				</tr>
			</table>
			<table border="1" width="100%" align="center" style="border:1px solid #ccc;">
			<?php
			$sayac=0;
			foreach($arsivler as $value)
			{
				$kategori_id = $value["KategoriID"];
				$kategori_adi = $value["KategoriAdi"];
				echo "
					<tr>
						<td width='80%' style='padding:5px;'>$kategori_adi</td>
						<td width='20%' align='center'><a href='".SITE_URL."/AdminKategori/ana_kategori_sil/$kategori_id'>Sil</a></td>
					</tr>
				";
				$sayac++;
			}
			if($sayac==0)
			{
				echo "<center><i>Arşivde Kayıt Bulunamadı!</i></center>";
			}
			?>
			</table>
			
		</div>
	</div>
</section>	