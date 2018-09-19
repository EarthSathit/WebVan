<?php
include("../include/db.php");
include("../include/exec.php");

$db = new Database();
$str_conn = $db->getConnection();
$str_exe = new ExecSQL($str_conn);
$action = $_POST['cmd'];
switch($action){
    case 'insert' :
    $route_id = $_POST['route_id'];
    $time = $_POST['time'];
    $van_id = $_POST['van_id'];

    $strSQL = $str_exe->insert("rounds",
    "round_id, route_id, time, van_id",
    "NULL, '$route_id', '$time', '$van_id'");
    if($strSQL){ echo "1"; }
    else { echo "0"; }
    break;

    case 'update' :
    $round_id = $_POST['round_id'];
    $route_id = $_POST['route_id'];
    $time = $_POST['time'];
    $van_id = $_POST['van_id'];

    $stmt = $str_exe->update("rounds"
    ," route_id = '$route_id', time = '$time', van_id = '$van_id'",
     "where round_id = '$round_id'");
    if($stmt){ echo "1"; }
    else { echo "0"; }
    break;


    case 'delete' :
    $round_id = $_POST['round_id'];
    $stmt = $str_exe->readOne("DELETE FROM", "rounds", "WHERE round_id = '$round_id'");
    if($stmt){ echo "1"; }
    else{ echo "0"; }
    break;
}
?>
