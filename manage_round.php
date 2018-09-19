<?php
include("include/db.php");
include("include/exec.php");

$db = new Database();
$str_conn = $db->getConnection();
$str_exe = new ExecSQL($str_conn);
$action = $_GET['cmd'];
switch($action){
    case "select":
    $stmt = $str_exe->readAll("rounds ru, routes rt, vans v where ru.route_id = rt.route_id and
                                ru.van_id = v.van_id");
    $num_row = $str_exe->rowCount("rounds");
    //echo json_encode($num_row);
    if ($num_row > 0){
        $data_arr['rs'] = array();
        foreach($stmt as $rows){
          $stmt_seat = "SELECT COUNT(re_id) as seat_cus from reservations re, rounds r where re.round_id = r.round_id
                      and re.phone = '".$_GET['phone']."' and re.payment_status = '1'";
              $result_seat = $str_conn->query($stmt_seat);
              foreach ($result_seat as $row) {
                $cus_seat = $row['seat_cus'];
                $rest_seat = 12 - $cus_seat;
              }
            $item = array(
                'round_id' => $rows['round_id'],
                'route_id' => $rows['route_id'],
                'route' => $rows['route'],
                'price' => $rows['price'],
                'time_route' => $str_exe->subSTR($rows['time_route']),
                'time' => $rows['time'],
                'van_id' => $rows['van_id'],
                'seat' => $rest_seat,
            );
            array_push($data_arr['rs'], $item);
        }
            echo json_encode($data_arr);
    }else{
        echo json_encode(array('msg' => 'result not format'));
    }
    break;

    case 'insert' :
    $route_id = $_GET['route_id'];
    $time = $_GET['time'];
    $van_id = $_GET['van_id'];

    $strSQL = $str_exe->insert("rounds",
    "round_id, route_id, time, van_id",
    "NULL, '$route_id', '$time', '$van_id'");
    if($strSQL){
      echo json_encode(array('msg' => 'Insert Success'));
    }else {
      echo json_encode(array('msg' => 'Can not Insert'));
    }
    break;

    case 'update' :
    $round_id = $_GET['round_id'];
    $route_id = $_GET['route_id'];
    $time = $_GET['time'];
    $van_id = $_GET['van_id'];

    $stmt = $str_exe->update("rounds"
    ," route_id = '$route_id', time = '$time', van_id = '$van_id'", "where round_id = ".$round_id);
    if($stmt){
      echo json_encode(array('msg' => 'Update Success'));
    }else {
      echo json_encode(array('msg' => 'Can not Update'));
    }
    break;


    case 'delete' :
    $round_id = $_GET['round_id'];
    $stmt = $str_exe->readOne("DELETE FROM", "rounds", "WHERE round_id = ".$round_id);
    if($stmt){
      echo json_encode(array('msg' => 'Delete Success'));
    }
    else{
      echo json_encode(array('msg' => 'Can not Delete'));
    }
    break;
}
?>
