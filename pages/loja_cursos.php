<?php include "lib/conexao.php";

  if (!isset($_SESSION)) session_start();

  $id_user = $_SESSION['user_id'];

  $sql = "SELECT * FROM cursos 
          WHERE id NOT IN (
          SELECT id_curso FROM relatorio 
          WHERE id_usuario = $id_user )";

  $result = $mysqli->query($sql) or die($mysqli->error);

  if (isset($_POST['comprar'])) {

    $id_curso = $_POST['comprar'];
    $id_user = $_SESSION['user_id'];
    
    $sql = "SELECT creditos FROM usuarios WHERE id = $id_user";      
    $result = $mysqli->query($sql) or die($mysqli->error);
    $user = $result->fetch_assoc();
    $credito = intval($user['creditos']);

    $sql = "SELECT preco FROM cursos WHERE id = $id_curso";
    $result = $mysqli->query($sql) or die($mysqli->error);
    $curso = $result->fetch_assoc();
    $preco = $curso['preco'];
    $erro = false;

    if ($preco > $credito) {
      $erro = "Você não tem crédito suficiente para adquirir este curso";
    } else {
      $sql = "INSERT INTO relatorio (id_usuario, id_curso, valor, data_compra) VALUES (
                '$id_user',
                '$id_curso',
                '$preco'
              )";

      $mysqli->query($sql) or die($mysqli->error);

      $novo_credito = ($credito - $preco);
      $sql = "UPDATE usuarios SET creditos = {$novo_credito} WHERE id = $id_user";
      $result = $mysqli->query($sql) or die($mysqli->error);


      die("<script>location.href='index.php?p=meus_cursos';</script>");
    }      
  }

?>
  
  <div class="page-header card">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4>Loja de Cursos</h4>
                    <span>Adquira nossos cursos usando o seu crédito</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="index.php">
                            <i class="icofont icofont-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#">Loja de Cursos</a></li>
                </ul>
            </div>
        </div>
    </div>
  </div>

  <div class="page-body">
    <div class="row">
        
      <?php if ($erro != false) { ?>
        <div class="col-sm-12">
          <div class="alert alert-danger"><?= $erro; ?></div>
        </div>
      <?php } ?>
     
      <?php while ($curso = $result->fetch_assoc()) { ?>
          <div class="col-sm-4">
            <div class="card">
              <div class="card-header">
                  <h5><?= $curso['titulo']; ?></h5>
              </div>
              <div class="card-block text-center">
                  <img src="<?= $curso['imagem']; ?>" class="img-fluid mb-3" style="max-height: 160px" alt="">
                  <p><?= $curso['descricao_curta']; ?></p>
                  <form action="" method="post">
                    <button 
                      type="submit" 
                      name="comprar" 
                      value="<?= $curso['id']; ?>"
                      class="btn btn-out-dashed btn-success btn-square form-control"
                    >
                      Comprar por R$ <?= number_format($curso['preco'], 2, ',', '.'); ?>
                    </button>
                  </form>
              </div>
            </div>
          </div>          
      <?php } ?>

    </div>
  </div>