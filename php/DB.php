<?php
  function connectDB() {
    //file->string
    $file=file_get_contents('db.txt');
    //string->vars
    list($host, $login, $pass, $db)=explode(",", trim($file));
    $mysqli = new mysqli ($host, $login, $pass, $db);
    $mysqli->query("SET NAMES 'utf-8'");
    return $mysqli;
  }
?>
