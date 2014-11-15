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

    if (isset($_REQUEST['userlog'])) {

        $userlog = $_REQUEST['userlog'];


        //get user id from name
        $sell = mysql_query("SELECT id FROM user WHERE login = '$userlog'") or die(mysql_error());
        $no_of_rows1 = mysql_num_rows($sell);

        if ($no_of_rows1 > 0) {

            while ($row = mysql_fetch_row($sell)) {
                $userId = $row[0];
            }

            echo "<div class='panel panel-primary'>";
            echo "<div class='panel-heading'>";
            echo "<h2 class='panel-title'>Advance Information</h2>";
            echo "</div><div class='panel-body'>";


            echo "<form action='UpdatedPro.php' method='post' enctype='multipart/form-data'>
<b>Gender</b><br>
    <input type='radio' name='gender' value='Male'  checked>Male
    &nbsp&nbsp<input type='radio' name='gender' value='Female'>Female
<br><br>

<b>Profile Picture</b><br>
<input type='file' name = 'image' id= 'image'><br/>

<input type='hidden' name='user' value='$userId'/>
<input type='submit' id='submitDetails' class='btn btn-primary' name='Add' value='Submit' />


</form>";

            $time = date('Y-m-d H:i:s');

            mysql_query("UPDATE user SET regDate = '$time' WHERE login = '$userlog';") or die(mysql_error());

            echo "<br><br><center><a href='ProfileUpdate.php?userlog=$userlog&&action=backToTheMain'><button type='button' class='btn btn-default' data-dismiss='modal'>Skip</button></a></center>";




            echo "</div></div>";

        }else {
            echo "<div class='alert alert-danger'>Error Login!</div>";
        }
    }
    ?>

</div>