<?php
$quizID = $_POST['quizID'];

$email = $_POST['email'];

$conn = new mysqli("localhost", "id13646060_swapnil", "l^I/M79&V5~*cx~[", "id13646060_quizgenerator");
if($conn->connect_error) {
  exit('Could not connect');  
}
/*
$sql = "select * from $quizID";
$result = $conn->query($sql);

$data = array();
if($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $data[] = $row;
    }
  }
  $myJSON = json_encode($data);
*/

$sql = "select * from quiz where quiz_id = '".$quizID."'";  
$result = $conn->query($sql);
$row = $result->fetch_assoc();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>Quiz</title>
    <style>
        @media only screen and (max-width: 576px) {
            .margin-btn{
                margin-top: 20px;
            }          
        }
    </style>
            
</head>
<body style="background-color:cornsilk;"> 
    
    <div class="container" style="margin-top: 50px;"> 
    <p id="quizRules"></p>
        <div class="alert alert-success col-md-2 text-danger" style="font-size:2.5em; margin-bottom:10px;" id="timerDisplay"></div>
        <div id="quizNav" class="bg-warning col-md-12" style="padding: 2%;"></div>
    
        <div id="quizName" style="margin-top: 10px;" class="alert alert-info text-center display-4"></div>
            <div class="card border-success bg-light" style="margin-top: 20px;">
              <div class="card-body">
                <h4 style="height: 250px;font-size: 15px; background-color: paleturquoise; padding: 2%;" id="question" 
                class="card-title question"></h4>
                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-6 col-sm-6">
                        <button id="option-1" onClick="storeResponse(this)" type="button" class="options text-left btn btn-dark btn-lg btn-block" style="font-size: 15px;"><span>A: </span></button>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <button id="option-2" onClick="storeResponse(this)" type="button" class="options text-left btn btn-dark btn-lg btn-block margin-btn" style="font-size: 15px;"><span>B: </span></button>
                    </div>
                </div>

                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-6 col-sm-6">
                        <button id="option-3" onClick="storeResponse(this)" type="button" class="options text-left btn btn-dark btn-lg btn-block" style="font-size: 15px;"><span>C: </span></span><span> </span></button>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <button id="option-4" onClick="storeResponse(this)" type="button" class="options text-left btn btn-dark btn-lg btn-block margin-btn" style="font-size: 15px;"><span>D: </span> </button>
                    </div>
                </div>
              </div>
              <div class="card-footer">
                  <span id="questionIndex" class="col-md-4 text-primary" style="display: block; margin-bottom: 8px;"></span>
                  <button id="prev" type="button" class="btn btn-success">&lt;&lt;Prev</button>
                  <button id="next" type="button" class=" btn btn-success">Next&gt;&gt</button>
                  <button id="submit" type="button" class=" btn btn-info">Submit</button> 
              </div>
            </div>
            <p id="result" class="text-danger alert alert-info" 
            style="font-size: large; margin-top: 10px; display: none; "></p>
    </div>
 <br><br><br><br><br><br>
        <!--- Footer -->
<?php include("footer.html"); ?>
    <script>
    var qid = '<?php echo $quizID ?>';
    
    var participant = '<?php echo $email ?>';
        var quizInfo = JSON.parse('<?php echo json_encode($row); ?>');
        /*
        var data = [];
         data = JSON.parse('<?php echo $myJSON ?>');
         console.log(data);
        */
        
        var data = [];
        var questionsarray = [];
          //-------------------------------------------------------------------------------------
                /* The object constructor for question */
        function Question(question, options, answer){
                    this.question = question;
                    this.options = options;
                    this.answer =answer;
                    this.response; 
                    this.answered = 0;
                }
                
                
                
                
            //---------------------------------------------------------------------------------------
            /* Quiz Constructor
                takes the array of all the question objects
            */
            function Quiz(questions){
                this.score = 0;
                this.questions = questions;
                this.questionIndex = 0;
                this.participant;
            }
            
            
            var quiz;
            var button;
        let submitted = 0;
       
    </script>   
   
    <script src="quiz.js"></script>
   
    <script>
        var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                 var res= JSON.parse(this.responseText);
                
                data = res;
                
                for(var i=0;i<data.length;i++){
                 questionsarray.push(new Question(data[i].question,
                        [data[i].option1,data[i].option2,data[i].option3,data[i].option4],
                     data[i].correct-1));
                }
            
            
                 /* Instantiate the Quiz- only one object that is for one participant*/
            quiz = new Quiz(questionsarray);
            //---------------Take Participant name-----------------
            quiz.participant = participant;

            for(let i=0;i<quiz.questions.length;i++)
            {
                 button = "<button id='" + 
                                (i+1) +
                                "' onClick='navigate(this)' style='width: 63px;  margin-right: 8px; margin-bottom: 5px;' class='qBtn btn btn            -default'>Q" + 
                                (i+1) + 
                                "</button>";
                    $("#quizNav").append(button);
            }
                
                
                /* Call the showQuestion() function, first time once to display the first question */
            showQuestion();

            }//if(this.readyState == 4 && this.status == 200) end here
        };
        
        
        xhttp.open('GET',"getData.php?check="+ 1 +
                    "&ID="+ qid +
                    "&q="+ Math.random()  
                    ,true);
        xhttp.send();
    </script>
       
    
</body>
</html>

