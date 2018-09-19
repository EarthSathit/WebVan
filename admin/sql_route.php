<?php
include("../include/db.php");
include("../include/exec.php");

$db = new Database();
$str_conn = $db->getConnection();
$str_exe = new ExecSQL($str_conn);
$action = $_POST['cmd'];
switch($action){
    case 'insert' :
    $route = $_POST['route'];
    $price = $_POST['price'];
    $time_route = $_POST['time_route'];

    $strSQL = $str_exe->insert("routes",
    "route_id, route, price, time_route",
    "NULL, '$route', '$price', '$time_route'");
    if($strSQL){ echo "1"; }
    else { echo "0"; }
    break;

    case 'update' :
    $route_id = $_POST['route_id'];
    $route = $_POST['route'];
    $price = $_POST['price'];
    $time_route = $_POST['time_route'];

    $stmt = $str_exe->update("routes"
    ," route = '$route', price = '$price', time_route = '$time_route'",
    "where route_id = '$route_id'");
    if($stmt){ echo "1"; }
    else { echo "0"; }
    break;


    case 'delete' :
    $route_id = $_POST['route_id'];
    $stmt = $str_exe->readOne("DELETE FROM", "routes", "WHERE route_id = '$route_id'");
    if($stmt){ echo "1"; }
    else{ echo "0"; }
    break;
}
?>
