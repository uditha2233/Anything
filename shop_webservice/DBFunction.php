<?php


require_once('Connection.php');
class DBFunction {

    private $db;

   function __construct(){

        $connIns = Connection::getInstance();
        $this->db = $connIns->getConnection();

   }

    //check user login details correct
    public function authenticate($userName, $password){
        $result = mysql_query("SELECT * FROM user WHERE login = '$userName' AND password = '$password'") or die(mysql_error());
        $no_of_rows = mysql_num_rows($result);

        if($no_of_rows > 0){
            return true;

        } else {

            return false;
        }
    }


    //get product data
	public function getItems($startPosition, $endPosition){
        $query = "SELECT * FROM shop_items LIMIT $startPosition, $endPosition";

        $resultSet = Array();

        $result = mysql_query($query) or die (mysql_error());

        while($fetchResult = mysql_fetch_array($result,MYSQL_ASSOC)){
            $resultSet[] = $fetchResult;
        }

        mysql_free_result($result);

        return $resultSet;

	}
	
	  public function registration($login,$password,$email,$phoneNo,$fullname){

          $username = trim($login, '"');
          $emailadd = trim($email, '"');

          $result_login = mysql_query("SELECT * FROM user WHERE login = '$username'") or die(mysql_error());
          $no_of_rows_login = mysql_num_rows($result_login);

          $result_email = mysql_query("SELECT * FROM user WHERE email = '$emailadd'") or die(mysql_error());
          $no_of_rows_email = mysql_num_rows($result_email);

          if($no_of_rows_login > 0){
              return false;

          }else if($no_of_rows_email > 0){
              return false;

          }

          else {

        mysql_query("INSERT INTO user (login,password,email,phone,fullname)
        VALUES ($login,$password,$email,$phoneNo,$fullname)");

        return true;
          }
    }


    //get message data
    public function getMessages($userId){

        $result = mysql_query("SELECT id FROM user WHERE login = '$userId'") or die(mysql_error());


        $no_of_rows = mysql_num_rows($result);

        while($row=mysql_fetch_row($result)){
            $user = $row[0];
        }


        $query = "SELECT * FROM messages WHERE toid = '$user'";

        $resultSet = Array();

        $result = mysql_query($query) or die (mysql_error());

        while($fetchResult = mysql_fetch_array($result,MYSQL_ASSOC)){
            $resultSet[] = $fetchResult;
        }

        mysql_free_result($result);

        return $resultSet;

    }


    //get message data
    public function getNoOfMessages($userId){

        $result = mysql_query("SELECT id FROM user WHERE login = '$userId'") or die(mysql_error());


        $no_of_rows = mysql_num_rows($result);

        while($row=mysql_fetch_row($result)){
            $user = $row[0];
        }


        $query = "SELECT * FROM `messages` WHERE `toid` = '$user' AND `state`='1'";

        $resultSet = Array();
        $count = 0;

        $result = mysql_query($query) or die (mysql_error());

        while($fetchResult = mysql_fetch_array($result,MYSQL_ASSOC)){

            $count++;
        }

        return $count;

    }
	
}