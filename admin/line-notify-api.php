<script src="js/jquery.min.js"></script>
<?php
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$lineid = $_POST['lineid'];
$mesg = $_POST['mesg'];

$message = $mesg."\n".'From: '.$name."\n".'E-mail: '.$email."\n".'Phone: '.$phone."\n".'Line ID: '.$lineid;

if($name<>"" || $email <> "" || $mesg <> "") {
	sendlinemesg();
	header('Content-Type: text/html; charset=utf-8');
	$res = notify_message($message);
	echo "<script type='text/javascript'>";
	echo "alert('ส่งข้อมูลแล้ว');";
	echo "</script>";
  header('refresh: 0; url=main.php');
	exit(0);
} else {
	echo "<div align='center'>Error: กรุณากรอกข้อมูลให้ครบถ้วน</div>";
}

function sendlinemesg() {
  define('LINE_API', "https://notify-api.line.me/api/notify");
	define('LINE_TOKEN','ua6izHyWHAy3npjd3F9Jr6sVZ4gSduKlakWVAycG5kO');
}

function notify_message($message){
	$queryData = array('message' => $message);
	$queryData = http_build_query($queryData, '', '&');
	$headerOptions = array(
		'http'=>array(
			'method'=>'POST',
			'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
					."Authorization: Bearer ".LINE_TOKEN."\r\n"
					."Content-Length: ".strlen($queryData)."\r\n",
			'content' => $queryData
		)
	);
	$context = stream_context_create($headerOptions);
	$result = file_get_contents(LINE_API, FALSE, $context);
	$res = json_decode($result);
	return $res;
}
?>
<!-- Modal -->
<div id="md_send" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <p>ส่งข้อมูลแล้ว</p>
      </div>
    </div>
  </div>
</div>
