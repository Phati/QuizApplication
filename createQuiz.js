$(document).ready(function(){
    
    /* Function to hide and show negative marks option */
    let radioValue;
    $("input[name='nm']").click(function(){
        radioValue = $("input[name='nm']:checked").val();
        if(radioValue == 0)
        $("#nMarks").hide();
        else
        $("#nMarks").show();
    });


    $("#createQuiz").click(function createQuiz(){
        
        var quizName = $("#quizName").val();
        var email = $("#email").val();
        var organiser = $("#organiser").val();
        var timeLimit = $("#timeLimit").val();
        var marks = $("#marks").val();
        radioValue = $("input[name='nm']:checked").val();
        var negative;
        var negativemarks;
        if (radioValue == 1){
            negativemarks =$("#negativeMarks").val();
            negative = "Yes";
        }
        
        else{
            negativemarks = 0;
            negative = "No";
        }
        

        if(quizName == "" || organiser =="" || timeLimit == "" || marks == "" || email == ""){
                $("#quizMessage").css("display","block");
                $("#quizMessage").html("Pleease fill all the details");
            }

        else{
        var txt = quizName.split(" ").join("");
        var quizID = txt + Math.floor(Math.random() * 100) + new Date().getTime();        
        var xhttp; 
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    $("#quizMessage").css("display","block");
                    $("#quizMessage").html(this.responseText);
                    $("#quizName").val("");
                    $("#organiser").val("");
                    
                }
            };
            
        xhttp.open("GET", "createQuiz.php?quizName="+ quizName + 
                        "&organiser="+ organiser +
                        "&timeLimit=" + timeLimit +
                        "&marks=" + marks +
                        "&negative=" + negative +
                        "&negativemarks=" + negativemarks +
                        "&email=" + email +
                        "&quizID=" + quizID 
                        , true);
        
        xhttp.send();
        }
        //else ends here
        
    });
});