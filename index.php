<?php 

  include "lib/protect.php";
  include "lib/conexao.php";

  protect(0); // Usuário normal (0) pode acessar essa página

  $pagina = 'inicial.php';

  if (isset($_GET['p'])) {
      $pagina = $_GET['p'] . ".php";
  }

  $id_user = $_SESSION['user_id'];
  $sql = "SELECT * FROM usuarios WHERE id = $id_user";
  $result = $mysqli->query($sql) or die($mysqli->error);
  $usuario = $result->fetch_assoc();  

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>My-EAD | Início</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="description" content="CodedThemes">
    <meta name="keywords" content="flat ui, admin  Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="CodedThemes">
    <!-- Favicon icon -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <!-- Google font--><link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/css/bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="assets/icon/icofont/css/icofont.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">
</head>

<body>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
            </div>
        </div>
    </div>
    
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">

                    <div class="navbar-logo">
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="ti-menu"></i>
                        </a>
                        <a class="mobile-search morphsearch-search" href="#">
                            <i class="ti-search"></i>
                        </a>
                        <a href="index.php">
                            <img class="img-fluid" src="assets/images/logo.png" width="150" alt="Theme-Logo" />
                        </a>
                        <a class="mobile-options">
                            <i class="ti-more"></i>
                        </a>
                    </div>

                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li>
                                <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                            </li>
                            
                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">
                            <?php if (!isset($_SESSION['user_adm']) || !$_SESSION['user_adm']) { ?>
                              <li class="header-notification">
                                  <a href="#!">
                                      <i class="ti-money"></i>
                                      <span class="badge bg-c-pink"></span><?php echo number_format($usuario['creditos'], 2, ',', '.'); ?>
                                  </a>
                              </li>
                            <?php } ?>

                            <li class="user-profile header-notification">
                              <?php if (isset($_SESSION['user_name'])) { ?>
                                <a href="#!">
                                  <!-- <img src="assets/images/avatar-4.jpg" class="img-radius" alt="User-Profile-Image"> -->
                                  <span><?= $_SESSION['user_name']; ?></span>
                                  <i class="ti-angle-down"></i>
                                </a>
                              <?php } ?>  

                                <ul class="show-notification profile-notification">
                                    
                                    <li>
                                        <a href="index.php?p=perfil">
                                            <i class="ti-user"></i> Perfil
                                        </a>
                                    </li>
                                    
                                    <li>
                                        <a href="logout.php">
                                            <i class="ti-layout-sidebar-left"></i> Sair
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        
                    </div>
                </div>
            </nav>

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar">
                        <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                        
                        <div class="pcoded-inner-navbar main-menu">   

                          <?php if (!isset($_SESSION['user_adm']) || !$_SESSION['user_adm']) { ?>                     
                            <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Menu</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="">
                                    <a href="index.php">
                                        <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Página Inicial</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="index.php?p=loja_cursos">
                                        <span class="pcoded-micon"><i class="ti-bag"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Loja de Cursos</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="index.php?p=meus_cursos">
                                        <span class="pcoded-micon"><i class="ti-control-play"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Meus Cursos</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="logout.php">
                                        <span class="pcoded-micon"><i class="ti-layout-sidebar-left"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Sair</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>

                          <?php } else { ?>                       
                            
                            <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Menu</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="">
                                    <a href="index.php">
                                        <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Página Inicial</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="index.php?p=gerenciar_cursos">
                                        <span class="pcoded-micon"><i class="ti-bag"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Gerenciar Cursos</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="index.php?p=gerenciar_usuarios">
                                        <span class="pcoded-micon"><i class="ti-user"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Gerenciar Usuários</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="index.php?p=relatorio">
                                        <span class="pcoded-micon"><i class="ti-file"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Relatório</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="logout.php">
                                        <span class="pcoded-micon"><i class="ti-layout-sidebar-left"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Sair</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>
                          <?php } ?>                       

                        </div>
                    </nav>

                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">

                            <div class="main-body">
                                <div class="page-wrapper">
                                    
                                    <?php include "pages/$pagina"; ?>

                                </div>
                            </div>
                            <div id="styleSelector">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- Required Jquery -->
<script type="text/javascript" src="assets/js/jquery/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="assets/js/popper.js/popper.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap/js/bootstrap.min.js"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="assets/js/jquery-slimscroll/jquery.slimscroll.js"></script>
<!-- modernizr js -->
<script type="text/javascript" src="assets/js/modernizr/modernizr.js"></script>
<script type="text/javascript" src="assets/js/modernizr/css-scrollbars.js"></script>
<!-- classie js -->
<script type="text/javascript" src="assets/js/classie/classie.js"></script>
<!-- Custom js -->
<script type="text/javascript" src="assets/js/script.js"></script>
<script src="assets/js/pcoded.min.js"></script>
<script src="assets/js/demo-12.js"></script>
<script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
</body>

</html>
