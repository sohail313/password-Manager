<?php
require_once 'functions.php';
$sid = (int) $_GET['del'];
connect_db();
$query = "Delete from site_account where S_ID = $sid";
$resul = MyquerySelect($query);
header('Refresh:0, url = ../html/sitelist.php');
 ?>
