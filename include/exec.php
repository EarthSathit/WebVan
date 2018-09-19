<?php
class ExecSQL{
    private $conn;
     public function __construct($str_conn){
        $this->conn = $str_conn;
     }
     //ค้นหาตาราง
     public function readAll($tablename){
         $stmt = $this->conn->prepare("SELECT * FROM ".$tablename);
         $stmt->execute();
         return $stmt;
    }

    public function readCount($field){
        $stmt = $this->conn->prepare($field);
        $stmt->execute();
        return $stmt;
   }
    //นับ
    public function rowCount($tablename){
        $stmt = $this->conn->prepare("SELECT  COUNT(*) AS total_row FROM ".$tablename);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_row'];
     }
     //ค้นหาตารางฟิล
     public function readOne($command, $tablename, $cond){
        $stmt = $this->conn->prepare(" ".$command." ".$tablename." ".$cond." ");
        if($command == "DELETE FROM"){
            return $this->EXEC($stmt);
        }

        if($command == "SELECT * FROM"){
            $stmt->execute();
            return $stmt;
        }
     }

     public function update($tablename, $filde, $cond){
        $stmt = $this->conn->prepare("UPDATE ".$tablename." SET ".$filde." ".$cond."");
        return $this->EXEC($stmt);
     }
     //เพิ่มข้อมูล
     public function insert($tablename, $Field, $Value){
         $stmt = $this->conn->prepare("INSERT INTO ".$tablename." (".$Field.") VALUES (".$Value.") ");
         //$stmt->execute();
         return $this->EXEC($stmt);
     }

     public function EXEC($stmt){
        if($stmt->execute()) {
          return true;
        }else {
          return false;
        }
     }

     public function subSTR($time){
       $ex = explode(":", $time);

       if (strpos($ex[0], "0") == 0) {
         if (strpos($ex[1], "0") == 0) {
           if (strcmp($ex[0], "00") == 1) {
             return trim($ex[0], 0)." ชม.";
           } else {
             return trim($ex[0], 0)." ชม. ".trim($ex[1], 0)." น.";
           }
         }else {
           return trim($ex[0], 0)." ชม. ".$ex[1]." น.";
         }
       }else {
         if (strpos($ex[1], "0") == 0) {
           if (strcmp($ex[1], "00") == 0) {
             return $ex[0]." ชม.";
           } else {
             return $ex[0]." ชม. ".trim($ex[1], 0)." น.";
           }
         } else {
           return $ex[0]." ชม. ".$ex[1]." น.";
         }
       }
     }
}
?>
