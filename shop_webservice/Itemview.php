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

if(isset($_REQUEST['userlog']) && isset($_REQUEST['item'])){


    $userlog = $_REQUEST['userlog'];
    $item = $_REQUEST['item'];

    //get user id from name
    $sell = mysql_query("SELECT id FROM user WHERE login = '$userlog'") or die(mysql_error());


    $no_of_rows1 = mysql_num_rows($sell);

    while($row=mysql_fetch_row($sell)){
        $userId = $row[0];
    }



    //get item details from item id
    $result = mysql_query("SELECT * FROM shop_items WHERE id = '$item'") or die(mysql_error());


    $no_of_rows2 = mysql_num_rows($result);

    if ($no_of_rows2 > 0) {

    while($row=mysql_fetch_row($result)){
        $item_id = $row[0];
        $item_name = $row[1];
        $item_price = $row[2];
        $item_description = $row[3];
        $item_owner = $row[4];
        $item_category = $row[5];
        $item_quantity = $row[6];
        $item_image = $row[7];
    }

    //get seller name and location from id
    $sell = mysql_query("SELECT login, location FROM user WHERE id = '$item_owner'") or die(mysql_error());


    $no_of_rows3 = mysql_num_rows($sell);

        if ($no_of_rows3 > 0) {

    while($row=mysql_fetch_row($sell)){
        $sellerName = $row[0];
        $item_location = $row[1];
    }


        echo "<div class='panel panel-primary'>";
        echo "<div class='panel-heading'>";
        echo "<h2 class='panel-title'>$item_name</h2>";
        echo "</div><div class='panel-body'>";
        echo "<a href='#' data-toggle='modal' data-target='#itemImageViewer'><img src='/shop_webservice/images/$item_image' height='180px' width='180px' class='img-rounded'></a><br><br>";

        echo "<table class='table'>";
        echo "<tr><td>Price:</td><td>";
        echo "Rs.$item_price/=";
        echo "</td></tr><tr><td>Quantity:</td><td>";
        echo "$item_quantity";
        echo "</td></tr><tr><td>Location :</td><td>";
        echo "$item_location";
        echo "</td></tr><tr><td>Seller :</td><td>";
        echo "$sellerName";

    if($userlog != $sellerName) {
        echo "<br><button class='btn btn-primary btn-xs' data-toggle='modal' data-target='#myModalSendMsg'>Contact Seller</button>";
    }

        echo "</td></tr>";
        echo "</table>";


    //item description view
        echo "<div class='panel-group' id='accordion'>
    <div class='panel panel-default'>
        <div class='alert alert-info'>
         <a data-toggle='collapse' data-parent='#accordion' href='#collapseOne'>
            <h5 class='panel-title'>
                Description
            </h5>
            </a>
        </div>
        <div id='collapseOne' class='panel-collapse collapse in'>
            <div class='panel-body'  style='text-align: center'>";
    echo "$item_description";
        echo "</div></div></div></div>";

    //if the user is the seller
if($userlog == $sellerName) {
    echo "<div class='alert alert-warning' style='text-align: center'>
    <button type='button' class='btn btn-warning btn-xs'>Edit</button>
    <button type='button' class='btn btn-danger btn-xs' data-toggle='modal' data-target='#itemDelete'>Delete</button>
    </div>";
}




        echo "</div></div>";


//Forum for Send massage to seller
    echo "<div class='modal fade' id='myModalSendMsg' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                <h4 class='modal-title' id='myModalLabel'>Message to: $sellerName</h4>
            </div>

            <form action='/shop_webservice/SendMsg.php' method='GET'>
                <div class='modal-body'>
                    <input type='hidden' name='from' value='$userId'/>
                    <input type='hidden' name='to' value='$item_owner'/>
                    <input type='hidden' name='about' value='$item_name'/>
                    <input type='hidden' name='item' value='$item'/>
                    <input type='text' name='subject' class='form-control' placeholder='Subject'>
                    <br>
                    <textarea class='form-control' name='msgbody' rows='3'></textarea>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                    <input type='submit' id='submitDetails' class='btn btn-primary' name='submitDetails' value='Send Message' />
                </div>
            </form>

        </div>
    </div>
</div>";



//item image viewer
    echo "<div class='modal fade' id='itemImageViewer' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
            </div>
                <div class='modal-body'><center>

                <img src='/shop_webservice/images/$item_image'>

                </center></div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                </div>


        </div>
    </div>
</div>";


    //own item delete
    echo "<div class='modal fade' id='itemDelete' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='alert alert-danger'>
            <b>Do you want to delete?</b>
            </div>
                <div class='modal-body'><center>
                 <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                 <a href='/shop_webservice/ItemDelete.php?userlog=$userlog&&item=$item'><button type='button' class='btn btn-danger'>Delete</button></a>
                </center></div>
        </div>
    </div>
</div>";

        }else {

            echo "<div class='jumbotron'>";

            echo " <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='alert alert-danger'>
            <b>Sorry. Seller doesn't exits!</b>
            </div>
                <div class='modal-body'><center>
                 <a href='/shop_webservice/Itemview.php?userlog=$userlog&&item=$item&&action=backToTheList'><button type='button' class='btn btn-default' data-dismiss='modal'>Back</button></a>
                </center></div>
        </div>

</div>";

            echo "</div>";

        }



    }else {

        echo "<div class='jumbotron'>";

        echo " <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='alert alert-danger'>
            <b>Sorry. This advertisment doesn't exits!</b>
            </div>
                <div class='modal-body'><center>
                 <a href='/shop_webservice/Itemview.php?userlog=$userlog&&item=$item&&action=backToTheList'><button type='button' class='btn btn-default' data-dismiss='modal'>Back</button></a>
                </center></div>
        </div>

</div>";

        echo "</div>";

    }



}

?>
</div>


