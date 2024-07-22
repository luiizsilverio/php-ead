<?php include "lib/conexao.php";

$id = intval($_GET['id']);

$sql = "SELECT imagem FROM cursos WHERE id = $id";

$result = $mysqli->query($sql) or die($mysqli->error);

if (!$result)
    $erros[] = "Falha ao buscar no banco de dados: " . $mysqli->error;

else {
  $curso = $result->fetch_assoc();

  if ($result->num_rows == 0)
    die("Curso não localizado");
  else {
    unlink($curso['imagem']);    
    $mysqli->query("DELETE FROM cursos WHERE id = $id") or die($mysqli->error);
  }

  die('<script>location.href="index.php?p=gerenciar_cursos";</script>');

}

?>
