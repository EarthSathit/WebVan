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

      if (isset($_POST['van_id'])) {
      $db = new Database();
      $str_conn = $db->getConnection();
      $str_exe = new ExecSQL($str_conn);
      $stmt = $str_exe->readAll("vans where van_id = '".$_POST['van_id']."'");
      $num_row = $str_exe->rowCount("vans");
      if ($num_row != 0) {
        $i = 0;
        foreach ($stmt as $row) { $i++; ?>
  <div class="container-fluid">
    <div id="alertbox"></div>
      <h3><span class="label label-success">แก้ไขข้อมูลรถตู้</span></h3>
      <hr align="left" style="width: 900px;">
      <form class="form-horizontal">
        <div class="form-group">
          <label for="van_id" class="col-sm-1 control-label w">ทะเบียนรถ :</label>
            <div class="col-sm-9">
              <input type="text" class="form-control w" id="van_id" placeholder="ทะเบียนรถ"
               readonly value="<?php echo $row['van_id']; ?>">
            </div>
        </div>
        <div class="form-group">
          <label for="brand" class="col-sm-1 control-label w">ยี่ห้อ :</label>
          <div class="col-sm-2">
          <select class="form-control w" id="brand_id">
            <option value="">ยี่ห้อ</option>
            <?php
              $stmt = $str_exe->readAll("brands");
              $num_row = $str_exe->rowCount("brands");
              if ($num_row != 0){
                  foreach($stmt as $rows){ ?>
                  <option value="<?php echo $rows['brand_id']?>" <?php if ($rows['brand_id'] == $row['brand_id'])
                  { echo ' selected="selected"'; } ?> ><?php echo $rows['name']; ?></option>
               <?php } } ?>
          </select>
          </div>
            <label for="seat" class="col-sm-1 control-label w">ที่นั่ง :</label>
            <div class="col-sm-2">
              <select class="form-control w" id="seat">
                <option value="">ที่นั่ง</option>
                <option value="12" <?php if($row['seat'] == 12)
                { echo ' selected="selected"'; } ?> >12</option>
                <option value="13" <?php if($row['seat'] == 13)
                { echo ' selected="selected"'; } ?> >13</option>
                <option value="14" <?php if($row['seat'] == 14)
                { echo ' selected="selected"'; } ?> >14</option>
                <option value="15" <?php if($row['seat'] == 15)
                { echo ' selected="selected"'; } ?> >15</option>
              </select>
            </div>
        </div>
        <div class="form-group">
          <label for="id_card" class="col-sm-1 control-label w">รหัสคนขับ :</label>
          <div class="col-sm-9">
            <input type="text" class="form-control w_id" id="id_card"
            placeholder="รหัสบัตรประชาชน" value="<?php echo $row['id_card']; ?>">
          </div>
        </div>
        <button type="button" class="btn btn-default" id="back_van">
          <span class="glyphicon glyphicon-arrow-left"></span> Back</button>
        <button type="submit" class="btn btn-warning" id="edted_van">
          <span class="glyphicon glyphicon-save"></span> Save</button>
      </form>
  </div>
  <?php } } } ?>
 </body>
</html>
<script type="text/javascript">
  $(document).ready(function() {
    $('#back_van').on('click', function(){
      $('#display_table').load("van.php");
    });

    $('#edted_van').on('click', function(){
      $.post("sql_van.php", {
      cmd : 'update',
      van_id : $('#van_id').val(),
      brand_id : $('#brand_id').val(),
      seat : $('#seat').val(),
      img_van : null,
      id_card : $("#id_card").val()
    }, function(data){
      if (data == '1') {
        alert_success('แก้ไขสำเร็จ');
        $('#van_id').val(null);
        $('#brand_id').val(null);
        $('#seat').val(null);
        $('#id_card').val(null);
        setTimeout(function(){ $('#display_table').load("van.php"); }, 1500);
      }else {
        alert_warning('กรุณากรอกข้อมูลก่อนกดบันทึก');
      }
    });
  });
 });
</script>
