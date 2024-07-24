
<?php

  include "lib/conexao.php";
  
  protect(0); // Usuário normal (0) pode acessar essa página

  if (!isset($_SESSION)) session_start();

  $id_user = $_SESSION['user_id'];

  $sql = "SELECT C.* FROM cursos C JOIN relatorio R ON R.id_curso = C.id WHERE R.id_usuario = $id_user";

  $result = $mysqli->query($sql) or die($mysqli->error);

?>

<div class="page-header card">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4>Meus Cursos</h4>
                    <span>Estes são os cursos que você já possui</span>
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
                    <li class="breadcrumb-item"><a href="#">Meus Cursos</a></li>
                </ul>
            </div>
        </div>
    </div>
  </div>

  <div class="page-body">
      <div class="row">

        <?php while ($curso = $result->fetch_assoc()) { ?>

            <div class="col-sm-4">
              <div class="card">
                  <div class="card-header">
                      <h5><?= $curso['titulo']; ?></h5>
                  </div>
                  <div class="card-block text-center">
                      <img src="<?= $curso['imagem']; ?>" class="img-fluid mb-3" alt="">
                      <p><?= $curso['descricao_curta']; ?></p>
                      <form action="index.php">
                        <input type="hidden" name="p" value="assistir">
                        <input type="hidden" name="id" value="<?= $curso['id']; ?>">
                        <button type="submit" class="btn btn-out-dashed btn-primary btn-square form-control">Assistir</button>
                      </form>
                  </div>
                </div>
            </div>

        <?php } ?>

          </div>
      </div>
  </div>