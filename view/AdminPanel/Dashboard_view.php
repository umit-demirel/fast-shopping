<!--
Dashboard Sayfası<br>
<?php
if(isset($_COOKIE["fastshoppingAdminEmail"]))
{
echo $_COOKIE["fastshoppingAdminEmail"]."<br>";
echo $_COOKIE["fastshoppingAdminPassword"];
}else{
	echo "cookie yok<BR>";
}
if(isset($_SESSION["admin_username"]))
{
	echo "session ok";
}else{
	echo "session yok";
}
?>
-->
<section class="content-header">
	<h1>Kullanıcı İstatistikleri</h1>
</section>
<section class="content" style="min-height:auto;">
	<div class="row">
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-green">
				<div class="inner">
					<h3><?php echo $aktif_bireysel_uye_sayisi; ?></h3>
					<p>Toplam Aktif Üye Sayısı</p>
				</div>
				<div class="icon">
					<i class="fa fa-user"></i>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-orange">
				<div class="inner">
					<h3><?php echo $aktif_bireysel_uye_sayisi; ?></h3>
					<p>Toplam Firma Üye Sayısı</p>
				</div>
				<div class="icon">
					<i class="fa fa-user"></i>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="content-header">
	<h1>Kategori İstatistikleri</h1>
</section>
<section class="content" style="min-height:auto;">
	<div class="row">
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-orange">
				<div class="inner">
					<h3><?php echo $ana_kategoriler; ?></h3>
					<p>Ana Kategori Sayısı</p>
				</div>
				<div class="icon">
					<i class="fa fa-user"></i>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-orange">
				<div class="inner">
					<h3><?php echo $alt_kategoriler; ?></h3>
					<p>Alt Kategori Sayısı</p>
				</div>
				<div class="icon">
					<i class="fa fa-user"></i>
				</div>
			</div>
		</div>
	</div>
</section>	

<section class="content-header">
	<h1>İlan/Ürün İstatistikleri</h1>
</section>
<section class="content" style="min-height:auto;">
	<div class="row">
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-green">
				<div class="inner">
					<h3><?php echo $bireysel_urun_onayli; ?></h3>
					<p>Onaylı Normal İlan/Ürünler</p>
				</div>
				<div class="icon">
					<i class="fa fa-user"></i>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-green">
				<div class="inner">
					<h3><?php echo $bireysel_urun_onaysiz; ?></h3>
					<p>Onaysız Normal İlan/Ürünler</p>
				</div>
				<div class="icon">
					<i class="fa fa-user"></i>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-green">
				<div class="inner">
					<h3><?php echo $firma_urun_onayli; ?></h3>
					<p>Firma Onaylı İlan/Ürünler</p>
				</div>
				<div class="icon">
					<i class="fa fa-user"></i>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-green">
				<div class="inner">
					<h3><?php echo $firma_urun_onaysiz; ?></h3>
					<p>Firma Onaysız İlan/Ürünler</p>
				</div>
				<div class="icon">
					<i class="fa fa-user"></i>
				</div>
			</div>
		</div>
	</div>
</section>	

<section class="content-header">
	<h1>Makale/Yayın İstatistikleri</h1>
</section>
<section class="content" style="min-height:auto;">
	<div class="row">
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-green">
				<div class="inner">
					<h3><?php echo $makale_sayisi; ?></h3>
					<p>Makale/Yayın Sayısı</p>
				</div>
				<div class="icon">
					<i class="fa fa-user"></i>
				</div>
			</div>
		</div>
	</div>
</section>	

<section class="content-header">
	<h1>Mesaj İstatistikleri</h1>
</section>
<section class="content" style="min-height:auto;">
	<div class="row">
		<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-green">
					<div class="inner">
						<h3><?php echo $mesaj_sayisi; ?></h3>
						<p>Tüm Mesajlar</p>
					</div>
					<div class="icon">
						<i class="fa fa-user"></i>
					</div>
				</div>
			</div>
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-green">
				<div class="inner">
					<h3><?php echo $okunmayan_mesaj_sayisi; ?></h3>
					<p>Okunmayan Mesajlar</p>
				</div>
				<div class="icon">
					<i class="fa fa-user"></i>
				</div>
			</div>
		</div>
	</div>
</section>