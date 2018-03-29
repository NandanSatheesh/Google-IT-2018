
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
              $CONNECTION = mysqli_connect($SERVERNAME, $SERVERUSER, $SERVERKEY, $DATABASENAME);
              // Check connection
              if (!$CONNECTION) {
                  die("Connection failed: " . mysqli_connect_error());
              }

              $row_count = (int) mysqli_num_rows( mysqli_query($CONNECTION, "SELECT * FROM users WHERE TeamName = '".$teamName."'") );


              if( $row_count > 0 ){
                  echo " <h2> Team Name already taken </h2>";
                  echo " <a href='./signup.html' class='btn btn-danger' style='width:50%;margin:auto'><h4>Try Again</h4></a> ";
              }
              else{
                  $teamName = mysqli_real_escape_string($CONNECTION, $teamName);
                  $teamPassword = mysqli_real_escape_string($CONNECTION, $teamPassword);

                  $SQL_QUERY = "INSERT INTO users (TeamName, Password, QuestionID, IPAddress) VALUES( '".$teamName."', '".$teamPassword."', 0, '".$_SERVER['REMOTE_ADDR']."')";

                  if ( mysqli_query($CONNECTION, $SQL_QUERY)) {
                       echo " <h2> Sign Up Successful </h2>";
                      $_SESSION["teamName"] = $teamName;
                      echo " <a href='./question.php' class='btn btn-success' style='width:50%;margin:auto'><h4>Continue</h4></a>";
                  }
                  else {
                      echo "Error: " . $SQL_QUERY . "<br>" . mysqli_error($CONNECTION);
                      echo " <a href='./signup.html' class='btn btn-danger' style='width:50%;margin:auto'><h4>Retry</h4></a> ";
                  }

              }
              mysqli_close($CONNECTION);
          ?>
        </div>
      </div>
    </div>
  </body>
</html>
