<?php
  session_start();
  include("../include/db_connect.php");
  $conn = connect();

if (isset($_POST['phone']) && isset($_POST['password'])) {
  $sql = "select * from users where phone = '".$_POST['phone']."' and password = '".$_POST['password']."'";
  $result = $conn->query($sql);
  $num = $result->num_rows;
  if($num == 1){
    foreach ($result as $rows) {
      $_SESSION['id_card']  = $rows['id_card'];
      $_SESSION['name']  = $rows['name']." ".$rows['lastname'];
      $_SESSION['type']  = $rows['user_type_id'];
      $_SESSION['email']  = $rows['email'];
      $_SESSION['phone']  = $rows['phone'];
    }
      echo "1";
  }else {
      echo "0";
    }
}
?>
