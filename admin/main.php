<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Van Service</title>
    <!--i-con-->
  	<link rel=icon href="images/ic_van.png">
    <!-- Jquery -->
    <script src="js/jquery.min.js"></script>
    <!-- Alertbox -->
    <script src="js/alertbox.js"></script>
    <!-- Remove img of Data Table -->
    <style media="screen">
      table.dataTable thead th.sorting,
      table.dataTable thead th.sorting_asc,
      table.dataTable thead th.sorting_desc {
        background : none;
      }
    </style>
  </head>
  <body>
    <?php include("navbar.php"); ?>
    <div class="container-fluid text-center">
  <div class="row content">
    <div class="col-sm-1 sidenav">
      <div class="well">
        <!--<p>ADS</p>-->
      </div>
      <div class="well">
          <!--<p>ADS</p>-->
      </div>
      <div class="well">
        <!--<p>ADS</p>-->
      </div>
      <div class="well">
          <!--<p>ADS</p>-->
      </div>
      <div class="well">
          <!--<p>ADS</p>-->
      </div>
      <div class="well">
          <!--<p>ADS</p>-->
      </div>
      <div class="well">
          <!--<p>ADS</p>-->
      </div>
      <div class="well">
          <!--<p>ADS</p>-->
      </div>
    </div>
    <div class="col-sm-10 text-left">
      <div id="display_table"></div>
    </div>
    <div class="col-sm-1 sidenav">
      <div class="well">
        <!--<p>ADS</p>-->
      </div>
      <div class="well">
          <!--<p>ADS</p>-->
      </div>
      <div class="well">
        <!--<p>ADS</p>-->
      </div>
      <div class="well">
          <!--<p>ADS</p>-->
      </div>
      <div class="well">
          <!--<p>ADS</p>-->
      </div>
      <div class="well">
          <!--<p>ADS</p>-->
      </div>
      <div class="well">
          <!--<p>ADS</p>-->
      </div>
      <div class="well">
          <!--<p>ADS</p>-->
      </div>
    </div>
  </div>
</div><br>

<footer class="container-fluid text-center"
style="background-color: #333232;color: #F5F7FA;padding: 10px;width: 100%;">
<a class="dropdown-toggle"
href="http://intranet.specialty.co.th:8000/intrastc/" style="text-decoration: none; color:#F5F7FA;" target="_blank">หนุมานทัวร์สยาม จำกัด.</a><span class="glyphicon glyphicon-phone" aria-hidden="true"></span> : 034-588-111
<a href="line-notify.html" style="color: white; text-decoration: none;">| Contact Me</a><br>
Company Name &copy; 2018.<b id="akru-footer"></b> Powered by Sathit Sivilaiz. <a class="dropdown-toggle"
href="http://www.kru.ac.th/"
style="text-decoration: none; color:#F5F7FA;" target="_blank">Kanchanaburi Rajabhat University.</a> All rights reserved.
</footer>
  </body>
</html>
<script type="text/javascript">
  $(document).ready(function() {
    $("#display_table").load("home.php");
  });
</script>
