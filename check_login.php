DATABASE_NAME
<?php
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="icon" type="image/png" href="/images/favicon.png">

    <script src="/js/main_script.js"></script>
    <!--BootStrap Scripts-->
    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <title>Google IT!</title>
  </head>
  <body>
    <div class="container">
      <div class="container" style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%)">
        <div class="row">
          <img src="images/logo.png" alt="GoogleItLogo" style="margin:auto; max-width:50%; display:block;">
        </div>
        <div class="row">
          <?php
              error_reporting(E_ERROR | E_PARSE);

              $SERVERNAME = "localhost";
              $SERVERUSER = "root";
              $SERVERKEY = "firewall123";
              $DATABASENAME = "googleit";

              $teamName = $_POST["teamname"];
              $teamPassword = $_POST["password"];

              // Create connection
              $CONNECTION = mysqli_connect($SERVERNAME,$SERVERUSER,$SERVERKEY,$DATABASENAME);
              // Check connection
              if (!$CONNECTION) {
                  die("Connection failed: " . mysqli_connect_error());
              }

              $loginAction = mysqli_query($CONNECTION, "SELECT * FROM users WHERE TeamName = '".$teamName."'");
              if(!$loginAction) {
                  die("ERROR Q: " . mysqli_errno($conn));
              }
              $rows = mysqli_num_rows($loginAction);

              if($rows>0){
                  $row = mysqli_fetch_assoc($loginAction);
                  if( $row['TeamName']==$teamName && $row['Password']==$teamPassword ){
                      echo " <h2> Login Success Successful </h2>";
                      $_SESSION["teamName"] = $teamName;
                      echo " <a href='/question.php' class='btn btn-danger' style='width:50%;margin:auto'><h4>Continue</h4></a> ";
                  }
                  else{
                      echo " <h2>Incorrect Password</h2>";
                      echo " <a href='./login.html' class='btn btn-danger' style='width:50%;margin:auto'><h4>Retry</h4></a> ";
                  }
              }
              else{
                  echo " <h2> Team Name Not Found </h2>";
                  echo " <a href='./login.html' class='btn btn-danger' style='width:50%;margin:auto'><h4>Retry</h4></a>";
              }

              mysqli_close($CONNECTION);
          ?>
        </div>
      </div>
    </div>
  </body>
</html>
