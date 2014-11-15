<?php


require_once('DBFunction.php');

$dbQuery = new DBFunction();
$response = array();

if(isset($_REQUEST['login']) && isset($_REQUEST['password'])){

    $login = $_REQUEST['login'];
    $password = $_REQUEST['password'];


    $userValidation = $dbQuery->authenticate($login, $password);

    if($userValidation != false){
        $numberofmsgs = $dbQuery->getNoOfMessages($login);

        $response['success'] = $numberofmsgs;


    } else {
        $response['error'] = 1;
        $response['error_msg'] = "incorrect username or password";

    }
    echo json_encode($response);

}else if(isset($_REQUEST['startPosition']) && isset($_REQUEST['endPosition'])){

    $startPosition = $_REQUEST['startPosition'];
    $endPosition = $_REQUEST['endPosition'];

    $productList = $dbQuery->getItems($startPosition, $endPosition);

    $response['product'] = $productList;

    echo json_encode($response);
}


else if(isset($_REQUEST['userName']) && isset($_REQUEST['password']) && isset($_REQUEST['fullname']) && isset($_REQUEST['email']) &&
    isset($_REQUEST['phoneNo'])){

    $dbQuery = new DBFunction();
    $response = array();

    $login = $_REQUEST['userName'];
    $password = $_REQUEST['password'];
    $fullname = $_REQUEST['fullname'];
    $email = $_REQUEST['email'];
    $phoneNo = $_REQUEST['phoneNo'];
    
    $valid = $dbQuery->registration($login,$password,$email,$phoneNo,$fullname);

    if($valid != false){

        $response['success'] = 1;

//        $to      =  $email;
//        $subject = 'Welcome to AnyThing';
//        $message = 'Thanks for create AnyThing account.';
//        $headers = 'From: webmaster@example.com' . "\r\n" .
//            'Reply-To: webmaster@example.com' . "\r\n" .
//            'X-Mailer: PHP/' . phpversion();
//
//        mail($to, $subject, $message, $headers);


    } else {
        $response['error'] = 1;
        $response['error_msg'] = "false";

    }
    echo json_encode($response);
    }

else if(isset($_REQUEST['messageuser'])){

    $userid = $_REQUEST['messageuser'];

    $numberofmsgs = $dbQuery->getNoOfMessages($userid);

    $response['newmsgs'] = $numberofmsgs;

    echo json_encode($response);
}