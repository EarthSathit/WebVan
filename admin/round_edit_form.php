<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>เพิ่มข้อมูลรถตู้</title>
  </head>
  <body>
    <?php
      include("../include/db.php");
      include("../include/exec.php");
      include("style_form.php");

      if (isset($_POST['round_id'])) {
      $db = new Database();
      $str_conn = $db->getConnection();
      $str_exe = new ExecSQL($str_conn);
      $stmt = $str_exe->readAll("rounds where round_id = '".$_POST['round_id']."'");
      $num_row = $str_exe->rowCount("rounds");
      if ($num_row != 0) {
        foreach ($stmt as $row) {
          $timee = explode('-', $row['time']);
          $time_s = $timee[0];
          $time_f = $timee[1]; ?>
  <div class="container-fluid">
    <div id="alertbox"></div>
      <h3><span class="label label-warning">แก้ไขข้อมูลเที่ยวรถ</span></h3>
      <hr align="left" style="width: 900px;">
      <form class="form-horizontal">
        <div class="form-group">
          <label for="van_id" class="col-sm-1 control-label w">เส้นทางรถ :</label>
            <div class="col-sm-9">
              <select class="form-control" id="route_id" style="width: 250px;">
                <option value="">เส้นทางรถ</option>
                <?php
                  $stmt = $str_exe->readAll("routes");
                  $num_row = $str_exe->rowCount("routes");
                  if ($num_row != 0) {
                    foreach ($stmt as $rows) { ?>
                 <option value="<?php echo $rows['route_id']; ?>" <?php if($rows['route_id'] == $row['route_id'])
                  { echo 'selected = "selected"'; } ?>>
                   <?php echo $rows['route']; ?></option>
               <?php } } ?>
              </select>
               <input type="hidden" class="form-control" id="round_id" placeholder="รหัสเส้นทางรถ"
                value="<?php echo $row['round_id']; ?>">
            </div>
        </div>
        <div class="form-group">
          <label for="brand" class="col-sm-1 control-label w">เที่ยวรถ :</label>
          <div class="col-sm-2">
            <input type="time" class="form-control" id="time_s"
            placeholder="" value="<?php $date = date("H:i", strtotime($time_s)); echo $date; ?>"
            style="width: 130px;">
          </div>
          <div class="col-sm-1" style="width: 40px; margin-top: 5px;">
            <span class="glyphicon glyphicon-minus"></span>
          </div>
          <div class="col-sm-2">
            <input type="time" class="form-control" id="time_f" placeholder=""
             value="<?php $date = date("H:i", strtotime($time_f)); echo $date; ?>"
             style="width: 130px;">
          </div>
          </div>
        <div class="form-group">
          <label for="id_card" class="col-sm-1 control-label w">ทะเบียนรถ :</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="van_id"
            placeholder="เวลาเดินทาง" value="<?php echo $row['van_id']; ?>" style="width: 110px;">
          </div>
        </div>
        <button type="button" class="btn btn-default" id="back_round">
          <span class="glyphicon glyphicon-arrow-left"></span> Back</button>
        <button type="submit" class="btn btn-primary" id="edted_round">
          <span class="glyphicon glyphicon-save"></span> Save</button>
      </form>
</div>
  <?php } } } ?>
 </body>
</html>
<script type="text/javascript">
  $(document).ready(function() {
    $('#back_round').on('click', function(){
      $('#display_table').load("round.php");
    });

    $('#edted_round').on('click', function(){
      var round_id = $('#round_id').val();
      var route_id = $('#route_id').val();
      var time_s = $('#time_s').val();
      var time_f = $('#time_f').val();
      var time_sum = time_s + " - " + time_f;
      var van_id = $('#van_id').val();
     $.post("sql_round.php", {
      cmd : 'update',
      round_id : round_id,
      route_id : route_id,
      time : time_sum,
      van_id : van_id
    }, function(data){
      if (data == '1') {
        alert_success('แก้ไขสำเร็จ');
        $('#route_id').val(null);
        $('#time_s').val(null);
        $('#time_f').val(null);
        $('#van_id').val(null);
        setTimeout(function(){ $('#display_table').load("round.php"); }, 1500);
      }else {
        alert_warning('กรุณากรอกข้อมูลก่อนกดบันทึก');
      }
    });
  });
 });
</script>
