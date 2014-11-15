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




<?php

require_once('DBFunction.php');

$dbQuery = new DBFunction();
$response = array();

if( $_REQUEST['fromuser'] || $_REQUEST['to'] || $_REQUEST['about'] || $_REQUEST['subject'] || $_REQUEST['msgbody'])
{

    $sender = $_REQUEST['fromuser'];
    $receiver = $_REQUEST['to'];
    $about = $_REQUEST['about'];
    $subject = $_REQUEST['subject'];
    $msgbody = $_REQUEST['msgbody'];
    $time = date('Y-m-d H:i:s');


    mysql_query("INSERT INTO messages (subject, fromid, toid, msgtime, message, about)
        VALUES ('$subject', '$sender', '$receiver', '$time', '$msgbody', '$about')");

    $user = mysql_query("SELECT login FROM user WHERE id = '$sender'") or die(mysql_error());

    while($row=mysql_fetch_row($user)){
        $username = $row[0];
    }


    echo "<div class='jumbotron'>";

    echo " <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='alert alert-success'>
            <b>Message reply sucessful!</b>
            </div>
                <div class='modal-body'><center>
                 <a href='/shop_webservice/Messages.php?userlog=$username&&page=1&&cat=1&&action=backToTheItem'><button type='button' class='btn btn-default' data-dismiss='modal'>Continue</button></a>
                </center></div>
        </div>

</div>";

    echo "</div>";

}