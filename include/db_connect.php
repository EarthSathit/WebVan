<?php
  define("hostname", "localhost");
  define("username", "root"); //tonrukfa_sathit1
  define("password", null); //sathit1234
  define("db", "van_service"); //tonrukfa_sathit


  function connect(){
    $conn = new mysqli(hostname, username, password, db);
    $conn->set_charset('utf8');

    return $conn;
  }
 ?>
