<?php
require_once('Connection.php');

class DataValid
{
    private $db;

    function __construct()
    {
        $connIns = Connection::getInstance();
        $this->db = $connIns->getConnection();
    }


//email validation
    public function validEmail($email)
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }else {
            return true;
        }

    }


//full name validation
    public function validFullName($fname)
    {

        $len = strlen($fname);


        if ($len < 10) {
            return false;
        } else {
            return true;
        }


    }


//phone number validation
    public function validPhone($phone)
    {

        if (preg_match('/^(NA|[0-9+-]+)$/',
            $phone)
        ) {
            return true;
        } else {
            return false;
        }


    }


//password equel validation
    public function validpassEqual($pass, $repass)
    {

        if ($pass == $repass) {


            return true;
        } else {

            return false;
        }


    }


}