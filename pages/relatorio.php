<?php 
  include "lib/conexao.php"; 
  include "lib/protect.php";

  protect(1); // somente Admin (1) pode acessar essa página
  
  $sql = "SELECT R.*, C.titulo, U.nome FROM relatorio AS R 
          JOIN cursos AS C ON C.id = R.id_curso
          JOIN usuarios AS U on U.id = R.id_usuario
          ORDER BY U.nome, C.titulo";

  $result = $mysqli->query($sql) or die($mysqli->error);
  $qtd_cursos = $result->num_rows;

?>

<div class="page-header card">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4>Relatório</h4>
                    <span>Visualize os gastos do usuário</span>
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
                    <li class="breadcrumb-item"><a href="#">Relatório</a></li>
                </ul>
            </div>
        </div>
    </div>
  </div>

  <div class="page-body">
      <div class="row">
          <div class="col-sm-12">
            <div class="card">

              <div class="card-header">
                <h5>Todos os Cursos do Usuário</h5>
                <div class="card-header-right">    
                  <ul class="list-unstyled card-option">        
                    <li><i class="icofont icofont-simple-left "></i></li>        
                    <li><i class="icofont icofont-maximize full-card"></i></li>        
                    <li><i class="icofont icofont-minus minimize-card"></i></li>        
                    <li><i class="icofont icofont-refresh reload-card"></i></li>        
                    <li><i class="icofont icofont-error close-card"></i></li>    
                  </ul>
                </div>
              </div>
                             
                <div class="card-block table-border-style">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Usuário</th>
                                  <th>Curso</th>
                                  <th>Dt. Compra</th>
                                  <th>Valor</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php if ($qtd_users == 0) { ?>
                                <tr>
                                  <td colspan="6">Nenhum curso foi comprado</td>
                                </tr>                                 
                              <?php } else { 
                                while ($curso = $result->fetch_assoc()) { 
                                  $dtcad = $curso['dt_compra'];
                                  if (!empty($dtcad))
                                    $dtcad = date('d/m/Y H:i', strtotime($dtcad));    
                              ?>
                                  <tr>
                                    <th scope="row"><?= $curso['id']; ?></th>
                                    <td><?= $curso['nome']; ?></td>
                                    <td><?= $curso['titulo']; ?></td>
                                    <td><?= $dtcad; ?></td>
                                    <td>R$ <?= number_format($curso['valor'], 2, ',', '.'); ?></td>
                                  </tr>
                              <?php }} ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>                  
          </div>
      </div>
  </div>