<?php
error_reporting(E_ALL ^ E_DEPRECATED);

require_once('Config.php');
class Connection {


    public static function getInstance(){
        static $instance = null;

        if($instance == null){

            $instance = new Connection();
        }

        return $instance;
    }


    public function getConnection(){

        $conn = mysql_connect(HOST, USER, PASSWORD);
        mysql_select_db(DATABASE);
        return $conn;

    }

    public function close(){

        mysql_close();

    }



} 