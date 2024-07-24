<?php 
  include "lib/conexao.php";
  include "lib/protect.php";

  protect(0); // Usuário normal (0) pode acessar essa página

  $id_curso = intval($_GET['id']);
  $id_user = $_SESSION['user_id'];

  $sql = "SELECT * FROM cursos WHERE id = {$id_curso} AND id IN (
          SELECT id_curso FROM relatorio WHERE id_usuario = {$id_user})";

  $result = $mysqli->query($sql) or die("Falha ao buscar no BD: " . $mysqli->error);

  $curso = $result->fetch_assoc();
?>

<div class="page-header card">
    <div class="row align-items-end">
        <div class="col-lg-6">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4><?= $curso['titulo']; ?></h4>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="index.php">
                            <i class="icofont icofont-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item"><a href="index.php?p=meus_cursos">Meus Cursos</a></li>
                    <li class="breadcrumb-item"><a href="#">Assistir Curso</a></li>
                </ul>
            </div>
        </div>
    </div>
  </div>

  <div class="page-body">
      <div class="row">
          <div class="col-sm-12">
              <div class="card">
                  <div class="card-block">
                    <p><?= $curso['conteudo']; ?></p>
                  </div>
              </div>
          </div>
      </div>
  </div>