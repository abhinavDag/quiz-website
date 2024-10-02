<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add questions</title>
    <link rel="stylesheet" href="add_questions.css">
</head>
<body>
    
    <form name="add_questions" id="add_questions" method="post" action="add_questions.php">
        <div id="question_1">
            <input type="text" name="problem_1" id="problem_1" placeholder="Type in the question"><br>
                
            <input type="text" name="option_1_1" id="option_1_1" placeholder="Option 1"><br>
            <input type="text" name="option_2_1" id="option_2_1" placeholder="Option 2"><br>
            <input type="text" name="option_3_1" id="option_3_1" placeholder="Option 3"><br>
            <input type="text" name="option_4_1" id="option_4_1" placeholder="Option 4"><br>
            Choose the correct option:
                                        <select name="correct_1" id="correct_1">
                                            <option value="option_1_1">Option 1</option>
                                            <option value="option_2_1">Option 2</option>
                                            <option value="option_3_1">Option 3</option>
                                            <option value="option_4_1">Option 4</option>
                                        </select><br>

            <input type="number" name="marks_1" id="marks_1" placeholder="Marks - 1.25,1,2.5,0" step="0.01">
        </div>

        <input id="submitButton" type="submit" value="Create">
    </form>
    
    <button onclick="duplicateDiv()">Add another question</button>

    
    
    <script src="add_questions.js"></script>
</body>
</html>