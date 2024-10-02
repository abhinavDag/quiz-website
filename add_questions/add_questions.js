let questionNumber = 1;
function duplicateDiv()
{

    //getting the boiler plate
    var question1 = document.getElementById('question_1');
    //creating the duplicate
    var nextQuestion = question1.cloneNode(true);

    //changing the duplicate to the required question number
    questionNumber++;

    nextQuestion.id = "question_"+questionNumber;
    nextQuestion.children[0].id = "problem_" + questionNumber;
    nextQuestion.children[0].name = "problem_" + questionNumber;

    nextQuestion.children[2].id = "option_1_" + questionNumber;
    nextQuestion.children[2].name = "option_1_" + questionNumber;
    nextQuestion.children[4].id = "option_2_" + questionNumber;
    nextQuestion.children[4].name = "option_2_" + questionNumber;
    nextQuestion.children[6].id = "option_3_" + questionNumber; 
    nextQuestion.children[6].name = "option_3_" + questionNumber;
    nextQuestion.children[8].id = "option_4_" + questionNumber;
    nextQuestion.children[8].name = "option_4_" + questionNumber;

    nextQuestion.children[10].name = "correct_" + questionNumber;
    nextQuestion.children[10].id = "correct_" + questionNumber;
    nextQuestion.children[10][0].value = "option_1_" + questionNumber;
    nextQuestion.children[10][1].value = "option_2_" + questionNumber;
    nextQuestion.children[10][2].value = "option_3_" + questionNumber;
    nextQuestion.children[10][3].value = "option_4_" + questionNumber;

    nextQuestion.children[12].name = "marks_" + questionNumber;
    nextQuestion.children[12].id = "marks_" + questionNumber;

    //appending the duplicated and updated division into the form
    document.getElementById("add_questions").appendChild(nextQuestion);
}