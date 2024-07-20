<?php include "lib/conexao.php"; 

  $sql_cursos = "SELECT * FROM cursos";
  $result = $mysqli->query($sql_cursos) or die($mysqli->error);
  $qtd_cursos = $result->num_rows;



?>

<div class="page-header card">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4>Gerenciar Cursos</h4>
                    <span>Administre os cursos cadastrados no sistema</span>
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
                    <li class="breadcrumb-item"><a href="#">Gerenciar Cursos</a></li>
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
                <h5>Todos os Cursos</h5>
                <span><a href="index.php?p=cadastrar_curso">Clique aqui</a> para cadastrar um curso</span>
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
                                  <th>Imagem</th>
                                  <th>Título</th>
                                  <th>Preço</th>
                                  <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php if ($qtd_cursos == 0) { ?>
                                <tr>
                                  <td colspan="5">Nenhum curso foi cadastrado</td>
                                </tr>                                 
                              <?php } else { 
                                while ($curso = $result->fetch_assoc()) { ?>
                                  <tr>
                                    <th scope="row"><?= $curso['id']; ?></th>
                                    <td>
                                      <img src="upload/<?= $curso['imagem']; ?>" height="50" alt="">
                                    </td>
                                    <td><?= $curso['titulo']; ?></td>
                                    <td>R$ <?= number_format($curso['preco'], 2, ',', '.'); ?></td>
                                    <td>
                                      <a href="index.php?p=editar_curso&id=<?= $curso['id']; ?>">editar</a> | 
                                      <a href="index.php?p=deletar_curso&id=<?= $curso['id']; ?>">deletar</a>
                                    </td>
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