<?php
if(isset($_GET["url"]))
{
    $url = $_GET["url"];
    $url = rtrim($url,"/");
    $url = explode("/", $url);
    
    if(isset($url[0]))
    {
        include 'controller/'.$url[0].".php";
        if(isset($url[2]))
        {
            $c = new $url[0];
            $c->$url[1]($url[2]);
        }
		/*Bu kısım sadece controller adı girilip diğerleri girilmediği zaman çalışır*/
		else if(isset($url[0]) && empty($url[1]))
		{
			header("Location:".SITE_URL);
		}
		else{
            $c = new $url[0];
            $c->$url[1]();
        }
    }
	else if(isset($url[0]) && empty($url[1]))
	{
		echo "ddd";
	}
	else{
        echo "url yok2";
    }
}else{
    include 'controller/anasayfa.php';
    $c = new anasayfa();
    $c->index();
}