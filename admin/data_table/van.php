<?php
  include("../include/db.php");
  include("../include/exec.php");
  include("plugin.php");

  $db = new Database();
  $str_conn = $db->getConnection();
  $str_exe = new ExecSQL($str_conn);
  $stmt = $str_exe->readAll("vans v, brands b where v.brand_id = b.brand_id limit 5");
  $num_row = $str_exe->rowCount("vans");
?>
<table id="tbl_van" class="table table-striped table-hover table-bordered table-condensed">
  <caption><div align="center">รถตู้</div></caption>
  <thead>
    <th><div align="center">ทะเบียนรถ</div></th>
    <th><div align="center">ยี่ห้อ</div></th>
    <th><div align="center">ที่นั่ง</div></th>
    <th><div align="center">รหัสคนขับ</div></th>
    <th><div align="center">รูปรถ</div></th>
  </thead>
  <tbody>
    <?php
    if ($num_row != 0){
        foreach($stmt as $row){ ?>
          <tr>
            <td><?php echo $row['van_id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><div align="center"><?php echo $row['seat']; ?></div></td>
            <td><?php echo $row['id_card']; ?></td>
            <td><?php echo $row['img_van']; ?></td>
          </tr>
     <?php
        }
    }
    ?>
  </tbody>
</table>
<script type="text/javascript">
  $(document).ready(function(){
    $('#tbl_van').dataTable();
  });
</script>
