<script type="text/javascript">
	$(document).ready(function(){
		$("#makale").show();
		$("#url").hide();
	});
	function selected_0()
	{
		$("#makale").show(1000);
		$("#url").hide(1000);
	}
	function selected_1()
	{
		$("#makale").hide(1000);
		$("#url").show(1000);
	}
</script>
<section class="content-header">
	<h1>Footer Link Ekle</h1>
</section>
<section class="content">
	<div class="box">
		<div class="box-body">
			<?php
			if(isset($mesaj))
			{
				if($mesaj=="makale_secilmedi")
				{
					echo "
						<div class='alert alert-error'>Makale Seçilmedi!</div>
					";
				}
				else if($mesaj=="secim_tanimsiz")
				{
					echo "
						<div class='alert alert-error'>Tanımsız Seçim!</div>
					";
				}
				else if($mesaj=="blok_secilmedi")
				{
					echo "
						<div class='alert alert-error'>Footer Bloğu Seçmediniz!</div>
					";
				}
				
			}
			?>
			
			<?php
			foreach($footerLink as $value)
			{
				$glink_id = $value["FooterLinkID"];
				$glink_adi = $value["LinkAdi"];
				$gurl = $value["Url"];
				$gmakale_id = $value["MakaleID"];
				$gblok_id = $value["FooterBlokID"];
				
				if(empty($gurl) || $gurl=="" || $gurl==null)
				{
					echo "<script>
						$('#makale').show();
						$('#url').hide();
					</script>";
				}else{
					echo "<script>
						$('#makale').hide();
						$('#url').show();
					</script>";
				}
			}
			?>
			<form action="<?php echo SITE_URL; ?>/AdminFooter/link_ekle" method="post" id="form1">
				<input type="hidden" name="state" value="state" />
				<label>Link Adı</label>
				<input type="text" name="link_adi" value="<?php echo $glink_adi; ?>" class="form-control" />
				<br>
				<label>Blok Seçiniz</label><br>
				<select name="blok">
				<option value="-1" disabled selected>Footer Blok Seçiniz</option>
				<?php
				foreach($bloklar as $value)
				{
					$blok_id = $value["FooterBlokID"];
					$blok_adi = $value["BlokAdi"];
					if($blok_id==$gblok_id)
					{
						echo "<option value='$blok_id' selected>$blok_adi</option>";
					}else{
						echo "<option value='$blok_id'>$blok_adi</option>";
					}
					
				}
				?>
				</select>
				<br><br>
				<label><input type="radio" name="secim" onclick="selected_0()" value="0" checked /> Makale Bağlantısı Yap</label>
				<br>
				<label><input type="radio" name="secim" onclick="selected_1()" value="1" /> Url Bağlantısı Yap</label>
				<div id="makale">
					<select name="makale">
					<option value="-1" disabled selected>Makale Seçiniz</option>
					<?php
						foreach($makaleler as $value)
						{
							$makale_id = $value["MakaleID"];
							$baslik = $value["Baslik"];
							if($makale_id==$gmakale_id)
							{
								echo "
								<option value='$makale_id' selected>$baslik</option>
								";
							}else{
								echo "
								<option value='$makale_id'>$baslik</option>
								";
							}
						}
					?>
					</select>
				</div>
				<div id="url">
					<input type="text" name="url" placeholder="Url Linkini Giriniz." class="form-control" />
				</div>
				
				<br>
				<input type="submit" value="Kaydet" class="btn btn-primary" />
			</form>
		</div>
	</div>
</section>	