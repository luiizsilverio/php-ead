<?php 

  include "lib/conexao.php";
  include "lib/protect.php";

  protect(1); // somente Admin (1) pode acessar essa página
  
  $id = intval($_GET['id']);

  $mysqli->query("DELETE FROM usuarios WHERE id = $id") or die($mysqli->error);

  die('<script>location.href="index.php?p=gerenciar_usuarios";</script>');


?>
