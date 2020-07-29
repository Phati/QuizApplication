<?php
$sql = $_GET['sql'];

$conn = new mysqli("localhost", "id13646060_swapnil", "l^I/M79&V5~*cx~[", "id13646060_quizgenerator");
if($conn->connect_error) {
  exit('Could not connect');  
}
$result = $conn->query($sql);
$data = array();
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $data[] = $row;
    }
  }
echo json_encode($data);

?>

