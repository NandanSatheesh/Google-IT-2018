currentTeam<?php
session_start();
?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
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
      <div class="container" style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:1000px;max-width:50%;">
        <div class="row">
          <a href="/index.html">
            <img src="images/logo.png" width="300px" alt="logo" style="padding-bottom:24px;">
          </a>
        </div>
        <div class="row">
          <div class="card bg-light col-lg-12">
            <div class="card-header">
                  <h2>Leader Board</h2>
            </div>
            <div class="card-body">
              <?php
                  error_reporting(E_ERROR | E_PARSE);

                  //configure this in college
                  $SERVERNAME = "localhost";
                  $SERVERUSER = "root";
                  $SERVERKEY = "firewall123";
                  $DATABASENAME = "googleit";
                  $currentTeam = $_SESSION["teamName"];

                  //new connection
                  $CONNECTION = mysqli_connect($SERVERNAME, $SERVERUSER, $SERVERKEY, $DATABASENAME);
                  if (!$CONNECTION) {
                      die("Connection failed: " . mysqli_connect_error());
                  }
                  $sql = "SELECT * FROM users ORDER BY QuestionID desc, TimeStamp" ;
                  $result = mysqli_query($CONNECTION, $sql);

                  if(!$result) {
                      die("ERROR Q" . mysqli_errno($CONNECTION));
                  }

                  echo "<table class='table' style='width:100%;'>";
                  echo "<tr>";
                  echo "<th> Team Name </th>" ;
                  echo "<th> No of URLS Found </th>" ;
                  echo "</tr>" ;
                  if ($result) {
                      $rc = 0;
                      while( $row = mysqli_fetch_assoc($result)) {
                          if($row['TeamName'] == $currentTeam){
                            echo "<tr class='table-active'>";
                         }
                          else if( $rc%2 == 1){
                              echo "<tr class='table-danger'>";
                          }
                          else{
                              echo "<tr class='table-success'>";
                          }
                          echo "<td> ".$row['TeamName']." </td>" ;
                          echo "<td> ".$row['QuestionID']." </td>" ;
                          echo "</tr>" ;
                          $rc+=1;
                      }
                  }
                  echo "</table>\n";
                  mysqli_close($CONNECTION);
                ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
