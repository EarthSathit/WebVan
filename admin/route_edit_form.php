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

      if (isset($_POST['route_id'])) {
      $db = new Database();
      $str_conn = $db->getConnection();
      $str_exe = new ExecSQL($str_conn);
      $stmt = $str_exe->readAll("routes where route_id = '".$_POST['route_id']."'");
      $num_row = $str_exe->rowCount("routes");
      if ($num_row != 0) {
        $i = 0;
        foreach ($stmt as $row) { $i++;
    ?>
  <div class="container-fluid">
    <div id="alertbox"></div>
      <h3><span class="label label-warning">แก้ไขข้อมูลเส้นทางรถ</span></h3>
      <hr align="left" style="width: 900px;">
      <form class="form-horizontal">
        <div class="form-group">
          <label for="van_id" class="col-sm-1 control-label w">เส้นทางรถ :</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="route_name" placeholder="เส้นทางรถ"
               value="<?php echo $row['route']; ?>" style="width: 250px;">
               <input type="hidden" class="form-control" id="route_id" placeholder="รหัสเส้นทางรถ"
                value="<?php echo $row['route_id']; ?>">
            </div>
        </div>
        <div class="form-group">
          <label for="brand" class="col-sm-1 control-label w">ราคา :</label>
          <div class="col-sm-2">
            <input type="text" class="form-control" id="price"
            placeholder="ราคา" value="<?php echo $row['price']; ?>">
          </div>
          </div>
        <div class="form-group">
          <label for="id_card" class="col-sm-1 control-label w">เวลาเดินทาง :</label>
          <div class="col-sm-9">
            <input type="time" class="form-control" id="time_route"
            placeholder="เวลาเดินทาง" value="<?php echo $row['time_route']; ?>" style="width: 140px;">
          </div>
        </div>
        <button type="button" class="btn btn-default" id="back_route">
          <span class="glyphicon glyphicon-arrow-left"></span> Back</button>
        <button type="submit" class="btn btn-primary" id="edted_route">
          <span class="glyphicon glyphicon-save"></span> Save</button>
      </form>
</div>
  <?php } } } ?>
 </body>
</html>
<script type="text/javascript">
  $(document).ready(function() {
    $('#back_route').on('click', function(){
      $('#display_table').load("route.php");
    });

    $('#edted_route').on('click', function(){
     $.post("sql_route.php", {
      cmd : 'update',
      route_id : $('#route_id').val(),
      route : $('#route_name').val(),
      price : $('#price').val(),
      time_route : $('#time_route').val()
    }, function(data){
      if (data == '1') {
        alert_success('แก้ไขสำเร็จ');
        $('#route_name').val(null);
        $('#price').val(null);
        $('#time_route').val(null);
        setTimeout(function(){ $('#display_table').load("route.php"); }, 1500);
      }else {
        alert_warning('กรุณากรอกข้อมูลก่อนกดบันทึก');
      }
    });
  });
 });
</script>
