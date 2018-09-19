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
      <h3><span class="label label-success">เพิ่มข้อมูลเส้นทางรถ</span></h3>
      <hr align="left" style="width: 900px;">
      <form class="form-horizontal">
        <div class="form-group">
          <label for="van_id" class="col-sm-1 control-label w">เส้นทางรถ :</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="route_name" placeholder="เส้นทางรถ"
              style="width: 250px;" required>
            </div>
        </div>
        <div class="form-group">
          <label for="brand" class="col-sm-1 control-label w">ราคา :</label>
          <div class="col-sm-2">
            <input type="text" class="form-control" id="price" placeholder="ราคา"
            style="width: 90px;" required>
          </div>
        </div>
        <div class="form-group">
          <label for="id_card" class="col-sm-1 control-label w">เวลาเดินทาง :</label>
          <div class="col-sm-9">
            <input type="time" class="form-control" id="time_route" style="width: 140px;"
            placeholder="เวลาในการเดินทาง" required>
          </div>
        </div>
        <button type="button" class="btn btn-default" id="back_route">
          <span class="glyphicon glyphicon-arrow-left"></span> Back</button>
        <button type="submit" class="btn btn-warning" id="save_route">
          <span class="glyphicon glyphicon-save"></span> Save</button>
      </form>
  </div>
 </body>
</html>
<script type="text/javascript">
  $(document).ready(function() {
    $('#back_route').on('click', function(){
      $('#display_table').load("route.php");
    });

    $('#save_route').on('click', function(){
      var route = $('#route_name').val();
      var price = $('#price').val();
      var time_route = $('#time_route').val();
      if(route != null && price != null && time_route != null){
        $.post("sql_route.php", {
          cmd : 'insert',
          route : route,
          price : price,
          time_route : time_route
        }, function(data){
          if (data == '1') {
            alert_success('บันทึกสำเร็จ');
            $('#route_name').val(null);
            $('#price').val(null);
            $('#time_route').val(null);
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
