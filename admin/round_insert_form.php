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

      $db = new Database();
      $str_conn = $db->getConnection();
      $str_exe = new ExecSQL($str_conn);
     ?>
  <div class="container-fluid">
    <div id="alertbox"></div>
      <h3><span class="label label-primary">เพิ่มข้อมูลเที่ยวรถ</span></h3>
      <hr align="left" style="width: 900px;">
      <form class="form-horizontal">
        <div class="form-group">
          <label for="van_id" class="col-sm-1 control-label w">เส้นทางรถ :</label>
            <div class="col-sm-9">
              <select class="form-control" id="route_r" style="width: 250px;">
                <option value="">เส้นทางรถ</option>
                <?php
                  $stmt = $str_exe->readAll("routes");
                  $num_row = $str_exe->rowCount("routes");
                  if ($num_row != 0){
                      foreach($stmt as $rows){ ?>
                      <option value="<?php echo $rows['route_id']?>"><?php echo $rows['route']; ?></option>
                   <?php } } ?>
              </select>
            </div>
        </div>
        <div class="form-group">
          <label for="brand" class="col-sm-1 control-label w">เที่ยวรถ :</label>
          <div class="col-sm-2">
            <input type="time" class="form-control" id="time_start" placeholder="เที่ยวรถ"
            style="width: 140px;" required>
          </div>
          <div class="col-sm-1" style="width: 40px; margin-top: 5px;">
            <span class="glyphicon glyphicon-minus"></span>
          </div>
          <div class="col-sm-2">
            <input type="time" class="form-control" id="time_finish" placeholder="เที่ยวรถ"
            style="width: 140px;" required>
          </div>
        </div>
        <div class="form-group">
          <label for="id_card" class="col-sm-1 control-label w">ทะเบียนรถ :</label>
          <div class="col-sm-9">
            <select class="form-control" name="" id="van_id_r" style="width: 150px;" required>
              <option value="" disabled selected>เลือกรถตู้</option>
              <?php
                $stmt = $str_exe->readAll("vans");
                $num_row = $str_exe->rowCount("vans");
                if ($num_row != 0){
                  foreach($stmt as $rows){ ?>
                  <option value="<?php echo $rows['van_id']?>"><?php echo $rows['van_id']; ?></option>
               <?php } } ?>
               ?>
            </select>
          </div>
        </div>
        <button type="button" class="btn btn-default" id="back_round">
          <span class="glyphicon glyphicon-arrow-left"></span> Back</button>
        <button type="submit" class="btn btn-success" id="save_route">
          <span class="glyphicon glyphicon-save"></span> Save</button>
      </form>
  </div>
 </body>
</html>
<script type="text/javascript">
  $(document).ready(function() {
    $('#back_round').on('click', function(){
      $('#display_table').load("round.php");
    });

    $('#save_route').on('click', function(){
      var route = $('#route_r').val();
      var time_start = $('#time_start').val();
      var time_finish = $('#time_finish').val();
      var time_sum = time_start + " - " + time_finish;
      var van_id = $('#van_id_r').val();
      if(route != null && time_sum != null && van_id != null){
        $.post("sql_round.php", {
          cmd : 'insert',
          route_id : route,
          time : time_sum,
          van_id : van_id
        }, function(data){
          if (data == '1') {
            alert_success('บันทึกสำเร็จ');
            $('#route_r').val(null);
            $('#time_start').val(null);
            $('#time_finish').val(null);
            $('#van_id_r').val(null);
          }else {
            alert_danger('ไม่สามารถบันทึกข้อมูลได้');
          }
        });
      }else {
        alert_warning('กรุณากรอกข้อมูลก่อนกดบันทึก');
      }
  });
 });
</script>
