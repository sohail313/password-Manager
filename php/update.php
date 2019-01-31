<?php
  session_start();
 require_once '../php/functions.php';
  $upd = (int) $_GET['upd'];
?>

<!DOCTYPE html>
  <head>
      <title>Add new site</title>
      <link rel="stylesheet" href="../css/style.css"/>
      <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
  </head>
<body class="bodybgnew">
  <header>
    <div class="navbar">
      <nav>
        <ul>
          <li><a href="sitelist.php?userLoggedin=yes">SiteList</a></li>
          <li><a href="index.php?userLoggedin=no">Logout</a></li>
          <li><span><a href="#"><?php echo $_SESSION['CurrentUSER']; ?></a></span></li>
        </ul>
      </nav>
    </div>
  </header>
  <main>
    <div class="newsite">
    <?php $result = RetriveUserdata($_SESSION['M_ID']) ; ?>
     <?php
        if(mysqli_num_rows($result) == 0){
          echo '<br>'."<span id='message'>You have not saved any sites.</span>";
        }else{
     ?>
      <?php while($row = mysqli_fetch_array($result)){ ?>
      <form action="" method="POST">
        <h2>New Site Details</h2>
        <input type="text" name="Websitename" value="<?php echo $row['WEBSITE_NAME']; ?>" placeholder="Website Name" required="required"/><br>
        <input type="url" name="url" value="<?php echo $row['WEBSITE_URL']; ?>" placeholder="URL" required="required"/><br>
        <input type="text" name="username" value="<?php echo $row['USERNAME']; ?>" placeholder="Username" required="required"/><br>
        <input type="text" name="Password" value="<?php echo $row['PASSWORD']; ?>" placeholder="Password" required="required"/><br>
        <label>
			       <textarea id="notes" name="notes" placeholder="Notes"></textarea>
		    </label><br>
        <input id="savebtn" type="submit" value="Save">
      </form>
    <?php break; } } ?>
    </div>
  </main>
  <footer>
    <div class="copyright">
		   <p>2018 &copy; All Rights Reserved</p>
    </div>
  </footer>
</body>
</html>
<?php
if($_POST){
  $Websitename = $_POST['Websitename'];
  $Websiteurl = $_POST['url'];
  $username = $_POST['username'];
  $password = $_POST['Password'];
  $notes = $_POST['notes'];
  $curentSession_MID = $_SESSION['M_ID'];

  if(!empty($Websitename)&&!empty($Websiteurl)&&!empty($username)&&!empty($password)){
    if($_SESSION['logIN'] == "yes"){
        $query = "update site_account set USERNAME='$username',PASSWORD='$password',WEBSITE_NAME='$Websitename',WEBSITE_URL='$Websiteurl',NOTES='$notes' where S_ID =$upd ";
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
