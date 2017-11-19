<?php
if(isset($_COOKIE["fastshoppingAdminEmail"]) && isset($_COOKIE["fastshoppingAdminPassword"]))
{
	//Cookie var ise ve session sonlanmış ise yeni session olustur
	if(empty($_SESSION["admin_username"]))
	{
		$_SESSION["admin_username"] = $_COOKIE["fastshoppingAdminEmail"];
	}
}else{
	//Cookie yok ve session da yok ise girişe yönlendir.
	if(empty($_SESSION["admin_username"]))
	{
		header("Location:".SITE_URL."/admin/login");
	}
}
?>

<!-- Seçilen menüyü belirleme işlemi -->
<?php 
	$query = $_GET["url"];
	$degerler = explode("/",$query);
	$controller = $degerler[0];
?>
<!-- #### -->

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Yönetim Paneli</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/admin_tasarim/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <!--<link rel="stylesheet" href="<?php echo SITE_URL; ?>/admin_tasarim/dist/css/font-awesome.min.css">-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <!--<link rel="stylesheet" href="<?php echo SITE_URL; ?>/admin_tasarim/dist/css/ionicons.min.css">-->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/admin_tasarim/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/admin_tasarim/dist/css/skins/skin-blue.min.css">
<!-- jQuery 2.1.4 -->
    <script src="<?php echo SITE_URL; ?>/admin_tasarim/plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<script src="<?php echo SITE_URL; ?>/assets/js/jquery-ui.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo SITE_URL; ?>/admin_tasarim/bootstrap/js/bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="<?php echo SITE_URL; ?>/admin_tasarim/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo SITE_URL; ?>/admin_tasarim/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo SITE_URL; ?>/admin_tasarim/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo SITE_URL; ?>/admin_tasarim/dist/js/demo.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script type="text/javascript" src="<?php echo SITE_URL; ?>/assets/js/validation/jquery.js"></script>
	<script type="text/javascript" src="<?php echo SITE_URL; ?>/assets/js/validation/jquery.validate.min.js"></script>
	<style type="text/css">
	tr{
		border:1px solid #ccc;
	}
	td{
		border:1px solid #ccc;
	}
	
	</style>
  </head>
  <!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
  <!-- the fixed layout is not compatible with sidebar-mini -->
  <body class="hold-transition skin-blue fixed sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo SITE_URL; ?>/admin/dashboard" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>A</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Admin</b></span>
        </a>
        
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navigasyon</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>        
          <div class="navbar-custom-menu">
<!--           
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
<!--               
              <li class="dropdown messages-menu">               
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success">4</span>
                </a>
<!--
                <ul class="dropdown-menu">
                  <li class="header">You have 4 messages</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
<!--                     
                    <ul class="menu">
                      <li><!-- start message -->
<!--                       
                        <a href="#">
                          <div class="pull-left">
                            <img src="<?php echo SITE_URL; ?>/admin_tasarim/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            Support Team
                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li><!-- end message -->
<!--                       
                    </ul>
                  </li>
                  <li class="footer"><a href="#">See All Messages</a></li>
                </ul>
              </li>              
              <!-- Notifications: style can be found in dropdown.less -->
<!--               
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning">10</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 10 notifications</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
<!--                     
                    <ul class="menu">
                      <li>
                        <a href="#">
                          <i class="fa fa-users text-aqua"></i> 5 new members joined today
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="footer"><a href="#">View all</a></li>
                </ul>
              </li>
              <!-- Tasks: style can be found in dropdown.less -->
<!--               
              <li class="dropdown tasks-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>
                  <span class="label label-danger">9</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 9 tasks</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
<!--                     
                    <ul class="menu">
                      <li><!-- Task item -->
<!--                       
                        <a href="#">
                          <h3>
                            Design some buttons
                            <small class="pull-right">20%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">20% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li><!-- end task item -->
<!--                       
                    </ul>
                  </li>
                  <li class="footer">
                    <a href="#">View all tasks</a>
                  </li>
                </ul>
              </li>              
              <!-- User Account: style can be found in dropdown.less -->
<!--               
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo SITE_URL; ?>/admin_tasarim/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $_SESSION["username"]; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
<!--                   
                  <li class="user-header">
                    <img src="<?php echo SITE_URL; ?>/admin_tasarim/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                    <p>
                      Alexander Pierce - Web Developer
                      <small>Member since Nov. 2012</small>
                    </p>
                  </li>
                  <!-- Menu Body -->
<!--                   
                  <li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </li>
                  <!-- Menu Footer-->
<!--                   
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="#" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
<!--               
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
-->
          </div>          
        </nav>
      </header>

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
<!--          
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo SITE_URL; ?>/admin_tasarim/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">            
              <p><?php echo $_SESSION["admin_username"]; ?></p>
            </div>
          </div>
          <!-- search form -->
