<?php
  include("include/db_connect.php");
  $conn = connect();

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "select * from users where phone = '".$_POST['phone']."'";
    $result = $conn->query($sql);
    $num = $result->num_rows;
    if($num == 1){
      $list['user'] = array();
      foreach ($result as $rows) {
        $login = array();
        $login['id_card'] = $rows['id_card'];
        $login['name'] = $rows['name']." ".$rows['lastname'];
        $login['user_type_id'] = $rows['user_type_id'];
        $login['email'] = $rows['email'];
        $login['phone'] = $rows['phone'];

        array_push($list['user'], $login);
      }
        $list['error'] = 1;
        echo json_encode($list);
    }else {
        $list['error'] = null;
        echo json_encode($list);
      }
  }
 ?>
