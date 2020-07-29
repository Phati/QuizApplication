<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Quiz Generaator</title>
</head>
<body>

    <div class="container-fluid">
        <div class="col-lg-8 offset-lg-2 jumbotron">
            <h1 class="text-success display-4 text-center">Welcome to Quiz Generator</h1>
            <p class="text-center text-primary" style="font-size:larger;">Perfect place to create and conduct an online test, right on the go.</p>    
            <div style="margin-bottom: 5px;" class="container-fluid text-center"><a href="generateQuiz.php" class="btn btn-lg btn-success">Generate a new quiz</a></div>
            <div style="margin-bottom: 5px;" class="container-fluid text-center"><a href="answerQuiz.php" class="btn btn-lg btn-warning">Answer a quiz</a></div>
            <div class="container-fluid text-center"><a href="generateReport.php" class="btn btn-lg btn-primary">Generate Report</a></div>
            <div style="margin-top: 5px;" class="container-fluid text-center"><a href="about.php" class="btn btn-lg btn-dark text-white">About Quiz Generator</a></div>
        </div>
    </div>
     <br><br><br><br><br><br>
        <!--- Footer -->
<?php include("footer.html"); ?>
</body>
</html>