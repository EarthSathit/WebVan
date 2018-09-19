<?php
include("include/db.php");
include("include/exec.php");

$db = new Database();
$str_conn = $db->getConnection();
$str_exe = new ExecSQL($str_conn);
$action = $_POST['cmd'];
switch($action){
    case "select":
    if (isset($_POST['phone'])) {
      $stmt = $str_exe->readAll("users where phone = '".$_POST['phone']."'");
    } else {
      $stmt = $str_exe->readAll("users");
    }
    $num_row = $str_exe->rowCount("users");
    //echo json_encode($num_row);
    if ($num_row > 0){
        $data_arr['rs'] = array();
        foreach($stmt as $row){
            $item = array(
                'id_card' => $row['id_card'],
                'initial_id' => $row['initial_id'],
                'name' => $row['name'],
                'lastname' => $row['lastname'],
                'email' => $row['email'],
                'phone' => $row['phone'],
                'password' => $row['password'],
                'user_type_id' => $row['user_type_id'],
            );
            array_push($data_arr['rs'], $item);
        }
            echo json_encode($data_arr);
    }else{
        echo json_encode(array('msg' => 'result not format'));
    }
    break;

    case 'insert' :
    /*$id_card = $_POST['id_card'];
    $initial_id = $_POST['initial_id'];*/
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    /*$password = $_POST['password'];
    $user_type_id = $_POST['user_type_id'];*/

    $strSQL = $str_exe->insert("users",
    "id_card, initial_id, name, lastname, email, phone, password, user_type_id",
    "NULL, NULL, '$name', '$lastname', '$email', '$phone', NULL, NULL");
    if($strSQL){
      echo json_encode(array('msg' => 'Insert Success'));
    }else {
      echo json_encode(array('msg' => 'Can not Insert'));
    }
    break;

    case 'update' :
    $id_card = $_GET['id_card'];
    $initial_id = $_GET['initial_id'];
    $name = $_GET['name'];
    $lastname = $_GET['lastname'];
    $email = $_GET['email'];
    $phone = $_GET['phone'];
    $password = $_GET['password'];
    $user_type_id = $_GET['user_type_id'];

    $stmt = $str_exe->update("users"
    ," initial_id = '$initial_id', name = '$name', lastname = '$lastname', email = '$email',
     phone = '$phone', password = '$password', user_type_id = '$user_type_id'", "where id_card = ".$id_card);
    if($stmt){
      echo json_encode(array('msg' => 'Update Success'));
    }else {
      echo json_encode(array('msg' => 'Can not Update'));
    }
    break;


    case 'delete' :
    $id_card = $_GET['id_card'];
    $stmt = $str_exe->readOne("DELETE FROM", "users", "WHERE id_card = ".$id_card);
    if($stmt){
      echo json_encode(array('msg' => 'Delete Success'));
    }
    else{
      echo json_encode(array('msg' => 'Can not Delete'));
    }
    break;
}
?>
