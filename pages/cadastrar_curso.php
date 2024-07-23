<?php 

  if (isset($_POST['enviar'])) {
    include "lib/conexao.php";
    include "lib/enviarArquivo.php";

    $titulo     = $mysqli->real_escape_string($_POST['titulo']);
    $desc_curta = $mysqli->real_escape_string($_POST['descricao_curta']);
    $preco      = $mysqli->real_escape_string($_POST['preco']);
    $conteudo   = $mysqli->real_escape_string($_POST['conteudo']);

    $erros = [];
    if (empty($titulo)) 
      $erros[] = "Informe o título";

    if (empty($desc_curta))
      $erros[] = "Informe a descrição";

    if (empty($preco))
      $erros[] = "Informe o preço";

    if (empty($conteudo))
      $erros[] = "Informe o conteúdo";

    if (!isset($_FILES) || !isset($_FILES['imagem']) || $_FILES['imagem']['size'] == 0) 
      $erros[] = "Selecione uma imagem para o curso";

    if (count($erros) == 0) {
      $path = enviarArquivo($_FILES['imagem']['error'], $_FILES['imagem']['size'], $_FILES['imagem']['name'], $_FILES['imagem']['tmp_name']);

      if ($path !== false) {
        $sql = "INSERT INTO cursos (titulo, descricao_curta, conteudo, preco, imagem) VALUES (
                  '$titulo', 
                  '$desc_curta', 
                  '$conteudo', 
                   $preco, 
                  '$path'
                )";

        $deu_certo = $mysqli->query($sql);

        if (!$deu_certo)
          $erros[] = "Falha ao inserir no banco de dados: " . $mysqli->error;
        else
          die('<script>location.href="index.php?p=gerenciar_cursos";</script>');
      } else
        $erros[] = "Falha ao enviar a imagem";
    }
  }
?>
  
  <div class="page-header card">
    <div class="row align-items-end">
        <div class="col-lg-6">
          <div class="page-header-title">
            <div class="d-inline">
              <h4>Cadastrar Curso</h4>
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
              <li class="breadcrumb-item"><a href="index.php?p=gerenciar_cursos">Gerenciar Cursos</a></li>
              <li class="breadcrumb-item"><a href="#">Cadastrar Curso</a></li>
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
          <form action="" method="post" enctype="multipart/form-data">
            <div class="card-block row">
              <div class="form-group col-lg-5">
                  <label for="titulo">Título</label>
                  <input type="text" class="form-control" id="titulo" name="titulo" value="<?= $titulo; ?>" />
              </div>
              <div class="form-group col-lg-7">
                  <label for="descricao_curta">Descrição</label>
                  <input type="text" class="form-control" id="descricao_curta" name="descricao_curta" value="<?= $desc_curta; ?>" />
              </div>
              <div class="form-group col-lg-8">
                  <label for="imagem">Imagem</label>
                  <input type="file" class="form-control" id="imagem" name="imagem" />
              </div>
              <div class="form-group col-lg-4">
                  <label for="preco">Preço</label>
                  <input type="text" class="form-control" id="preco" name="preco" value="<?= $preco; ?>" />
              </div>
              <div class="form-group col-lg-12">
                  <label for="conteudo">Conteúdo</label>
                  <textarea class="form-control no-resize" id="conteudo" name="conteudo" rows="7" value="<?= $conteudo; ?>"></textarea>
              </div>
              <div class="col-lg-12">
                <a href="index.php?p=gerenciar_cursos" class="btn btn-primary mr-2" type="button">
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