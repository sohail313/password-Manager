<?php
require_once 'functions.php';

if($_POST){
  $salt = '!@#122+_';
  $fullname = fix_name($_POST['fullName']);
  $Musername = fix_name($_POST['Musername']);
  $Mpassword = hash('sha512',$salt.$_POST['Mpassword'].$salt);
  $Mconpassword = hash('sha512',$salt.$_POST['Mconpassword'].$salt);
  $Memail = $_POST['Memail'];

   if(!empty($fullname)&&!empty($Musername)&&!empty($Mpassword)&&!empty($Mconpassword)&&!empty($Memail)){
     if($Mpassword != $Mconpassword){
       echo " <p>please enter corect password</p>" ;
       header('Refresh:2, url= ../html/signup.php');
     }
     else{
       //check if the user exist or not
       $retriveUsername = RetriveUsername($Musername);  //retrive username from master_account
       if(isset($retriveUsername['M_USERNAME'])){
         echo "Name is alredy taken ".'<br>';
         header('Refresh:2, url= ../html/signup.php');
       }
       else{
        $query = "Insert into master_account(M_NAME,M_USERNAME,M_PASSWORD) values('$fullname','$Musername','$Mpassword')";
        $result = MyquerySelect($query);
        if($result) echo "successfully inserted"; else echo "Error occured".mysqli_error();
        header('Refresh:1 , url = ../html/login.php');

       }
     }

   }
   else{
     header('Refresh:0 , url= ../html/signup.php');
   }
  }
?>
