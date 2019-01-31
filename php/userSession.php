<?php
session_start();

// echo $_SERVER['PHP_SELF'];
if(array_key_exists('userLoggedin',$_SESSION)){
    echo "exists";
}
else{
    echo "not exists";
}
session_destroy();

?>