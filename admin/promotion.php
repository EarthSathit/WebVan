<?php
  include("../include/db.php");
  include("../include/exec.php");
  include("plugin.php");

  $db = new Database();
  $str_conn = $db->getConnection();
  $str_exe = new ExecSQL($str_conn);
  $stmt = $str_exe->readAll("vans v, brands b where v.brand_id = b.brand_id");
  $num_row = $str_exe->rowCount("vans");
?>
<div id="alertbox"></div>
<!--Start of slider section-->
<section id="slider">
    <div id="carousel-example-generic" class="carousel slide carousel-fade" data-ride="carousel"
    data-interval="3000" align="center">\
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            <li data-target="#carousel-example-generic" data-slide-to="3"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <div class="slider_overlay">
                    <img src="images/pro1.jpeg" alt="...">
                    <div class="carousel-caption">
                        <div class="slider_text">

                        </div>
                    </div>
                </div>
            </div>
            <!--End of item With Active-->
            <div class="item">
                <div class="slider_overlay">
                    <img src="images/pro2.jpeg" alt="...">
                    <div class="carousel-caption">
                        <div class="slider_text">

                        </div>
                    </div>
                </div>
            </div>
            <!--End of Item-->
            <div class="item">
                <div class="slider_overlay">
                    <img src="images/pro3.jpeg" alt="...">
                    <div class="carousel-caption">
                        <div class="slider_text">

                        </div>
                    </div>
                </div>
            </div>
            <!--End of item-->
            <div class="item">
                <div class="slider_overlay">
                    <img src="images/pro4.jpeg" alt="...">
                    <div class="carousel-caption">
                        <div class="slider_text">

                        </div>
                    </div>
                </div>
            </div>
            <!--End of item-->
        </div>
        <!--End of Carousel Inner-->
    </div>
</section>
<!--end of slider section-->
<script type="text/javascript">
  $(document).ready(function(){
    $('#add_van').on('click', function(){
      $('#display_table').load("van_insert_form.php");
    });

    $('*[id^=edt_van]').on('click', function(){
      var van_id = $(this).attr('name');
      $('#display_table').load("van_edit_form.php",{van_id : van_id});
    });

    $('*[id^=del_van]').on('click', function(){
      var van_id = $(this).attr('name');
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
