<?php

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "lib/conexao.php";

    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $erros = [];
  
    if (empty($email))
      $erros[] = "Informe o e-mail";

    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
      $erros[] = 'E-mail inválido';
    
    if (empty($senha))
      $erros[] = "Informe a senha";    

    if (count($erros) == 0) {
      $email = $mysqli->real_escape_string($_POST['email']);
      $senha = $mysqli->real_escape_string($_POST['senha']);

      $sql = $mysqli->query("SELECT * FROM usuarios WHERE email = '$email'") or die($mysqli->error);
      
      $user = $sql->fetch_assoc();

      if (password_verify($senha, $user['senha'])) {
        if (!isset($_SESSION)) 
          session_start();
        $_SESSION['user_id']    = $user['id'];
        $_SESSION['user_name']  = $user['nome'];
        $_SESSION['user_adm']   = $user['admin'];
        header("Location: index.php");        
      } else {
        $erros[] = "Senha incorreta";
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <title>My-EAD | Login</title>
    <!-- HTML5 Shim and Respond.js IE9 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="CodedThemes">
    <meta name="keywords" content=" Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="CodedThemes">
    <!-- Favicon icon -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/css/bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="assets/icon/icofont/css/icofont.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>

<body class="fix-menu">
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

    <section class="login p-fixed d-flex text-center bg-primary common-img-bg">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    <div class="login-card card-block auth-body mr-auto ml-auto">
                        <form method="POST" class="md-float-material">
                            <div class="text-center">
                                <img src="assets/images/logo_preto.png" height="70" alt="logo.png">
                            </div>

                            <div class="auth-box">
                              <?php if (isset($erros) && count($erros) > 0) { ?>
                                <div class="alert alert-danger">
                                  <?= implode('<br>', $erros); ?>
                                </div>
                              <?php } ?>
                            
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-left txt-primary">Entrar</h3>
                                    </div>
                                </div>
                                <hr/>
                                <div class="input-group">
                                    <input type="email" name="email" class="form-control" placeholder="Seu e-mail" value="<?= $email; ?>">
                                    <span class="md-line"></span>
                                </div>
                                <div class="input-group">
                                    <input type="password" name="senha" class="form-control" placeholder="Sua senha">
                                    <span class="md-line"></span>
                                </div>
                                <div class="row m-t-25 text-left">                                    
                                    <div class="col-sm-12 col-xs-12 forgot-phone text-right">
                                        <a href="resetar_senha.php" class="text-right f-w-600 text-inverse text-info"> 
                                            Esqueceu sua senha?
                                        </a>
                                    </div>
                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit" name="acessar" 
                                          class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">
                                          Acessar
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </form>
                        <!-- end of form -->
                    </div>
                    <!-- Authentication card end -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>
   
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
    <script type="text/javascript" src="assets/js/common-pages.js"></script>
</body>

</html>
