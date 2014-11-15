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
        echo "<h2 class='panel-title'>Post Your AD</h2>";
        echo "</div><div class='panel-body'>";


        echo "<form action='Add.php' method='post' enctype='multipart/form-data'>
    <input type='text' name='item' class='form-control' placeholder='Ad Title' maxlength='25'>

     <br>

    <select class='form-control' name='category'>
    <option value='6' value='6' selected='selected'>Select a Category</option>
    <option value='1'>Cell Phones & Accessories</option>
    <option value='2'>Computers & Tablet PCs</option>
    <option value='3'>Consumer Electronics</option>
    <option value='4'>Vehicles & Parts</option>
    <option value='5'>Services</option>
    <option value='6'>Other</option>
    </select>

    <br>

    <textarea name='description' class='form-control' rows='3' placeholder='Description' maxlength='150'></textarea><br>

<input type='file' name = 'image' id= 'image'><br/>

    <div class='input-group' style='width: 70%'>
  <span class='input-group-addon'>Rs.</span>
  <input type='text' name='price' class='form-control' maxlength='6'>
  <span class='input-group-addon'>/=</span>
</div>
<br>

<div class='input-group' style='width: 70%'>
  <span class='input-group-addon'>Quantity</span>
  <input type='text' name='quantity' class='form-control' value='1' maxlength='3'>
</div>
<br>
<input type='hidden' name='owner' value='$userId'/>
<input type='submit' id='submitDetails' class='btn btn-primary' name='Add' value='Add Item' />


</form>";




        echo "</div></div>";

        }else {
            echo "<div class='alert alert-danger'>Error Login!</div>";
        }
    }
    ?>

</div>