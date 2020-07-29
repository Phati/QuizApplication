<?php
if($_GET['check'] == 0){
  $qID = $_GET['q'];
  if($qID == ""){
    echo "";
  }
  else{

 
$conn = new mysqli("localhost", "id13646060_swapnil", "l^I/M79&V5~*cx~[", "id13646060_quizgenerator");
if($conn->connect_error) {
  exit('Could not connect');  
}

$sql = "select * from quiz where quiz_id='".$qID."'";
$result = $conn->query($sql);

if($result->num_rows == 0){
    echo "not_found";
}

else{
  $sql = "select * from ".$qID;
  $result = $conn->query($sql);
  if($result->num_rows == 0){
    $qNo= 1;
    echo "$qNo";
  }
  else{
    $qNo= $result->num_rows + 1;
    echo "$qNo";
  }
}
}
}

else if($_GET['check'] == 1){
  $qID = $_GET['q'];
  $question = ($_REQUEST['question']);
  $option1 = ($_GET['option1']);
  $option2 = ($_GET['option2']);
  $option3 = ($_GET['option3']);
  $option4 = ($_GET['option4']);
  $correct = ($_GET['correct']);

 $conn = new mysqli("localhost", "id13646060_swapnil", "l^I/M79&V5~*cx~[", "id13646060_quizgenerator");
  if($conn->connect_error) {
    exit('Could not connect');  
  }
  ///*
  $stmt = $conn->prepare("INSERT INTO $qID (question,option1,option2,option3,option4,correct) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssss", $question, $option1, $option2, $option3, $option4, $correct);
  //*/
  
  /*
  $sql = "insert into ".$qID." (question,option1,option2,option3,option4,correct)
  values ('".addslashes($question)."','".$option1."','".$option2."','".$option3."','".$option4."','".$correct."')";
  if($conn->query($sql)==true){
  */
      if($stmt->execute()== true){
    echo "Question Added Successfully";
  }
  else echo "$conn->error()";
  
  
  
  }
?>