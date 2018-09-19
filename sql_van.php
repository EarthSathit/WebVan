<?php
  include("../include/db.php");
  include("../exec.php");

  $db = new Database();
  $str_conn = $db->getConnection();
  $str_exec = new ExecSQL($str_conn);
  $action = $_GET['cmd'];

  switch($action){
    case "select" :
    $stmt = $str_exec->readAll("vans");
    $num_row = $str_exec->rowCount("vans");
    if ($num_row != 0) {
      foreach ($stmt as $rows) {
        $van_id = $rows['van_id'];
        $brand_id = $rows['brand_id'];
        $seat = $rows['seat'];
        $id_card = $rows['id_card'];
        $img_van = $rows['img_van'];
      }
    }
  }
?>
