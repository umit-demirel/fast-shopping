<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<link rel="stylesheet" href="<?php echo SITE_URL; ?>/css/style.css" />
	<title>Duyurular</title>
</head>
<body>
	<?php
	$i=0;
	foreach($duyuru as $value)
	{
		$baslik = $value["baslik"];
		$icerik = $value["icerik"];
		$i++;
	}
	if($i==0)
	{
		header("Location:".SITE_URL);
	}
	?>
	<?php echo $baslik; ?>
	<hr>
	<?php echo $icerik; ?>
</body>
</html>