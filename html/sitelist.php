<?php session_start(); ?>
<?php require_once '../php/functions.php'; ?>
<!DOCTYPE html>
<head>
  <title>Your List</title>
  <link rel="stylesheet" href="../css/style.css"/>
  <!-- <link rel="stylesheet" href="/css/style.css"/> -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
</head>
<body class="bodybglist">
  <header>
    <div class="navbar">
      <nav>
        <ul>
          <?php //if(array_key_exists('logIN',$_SESSION)){ ?>
          <?php if(array_key_exists('userLoggedin',$_SESSION)){ ?>
                <?php  if($_SESSION['userLoggedin'] == "yes"){ ?>
                    <li><span><a href="sitelist.php?userLoggedin=yes" >SiteList</a></span></li>
                    <li><span><a href="index.php?userLoggedin=no" >Logout</a></span></li>
                    <li><span><a href="#"><?php echo $_SESSION['CurrentUSER']; ?></a></span></li>
                    <?php }?>
              <?php }else{ ?>
            <li><span><a href="login.php>userLoggedin=no">LogIn</a></span></li>
            <?php header('Location: index.php?userLoggedin=no');  ?>
          <?php }?>
        </ul>

      </nav>
    </div>
  </header>
  <main>
    <div class="list">
    <h2>Sites</h2>
      <form action="newsite.php" method="POST">
        <input type="submit" name="submit"  value="+ Add New"><br>
      </form>
      <form method="GET">
      <input id="sear" type="search" name="search" placeholder="search my list">
      <input id="searchbtn" type="submit" formaction="sitelist.php"  value="Search"><br>
      </form>


    </div>
    <div class="content">

      <?php $result = RetriveUserdata($_SESSION['M_ID']) ; ?>
       <?php
          if(mysqli_num_rows($result) == 0){
            echo '<br>'."<span id='message'>You have not saved any sites.</span>";
          }else{
       ?>
       <?php while($row = mysqli_fetch_array($result)): ?>
          <div id="website" class="contentDiv"><span class="contentLable">Website Name:</span>  <span class="contentValue"><?php echo $row['WEBSITE_NAME']; ?></span></div>
          <div id="url" class="contentDiv"><span class="contentLable">Website Url:</span> <span class="contentValue"> <?php echo $row['WEBSITE_URL']; ?></span></div>
          <div id="username" class="contentDiv"><span class="contentLable">Username:</span>  <span class="contentValue"><?php echo  $row['USERNAME']; ?></span></div>
          <div id="password" class="contentDiv"><span class="contentLable">Password:</span> <span class="contentValue"> <?php echo $row['PASSWORD']; ?></span></div>
          <div id="note" class="contentDiv"><span class="contentLable">Notes:</span> <span class="contentValue"><?php echo $row['NOTES']; ?></span> </div>
          <div class="contentDiv" id="deletedata"> <a href="../php/delete.php?del=<?php echo $row['S_ID']; ?>"><button>Delete</button></a> </div>
          <div class="contentDiv" id="updatedata"> <a href="../php/update.php?upd=<?php echo $row['S_ID']; ?>"><button>Update</button> </a></div>

        <?php endwhile;?>
          <?php } ?>
      </div>

  </main>
  <footer>
    <div>
        <p>2018 &copy; All Rights Reserved</p>
    </div>
  </footer>
  <script src="../js/jquery-3.3.1.min.js"></script>
  <script src="../js/search.js"></script>

</body>
</html>
