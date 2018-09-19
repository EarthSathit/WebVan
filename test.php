<?php
  $time = "30:00:00";
  $ex = explode(":", $time);

  if (strpos($ex[0], "0") == 0) {
    if (strpos($ex[1], "0") == 0) {
      if (strcmp($ex[0], "00") == 1) {
        echo trim($ex[0], 0)." ชม. ";
      } else {
        echo trim($ex[0], 0)." ชม. ".trim($ex[1], 0)." นาที";
      }
    }else {
      echo trim($ex[0], 0)." ชม. ".$ex[1]." นาที";
    }
  }else {
    if (strpos($ex[1], "0") == 0) {
      if (strcmp($ex[1], "00") == 0) {
        echo $ex[0]." ชม. ";
      } else {
        echo $ex[0]." ชม. ".trim($ex[1], 0)." นาที";
      }
    } else {
      echo $ex[0]." ชม. ".$ex[1]." นาที";
    }
  }
?>
