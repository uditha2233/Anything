<!doctype html>
<html>
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="/shop_webservice/theme/css/bootstrap.css">

<!--    <script src="http://code.jquery.com/jquery.js"></script>-->
<!--    <script src="/shop_webservice/theme/js/bootstrap.min.js"></script>-->
<!--    <script src="/shop_webservice/theme/js/bootstrap.js"></script>-->




</head>

<body style="background-color: #eee">


<?php

require_once('DBFunction.php');

$dbQuery = new DBFunction();
$response = array();

  if( $_REQUEST['from'] || $_REQUEST['to'] || $_REQUEST['about'] || $_REQUEST['item'] || $_REQUEST['subject'] || $_REQUEST['msgbody'])
  {

      $sender = $_REQUEST['from'];
      $receiver = $_REQUEST['to'];
      $about = $_REQUEST['about'];
      $item = $_REQUEST['item'];
      $subject = $_REQUEST['subject'];
      $msgbody = $_REQUEST['msgbody'];
      $time = date('Y-m-d H:i:s');
      $userlog = $_REQUEST['from'];


      mysql_query("INSERT INTO messages (subject, fromid, toid, msgtime, message, about)
        VALUES ('$subject', '$sender', '$receiver', '$time', '$msgbody', '$about')");


      echo "<div class='jumbotron'>";

      echo " <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='alert alert-success'>
            <b>Message Sent sucessful!</b>
            </div>
                <div class='modal-body'><center>
                 <a href='/shop_webservice/Itemview.php?userlog=$userlog&&item=$item&&action=backToTheItem'><button type='button' class='btn btn-default' data-dismiss='modal'>Continue</button></a>
                </center></div>
        </div>

</div>";

      echo "</div>";


  }