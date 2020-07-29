      
$("#quizName").html(quizInfo.quiz_name);
if(quizInfo.negative == "Yes"){
    $("#quizRules").html("Quiz Rules<br><ul>"+
    "<li>This quiz is organised by "+ quizInfo.organiser +".</li>"+
    "<li>Each correct question carries "+ quizInfo.marks +" marks.</li>"+
    "<li>For each wrong answer "+ quizInfo.negative_marks +" marks will be deducted.</li>"+
    "<li>Quiz duration is "+ quizInfo.time_limit +" minutes. After which the quiz will be auto submitted.</li>"+
    "</ul>");
    $("#quizRules").addClass("alert alert-info");
}

else{
    $("#quizRules").html("Quiz<br><ul>"+
    "<li>This quiz is organisd by "+ quizInfo.organiser +".</li>"+
    "<li>Each correct question carries "+ quizInfo.marks +" marks.</li>"+
    "<li>There is no negative marking.</li>"+
    "<li>Quiz duration is "+ quizInfo.time_limit +" minutes. After which the quiz will be auto submitted.</li>"+
    "</ul>");
    $("#quizRules").addClass("alert alert-info");
}




//--------------------------------------------------------------------------------------------
/* Kidnap all the html elements into variables */
var question = document.getElementById("question"); //Element to display the question
var option1 = document.getElementById("option-1"); //Element to display option-1 
var option2 = document.getElementById("option-2"); // Element to display option-2
var option3 = document.getElementById("option-3"); // Element to display option-3
var option4 = document.getElementById("option-4"); // Element to display option-4
var currentQuestion = document.getElementById("questionIndex"); //element to display the current question number
var next = document.getElementById("next"); //Next button
var prev = document.getElementById("prev"); // previous button
var allButtons = document.querySelectorAll('.options'); // All option buttons
var submit = document.getElementById("submit"); /* Submit button captured */


//-----------------------------------------------------------------------------------------

/* This function removes the btn-success class of all option buttons 
    and resets all the option buttons with btn-dark class before navigating to the next question
 */
function removeClass(){
    allButtons.forEach(function(navElement){
        if(navElement.classList.contains("btn-success")){
            navElement.classList.remove("btn-success");
            navElement.classList.add("btn-dark");
        }

        if(navElement.classList.contains("btn-danger")){
            navElement.classList.remove("btn-danger");
            navElement.classList.add("btn-dark");
        }

        if(navElement.classList.contains("btn-info")){
            navElement.classList.remove("btn-info");
            navElement.classList.add("btn-dark");
        }
        
    });   
}

function disableButtons(allButtons){
    allButtons.forEach(function(navElement){
        navElement.disabled = true;
    });
}

//--------------------------------------------------------------------------------------




function changebtnClass(){
    for(var i=0;i<quiz.questions.length;i++){
    if(submitted === 0)
    {
        let qIndex = i+1;
        qIndex = "#" + qIndex;
        if(quiz.questions[i].answered == 1)
        {

            $(qIndex).addClass("btn-primary")
        } 

        else{
            if($(qIndex).hasClass("btn-primary")){
                $(qIndex).removeClass("btn-primary");
            }
        }
    }

    if(submitted === 1)
    {
        let qIndex = i+1;
        qIndex = "#" + qIndex;
        if(quiz.questions[i].answered == 1)
        {
            if(quiz.questions[i].response === quiz.questions[i].answer)
            $(qIndex).addClass("btn-success");

            else
            $(qIndex).addClass("btn-danger");

        } 

        else{
                $(qIndex).addClass("btn-default");
            }
        }
    }



}













