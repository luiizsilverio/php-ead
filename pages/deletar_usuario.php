<?php include "lib/conexao.php";

  $id = intval($_GET['id']);

  $mysqli->query("DELETE FROM usuarios WHERE id = $id") or die($mysqli->error);

  die('<script>location.href="index.php?p=gerenciar_usuarios";</script>');


?>
