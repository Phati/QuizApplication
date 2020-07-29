<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Answer Quiz</title>
</head>
<body>

    <div class="container-fluid">
        <div class="col-lg-8 offset-lg-2 jumbotron">
            <form action="quiz.php" method="POST">
                <div class="form-group form-row">
                    <input required id="quizID" name='quizID' type="text" class="form-control col-md-6 col-12 offset-md-3" placeholder="Enter the quiz id to answer the quiz">
                </div>
                <div class="form-group form-row">
                    <input required id="email" name='email' type="email" class="form-control col-md-6 col-12 offset-md-3" placeholder="Enter your email id">
                </div>
                <div class="form-row">
                    <button id="submit" type="submit" class="col-md-2 col-12 offset-md-5 btn btn-primary">Submit</button>
                </div>
                <label id="invalidQuiz" class="col-3 text-center" ></label>
            </form>
        </div>
    </div>

 <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <!--- Footer -->
<?php include("footer.html"); ?>

    <script>

$(document).ready(function () {

$("#quizID").change(getQNo);

function  getQNo() {
var q = $(this).val();

var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        if(this.responseText == "not_found"){
            $("#invalidQuiz").css("display","inline-block");
            $("#invalidQuiz").html("invalid Quiz ID");
            $("#submit").css("display","none");
        }
        else{
            $("#invalidQuiz").css("display","inline-block");
            $("#invalidQuiz").html("");
            $("#submit").css("display","inline-block");
        }
        
        
    }
};

xhttp.open("GET", "addQuestion.php?q="+ q +
            "&check=" + 0 + 
            "&t="+ Math.random() , true);

xhttp.send();
}
});

    </script>
    
</body>
</html>