<?php
include("../include/db.php");
include("../include/exec.php");

$db = new Database();
$str_conn = $db->getConnection();
$str_exe = new ExecSQL($str_conn);
$action = $_POST['cmd'];
switch($action){
    case 'insert' :
    $van_id = $_POST['van_id'];
    $brand_id = $_POST['brand_id'];
    $seat = $_POST['seat'];
    $id_card = $_POST['id_card'];
    $img_van = $_POST['img_van'];

    $strSQL = $str_exe->insert("vans",
    "van_id, brand_id, seat, id_card, img_van",
    "'$van_id', '$brand_id', '$seat', '$id_card', '$img_van'");
    if($strSQL){ echo "1"; }
    else { echo "0"; }
    break;

    case 'update' :
    $van_id = $_POST['van_id'];
    $brand_id = $_POST['brand_id'];
    $seat = $_POST['seat'];
    $id_card = $_POST['id_card'];
    $img_van = $_POST['img_van'];

    $stmt = $str_exe->update("vans"
    ," brand_id = '$brand_id', seat = '$seat', id_card = '$id_card', img_van = '$img_van'",
     "where van_id = '$van_id'");
    if($stmt){ echo "1"; }
    else { echo "0"; }
    break;


    case 'delete' :
    $van_id = $_POST['van_id'];
    $stmt = $str_exe->readOne("DELETE FROM", "vans", "WHERE van_id = '$van_id'");
    if($stmt){ echo "1"; }
    else{ echo "0"; }
    break;
}
?>