/*  This function displays the current question in the html elements kidnapped earlier 
    initially the questionIndex is 0, so the first object in the quiz.questions array will be displayed first
*/
function showQuestion(){
    removeClass();
    question.innerHTML = quiz.questions[quiz.questionIndex].question;
    option1.innerHTML = quiz.questions[quiz.questionIndex].options[0];
    option2.innerHTML = quiz.questions[quiz.questionIndex].options[1];
    option3.innerHTML = quiz.questions[quiz.questionIndex].options[2];
    option4.innerHTML = quiz.questions[quiz.questionIndex].options[3];
    currentQuestion.innerHTML = "Q- " + (quiz.questionIndex + 1) + " of " + quiz.questions.length;
    


    if(submitted === 0){
        if(quiz.questionIndex < quiz.questions.length -1 ){  
            submit.style.display = 'none';
        } 
        else{
            submit.style.display = 'inline-block';
        }

        if(quiz.questions[quiz.questionIndex].response !== undefined){   
        let response = quiz.questions[quiz.questionIndex].response;
        response = "#option-" + (response + 1);
        
        let selectedButton = document.querySelector(response);
        selectedButton.classList.add("btn-success");
        selectedButton.classList.remove("btn-dark");
        }


    }

    else if(submitted === 1){
        disableButtons(allButtons);
        let response1 = quiz.questions[quiz.questionIndex].response;
        let answer = quiz.questions[quiz.questionIndex].answer;
        let correctAnswer = document.querySelector("#option-" + (answer + 1));
        if(quiz.questions[quiz.questionIndex].answered === 0){
            correctAnswer.classList.add("btn-info");
            correctAnswer.classList.remove("btn-dark");
        }

        else if(quiz.questions[quiz.questionIndex].answered === 1){
            let selectedButton = document.querySelector("#option-" + (response1 + 1));
            if(response1 === answer){
                correctAnswer.classList.add("btn-success");
                correctAnswer.classList.remove("btn-dark");
            }
            else{
                correctAnswer.classList.add("btn-success");
                correctAnswer.classList.remove("btn-dark");
                selectedButton.classList.add("btn-danger");
                selectedButton.classList.remove("btn-dark");
            }
        }
        
        
    }
}





//---------------------------------------------------
/*
$(".qBtn").click(function(){
    var qIndex = $(this).attr("id");
    qIndex -= 1;
    quiz.questionIndex = qIndex;
    showQuestion(); 
});
*/

function navigate(button){
     var qIndex = button.getAttribute("id");
    qIndex -= 1;
    quiz.questionIndex = qIndex;
    showQuestion(); 
}











/* An event Listener is already added to all the option buttons which calls below function
    when user clicks on any option an index (0 to 3) gets stored in the current question's response property
    and it is also highlighted on the html page as the color of the button changes
*/
function storeResponse(button){
    if(submitted === 0){
        var index = button.id.split("-");
        if(quiz.questions[quiz.questionIndex].answered === 0){
            quiz.questions[quiz.questionIndex].answered = 1;
            quiz.questions[quiz.questionIndex].response = parseInt(index[1]) -1 ;
            removeClass();
            if(button.classList.contains("btn-dark")){
                button.classList.add("btn-success");
                button.classList.remove("btn-dark");
            }
        }
        else if(quiz.questions[quiz.questionIndex].answered === 1 && quiz.questions[quiz.questionIndex].response === parseInt(index[1]) -1 ){
            quiz.questions[quiz.questionIndex].answered = 0;
            quiz.questions[quiz.questionIndex].response = undefined ;
            removeClass();    
        }  
        else{
            quiz.questions[quiz.questionIndex].answered = 0;
            storeResponse(button);
        }

        changebtnClass();
    }
}


/* when the User clicks on the next button next question is displayed
    quiz object's questionIndex property is incremented
*/
function nextQuestion(){
    
        if(quiz.questionIndex < quiz.questions.length -1){  
            quiz.questionIndex++;
            showQuestion();
        } 
        // else{
        //     alert("This is the last question, please submit");
        // }     
}
    
/* Event listener added on Next button to display the next question */
next.addEventListener("click", nextQuestion);

/* when the User clicks on the prev button previous question is displayed
    quiz object's questionIndex property is decremented
*/
function prevQuestion(){
    if(quiz.questionIndex > 0 ){  
        quiz.questionIndex--;
        showQuestion();
    } 
    // else{
    //     alert("This is the first question");
    // } 
}
/* Event listener added on Prev button to display the previous question */
prev.addEventListener("click", prevQuestion);


/* Element to display the Score after submitting */
var scoreElement = document.getElementById("result");

