<?php
  require_once 'DB.php';
  //convert query into array
  function resultToArray ($res) {
    $array=array();
    while (($row = $res->fetch_assoc()) != false)
      $array[] = $row;
    return $array;
  }

  $connect=connectDB();
  if ($connect->connect_errno) {
    echo "db_error";
  }
  else {
    $countmes=$_POST['countmes'];
  	$result_set=$connect->query("SELECT * FROM `messages` WHERE `id`>'$countmes' ORDER BY `id` ASC LIMIT 0 , 1000");
    $connect->close();
    //send with converting into JSON
    echo json_encode(resultToArray($result_set));
  }
?>
