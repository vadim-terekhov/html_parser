<?php
  if ($_GET['graph']=='no'){
      echo "<div class=\"alert alert-warning\">не выбран файл для построения графика</div>";
  }
  if ($_GET['graph']=='yes'){
    $res_str = $_GET['resstr'];
  }

  require_once (__DIR__."/header.php");
  require_once (__DIR__."/content.php");
  require_once (__DIR__."/footer.php");
?>
