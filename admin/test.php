<!DOCTYPE html>
<html>
<header>
<!-- Bootstrap Table-->
<link rel="stylesheet" href="css/jquery.dataTables.min.css">
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<!-- Jquery Table-->
<script type="text/javacsript" src="js/jquery.dataTables.min.js" type="text/javascript"></script>
<script type="text/javacsript" src="js/dataTables.bootstrap.min.js" type="text/javascript"></script>
</header>
<body>
<table id="example" class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Extn.</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Name</td>
                <td>Position</td>
                <td>Office</td>
                <td>Extn.</td>
                <td>Start date</td>
                <td>Salary</td>
            </tr>
        </tbody>
        <tbody>
            <tr>
              <td>Name</td>
              <td>Position</td>
              <td>Office</td>
              <td>Extn.</td>
              <td>Start date</td>
              <td>Salary</td>
            </tr>
        </tbody>
        <tbody>
            <tr>
              <td>Name</td>
              <td>Position</td>
              <td>Office</td>
              <td>Extn.</td>
              <td>Start date</td>
              <td>Salary</td>
            </tr>
        </tbody>
    </table>
  </body>
</html>
<script type="text/javacsript" src="js/jquery.min.js"></script>
<script type="text/javacsript">
  $("#example").dataTable();
</script>
