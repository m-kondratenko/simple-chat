<?php
  require_once 'DB.php';
  //check for injections
  if(get_magic_quotes_gpc()==1)  {
    $name=stripslashes(trim($_POST["name"]));
    $message=stripslashes(trim($_POST["message"]));
    }
  else {
    $name=trim($_POST["name"]);
    $message=trim($_POST["message"]);
    }
  $name=mysql_real_escape_string($name);
  $message=mysql_real_escape_string($message);

  $connect=connectDB();
  if ($connect->connect_errno) {
    echo "db_error";
  }
  else {
    $success=$connect->query("INSERT INTO  `messages` (`id`, `username`, `message`, `date`) VALUES (NULL, '$name', '$message', CURRENT_TIMESTAMP)");
    $connect->close();
  }
?>
