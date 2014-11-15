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

    if (isset($_REQUEST['userlog']) && isset($_REQUEST['who'])) {


        $userlog = $_REQUEST['userlog'];
        $item = $_REQUEST['who'];

        //get user id from name
        $sell = mysql_query("SELECT id FROM user WHERE login = '$userlog'") or die(mysql_error());


        $no_of_rows1 = mysql_num_rows($sell);

        while ($row = mysql_fetch_row($sell)) {
            $userId = $row[0];
        }


        //get item details from item id
        $result = mysql_query("SELECT * FROM user WHERE login = '$item'") or die(mysql_error());


        $no_of_rows2 = mysql_num_rows($result);


        if ($no_of_rows1 > 0 && $no_of_rows2 > 0) {

            while ($row = mysql_fetch_row($result)) {
                $user_id = $row[0];
                $user_name = $row[1];
                $user_pass = $row[2];
                $user_fullName = $row[3];
                $user_email = $row[4];
                $user_phone = $row[5];
                $user_location = $row[6];
                $user_image = $row[7];
                $user_regDate = $row[9];
                $user_gender = $row[10];
            }


            echo "<div class='panel panel-primary'>";
            echo "<div class='panel-heading'>";
            echo "<h2 class='panel-title'>$user_name</h2>";
            echo "</div><div class='panel-body'>";
            echo "<img src='/shop_webservice/profilepic/$user_image' height='180px' width='180px' class='img-rounded'><br><br>";

            echo "<table class='table'>";
            echo "<tr><td>Full Name:</td><td>";
            echo "$user_fullName";
            echo "</td></tr><tr><td>Email:</td><td>";
            echo "$user_email";
            echo "</td></tr><tr><td>Gender :</td><td>";
            echo "$user_gender";
            echo "</td></tr><tr><td>Phone :</td><td>";
            echo "$user_phone";
            echo "</td></tr><tr><td>Location :</td><td>";
            echo "$user_location";
            echo "</td></tr><tr><td>Registered :</td><td>";
            echo "$user_regDate";

            echo "</td></tr>";
            echo "</table>";

            //if the user is the seller
            if ($userlog == $item) {
                echo "<div class='alert alert-warning' style='text-align: center'>
    <button type='button' class='btn btn-warning btn-xs' data-toggle='modal' data-target='#myModalProfileEd'>Edit</button>
    </div>";
            }


            echo "</div></div>";


            //Forum for Send massage to seller
            echo "<div class='modal fade' id='myModalProfileEd' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                <h4 class='modal-title' id='myModalLabel'>Profile Edit</h4>
            </div>

            <form action='/shop_webservice/ProfileEdit.php' method='post' enctype='multipart/form-data'>
                <div class='modal-body'>
                <input type='hidden' name='user' value='$userlog'/>
                    Full Name
                    <input type='text' name='fname' class='form-control' placeholder='Full Name' value='$user_fullName'><br>
                    Email
                    <input type='text' name='email' class='form-control' placeholder='Email' value='$user_email'><br>
                    Phone No
                    <input type='text' name='phone' class='form-control' placeholder='Phone No' value='$user_phone'><br>


                    Gender<br>
    <input type='radio' name='gender' value='Male'  checked>Male
    &nbsp&nbsp<input type='radio' name='gender' value='Female'>Female
<br><br>

                    Location
                    <input type='text' name='location' class='form-control' placeholder='Location' value='$user_location'><br>
                    Password
                    <input type='password' name='pass' class='form-control' placeholder='Password' value='$user_pass'><br>
                    Re-Type Password
                    <input type='password' name='repass' class='form-control' placeholder='Re-Type Password' value='$user_pass'><br>

Profile Picture<br>
<input type='file' name = 'image' id= 'image'><br/>


                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                    <input type='submit' id='submitDetails' class='btn btn-primary' name='Add' value='Save Changes' />
                </div>
            </form>

        </div>
    </div>
</div>";


        } else {

            echo "<div class='jumbotron'>";

            echo " <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='alert alert-danger'>
            <b>Sorry. This user doesn't exits!</b>
            </div>
                <div class='modal-body'><center>
                 <a href='&&action=backToTheList'><button type='button' class='btn btn-default' data-dismiss='modal'>Back</button></a>
                </center></div>
        </div>

</div>";

            echo "</div>";

        }

    }

    ?>
</div>


