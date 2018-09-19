<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>เพิ่มข้อมูลผู้ใช้งาน</title>
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
    <div class="row">
      <h3><span class="label label-primary">เพิ่มข้อมูลผู้ใช้งาน</span></h3>
      <hr align="left" style="width: 900px;">
      <form class="form-horizontal">
      <div class="form-group">
          <label for="brand" class="col-sm-1 control-label" style="width: 200px;">เลขประจำตัวประชาชน :</label>
          <div class="col-sm-2">
            <input type="tel" class="form-control" id="id_card" maxLength="17" placeholder="เลขประจำตัวประชาชน"
            style="width: 190px;" required>
          </div>
        </div>
        <div class="form-group">
          <label for="van_id" class="col-sm-1 control-label" style="width: 200px;">คำนำหน้าชื่อ :</label>
            <div class="col-sm-1">
              <select class="form-control" id="initial" style="width: 150px;">
                <option value="" disabled selected>คำนำหน้าชื่อ</option>
                <?php
                  $stmt = $str_exe->readAll("initial");
                  $num_row = $str_exe->rowCount("initial");
                  if ($num_row != 0){
                      foreach($stmt as $rows){ ?>
                      <option value="<?php echo $rows['initial_id']?>"><?php echo $rows['init_name']; ?></option>
                   <?php } } ?>
              </select>
            </div>
            <label for="id_card" class="col-sm-1 control-label" style="width: 150px;">ชื่อ :</label>
          <div class="col-sm-1">
            <input type="text" class="form-control" id="username" style="width: 160px;"
            placeholder="ชื่อ" required>
          </div>
          <label for="id_card" class="col-sm-1 control-label" style="width: 190px;">นามสกุล :</label>
          <div class="col-sm-1">
            <input type="text" class="form-control" id="lastname" style="width: 190px;"
            placeholder="นามสกุล" required>
          </div>
        </div>
        <div class="form-group">
          <label for="id_card" class="col-sm-1 control-label" style="width: 200px;">อีเมล์ :</label>
          <div class="col-sm-9">
            <input type="email" class="form-control" id="email" style="width: 300px;"
            placeholder="Example@gmail.com" required>
          </div>
        </div>
        <div class="form-group">
          <label for="id_card" class="col-sm-1 control-label" style="width: 200px;">เบอร์โทรศัพท์ :</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="phone" style="width: 140px;"
            placeholder="เบอร์โทรศัพท์" maxLength="10" required>
          </div>
        </div>
        <div class="form-group">
          <label for="id_card" class="col-sm-1 control-label" style="width: 200px;">รหัสผ่าน :</label>
          <div class="col-sm-2">
            <input type="password" class="form-control" id="password" style="width: 140px;"
            placeholder="รหัสผ่าน" required>
          </div>
          <div class="col-sm-2">
              <button type="button" class="btn btn-warning" id="show_password"
              ><span class="glyphicon glyphicon-eye-open"></span></button>
              <button type="button" class="btn btn-warning" id="none_password" style="display: none;"
              ><span class="glyphicon glyphicon-eye-close"></span></button>
            </div>
        </div>
        <div class="form-group">
          <label for="id_card" class="col-sm-1 control-label" style="width: 200px;">ยืนยันรหัสผ่าน :</label>
          <div class="col-sm-2">
            <input type="password" class="form-control" id="re_password" style="width: 140px;"
            placeholder="รหัสผ่าน" required>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-0">
          <button type="button" class="btn btn-default" id="back_users">
          <span class="glyphicon glyphicon-arrow-left"></span> Back</button>
        <button type="submit" class="btn btn-success" id="save_user">
          <span class="glyphicon glyphicon-save"></span> Save</button>
          </div>
        </div>
      </form>
  </div>
  </div>
 </body>
</html>
<script type="text/javascript">
  $(document).ready(function() {
    $('#back_users').on('click', function(){
      $('#display_table').load("users.php");
    });

    $('#save_user').on('click', function(){
      let id_card_str = $('#id_card').val()
      let id_card = substrToID(id_card_str)
      let initial = $('#initial').val()
      let username = $('#username').val()
      let lastname = $('#lastname').val()
      let email = $('#email').val()
      let phone = $('#phone').val()
      let pass1 = $('#password').val()
      let pass2 = $('#re_password').val()

      let check = true;

      if(!$.isNumeric(id_card)){
        alert_danger('กรุณากรอกเลขบัตรประจำตัวประชาชนให้ถูกต้อง')
        $('#id_card').val('')
        $('#id_card').focus()
        check = false;
      }

      if(pass1 != pass2){
        alert_danger('รหัสผ่านไม่ตรงกัน')
        $('#password').val('')
        $('#re_password').val('')
        $('#password').focus()
        $('#re_password').focus()
        check = false;
      }

      if(id_card != '' && initial != '' && username != '' && lastname != ''
         email != '' && phone != '' && pass1  != ''){
           if(check){
             $.post("manage_user.php", {
               cmd : 'insert',
               id_card : id_card,
               initial : initial,
               username : username,
               lastname : lastname,
               email : email,
               phone : phone,
               password : pass
             }, function(data){
                if(data == '1'){
                  alert_success('บันทึกเรียบร้อย')
                }
             });
           }
         }
      /*var route = $('#route_r').val();
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
      }*/
  });

  $('#id_card').on('keyup', function(e) {
    let id = $(this).val()
    let id_length = $(this).val().length

    const setValue = (id) => {
      return $(this).val(id + '-')
    }

    if(e.keyCode != 8){
      if(id_length == 1){ setValue(id) }
      if(id_length == 6){ setValue(id) }
      if(id_length == 12){ setValue(id) }
      if(id_length == 15){ setValue(id) }
    }
  });

  $('#show_password').on('click', function(){
    $('#password').attr('type', 'text')
    $(this).css('display', 'none')
    $('#none_password').css('display', '')
  });

  $('#none_password').on('click', function(){
    $('#password').attr('type', 'password')
    $(this).css('display', 'none')
    $('#show_password').css('display', '')
  });

  const substrToID = (id) => {
    sub_id1 = id.substr(0, 1)
    sub_id2 = id.substr(2, 4)
    sub_id3 = id.substr(7, 5)
    sub_id4 = id.substr(13, 2)
    sub_id5 = id.substr(16, 1)
    return sub_id1+ '' +sub_id2+ '' +sub_id3+ '' +sub_id4+ '' +sub_id5;
  }
 });
</script>
