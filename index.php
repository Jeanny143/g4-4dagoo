<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guessing Game with Lives</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            text-align: center;
            margin: 20px;
        }

        form {
            display: inline-block;
            margin-top: 20px;
        }

        label {
            font-weight: bold;
        }

        input {
            padding: 8px;
            margin-right: 10px;
        }

        button {
            padding: 8px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        p {
            margin-top: 10px;
            color: #333;
        }

        a {
            color: #4CAF50;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<?php
// Define the list of fruits and vegetables
$items = ['apple', 'banana', 'carrot', 'broccoli', 'grape', 'lettuce', 'orange', 'tomato'];

// Check if the form is submitted
if(isset($_POST['submit'])){
    // Pick a random item from the list as the correct answer
    $correctAnswer = $items[array_rand($items)];
    
    // Set the initial number of lives if it's not set
    $lives = isset($_POST['lives']) ? $_POST['lives'] : 5;
    
    // Get user's guess from the form
    $userGuess = strtolower($_POST['guess']);

    // Check if the guess is correct
    if($userGuess == $correctAnswer){
        echo "<p>Congratulations! You guessed it right. The answer is $correctAnswer.</p>";
    } else {
        echo "<p>Sorry, that's incorrect. Try again!</p>";
        // Decrease the number of lives
        $lives--;

        // Check if the user has run out of lives
        if($lives <= 0){
            echo "<p>Game over! You've run out of lives. The correct answer was $correctAnswer.</p>";
            echo "<p><a href='".$_SERVER['PHP_SELF']."'>Play Again</a></p>";
            exit(); // Stop further execution to prevent duplicate form submission
        } else {
            echo "<p>Lives left: $lives</p>";
            // Include the remaining lives in the form for the next guess
            echo "<input type='hidden' name='lives' value='$lives'>";
        }
    }
} else {
    // Set the initial number of lives if it's the first time loading the page
    $lives = 5;
}
?>

<!-- Display the form -->
<form method="post" action="">
    <label for="guess">Guess the fruit or vegetable:</label>
    <input type="text" id="guess" name="guess" required>
    <button type="submit" name="submit">Submit</button>
    <!-- Include the initial number of lives in the form -->
    <input type="hidden" name="lives" value="<?php echo $lives; ?>">
</form>

</body>
</html>
