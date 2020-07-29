<?php 

/* Get all the column values into variables */

$quizName = $_GET['quizName'];
$organiser = $_GET['organiser'];
$timeLimit = $_GET['timeLimit'];
$marks = $_GET['marks'];
$negative = $_GET['negative'];
$negativemarks = $_GET['negativemarks'];
$quizID = $_GET['quizID'];
$email = $_GET['email'];
    
/*Create a connection to the database */
$conn = new mysqli("localhost", "id13646060_swapnil", "l^I/M79&V5~*cx~[", "id13646060_quizgenerator");
if($conn->connect_error) {
  exit('Could not connect');  
}
// else 
// echo "success";

/*Insert query*/
$sql = "INSERT INTO quiz (quiz_id,email,quiz_name,organiser,marks,time_limit,negative,negative_marks)
        VALUES('$quizID','$email','$quizName','$organiser','$marks','$timeLimit','$negative','$negativemarks')";

if ($conn->query($sql) === TRUE) {

    $sql = "CREATE TABLE `".$quizID."` (
      question_no tinyint primary key auto_increment,
      question text not null,
      option1 varchar(255) not null,
      option2 varchar(255) not null,
      option3 varchar(255) not null,
      option4 varchar(255) not null,
      correct tinyInt not null
    )";
    $conn->query($sql);

    echo "Quiz Created Successfully.<br>Your quiz Id is " .$quizID. 
    " ,Plesae note down the quiz id as it will be required to answer the quiz. <br> Now go down and add some questions to the quiz.";
    
    $to = "$email";
$subject = "Quiz creation email";

$message = "
<html style='font-family: sans-serif;
    line-height: 1.15;
    -webkit-text-size-adjust: 100%;
    -ms-text-size-adjust: 100%;
    -ms-overflow-style: scrollbar;
    -webkit-tap-highlight-color: transparent;'>
<head>
<title>About</title>

</head>
<body style='margin: 0;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    text-align: left;
    background-color: #fff;'>

  <div style='width: 100%;
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;max-width: 540px;'>
    

    <div style=' position: relative;
    width: 100%;
    min-height: 1px;
    padding-right: 15px;
    padding-left: 15px; -ms-flex-preferred-size: 0;
    flex-basis: 0;
    -webkit-box-flex: 1;
    -ms-flex-positive: 1;
    flex-grow: 1;
    max-width: 100%; padding: 2rem 1rem;
    margin-bottom: 2rem;
    background-color: #e9ecef;
    border-radius: 0.3rem;background-color: #343a40 !important;padding: 4rem 2rem;'>
      
      
      
      
      <h1 style='margin-top: 0;
    margin-bottom: 0.5rem;color: #fff !important;font-size: 2.5rem;
  '>Hey! $organiser your quiz has been successfully created.</h1>
      
      <h3 style='margin-top: 0;
    margin-bottom: 0.5rem;color: #ffc107 !important;font-size: 1.75rem;'>
      Your Quiz ID is $quizID
    </h3>
      
      <br>
      
      
      <a style='color: #007bff;
    text-decoration: none;
    background-color: transparent;
    -webkit-text-decoration-skip: objects;' href='http://lockdownproject.000webhostapp.com/quizGenerator/generateQuiz.php'>
        <button style='border-radius: 0;
    outline: 1px; margin: 0;
    font-family: inherit;
    font-size: inherit;
    line-height: inherit;overflow: visible;text-transform: none;display: inline-block;
    font-weight: 400;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    border: 1px solid transparent;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: 0.25rem;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;color: #fff;
    background-color: #28a745;
    border-color: #28a745;'>
        Add questions to the quiz
      </button>
      </a>
      
      
      
      <br>
      <br>
      
      
      <h4 style='margin-top: 0;
    margin-bottom: 0.5rem;font-size: 1.5rem;color: #fff !important;'>
        What you can do on Quiz Generator:-</h4>
      
      
      <p style=' margin-top: 0;
    margin-bottom: 1rem;'>
        
      
      <ul style='margin-top: 0;
    margin-bottom: 1rem;margin-bottom: 0;color: #17a2b8 !important;'>
          <li>Quiz Generator is a free tool for Organising Online Tests and Quizs</li>
          
          <li>You just need to create a quiz by filling in the details, after which you will recieve the quiz id.</li>
          
          <li>It allows you to set the time limit for the quiz and also to add negative marking scheme.</li>
          
          <li>Then you can add questions to your quiz using the quiz id. Just make sure the quiz is not an easy one.</li>
          
          <li>Now you can share the Quiz ID to those whom you want to test. And ask them to submit before before time. If not no worries as the quiz gets auto submitted.</li>
          
          <li>Now go to the generate report page and again enter the same quiz id and there you go!</li>
          
          <li>You can sort the report using the available options and download the pdf of the report.</li>
        
      
      
      
        </ul>
      
      </p>
    
    </div>
  </div>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <phatisavant@gmail.com>' . "\r\n";

mail($to,$subject,$message,$headers);
    
    
    
  } else {
    echo "Quiz could not be created. Please try again";
  }



?>