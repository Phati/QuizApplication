<?php
  $email = $_GET['email'];
  $quizID = $_GET['quizID'];
  $score = $_GET['score'];
  $totalAnswered = $_GET['totalAnswered'];
  $totalUnanswered = $_GET['totalUnanswered'];
  $totalCorrect = $_GET['totalCorrect'];
  $totalWrong = $_GET['totalWrong'];
  $outOf = $_GET['outOf'];
  $timeTaken = $_GET['timeTaken'];
  $responses = $_GET['responses'];
  implode(",",$resposes);
echo $responses;
  $conn = new mysqli("localhost", "id13646060_swapnil", "l^I/M79&V5~*cx~[", "id13646060_quizgenerator");
  if($conn->connect_error) {
    exit('Could not connect');  
  }
  
  $sql = "insert into response (email,quiz_id,score,total_answered,total_unanswered,total_correct,total_wrong,out_of,time_taken,responses)
  values ('".$email."','".$quizID."','".$score."','".$totalAnswered."','".$totalUnanswered."','".
  $totalCorrect."','".$totalWrong."','".$outOf."','".$timeTaken."','".$responses."')";
  if($conn->query($sql)==true){
    echo "Rsponse submitted Successfully";
  }
  else echo "$conn->error()";
  
  
  

?>