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
<body style="background-color: #eee">


<?php


require_once('DBFunction.php');

$dbQuery = new DBFunction();
$response = array();

if (isset($_REQUEST['userlog']) && isset($_REQUEST['page']) && isset($_REQUEST['cat']) && isset($_REQUEST['search'])) {

    $userlog = $_REQUEST['userlog'];
    $page = $_REQUEST['page'];
    $cat = $_REQUEST['cat'];
    $search = $_REQUEST['search'];

    if ($search == "null") {
        $search = "";
    }


    $result = mysql_query("SELECT login FROM user WHERE login = '$userlog'") or die(mysql_error());


    $no_of_rows = mysql_num_rows($result);

    while ($row = mysql_fetch_row($result)) {
        $userName = $row[0];
    }

    if ($no_of_rows > 0) {

        // echo "Thanks you for login $userName ";

    } else {

        echo "Error";
    }

    $position = $page * 10;
    $count = 0;


    if ($cat > 1) {

        $newcat = $cat - 1;
        $countItems = mysql_query("SELECT * FROM shop_items WHERE approve = '1' AND item_category='$newcat' AND item_name LIKE '%$search%'");
        $noOfItems = mysql_num_rows($countItems);

        $res = mysql_query("SELECT id,item_name,item_price,item_image FROM shop_items WHERE approve = '1' AND item_category='$newcat' AND item_name LIKE '%$search%' ORDER BY id DESC LIMIT 0, $position");


    } else {

        $countItems = mysql_query("SELECT * FROM shop_items WHERE approve = '1' AND item_name LIKE '%$search%'");
        $noOfItems = mysql_num_rows($countItems);

        $res = mysql_query("SELECT id,item_name,item_price,item_image FROM shop_items WHERE approve = '1' AND item_name LIKE '%$search%' ORDER BY id DESC LIMIT 0, $position");

    }


    if ($noOfItems == 0) {
        echo "<body style='background-color: #eee;'><div class='jumbotron'>";
        echo "<center><big>No Items Exits!</big></center>";
        echo "</div></body>";
    }

    echo "<br>";
    while ($row = mysql_fetch_array($res)) {

        $id = $row ["id"];
        $image = $row ["item_image"];

        echo "<center><a href='/shop_webservice/MainPage.php?userlog=$userlog&&page=$page&&cat=$cat&&search=$search&&Itemview.php?@$id'>";
        echo "<button type='button' class='btn btn-default btn-lg active'>";
        echo "<table border='0' width='100%' style='width:100%; text-align: left;padding: 5px;border-width: 10px' >";

        echo "<tr><td style='width: 30%'><a href='/shop_webservice/MainPage.php?userlog=$userlog&&page=$page&&cat=$cat&&search=$search&&Itemview.php?@$id'>";
        echo "<img src='/shop_webservice/images/$image' height='70px' width='70px' class='img-rounded'></a>";
        echo "</td><td style='padding: 5px; width: 60%'><a href='/shop_webservice/MainPage.php?userlog=$userlog&&page=$page&&cat=$cat&&search=$search&&Itemview.php?@$id'>";
        echo $row ["item_name"];
        echo "</a><br>Rs.";
        echo $row ["item_price"];
        echo "/=</td><td><a href='/shop_webservice/MainPage.php?userlog=$userlog&&page=$page&&cat=$cat&&Itemview.php?@$id'><button type='button' class='btn btn-primary'>View</button></a></td>";
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

    if ($noOfItems > $page * 10) {
        echo "<center><br><a href='/shop_webservice/MainPage.php?userlog=$userlog&&page=$nextPage&&cat=$cat&&search=$search#jump'><button type='button' id='fat-btn' data-loading-text='loading...' class='btn btn-primary btn-lg btn-block'>More...</button></a></center>";
    }

} else {

    echo "<div class='jumbotron'><h3>Error Login</h3></div>";
}

?>

