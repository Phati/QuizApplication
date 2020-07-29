$(document).ready(function () {

    $("#quizID").change(getQNo);
    
    function  getQNo() {
    var q = $(this).val();
    console.log(q);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if(this.responseText == "not_found"){
                $("#invalidQuiz").css("display","inline-block");
                $("#invalidQuiz").html("invalid Quiz ID");
                $("#questionNo").val("");
                $("#addQ").css("display","none");
            }
            else{
                $("#invalidQuiz").css("display","inline-block");
                $("#invalidQuiz").html("");
                $("#questionNo").val(this.responseText);
                $("#addQ").css("display","inline-block");
            }
            
            
        }
    };
    
xhttp.open("GET", "addQuestion.php?q="+ q +
                "&check=" + 0 + 
                "&t="+ Math.random() , true);

xhttp.send();
}

$("#addQ").click(function(){
    var q = $("#quizID").val();
    var question = document.getElementById("question").value;
    question = question.replace(/\n/g, "<br>");
    var option1 = $("#option1").val();
    var option2 = $("#option2").val();
    var option3 = $("#option3").val();
    var option4 = $("#option4").val();
    var correct =  $("#correct").val();
    if(question == "" || option1 === "" || option2 == "" || option3 == "" 
    || option4 == "" || correct == ""){
        $("#addMessage").css("display","block");
        $("#addMessage").html("Please fill all the details");
    }
    else if(correct <1 || correct > 4){
        $("#addMessage").css("display","block");
        $("#addMessage").html("Correct option should bebetween 1 and 4");
    }
    else{
        let xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange =  function(){
            if(this.status == 200 && this.readyState == 4){
                $("#addMessage").css("display","block");
                $("#addMessage").html(this.responseText);
                var n = $("#questionNo").val();
                n = Number(n) + 1;
                console.log(n);
                $("#questionNo").val(n);
                $("#question, #option1,#option2,#option3,#option4,#correct").val("");
            }
        };

        xhttp.open('GET',"addQuestion.php?check="+ 1 +
                    "&question="+ question +
                    "&option1="+ option1 +
                    "&option2="+ option2 +
                    "&option3="+ option3 +
                    "&option4="+ option4 +
                    "&correct="+ correct +
                    "&q="+ q 
                    ,true);
        xhttp.send();
    }
    getQNo();
    
});
   
});