<?php
  include("../include/db.php");
  include("../include/exec.php");
  include("plugin.php");

  $db = new Database();
  $str_conn = $db->getConnection();
  $str_exe = new ExecSQL($str_conn);
  $stmt = $str_exe->readAll("users u, initial i, user_type ut where u.initial_id = i.initial_id
                              and u.user_type_id = ut.user_type_id");
  $num_row = $str_exe->rowCount("users");

  function substrIDCard($id_card){
    $id1 = substr($id_card, 0, 1);
    $id2 = substr($id_card, 1, 4);
    $id3 = substr($id_card, 5, 5);
    $id4 = substr($id_card, 10, 2);
    $id5 = substr($id_card, 12, 1);
    return $id1.'-'.$id2.'-'.$id3.'-'.$id4.'-'.$id5;
  }
?>
<div id="alertbox"></div>
<div class="table-responsive">
<table id="tbl_van" class="table table-striped table-hover table-condensed">
  <caption><div align="center">
    <h3><button type="button" id="add_van" class="btn btn-danger" name="button">
      <span class="glyphicon glyphicon-plus"></span></button> ผู้ใช้งาน</h3></div></caption>
  <thead class="thead-dark">
    <th class="no-sort"><div align="center">ลำดับ</div></th>
    <th class="no-sort"><div align="center">เลขประจำตัวประชาชน</div></th>
    <th class="no-sort"><div align="center">ชื่อ-นามสกุล</div></th>
    <th class="no-sort"><div align="center">อีเมล์</div></th>
    <th class="no-sort"><div align="center">โทรศัพท์</div></th>
    <th class="no-sort"><div align="center">รหัสผ่าน</div></th>
    <th class="no-sort"><div align="center">ประเภท</div></th>
    <th class="no-sort"><div align="center">แก้ไข</div></th>
    <!--<th class="no-sort"><div align="center">ลบ</div></th>-->
  </thead>
  <tbody id="myTable">
    <?php
    if ($num_row != 0) {
      $i = 0;
        foreach($stmt as $rows) { $i++;?>
          <tr>
            <td><div align="center"><?php echo $i; ?></div></td>
            <td><div align="center"><?php echo substrIDCard($rows['id_card']); ?></div></td>
            <td><div align="left"><?php echo $rows['init_name']." ".$rows['name']." ".$rows['lastname']; ?></div></td>
            <td><div align="left"><?php echo $rows['email']; ?></div></td>
            <td><div align="center"><?php echo $rows['phone']; ?></div></td>
            <td><div align="center"><?php echo $rows['password']; ?></div></td>
            <td><div align="center"><?php echo $rows['user_type']; ?></div></td>
            <td><div align="center">
              <button type="button" class="btn btn-warning" id="edt_van" name="<?php echo $rows['id_card']; ?>">
              <span class="glyphicon glyphicon-edit"></span></button>
            </div></td>
            <!--<td><div align="center">
              <button type="button" class="btn btn-warning" id="del_van" name="<?php //echo $rows['id_card']; ?>">
                <span class="glyphicon glyphicon-trash"></span></button>
            </div></td>-->
          </tr>
     <?php } } ?>
  </tbody>
</table>
</div>
<!-- Modal -->
<div id="md_del_van" class="modal fade" role="dialog">
  <div class="modal-dialog">
     <!-- Modal content-->
     <div class="modal-content">
     <div class="modal-body">
       <h4>ต้องการลบข้อมูลนี้หรือไม่? &nbsp; <input type="hidden" id="txt_van_id" readonly></h4>
     </div>
     <div class="modal-footer">
       <button type="button" class="btn btn-default" data-dismiss="modal">ไม่</button>
       <button type="button" class="btn btn-danger" id="deled_van">ใช่</button>
     </div>
  </div>
 </div>
</div>
<!-- End Modal -->
<script type="text/javascript">
  $(document).ready(function(){
    $('#add_van').on('click', function(){
      $('#display_table').load("users_insert_form.php");
    });

    $('*[id^=edt_van]').on('click', function(){
      let van_id = $(this).attr('name');
      $('#display_table').load("van_edit_form.php",{van_id : van_id});
    });

    $('*[id^=del_van]').on('click', function(){
      let van_id = $(this).attr('name');
      $('#md_del_van').modal('show');
      $('#md_del_van').find('#txt_van_id').val(van_id);
    });

    $('#deled_van').on('click', function(){
      $.post("sql_van.php",{
        cmd : 'delete',
        van_id : $('#txt_van_id').val()
      }, function(data){
        if (data == '1') {
          alert_success('ลบข้อมูลสำเร็จ');
          $("#md_del_van").modal('toggle');
          setTimeout(function(){ $("#display_table").load("van.php"); }, 2000);
        } else {
          alert_danger('ไม่สามารถลบข้อมูลได้');
        }
      });
    });

    $('#tbl_van').DataTable({
      "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
      "order": [],
      "columnDefs": [ {
      "targets"  : 'no-sort',
      "orderable": false,
      }]
    });
  });
</script>
