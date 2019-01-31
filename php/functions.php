<?php

function fix_name($name){
	$name=trim($name);
	$name=ucfirst($name);
	return $name;
}

$link=null;
function connect_db(){
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "root";
    $db_name = "passmanager";
    global $link;
    $link = mysqli_connect($db_host,$db_user,$db_password,$db_name) or die(mysqli_error($link));

    // mysqli_select_db($link,$db_name) or die(mysqli_error($link));
}


function MyquerySelect($query){
    connect_db();
    global $link;
    $result = mysqli_query($link,$query);

    if(!$result){
        echo 'Somthing went wrong '.'<br>'.mysqli_error($link);
        die();
    }
    mysqli_close($link);
    return $result;
}
//function for Retrival of username to check user exist or not
function RetriveUsername($name){
    connect_db();
    $query = "Select * from master_account where M_USERNAME='$name' ";
    $result = MyquerySelect($query);
    $row = mysqli_fetch_array($result);
    return $row;
}

function destroy_session_and_data(){
    $_SESSION = array();
    // setcookie(session_name(), '', time() - 2592000, '/');
    session_destroy();

}
//function for Retrival user data to display the content
function RetriveUserdata($mid){
    connect_db();
    global $link;
    $query = "select S_ID, USERNAME,PASSWORD,WEBSITE_NAME,WEBSITE_URL,NOTES from site_account where M_ID ='$mid' order by WEBSITE_NAME";
    $result = mysqli_query($link,$query);
    if(!$result){
        echo 'Somthing went wrong '.'<br>'.mysqli_error($link);
        die();
    }
    mysqli_close($link);
    return $result;
}

// function SearchFromData($search,$mid){
//     connect_db();
//     global $link;
//     $query = "select USERNAME,WEBSITE_NAME,WEBSITE_URL,NOTES from site_account where  USERNAME like '%$search%' OR PASSWORD like '%$search%' OR WEBSITE_NAME like '%$search%' OR WEBSITE_URL like '%$search%' OR NOTES like '%$search%'";
//     $result = MyquerySelect($link,$query);
//     if(!$result){
//         echo 'Somthing went wrong '.'<br>'.mysqli_error($link);
//         die();
//     }
//     mysqli_close($link);
//     return $result;

// }

?>
