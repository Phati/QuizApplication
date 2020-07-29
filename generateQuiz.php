<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="createQuiz.js"></script>
    <script src="addQuestion.js"></script>
    <title>Generate Quiz</title>
</head>
<body>

    <div class="container-fluid">
        <div class="col-12 col-md-8 offset-md-2 jumbotron">
            <form class="form" action="">
             <div class="form-row">
                <div class="form-group col-md-10">
                    <label class="text-danger" for="email">Email Id</label>
                    <input type="email" class="form-control" id="email" placeholder="Please enter your email id">
                </div>
            </div>    
            
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="text-danger" for="quizName">Quiz Name</label>
                    <input type="text" class="form-control" id="quizName" placeholder="Please give your quiz a name">
                </div>
                
                <div class="form-group col-md-4">
                    <label class="text-danger" for="organiser">Organiser:</label>
                    <input type="text" class="form-control" id="organiser" placeholder="Please enter organiser's name">
                </div>

                <div class="form-group col-md-4">
                    <label class="text-danger" for="timeLimit">Time Limit (Minutes):</label>
                    <input type="number" min="2" value="5" class="form-control" id="timeLimit" placeholder="Enter duration of quiz">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="text-danger" for="marks">Marks per question</label>
                    <input type="number" min="1" value="1" class="form-control" id="marks" placeholder="Please give your quiz a name">
                </div>
                
                

                <div class="form-group col-md-4">
                <label class="text-danger" style='display: block;' for="organiser">Negative Marking:</label>
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default">
                            <input style="transform: scale(1.5);" name="nm" type="radio" id="negativeMarking" value="1" checked="checked" />  Yes  
                        </label>
                        <label class="btn btn-default">
                            <input style="transform: scale(1.5);" name="nm" type="radio" id="negativeMarking" value="0" />   No
                        </label>
                    </div>
                </div>

                <div id="nMarks"  class="form-group col-md-4">
                    <label class="text-danger" for="negativeMarks">Negative Marks per question</label>
                    <input type="number" min="1" value="1" class="form-control" id="negativeMarks" placeholder="">
                </div>
            </div>
            <button type="button" id="createQuiz" class="col-12 btn btn-primary">Create quiz</button>
           </form>
           <hr class="bg-danger">
           <label id="quizMessage" class="text-center" style="display: none;"></label>
        </div>
        
<!--------------------------------------------------------->


        <div class="col-12 col-md-8 offset-md-2 jumbotron" style="background-color:antiquewhite;">
            <form class="form" action="">
                <div class="form-group col-10" style="padding-left: 0%;">
                    <label class="text-danger" style="display: block;" for="quizID">Quiz ID:</label>
                    <input type="text" class="col-6 form-control" id="quizID" style="display: inline-block;" placeholder="">
                    <label id="invalidQuiz" class="col-3 text-center" ></label>
                </div>    

                <div class="form-group col-6" style="padding-left: 0%;">
                    <label class="text-danger" for="questionNo">Question No:</label>
                    <input disabled type="text" class="form-control" id="questionNo" placeholder="">
                </div>
                
                <div class="form-group">
                    <label class="text-danger" for="question">Question:</label>
                    <textarea class="form-control" id="question" placeholder="Question to be added"></textarea>
                </div>

                <div class="form-group col-md-5 col-12" style="padding-left: 0%; display:inline-block;">
                    <label class="text-danger" for="option1">Option 1:</label>
                    <input type="text" class="form-control" id="option1" placeholder="">
                </div>
                <div class="form-group col-md-5 col-12" style="padding-left: 0%; display:inline-block;">
                    <label class="text-danger" for="option2">Option 2:</label>
                    <input type="text" class="form-control" id="option2" placeholder="">
                </div>
                <div class="form-group col-md-5 col-12" style="padding-left: 0%; display:inline-block;">
                    <label class="text-danger" for="option3">Option 3:</label>
                    <input type="text" class="form-control" id="option3" placeholder="">
                </div>
                <div class="form-group col-md-5 col-12" style="padding-left: 0%; display:inline-block;">
                    <label class="text-danger" for="option4">Option 4:</label>
                    <input type="text" class="form-control" id="option4" placeholder="">
                </div>

                <div class="form-group col-md-5 col-12" style="padding-left: 0%; display:inline-block;">
                    <label class="text-danger" for="correct">Correct Option No:</label>
                    <input type="number" class="form-control" id="correct" placeholder="">
                </div>

                <button id="addQ" type="button" class="col-md-4 col-12 btn btn-success">Add Question</button>
                <label id="addMessage" class="text-center" style="display: none;"></label>
            </form>
        </div>

    </div>
 <br><br><br><br><br><br>
        <!--- Footer -->
<?php include("footer.html"); ?>
    <script>
        

    </script>
    
</body>
</html>