<!--  
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
<!--            
            <li class="header">ANA MENÜLER</li>
-->         
			<li>
              <a href="<?php echo SITE_URL; ?>/admin/profil">
                <i class="fa fa-image"></i>
                <span>Profil İşlemleri</span><i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>	
			
			<li class="treeview active">
              <a href="#">
                <i class="fa fa-plus-square"></i> <span>Kategori Yönetimi</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
				<li><a href="<?php echo SITE_URL; ?>/AdminKategori/ana_kategori_ekle"><i class="fa fa-circle-o"></i>Ana Kategori Ekle</a></li>
				<li><a href="<?php echo SITE_URL; ?>/AdminKategori/ana_kategoriler"><i class="fa fa-circle-o"></i>Ana Kategori İşlemleri</a></li>
				<li><a href="<?php echo SITE_URL; ?>/AdminKategori/alt_kategori_ekle"><i class="fa fa-circle-o"></i>Alt Kategori Ekle</a></li>
				<li><a href="<?php echo SITE_URL; ?>/AdminKategori/alt_kategoriler"><i class="fa fa-circle-o"></i>Alt Kategori İşlemleri</a></li>

				
              </ul>
            </li>
			
			<!--
			<li>
              <a href="<?php echo SITE_URL; ?>/AdminKategori/kategori_arsivleri">
                <i class="fa fa-archive"></i>
                <span>Kategori Arşivleri</span><i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>
			-->
			
			<li class="treeview active">
              <a href="#">
                <i class="fa fa-plus-square"></i> <span>Makale Yönetimi</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
				<li><a href="<?php echo SITE_URL; ?>/AdminMakale/makale_ekle"><i class="fa fa-circle-o"></i>Yeni Makale Ekle</a></li>
				<li><a href="<?php echo SITE_URL; ?>/AdminMakale/makaleler"><i class="fa fa-circle-o"></i>Makale İşlemleri</a></li>

				
              </ul>
            </li>
			
			<li class="treeview active">
              <a href="#">
                <i class="fa fa-plus-square"></i> <span>Footer Yönetimi</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
				<li><a href="<?php echo SITE_URL; ?>/AdminFooter/blok_ekle"><i class="fa fa-circle-o"></i>Footer Bloğu Ekle</a></li>
				<li><a href="<?php echo SITE_URL; ?>/AdminFooter/bloklar"><i class="fa fa-circle-o"></i>Footer Blok Listesi</a></li>
				<li><a href="<?php echo SITE_URL; ?>/AdminFooter/link_ekle"><i class="fa fa-circle-o"></i>Blok İçi Link Ekle</a></li>
				<li><a href="<?php echo SITE_URL; ?>/AdminFooter/linkler"><i class="fa fa-circle-o"></i>Blok İçi Link Listesi</a></li>
				
              </ul>
            </li>
			
			<li>
              <a href="<?php echo SITE_URL; ?>/admin/site_ayarlari">
                <i class="fa fa-gears"></i>
                <span>Site Ayarları Yönetimi</span><i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>
			
			
			
			<li>
              <a href="<?php echo SITE_URL; ?>/AdminSlider/Slider">
                <i class="fa fa-image"></i>
                <span>Slider Resimleri</span><i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>
			
			<li>
              <a href="<?php echo SITE_URL; ?>/AdminUye/bireysel_uyeler">
                <i class="fa fa-user"></i>
                <span>Bireysel Üyeler</span><i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>
			<li>
              <a href="<?php echo SITE_URL; ?>/AdminUye/firma_uyeler">
                <i class="fa fa-users"></i>
                <span>Firma Üyeler</span><i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>
			
			<li>
              <a href="<?php echo SITE_URL; ?>/AdminEbulten/ebulten">
                <i class="fa fa-list"></i>
                <span>E-Bülten Listesi</span><i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>
			
			<li>
              <a href="<?php echo SITE_URL; ?>/AdminSosyalMedyaLink/sosyal_medya_linkleri">
                <i class="fa fa-link"></i>
                <span>Sosyal Medya Linkleri</span><i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>
			
			<li>
              <a href="<?php echo SITE_URL; ?>/AdminTopluMail/mail_gonder">
                <i class="fa fa-envelope-o"></i>
                <span>Toplu Mail Yönetimi</span><i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>
			
			<li>
              <a href="<?php echo SITE_URL; ?>/AdminReklam/Reklam">
                <i class="fa fa-line-chart"></i>
                <span>Reklam Yönetimi</span><i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>
			
			
			<li>
              <a href="<?php echo SITE_URL; ?>/admin/cikis">
                <i class="fa fa-close"></i>
                <span>Çıkış Yap</span><i class="fa fa-angle-left pull-right"></i>
                <!--<span class="label label-primary pull-right">4</span>-->
              </a>
              
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">