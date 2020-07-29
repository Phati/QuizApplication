<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Generate Report</title>
</head>
<body>

    <div class="container-fluid">
        <div class="col-lg-8 offset-lg-2 jumbotron">
            <form>
                <div class="form-group form-row">
                    <input required id="quizID" name='quizID' type="text" class="form-control col-md-6 offset-md-3 col-12" placeholder="Enter the quiz id to generate the report">
                </div>
                <div class="form-row">
                    <button style="margin-right:10px;" id="submit" type="button" class="col-md-2 offset-md-4 col-5 btn btn-primary">Get Report</button>

                    <div id="sortBy" style="display: none;" class="dropdown col-md-2 col-5">
                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                        Sort By:
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" id="sortEmail">Email</a>
                        <a class="dropdown-item" id="sortMarks">Highest score</a>
                        <a class="dropdown-item" id="sortTime">Least time taken</a>
                    </div>
                </div>
                </div>
                <label id="invalidQuiz" style="margin: auto;" class="text-danger col-3 text-center" ></label>
            </form>
        </div>
    </div>

    <div id="content"  class="container-fluid table-responsive">




    </div>
    <div id="editor"></div>
    <button  type="button" class="btn btn-danger" style="display: none; margin: auto;" id="cmd">Download PDF</button>
    <br><br><br><br><br><br><br><br><br><br><br><br>

    <!--- Footer -->
<?php include("footer.html"); ?>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
$(document).ready(function () {
let Qid;

$("#submit").click(getQNo);

function  getQNo() {

Qid= $("#quizID").val(); 
var q = $("#quizID").val();
let sql;
if($("#quizID").val() == "")
{
    $("#invalidQuiz").css("display","inline-block");
            $("#invalidQuiz").html("Cannot be empty");
            $("#tableReport").html("");
            $("#cmd").css("display","none");
            $("#sortBy").css("display","none");
            return;
}

else{


var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        if(this.responseText == "not_found"){
            $("#invalidQuiz").css("display","inline-block");
            $("#invalidQuiz").html("invalid Quiz ID");
            $("#tableReport").html("");
            $("#cmd").css("display","none");
            $("#sortBy").css("display","none");
        }
        else{
            $("#invalidQuiz").css("display","none");
            sql = "SELECT * FROM `response` "+
                    "WHERE quiz_id = '"+$("#quizID").val() + "'";
                    $("#cmd").css("display","block");
                    $("#sortBy").css("display","inline-block");
                    getReport(sql);

        }


    }
};

xhttp.open("GET", "addQuestion.php?q="+ q +
            "&check=" + 0 +
            "&t="+ Math.random() , true);

xhttp.send();
}

}

function getReport(sql){
    console.log(sql);
 let xhttp = new XMLHttpRequest();
 xhttp.onreadystatechange = function() {
     if(this.readyState == 4 && this.status == 200){
        var data = JSON.parse(this.responseText);
    console.log(data);
    displayRecord(data);
     }
};

xhttp.open("GET", "report.php?sql="+ sql +
            "&t="+ Math.random() , true);

xhttp.send();
}

function displayRecord(data){
    //innerTables = "<h3 class='text-center text-success'>Quiz ID:- "+ $("#quizID").val() + "<br>Report generated on: " + new Date().toUTCString()+"</h2>";
    var innerTables = "<table id='tableReport' class='table table-bordered  table-hover'>";
    innerTables += "<thead>";
    innerTables += "<tr class='bg-success'>";
    innerTables += "<th colspan='10'>Quiz ID:- " + $("#quizID").val() + "<br>Report generated on: "+ new Date().toUTCString() + "</th>";
    innerTables += "</tr>";
    innerTables += "<tr class='bg-warning'>";
    innerTables += "<th>Response ID</th>";
    innerTables += "<th>Email</th>";
    innerTables += "<th>Date of submission</th>";
    innerTables += "<th>Time taken</th>";
    innerTables += "<th>Score</th>";
    innerTables += "<th>Out of</th>";
    innerTables += "<th>Total Answered</th>";
    innerTables += "<th>Total Unanswered</th>";
    innerTables += "<th>Total correct</th>";
    innerTables += "<th>Total Incorrect</th>";
    innerTables += "</tr>";
    innerTables += "</thead>";

    for(var i = 0; i < data.length; i++){
        innerTables += "<tr>";
        innerTables += "<td>" + data[i].response_id + "</td>";
        innerTables += "<td>" + data[i].email + "</td>";
        innerTables += "<td>" + data[i].answered_date + "</td>";
        innerTables += "<td>" + data[i].time_taken + "</td>";
        innerTables += "<td>" + data[i].score + "</td>";
        innerTables += "<td>" + data[i].out_of + "</td>";
        innerTables += "<td>" + data[i].total_answered + "</td>";
        innerTables += "<td>" + data[i].total_unanswered + "</td>";
        innerTables += "<td>" + data[i].total_correct + "</td>";
        innerTables += "<td>" + data[i].total_wrong + "</td>";
        innerTables += "</tr>";
    }

    innerTables += "</table>";

    $("#content").html(innerTables);
}


$("body").on("click", "#cmd", function () {
            html2canvas($('#tableReport')[0], {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download(""+ Qid +".pdf");
                }
            });
        });


$("#sortEmail").click(function(){
    var sqlEmail = "SELECT * FROM `response` "+
                    "WHERE quiz_id = '"+ Qid +"'"+
                    " ORDER BY email";
    getReport(sqlEmail);
});
$("#sortMarks").click(function(){
    var sqlMarks = "SELECT * FROM `response` "+
                    "WHERE quiz_id = '"+ Qid +"'"+
                    " ORDER BY score DESC";
    getReport(sqlMarks);
});
$("#sortTime").click(function(){
    var sqlTime = "SELECT * FROM `response` "+
                    "WHERE quiz_id = '"+ Qid +"'"+
                    " ORDER BY time_taken";
    getReport(sqlTime);
});



});
</script>
</body>
</html>