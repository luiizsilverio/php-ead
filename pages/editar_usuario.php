<?php include "lib/conexao.php";

  $id = intval($_GET['id']);
  $sql = "SELECT * FROM usuarios WHERE id = {$id}";

  $result = $mysqli->query($sql);

  if (!$result)
    $erros[] = "Falha ao buscar no banco de dados: " . $mysqli->error;

  else {
    $user = $result->fetch_assoc();

    if ($result->num_rows == 0)
      $erros[] = "Usuário não localizado";
    else {
      $nome     = $user['nome'];
      $email    = $user['email'];
      $creditos = $user['creditos'];
      $senha    = $user['senha'];
      $admin    = $user['admin'];
    }
  }


  if (isset($_POST['enviar'])) {
    $nome     = $mysqli->real_escape_string($_POST['nome']);
    $email    = $mysqli->real_escape_string($_POST['email']);
    $creditos = $mysqli->real_escape_string($_POST['creditos']);
    $senha    = $mysqli->real_escape_string($_POST['senha']);
    $senha2   = $mysqli->real_escape_string($_POST['senha2']);
    $admin    = $mysqli->real_escape_string($_POST['admin']);

    $erros = [];
    if (empty($nome)) 
      $erros[] = "Informe o nome";

    if (empty($email))
      $erros[] = "Informe o e-mail";

    if (empty($creditos)) $creditos = 0;

    if ($senha != $senha2) {
        $erros[] = "Senhas não conferem";
    }

    if (count($erros) == 0) {
      
      if (!empty($senha)) {
        $hash = password_hash($senha, PASSWORD_DEFAULT);
        $sql_senha = "senha = '$hash', ";
      } else {
        $sql_senha = "";
      }
      
      $sql = "UPDATE usuarios SET 
                nome = '$nome', 
                email = '$email', 
                {$sql_senha}
                creditos = '$creditos',
                admin = '$admin'
              WHERE id = $id";

      $deu_certo = $mysqli->query($sql);
      
      if (!$deu_certo)
        $erros[] = "Falha ao inserir no banco de dados: " . $mysqli->error;
      else
        die('<script>location.href="index.php?p=gerenciar_usuarios";</script>');
    }
  }
?>

  
  <div class="page-header card">
    <div class="row align-items-end">
        <div class="col-lg-6">
          <div class="page-header-title">
            <div class="d-inline">
              <h4>Editar Usuário</h4>
              <span>Preencha as informações e clique em Salvar</span>
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
              <li class="breadcrumb-item"><a href="index.php?p=gerenciar_usuarios">Gerenciar Usuários</a></li>
              <li class="breadcrumb-item"><a href="#">Editar Usuário</a></li>
            </ul>
          </div>
        </div>
    </div>
  </div>

  <div class="page-body">
    <div class="row">
      <div class="col-sm-12">

        <?php if (isset($erros) && count($erros) > 0) { ?>
          <div class="alert alert-danger">
            <?= implode('<br>', $erros); ?>
          </div>
        <?php } ?>

        <div class="card">
          <div class="card-header"><h5>Formulário de Cadastro</h5></div>
          <form action="" method="post">
            <div class="card-block row">
              <div class="form-group col-lg-6">
                  <label for="nome">Nome</label>
                  <input type="text" class="form-control" id="nome" name="nome" value="<?= $nome; ?>" />
              </div>
              <div class="form-group col-lg-6">
                  <label for="email">E-mail</label>
                  <input type="email" class="form-control" id="email" name="email" value="<?= $email; ?>" />
              </div>
              <div class="form-group col-lg-6">
                  <label for="senha">Senha</label>
                  <input type="password" class="form-control" id="senha" name="senha" />
              </div>
              <div class="form-group col-lg-6">
                  <label for="senha2">Repita a Senha</label>
                  <input type="password" class="form-control" id="senha2" name="senha2" />
              </div>
              <div class="form-group col-lg-6">
                  <label for="creditos">Crédito</label>
                  <input type="text" class="form-control" id="creditos" name="creditos" value="<?= $creditos; ?>" />
              </div>
              <div class="form-group col-lg-4">
                  <label for="admin">Tipo</label>
                  <select name="admin" id="admin" class="form-control">
                    <option value="0" <?php echo $admin == "1" ? "" : "selected"; ?>>Usuário</option>
                    <option value="1" <?php echo $admin == "1" ? "selected" : ""; ?>>Administrador</option>
                  </select>
              </div>
              <div class="col-lg-12">
                <a href="index.php?p=gerenciar_usuarios" class="btn btn-primary mr-2" type="button">
                  <i class="ti-arrow-left"></i>Voltar
                </a>
                <button class="btn btn-success" type="submit" name="enviar">
                  <i class="ti-save"></i>Salvar
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>