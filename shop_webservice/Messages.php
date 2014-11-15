<!doctype html>
<html>
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="/shop_webservice/theme/css/bootstrap.css">

    <script src="/shop_webservice/theme/jquery/jquery.js"></script>
    <script src="/shop_webservice/theme/js/bootstrap.min.js"></script>
    <script src="/shop_webservice/theme/js/bootstrap.js"></script>

    <script>
        $(function () {
            var btn = $('#fat-btn').click(function () {
                btn.button('loading')
                setTimeout(function () {
                    btn.button('reset')
                }, 3000)
            })
        })
    </script>

</head>
<body>


<?php


require_once('DBFunction.php');

$dbQuery = new DBFunction();
$response = array();

if (isset($_REQUEST['userlog']) && isset($_REQUEST['page']) && isset($_REQUEST['cat'])) {

    $userlog = $_REQUEST['userlog'];
    $page = $_REQUEST['page'];
    $cat = $_REQUEST['cat'];


    $result = mysql_query("SELECT id FROM user WHERE login = '$userlog'") or die(mysql_error());


    $no_of_rows = mysql_num_rows($result);

    while ($row = mysql_fetch_row($result)) {
        $userId = $row[0];
    }


    if ($no_of_rows > 0) {

        $msgs = mysql_query("SELECT id FROM messages WHERE toid = '$userId'") or die(mysql_error());
        $no_of_msgs = mysql_num_rows($msgs);


        if ($no_of_msgs > 0) {

            $position = $page * 10;
            $count = 0;

            if ($cat == 1) {
            $res = mysql_query("SELECT id, subject, fromid, state FROM messages WHERE toid = '$userId' AND state = '1'  ORDER BY id DESC LIMIT 0, $position");
                $msgCount = mysql_query("SELECT * FROM messages WHERE toid = '$userId' AND state = '1'");
            }
            else if ($cat == 2) {
                $res = mysql_query("SELECT id, subject, fromid, state FROM messages WHERE toid = '$userId' AND state = '0'  ORDER BY id DESC LIMIT 0, $position");
                $msgCount = mysql_query("SELECT * FROM messages WHERE toid = '$userId' AND state = '0'");
            }
            else {
                $res = mysql_query("SELECT id, subject, toid, state FROM messages WHERE fromid = '$userId'  ORDER BY id DESC LIMIT 0, $position");
                $msgCount = mysql_query("SELECT * FROM messages WHERE fromid = '$userId'");
            }

            $noOfMsgs = mysql_num_rows($msgCount);

            if ($noOfMsgs == 0 ){
                echo "<body style='background-color: #eee'><div class='jumbotron'>";

                echo "<big>no messages!</big>";

                echo "</div></body>";
            }


            while ($row = mysql_fetch_array($res)) {

                $id = $row['id'];
                $subject = $row['subject'];

                if ($cat == 1 || $cat == 2) {
                $who = $row['fromid'];
                    $about = "from";
                }
                else {
                    $who = $row['toid'];
                    $about = "to";
                }

                $read = $row['state'];

                $result = mysql_query("SELECT login FROM user WHERE id = '$who'") or die(mysql_error());

                $no_of_rows1 = mysql_num_rows($result);

                if ($no_of_rows1 > 0) {
                    while ($row = mysql_fetch_row($result)) {
                        $fromName = $row[0];
                    }
                }


                echo "<center><a href='/shop_webservice/Messages.php?userlog=$userlog&&page=$page&&cat=$cat&&Messageview.php?@$id'>";
                echo "<button type='button' class='btn btn-default btn-lg active'>";
                echo "<table border='0' width='100%' style='width:100%; text-align: left;padding: 5px;border-width: 10px' >";

                echo "<tr><td style='width: 30%'>";

                if ($read > 0) {
                    echo "<img src='/shop_webservice/images/newmsg.png' height='50px' width='50px' class='img-rounded'>";
                } else {
                    echo "<img src='/shop_webservice/images/openmsg.png' height='50px' width='50px' class='img-rounded'>";
                }

                echo "</td><td style='padding: 5px; width: 60%'>";

                echo "$subject<br><small>$about : $fromName</small>";

                echo "</td><td><button type='button' class='btn btn-primary'>View</button></td>";
                echo "</tr>";
                echo "</table></button></a></center>";

                $count++;
                $next = $position - 15;

                if ($count == $next) {
                    echo "<a id='jump'></a>";
                }

            }
            if ($count % 10 != 0) {
                echo "<a id='jump'></a>";
            }

            $nextPage = $page + 1;

            if($noOfMsgs > $page*10){
            echo "<center><br><a href='/shop_webservice/Messages.php?userlog=$userlog&&page=$nextPage&&cat=$cat#jump'><button type='button' id='fat-btn' data-loading-text='loading...' class='btn btn-primary btn-lg btn-block'>More...</button></a></center>";
            }

        } else {

            echo "<body style='background-color: #eee'><div class='jumbotron'>";

            echo "<big>no messages!</big>";

            echo "</div></body>";

        }

    } else {

        echo "<div class='jumbotron'>";

        echo " <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='alert alert-danger'>
            <b>Error Login</b>
            </div>

        </div>

</div>";

        echo "</div>";
    }

}

?>

