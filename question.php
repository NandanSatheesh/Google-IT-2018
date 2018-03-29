<?php
session_start();
?>
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
<?php
    function debug_to_console( $data ) {
        echo "<script>console.log('".$data."');</script>\n";
    }

    error_reporting(E_ERROR | E_PARSE);

    // Global Variables
    $servername = "localhost";
    $username = "root";
    $password = "firewall123";
    $dbname = "googleit";
    $sess_teamname = $_SESSION["teamName"];
    $prev_questionID = -1;
    if( isset($_POST['questionid']) ){
        $prev_questionID = $_POST['questionid'];
    }
    $prev_answer = -1;
    if( isset($_POST['answer']) ){
        $prev_answer = rtrim(strtolower($_POST['answer']));
    }


    // Establish a Connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failure retry: " . mysqli_connect_error());
    }

    // Check if Question was Correct
    if($prev_questionID>=0){
        $sql = "SELECT * FROM questions WHERE QuestionID = ".$prev_questionID." ";
        $result = mysqli_query($conn, $sql);
        if(!$result) {
            die("Query get previous Question ID Failed." . mysqli_errno($conn));
        }
        $row = mysqli_fetch_assoc($result);
        $correctans = strtolower($row['Answer']);
        if( $correctans==$prev_answer ){
            $sql = "UPDATE users SET QuestionID=".($prev_questionID + 1)." WHERE TeamName = '".$sess_teamname."' ";
            $result = mysqli_query($conn, $sql);
            if(!$result) {
                die("Querry correct answer failed: " . mysqli_errno($conn));
            }
        }
        else{
            debug_to_console("Wrong Answer");
        }
    }

    //Get Max Question
    $sql = "SELECT * FROM questions";
    $result = mysqli_query($conn, $sql);
    if(!$result) {
        die("Querry failed: " . mysqli_errno($conn));
    }
    $question_count = mysqli_num_rows($result)-1;


    // Display the Question
    $sql = "SELECT * FROM users WHERE TeamName = '".$sess_teamname."' ";
    $result = mysqli_query($conn, $sql);
    if(!$result) {
        die("Querry failed: " . mysqli_errno($conn));
    }
    $row = mysqli_fetch_assoc($result);
    $cur_questionID = $row['QuestionID'];

    // If all questions answered
    if( $cur_questionID > $question_count ){
      echo '<div class="container">';
      echo '<div class="container" style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%)">';
      echo '<div class="row">';
      echo '<img src="images/logo.png" alt="GoogleItLogo" style="margin:auto; max-width:50%; display:block;">';
      echo '</div>';
      echo '<div class="row">';
      echo '<h2>Congratulations on winning Google IT!</h2>';
      echo '<h3>Your Googling Skills are on point.</h3>';
      echo '<a href="/leaderboard.php" class="btn btn-danger" style="width:100%;"><h4>Leader Board</h4></a>';
      echo '</div>';
      echo '</div>';
      echo '</div>';
    }
    else{
      echo '<div class="container-fluid">';
      echo '<div class="container" style="position:relative;margin:auto;width:75%; min-width:40%;">';
      echo '<div class="row">';
      echo '<a href="/index.html" class="col-md-4">';
      echo '<img src="images/logo.png" width="100%" alt="logo" style="margin:auto; padding-top:5%; padding-bottom:5%">';
      echo '</a>';
      echo '<div class="col-md-4" style="margin:auto; padding-bottom:5%; padding-top:5%;">';
      echo "<h5> Team : ".$sess_teamname."</h5>";
      echo "</div>";
      echo '<a href="/leaderboard.php" class="btn btn-danger col-md-4" style="width:50%; margin:auto;"><h4>Leader Board</h4></a>';
      echo '</div>';
      echo '<div class="row">';
      echo '<div class="card bg-light" style="max-width:100%; margin:auto;">';
      echo '<div class="card-header">';
      echo "<h4> Question ".$cur_questionID." </h4>";
      echo '</div>';
      $sql = "SELECT * FROM questions WHERE QuestionID = ".$cur_questionID." ";
      $result = mysqli_query($conn, $sql);
      if(!$result) {
          die("Querry get cur question failed: " . mysqli_errno($conn));
      }
      $row = mysqli_fetch_assoc($result);
      $imgurl = $row['ImageURL'];
      echo '<div class="card-body">';
      echo "<img class='card-img-top' src='$imgurl' alt='Call Voluteer for help.' style='width:100%;'>";
      echo "<form action='question.php' method='post' style='margin:auto; width:100%; display:block; padding-top:5%;'>";
      echo "<input class='form-control'  name='answer' type='text' placeholder='Answer' >";
      echo "<input type='hidden' name='questionid' value='".$cur_questionID."' style='padding-bottom:24px'>";
      echo "<button type='submit' class='btn btn-danger' value='submit' style='margin:auto; width:50%; display:block;margin-top:5%'><h4>Submit</h4></button>";
      echo "</form>";
      echo '</div>';
      echo '</div>';
      echo '</div>';
      echo '</div>';
      echo '</div>';
    }
    mysqli_close($conn);
?>
</body>
</html>
