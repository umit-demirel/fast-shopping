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