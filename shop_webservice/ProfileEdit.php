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
require_once('DataValid.php');

$dbQuery = new DBFunction();
$validQuery = new DataValid();
$response = array();

$userName = $_POST["user"];


$image_name = $_FILES["image"]["name"];
$img_nameLen = strlen($image_name);

$temp = $_FILES["image"]["tmp_name"];
$error = $_FILES ["image"]["error"];
$type = $_FILES ["image"]["type"];


$image_path = "profilepic";


if (isset($_POST['Add']) && (isset($_POST['pass'])) && (isset($_POST['repass'])) && (isset($_POST['fname'])) && (isset($_POST['email']))) {

    $gender = $_POST["gender"];
    $fullName = $_POST['fname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $pass = $_POST['pass'];
    $repass = $_POST['repass'];
    $location = $_POST['location'];

    $fullnameValidation = $validQuery->validFullName($fullName);
    $emailValidation = $validQuery->validEmail($email);
    $phoneValidation = $validQuery->validPhone($phone);
    $passValidation = $validQuery->validpassEqual($pass, $repass);

    if ($fullnameValidation) {

        if ($emailValidation) {

            if ($phoneValidation) {

                if ($passValidation) {

                    if ($img_nameLen > 0 ){
                    if ($type == "image/png"
                        || $type == "image/jpeg"
                        || $type == "image/jpg"
                        || $type == "image/pjpeg"
                        || $type == "image/x-png"
                        || $type == "image/gif"
                    ) {

                        move_uploaded_file($temp, "$image_path/$image_name");


                        echo "<div class='jumbotron'>";

                        echo " <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='alert alert-success'>
            <b>Profile Updated successfully</b>
            </div>
                <div class='modal-body'><center>
                 <a href='/shop_webservice/ProfileView.php?userlog=$userName&&who=$userName&&action=backToTheItem'><button type='button' class='btn btn-default' data-dismiss='modal'>Continue</button></a>
                </center></div>
        </div>

</div>";

                        echo "</div>";


                        mysql_query("UPDATE user SET password = '$pass', fullname = '$fullName', email = '$email', phone = '$phone', location = '$location', gender = '$gender', profile_pic = '$image_name' WHERE login = '$userName';") or die(mysql_error());

                    } else {

                        echo "<div class='jumbotron'><div class='alert alert-danger'>The file that you are trying to upload couldn't be an
             image.Please check again!!</div>";
                        echo "<a class='btn btn-primary' role='button' href='/shop_webservice/ProfileView.php?userlog=$userName&&who=$userName&&action=backToTheItem'>Back</a></div>";
                    }

                    }else{


                        echo "<div class='jumbotron'>";

                        echo " <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='alert alert-success'>
            <b>Profile Updated successfully</b>
            </div>
                <div class='modal-body'><center>
                 <a href='/shop_webservice/ProfileView.php?userlog=$userName&&who=$userName&&action=backToTheItem'><button type='button' class='btn btn-default' data-dismiss='modal'>Continue</button></a>
                </center></div>
        </div>

</div>";

                        echo "</div>";


                        mysql_query("UPDATE user SET password = '$pass', fullname = '$fullName', email = '$email', phone = '$phone', location = '$location', gender = '$gender' WHERE login = '$userName';") or die(mysql_error());



                    }


                } else {
                    echo "<div class='jumbotron'>";

                    echo " <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='alert alert-danger'>
            <b>Error : Passwords are not equel!</b>
            </div>
                <div class='modal-body'><center>
                 <a href='/shop_webservice/ProfileView.php?userlog=$userName&&who=$userName&&action=backToTheItem'><button type='button' class='btn btn-default' data-dismiss='modal'>Back</button></a>
                </center></div>
        </div></div>";
                    echo "</div>";
                }

            } else {
                echo "<div class='jumbotron'>";

                echo " <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='alert alert-danger'>
            <b>Error : Phone number invalid!</b>
            </div>
                <div class='modal-body'><center>
                 <a href='/shop_webservice/ProfileView.php?userlog=$userName&&who=$userName&&action=backToTheItem'><button type='button' class='btn btn-default' data-dismiss='modal'>Back</button></a>
                </center></div>
        </div></div>";
                echo "</div>";
            }

        } else {
            echo "<div class='jumbotron'>";

            echo " <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='alert alert-danger'>
            <b>Error : Email Invalid!</b>
            </div>
                <div class='modal-body'><center>
                 <a href='/shop_webservice/ProfileView.php?userlog=$userName&&who=$userName&&action=backToTheItem'><button type='button' class='btn btn-default' data-dismiss='modal'>Back</button></a>
                </center></div>
        </div></div>";
            echo "</div>";
        }

    } else {
        echo "<div class='jumbotron'>";

        echo " <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='alert alert-danger'>
            <b>Error : FullName Invalid!</b>
            </div>
                <div class='modal-body'><center>
                 <a href='/shop_webservice/ProfileView.php?userlog=$userName&&who=$userName&&action=backToTheItem'><button type='button' class='btn btn-default' data-dismiss='modal'>Back</button></a>
                </center></div>
        </div></div>";
        echo "</div>";
    }


} else {

    echo "<div class='jumbotron'>";

    echo " <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='alert alert-danger'>
            <b>Error Updating Profile!</b>
            </div>
                <div class='modal-body'><center>
                 <a href='/shop_webservice/ProfileView.php?userlog=$userName&&who=$userName&&action=backToTheItem'><button type='button' class='btn btn-default' data-dismiss='modal'>Back</button></a>
                </center></div>
        </div></div>";
    echo "</div>";

}
?>