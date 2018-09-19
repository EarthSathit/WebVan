<?php
  session_start();
  include("style_modal.php");
  if($_SESSION['name'] == ''){ ?>
     <meta http-equiv="refresh" content="0;url=index.html">
  <?php }
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!--<link rel="stylesheet" href="include/css/bootstrap.min.css">-->
<script src="js/jquery.min.js"></script>
<!--<script src="js/bootstrap.min.js"></script>-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--Begin Navbar-->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#" id="home"
      data-toggle="tooltip" data-placement="bottom" title="หน้าแรก">
        <span class="glyphicon glyphicon-home"></span></a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="#" id="van" data-toggle="tooltip" title="รถตู้"
        data-placement="bottom">รถตู้</a></li>
      <li><a href="#" id="route" data-toggle="tooltip" data-placement="bottom"
        title="เส้นทางรถ">เส้นทางรถ</a></li>
      <li><a href="#" id="round" data-toggle="tooltip" data-placement="bottom"
        title="เที่ยวรถ">เที่ยวรถ</a></li>
      <li><a href="#" id="users" data-toggle="tooltip" data-placement="bottom"
          title="ผู้ใช้งาน">ผู้ใช้งาน</a></li>
      <li><a href="#" id="promotion" data-toggle="tooltip" data-placement="bottom"
            title="โปรโมชัน">โปรโมชัน</a></li>
      <li><a href="#" id="reserv" data-toggle="tooltip" data-placement="bottom"
            title="จอง">จอง</a></li>
    </ul>
    <form class="navbar-form navbar-left" action="/action_page.php">
      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
          <input type="text" class="form-control" placeholder="Search" name="search" id="mySearch">
        </div>
      </div>
    </form>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="user_data.php?userID=<?php echo $_SESSION['id_card']; ?>" data-toggle="tooltip"
        data-placement="bottom" title="ข้อมูลส่วนตัว">
        <span class="glyphicon glyphicon-user"></span><?php echo " : ".$_SESSION['name']; ?></a></li>
      <li><a href="#" id="logout" data-toggle="tooltip" data-placement="bottom"
        title="ออกจากระบบ"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
  </div>
</nav>
<!--End Navbar-->

<!-- Modal Logout -->
  <div id="modal_logout" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal Content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Warning!</h4>
        </div>
        <div class="modal-body">
          <p>ต้องการออกจากระบบหรือไม่?</p>
        </div>
        <div class="modal-footer">
          <button id="md_cancel" type="submit" class="btn btn-danger" data-dismiss="modal">ไม่</button>
          <button id="md_ok" type="submit" class="btn btn-success">ใช่</button>
        </div>
      </div>
    </div>
  </div>
<!-- End Modal -->
<script type="text/javascript">
  $(document).ready(function() {
    $("#mySearch").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
      });
    });

    $("#logout").on('click', function(){
      /*var logout = confirm('คุณต้องการออกจากระบบหรือไม่?');
      if(logout == true){
        window.location = "logout.php";
      }*/

      $("#modal_logout").modal('show');
    });

    $("#md_ok").on('click', function() {
      window.location = "logout.php";
    });

    $('[data-toggle="tooltip"]').tooltip();

    $("#home").on('click', function(){
      $("#display_table").load("home.php");
    });

    $("#van").on('click' , function(){
      $("#display_table").load("van.php");
    });

    $("#route").on('click', function(){
      $("#display_table").load("route.php");
    });

    $("#round").on('click', function(){
      $("#display_table").load("round.php");
    });

    $('#users').on('click', function(){
      $('#display_table').load("users.php");
    });

    $('#promotion').on('click', function(){
      $('#display_table').load("promotion.php");
    });

    $('#reserv').on('click', function(){
      $('#display_table').load("reserv.php");
    });
  });
</script>
