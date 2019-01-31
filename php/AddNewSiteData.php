<?php
session_start();
include 'functions.php';

if($_POST){
    $Websitename = $_POST['Websitename'];
    $Websiteurl = $_POST['url'];
    $username = $_POST['username'];
    $password = $_POST['Password'];
    $notes = $_POST['notes'];
    $curentSession_MID = $_SESSION['M_ID'];

    if(!empty($Websitename)&&!empty($Websiteurl)&&!empty($username)&&!empty($password)){
      if($_SESSION['logIN'] == "yes"){
        $query = "Insert into  site_account(USERNAME,PASSWORD,WEBSITE_NAME,WEBSITE_URL,M_ID,NOTES) values('$username','$password','$Websitename','$Websiteurl','$curentSession_MID','$notes')";
        $result = MyquerySelect($query);
        if($result){
          echo "successfully inserted";
        }
        else{
          echo "Error occured".mysqli_error();
        }
        header('Refresh:1 , url = ../html/sitelist.php');
      }
      else{
        echo "NOT Logged IN";
      }
    }
    else{
      echo "Somthing is missing";
    }

}






?>
