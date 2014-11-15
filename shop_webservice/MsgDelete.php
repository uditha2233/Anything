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

if(isset($_REQUEST['userlog']) && isset($_REQUEST['item'])){

    $userlog = $_REQUEST['userlog'];
    $item = $_REQUEST['item'];


    $result = mysql_query("SELECT toid FROM messages WHERE id = '$item'") or die(mysql_error());


    $no_of_rows1 = mysql_num_rows($result);

    while($row=mysql_fetch_row($result)){
        $msg_toid = $row[0];
    }

    $user = mysql_query("SELECT id FROM user WHERE login= '$userlog'") or die(mysql_error());


    $no_of_rows2 = mysql_num_rows($user);

    while($row=mysql_fetch_row($user)){
        $userid = $row[0];

    }


    if ($no_of_rows1 > 0) {

        if ($msg_toid == $userid) {
            mysql_query("DELETE FROM messages WHERE id = '$item'") or die(mysql_error());

            echo "<div class='jumbotron'>";

            echo " <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='alert alert-success'>
            <b>Your message deleted Sucessful!</b>
            </div>
                <div class='modal-body'><center>
                 <a href='/shop_webservice/MsgDelete.php?userlog=$userlog&&item=$item&&action=backToTheList'><button type='button' class='btn btn-default' data-dismiss='modal'>Continue</button></a>
                </center></div>
        </div>

</div>";

            echo "</div>";


        }else{

            echo "<div class='jumbotron'>";

            echo " <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='alert alert-danger'>
            <b>Sorry. This message is not your's!</b>
            </div>
                <div class='modal-body'><center>
                 <a href='/shop_webservice/MsgDelete.php?userlog=$userlog&&item=$item&&action=backToTheItem'><button type='button' class='btn btn-default' data-dismiss='modal'>Back</button></a>
                </center></div>
        </div>

</div>";

            echo "</div>";


        }

    }else{

        echo "<div class='jumbotron'>";

        echo " <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='alert alert-danger'>
            <b>Sorry. This message is already deleted!</b>
            </div>
                <div class='modal-body'><center>
                 <a href='/shop_webservice/MsgDelete.php?userlog=$userlog&&item=$item&&action=backToTheList'><button type='button' class='btn btn-default' data-dismiss='modal'>Back</button></a>
                </center></div>
        </div>

</div>";

        echo "</div>";


    }

}