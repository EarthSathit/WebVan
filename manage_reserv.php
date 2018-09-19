<?php
include("include/db.php");
include("include/exec.php");

$db = new Database();
$str_conn = $db->getConnection();
$str_exe = new ExecSQL($str_conn);
$action = $_GET['cmd'];
switch($action){
    case "select":
    if (isset($_POST['phone'])) {
      $stmt = $str_exe->readAll("reservations re, rounds ro, routes rt where re.round_id = ro.round_id
                                  and rt.route_id = ro.route_id and id_card = '".$_POST['phone']."'
                                  and payment_status = '2'");
    } else {
      $stmt = $str_exe->readAll("reservations re, rounds ro, routes rt where re.round_id = ro.round_id
                                  and rt.route_id = ro.route_id");
    }

    $num_row = $str_exe->rowCount("reservations");
    //echo json_encode($num_row);
    if ($num_row > 0){
        $data_arr['rs'] = array();
        foreach($stmt as $rows){
            $item = array(
                're_id' => $rows['re_id'],
                'round_id' => $rows['round_id'],
                'id_card' => $rows['id_card'],
                'reserv_date' => $rows['reserv_date'],
                'travel_date' => $rows['travel_date'],
                'payment_status' => $rows['payment_status'],
                'payment_method' => $rows['payment_method'],
                'route' => $rows['route'],
                'time' => $rows['time'],
                'price' => $rows['price'],
                'van_id' => $rows['van_id'],
            );
            array_push($data_arr['rs'], $item);
        }
            echo json_encode($data_arr);
    }else{
        echo json_encode(array('msg' => 'result not format'));
    }
    break;

    case 'insert' :
    $re_id = $_POST['re_id'];
    $round_id = $_POST['round_id'];
    //$id_card = $_POST['id_card'];
    $phone = $_POST['phone'];
    $reserv_date = $_POST['reserv_date'];
    $travel_date = $_POST['travel_date'];
    $payment_status = $_POST['payment_status'];
    $payment_method = $_POST['payment_method'];
    $reserv_seat = $_POST['reserv_seat'];
    $reserv_price = $_POST['reserv_price'];

    $strSQL = $str_exe->insert("reservations",
    "re_id, round_id, phone, reserv_date, travel_date, payment_status, payment_method,
    reserv_seat, reserv_price",
    "'$re_id', '$round_id', '$phone', '$reserv_date', '$travel_date', '$payment_status',
    '$payment_method', '$reserv_seat', '$reserv_price'");
    if($strSQL){
      echo json_encode(array('msg' => 'Insert Success'));
    }else {
      echo json_encode(array('msg' => 'Can not Insert'));
    }
    break;

    case 'update' :
    $re_id = $_GET['re_id'];
    $round_id = $_GET['round_id'];
    $id_card = $_GET['id_card'];
    $reserv_date = $_GET['reserv_date'];
    $payment_status = $_GET['payment_status'];
    $payment_method = $_GET['payment_method'];

    $stmt = $str_exe->update("reservations"
    ," round_id = '$round_id', id_card = '$id_card', reserv_date = '$reserv_date',
     payment_status = '$payment_status', payment_method = '$payment_method'",  "where re_id = ".$re_id);
    if($stmt){
      echo json_encode(array('msg' => 'Update Success'));
    }else {
      echo json_encode(array('msg' => 'Can not Update'));
    }
    break;


    case 'delete' :
      $re_id = $_GET['re_id'];
      $stmt = $str_exe->readOne("DELETE FROM", "reservations", "WHERE re_id = ".$re_id);
      if($stmt){
        echo json_encode(array('msg' => 'Delete Success'));
      }
      else{
        echo json_encode(array('msg' => 'Can not Delete'));
      }
    break;

    case 'history':
      $phone = $_POST['phone'];
      $stmt = "select COUNT(re_id) as amount_service from
                                  reservations where status_promotion = '0' and phone = '$phone'";
      $result = $str_conn->query($stmt);
      if($result){
        $data_arr['rs'] = array();
        foreach($result as $rows){
              $item = array(
                  'amount_service' => $rows['amount_service'],
                );
                array_push($data_arr['rs'], $item);
            }
                echo json_encode($data_arr);
        }else {
        echo $stmt;
      }
    break;

    case 'seat':
    $van_id = $_POST['van_id'];
    $stmt = "SELECT COUNT(re_id) as seat_cus from reservations re, rounds r where re.round_id = r.round_id
              and r.van_id = '$van_id' and re.payment_status = 1";

              $result = $str_conn->query($stmt);
    if($result){
        $data_arr['rs'] = array();
        foreach($result as $rows){
            $item = array(
              'seat_cus' => $rows['seat_cus'],
            );
            array_push($data_arr['rs'], $item);
         }
            echo json_encode($data_arr);
      }else {
        echo $stmt;
    }
    break;

    case 'used_promotion':
    $phone = $_POST['phone'];
    $stmt = "UPDATE reservations SET status_promotion = '1' WHERE phone = '$phone' ORDER BY re_id
             LIMIT 10";
    $result = $str_conn->query($stmt);
    break;

    case 'unused_promotion':
    $phone = $_POST['phone'];
    $stmt = "UPDATE reservations SET status_promotion = '0' WHERE phone = '$phone' ORDER BY re_id
             LIMIT 10";
    $result = $str_conn->query($stmt);
    break;

    case 'data_reserv':

    if (isset($_GET['phone'])) {
      $stmt = $str_exe->readAll("reservations re, rounds ro, routes rt where re.round_id = ro.round_id
                                  and rt.route_id = ro.route_id and phone = '".$_GET['phone']."'
                                  and payment_status = '1'");
    }
    $num_row = $str_exe->rowCount("reservations");
    //echo json_encode($num_row);
    if ($num_row > 0){
        $data_arr['rs'] = array();
        foreach($stmt as $rows){
            $item = array(
                're_id' => $rows['re_id'],
                'round_id' => $rows['round_id'],
                'phone' => $rows['phone'],
                'reserv_date' => $rows['reserv_date'],
                'travel_date' => $rows['travel_date'],
                'payment_status' => $rows['payment_status'],
                'payment_method' => $rows['payment_method'],
                'route' => $rows['route'],
                'time' => $rows['time'],
                'price' => $rows['price'],
                'van_id' => $rows['van_id'],
            );
            array_push($data_arr['rs'], $item);
        }
            echo json_encode($data_arr);
    }else{
        echo json_encode(array('msg' => 'result not format'));
    }
    break;

    case 'save_img_payment':
    $path_img = $_POST['img_payment'];
    $strSQL = $str_exe->insert("reservations", "img_payment", "'$path_img'");
    if($strSQL){
      echo json_encode(array('msg' => 'Insert Success'));
    }else {
      echo json_encode(array('msg' => 'Can not Insert'));
    }
    break;

    case 'cancel_reserv': 
    $phone = $_POST['phone'];
    $re_id = $_POST['re_id'];
    $strSQL = $str_exe->readOne("DELETE FROM", "reservations", "WHERE re_id = ".$re_id);
    if($strSQL) {
      echo json_encode(array('msg' => 'Delete Success'));
    }else {
      echo json_encode(array('msg' => 'Can not Delete'));
    }
    break;
}
?>
