<?php
include("include/db.php");
include("include/exec.php");

$db = new Database();
$str_conn = $db->getConnection();
$str_exe = new ExecSQL($str_conn);
$action = $_GET['cmd'];
switch($action){
    case "select":
    $stmt = $str_exe->readAll("routes");
    $num_row = $str_exe->rowCount("routes");
    //echo json_encode($num_row);
    if ($num_row > 0){
        $data_arr['rs'] = array();
        foreach($stmt as $row){
            $item = array(
                'route_id' => $row['route_id'],
                'route' => $row['route'],
                'price' => $row['price'],
            );
            array_push($data_arr['rs'], $item);
        }
            echo json_encode($data_arr);
    }else{
        echo json_encode(array('msg' => 'result not format'));
    }
    break;

    case 'insert' :
    $route = $_GET['route'];
    $price = $_GET['price'];

    $strSQL = $str_exe->insert("routes",
    "route_id, route, price",
    "NULL, '$route', '$price'");
    if($strSQL){
      echo json_encode(array('msg' => 'Insert Success'));
    }else {
      echo json_encode(array('msg' => 'Can not Insert'));
    }
    break;

    case 'update' :
    $route_id = $_GET['route_id'];
    $route = $_GET['route'];
    $price = $_GET['price'];

    $stmt = $str_exe->update("routes"
    ," route = '$route', price = '$price'", "where route_id = ".$route_id);
    if($stmt){
      echo json_encode(array('msg' => 'Update Success'));
    }else {
      echo json_encode(array('msg' => 'Can not Update'));
    }
    break;


    case 'delete' :
    $route_id = $_GET['route_id'];
    $stmt = $str_exe->readOne("DELETE FROM", "routes", "WHERE route_id = ".$route_id);
    if($stmt){
      echo json_encode(array('msg' => 'Delete Success'));
    }
    else{
      echo json_encode(array('msg' => 'Can not Delete'));
    }
    break;
}
?>
