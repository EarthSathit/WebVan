<?php
include("include/db.php");
include("include/exec.php");

$db = new Database();
$str_conn = $db->getConnection();
$str_exe = new ExecSQL($str_conn);
$action = $_GET['cmd'];
switch($action){
    case "select":
    $stmt = $str_exe->readAll("vans");
    $num_row = $str_exe->rowCount("vans");
    //echo json_encode($num_row);
    if ($num_row > 0){
        $data_arr['rs'] = array();
        foreach($stmt as $row){
            $item = array(
                'van_id' => $row['van_id'],
                'brand_id' => $row['brand_id'],
                'seat' => $row['seat'],
                'id_card' => $row['id_card'],
                'img_van' => $row['img_van'],
            );
            array_push($data_arr['rs'], $item);
        }
            echo json_encode($data_arr);
    }else{
        echo json_encode(array('msg' => 'result not format'));
    }
    break;

    case 'insert' :
    $van_id = $_GET['van_id'];
    $brand_id = $_GET['brand_id'];
    $seat = $_GET['seat'];
    $id_card = $_GET['id_card'];
    $img_van = $_GET['img_van'];

    $strSQL = $str_exe->insert("vans",
    "van_id, brand_id, seat, id_card, img_van",
    "'$van_id', '$brand_id', '$seat', '$id_card', '$img_van'");
    if($strSQL){
      echo json_encode(array('msg' => 'Insert Success'));
    }else {
      echo json_encode(array('msg' => 'Can not Insert'));
    }
    break;

    case 'update' :
    $van_id = $_GET['van_id'];
    $brand_id = $_GET['brand_id'];
    $seat = $_GET['seat'];
    $id_card = $_GET['id_card'];
    $img_van = $_GET['img_van'];

    $stmt = $str_exe->update("vans"
    ," brand_id = '$brand_id', seat = '$seat', id_card = '$id_card', img_van = '$img_van'",
     "where van_id = ".$van_id);
    if($stmt){
      echo json_encode(array('msg' => 'Update Success'));
    }else {
      echo json_encode(array('msg' => 'Can not Update'));
    }
    break;


    case 'delete' :
    $van_id = $_GET['van_id'];
    $stmt = $str_exe->readOne("DELETE FROM", "vans", "WHERE van_id = '$van_id'");
    if($stmt){
      echo json_encode(array('msg' => 'Delete Success'));
    }
    else{
      echo json_encode(array('msg' => 'Can not Delete'));
    }
    break;
}
?>