/* Function to calculate the score and display it
    This function will be called  when submit button is clicked    
*/
var totalAnswered,totalCorrect,totalWrong,totalUnanswered;
totalAnswered = 0;
totalUnanswered = 0;
totalWrong = 0;
totalCorrect = 0;
var responses = [];
var outOf;
var timeTaken;
function showScore(){
    outOf = quiz.questions.length * quizInfo.marks;
    var i;
    for(i=0 ; i < quiz.questions.length; i++){
        if(quiz.questions[i].answered == 1){
            totalAnswered++;
            responses.push(quiz.questions[i].response + 1);
            if(quiz.questions[i].response === quiz.questions[i].answer){
                quiz.score+= Number(quizInfo.marks);
                totalCorrect++;
                
            }
            else {quiz.score-= Number(quizInfo.negative_marks); totalWrong++;}
        }
        else { totalUnanswered++; responses.push("NA");}
            
    }
    
    submitted = 1;
    submit.disabled =true;
    showQuestion();
    clearInterval(interval);
    timeTaken = Number(quizInfo.time_limit) * 60 -time;
    changebtnClass();

    //console.log(timeTaken,responses,totalAnswered,totalUnanswered,totalCorrect,totalWrong,quiz.score,outOf);
    var comment = getComment(quiz.score);
    scoreElement.style.display = "block";
    scoreElement.innerHTML= "Hey " + quiz.participant + " you scored " + 
                            quiz.score + "/" + outOf +
                            "<br>" + comment + "<br>" + 
                            "Total Questions attempted: " + totalAnswered + "<br>"+
                            "Total Questions Unattempted: " + totalUnanswered + "<br>"+
                            "Total correct answers : " + totalCorrect + "<br>"+
                            "Total wrong answers : " + totalWrong + "<br>"+
                            "Total time taken : " + timeTaken + " seconds.<br>"+
                            "Please check your answers.";


    let xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange =  function(){
            if(this.status == 200 && this.readyState == 4){
                console.log(this.responseText);
            }
        };

        xhttp.open('GET',"submit.php?email="+ participant +
                    "&quizID="+ qid +
                    "&score="+ quiz.score +
                    "&totalAnswered="+ totalAnswered +
                    "&totalUnanswered="+ totalUnanswered +
                    "&totalCorrect="+ totalCorrect +
                    "&totalWrong="+ totalWrong +
                    "&outOf="+ outOf +
                    "&timeTaken="+ timeTaken +
                    "&responses="+ responses +
                    "&t="+ Math.random() 
                    ,true);
        xhttp.send();













}

function getPermission(){

    var i, flag = 0;
    for(i=0 ; i < quiz.questions.length; i++){
            if(quiz.questions[i].answered === 0){
                flag = 1;
                break;
            }
        }
    if(flag == 1)
    {
        let permit = 0;
        permit = prompt("You have not answered all the questions! Do you really want to continue. Enter 1 to continue, 0 to cancel");
        
        if(permit == 1)
        showScore();
    }

    else
    showScore();
    
}

submit.addEventListener("click", getPermission);

function getComment(score){
    let comment;
    if(score >= (outOf * 0.9)) 
    comment = "You are a genuis";

    else if(score >= (outOf * 0.65))
    comment = "Thats nice! You are on the right track";

    else if(score < (outOf * 0.4))
    comment = "You need to work hard!";

    return comment;
}



//-------------Timer---------------------------
let interval, timerDisplay;


let time = Number(quizInfo.time_limit) * 60;

timerDisplay = document.getElementById("timerDisplay");//show countdown element

interval = setInterval(displayCountdown, 1000);

function displayCountdown (){  
    time--;
    if(time < 0)
    {
        
        timerDisplay.innerHTML = "Time Out!";
        showScore();
    } 
    else
    {
        let minutes = Math.floor(time / 60);
        let seconds = time % 60;
    
        if(seconds < 10)
        seconds = '0' + seconds.toString();
        if(minutes < 10)
        minutes = '0' + minutes.toString();

        timerDisplay.innerHTML =minutes + " : " + seconds; 
    }
    
} 

