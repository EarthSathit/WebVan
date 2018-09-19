<?php
include("include/db.php");
include("include/exec.php");

$db = new Database();
$str_conn = $db->getConnection();
$str_exe = new ExecSQL($str_conn);
$action = $_GET['cmd'];
switch($action){
    case "select":
    $stmt = $str_exe->readAll("initial");
    $num_row = $str_exe->rowCount("initial");
    //echo json_encode($num_row);
    if ($num_row > 0){
        $data_arr['rs'] = array();
        foreach($stmt as $row){
            $item = array(
                'initial_id' => $row['initial_id'],
                'name' => $row['name'],
            );
            array_push($data_arr['rs'], $item);
        }
            echo json_encode($data_arr);
    }else{
        echo json_encode(array('msg' => 'result not format'));
    }
    break;

    case 'insert' :
    $name = $_GET['name'];

    $strSQL = $str_exe->insert("initial",
    "initial_id, name",
    "NULL, '$name'");
    if($strSQL){
      echo json_encode(array('msg' => 'Insert Success'));
    }else {
      echo json_encode(array('msg' => 'Can not Insert'));
    }
    break;

    case 'update' :
    $initial_id = $_GET['initial_id'];
    $name = $_GET['name'];

    $stmt = $str_exe->update("initial"
    ," name = '$name'", "where initial_id = ".$initial_id);
    if($stmt){
      echo json_encode(array('msg' => 'Update Success'));
    }else {
      echo json_encode(array('msg' => 'Can not Update'));
    }
    break;


    case 'delete' :
    $initial_id = $_GET['initial_id'];
    $stmt = $str_exe->readOne("DELETE FROM", "initial", "WHERE initial_id = ".$initial_id);
    if($stmt){
      echo json_encode(array('msg' => 'Delete Success'));
    }
    else{
      echo json_encode(array('msg' => 'Can not Delete'));
    }
    break;
}
?>
