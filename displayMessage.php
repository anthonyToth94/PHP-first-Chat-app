<?php
$message = new Message();
 if(isset($_GET['name']))
 {
    if(isset($_SESSION['uname']))
    {
          $_SESSION['rName'] = $_GET['name'];
          $message->setSender($_SESSION['uname']);
          $message->setReceiver($_SESSION['rName']);
          $message->selectMessage();
    }
    else
    {
          echo "<script>alert('You need to log in before select somebody')</script>";
    }
  }
?>