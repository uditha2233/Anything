<!doctype html>
<html>
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="/shop_webservice/theme/css/bootstrap.css">

    <script src="/shop_webservice/theme/jquery/jquery.js"></script>
    <script src="/shop_webservice/theme/js/bootstrap.min.js"></script>
    <script src="/shop_webservice/theme/js/bootstrap.js"></script>


</head>


<body>
<div class="span2 well" style="border: 1px">

    <?php


    require_once('DBFunction.php');

    $dbQuery = new DBFunction();
    $response = array();

    if (isset($_REQUEST['userlog']) && isset($_REQUEST['item'])) {


        $userlog = $_REQUEST['userlog'];
        $item = $_REQUEST['item'];
        $msg_fromName = "deleted";

        //get user id from name
        $sell = mysql_query("SELECT id FROM user WHERE login = '$userlog'") or die(mysql_error());

        $no_of_rows1 = mysql_num_rows($sell);

        while ($row = mysql_fetch_row($sell)) {
            $userId = $row[0];
        }


        //get item details from item id
        $result = mysql_query("SELECT * FROM messages WHERE id = '$item'") or die(mysql_error());

        $no_of_rows2 = mysql_num_rows($result);

        if ($no_of_rows2 > 0) {

            while ($row = mysql_fetch_row($result)) {
                $msg_id = $row[0];
                $msg_sub = $row[1];
                $msg_from = $row[2];
                $msg_to = $row[3];
                $msg_time = $row[4];
                $msg_state = $row[5];
                $msg_message = $row[6];
                $msg_about = $row[7];
            }

            //get seller name and location from id
            $sell = mysql_query("SELECT login FROM user WHERE id = '$msg_from'") or die(mysql_error());


            $no_of_rows3 = mysql_num_rows($sell);

            while ($row = mysql_fetch_row($sell)) {
                $msg_fromName = $row[0];
            }

            if ($userId == $msg_to) {
            mysql_query("UPDATE messages SET state = '0' WHERE id = '$msg_id';") or die(mysql_error());
            }

            echo "<div class='panel panel-primary'>";
            echo "<div class='panel-heading'>";
            echo "<h2 class='panel-title'>$msg_sub</h2><small>About: $msg_about</small>";
            echo "</div><div class='panel-body'>";


            echo "<small>From : ";
            echo "<b>$msg_fromName</b><br>";
            echo "Time :";
            echo "<b>$msg_time</b></small><hr>";


            //item description view
            echo "<div class='panel panel-default'>
            <div class='panel-body'>";
            echo "<b>Dear $userlog,</b> <center>$msg_message</center><br><small><b>- $msg_fromName</b></small>";


            if ($userId == $msg_from) {

            }else {
            echo "<form action='/shop_webservice/MsgReply.php' method='GET'>";
            echo "<input type='hidden' name='fromuser' value='$msg_to'/>";
            echo "<input type='hidden' name='to' value='$msg_from'/>";
            echo "<input type='hidden' name='about' value='$msg_about'/>";
            echo "<input type='hidden' name='subject' value='$msg_sub'/>";
            echo "</div></div><textarea class='form-control' name='msgbody' rows='2'></textarea>";
            echo "<input type='submit' id='submitDetails' class='btn btn-primary' name='submitDetails' value='Reply' /></form> ";


            echo "<button type='button' class='btn btn-warning btn-sm' data-toggle='modal' data-target='#itemDelete'>Delete</button>";
            }


            echo "</div></div>";


            //msg delete
            echo "<div class='modal fade' id='itemDelete' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='alert alert-danger'>
            <b>Do you want to delete?</b>
            </div>
                <div class='modal-body'><center>
                 <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                 <a href='/shop_webservice/MsgDelete.php?userlog=$userlog&&item=$item'><button type='button' class='btn btn-danger'>Delete</button></a>
                </center></div>
        </div>
    </div>
</div>";

        } else {

            echo "<div class='jumbotron'>";

            echo " <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='alert alert-danger'>
            <b>Message has deleted !</b>
            </div>
                <div class='modal-body'><center>
                 <a href='/shop_webservice/Messages.php?userlog=$userlog&&page=1&&cat=1&&action=backToTheList'><button type='button' class='btn btn-default' data-dismiss='modal'>Back</button></a>
                </center></div>
        </div>

</div>";

            echo "</div>";

        }

    }

    ?>
</div>


