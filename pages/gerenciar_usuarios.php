<?php 

  include "lib/conexao.php"; 
  include "lib/protect.php";

  protect(1); // somente Admin (1) pode acessar essa página
  
  $sql = "SELECT * FROM usuarios";
  $result = $mysqli->query($sql) or die($mysqli->error);
  $qtd_users = $result->num_rows;

?>

<div class="page-header card">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4>Gerenciar Usuários</h4>
                    <span>Administre os usuários cadastrados no sistema</span>
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
                    <li class="breadcrumb-item"><a href="#">Gerenciar Usuários</a></li>
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
                <h5>Todos os Usuários</h5>
                <span><a href="index.php?p=cadastrar_usuario">Clique aqui</a> para cadastrar um usuário</span>
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
                                  <th>Nome</th>
                                  <th>E-mail</th>
                                  <th>Crédito</th>
                                  <th>Dt. Cadastro</th>
                                  <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php if ($qtd_users == 0) { ?>
                                <tr>
                                  <td colspan="6">Nenhum usuário foi cadastrado</td>
                                </tr>                                 
                              <?php } else { 
                                while ($user = $result->fetch_assoc()) { 
                                  $dtcad = $user['dt_cadastro'];
                                  if (!empty($dtcad))
                                    $dtcad = date('d/m/Y H:i', strtotime($dtcad));    
                              ?>
                                  <tr>
                                    <th scope="row"><?= $user['id']; ?></th>
                                    <td><?= $user['nome']; ?></td>
                                    <td><?= $user['email']; ?></td>
                                    <td>R$ <?= number_format($user['creditos'], 2, ',', '.'); ?></td>
                                    <td><?= $dtcad; ?></td>
                                    <td>
                                      <a href="index.php?p=editar_usuario&id=<?= $user['id']; ?>">editar</a> | 
                                      <a href="index.php?p=deletar_usuario&id=<?= $user['id']; ?>">deletar</a>
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