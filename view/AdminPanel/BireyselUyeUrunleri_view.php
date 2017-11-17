<section class="content-header">
	<h1>Bireysel Üye İlanları</h1>
</section>
<section class="content">
	<div class="box">
		<div class="box-body">
			<table border="1" width="100%" align="center" style="background-color:#f4f4f4; border:1px solid #ccc;">
				<tr>
					<td width="10%" style="padding:5px;" align="center"><b>Resim</b></td>
					<td width="18%" style="padding:5px;" align="center"><b>Ürün Adı</b></td>
					<td width="18%" style="padding:5px;" align="center"><b>Fiyat</b></td>
					<td width="18%" style="padding:5px;" align="center"><b>Adet</b></td>
					<td width="18%" style="padding:5px;" align="center"><b>Kategori</b></td>
					<td width="18%" align="center"><b>Eylemler</b></td>
				</tr>
			</table>
			<table border="1" width="100%" align="center" style="border:1px solid #ccc;">
			<?php
			$sayac=0;
			foreach($urunler as $value)
			{
				$urun_id = $value["UrunID"];
				$urun_adi = $value["UrunAd"];
				$fiyat = $value["UrunFiyat"];
				$urun_resim = $value["UrunResim"];
				$adet = $value["UrunAdet"];
				$kategori_adi = $value["KategoriAdi"];
				$sayac++;
				if($urun_resim=="default")
				{
					$urun_resim = SITE_URL."/assets/images/no-image-thumb.png";
				}
				echo "
					<tr>
					<td width='10%' style='padding:5px;' align='center'><img src='$urun_resim' wdth='25' height='25' /></td>
					<td width='18%' style='padding:5px;' align='center'>$urun_adi</td>
					<td width='18%' style='padding:5px;' align='center'>$fiyat</td>
					<td width='18%' style='padding:5px;' align='center'>$adet</td>
					<td width='18%' style='padding:5px;' align='center'>$kategori_adi</td>
					<td width='18%' align='center'></td>
					</tr>
				";
			}
			if($sayac==0)
			{
				echo "<center><i>Üyeye Ait İlan Bulunamadı!</i></center>";
			}
			?>
			</table>
		</div>
	</div>
</section>	